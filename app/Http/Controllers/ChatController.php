<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Carbon;

class ChatController extends Controller
{
	public function threads(Request $request)
	{
		$threads = DB::table('chat_threads')
			->leftJoin('customer', 'customer.idCustomer', '=', 'chat_threads.customer_id')
			->orderByDesc('chat_threads.updated_at')
			->limit(100)
			->select(
				'chat_threads.*',
				DB::raw('customer.CustomerName as CustomerName'),
				DB::raw('customer.Avatar as Avatar'),
				DB::raw('customer.idCustomer as idCustomer'),
				DB::raw('(SELECT cm.message FROM chat_messages cm WHERE cm.thread_id = chat_threads.id ORDER BY cm.id DESC LIMIT 1) as last_message')
			)
			->get();

		return response()->json(['threads' => $threads]);
	}

	public function open(Request $request)
	{
		$validator = Validator::make($request->all(), [
			'customer_id' => 'nullable|integer|exists:customer,idCustomer',
			'guest_token' => 'nullable|string|max:100',
			'subject' => 'nullable|string|max:255',
		]);
		if ($validator->fails()) {
			return response()->json(['errors' => $validator->errors()], 422);
		}

		$customerId = $request->input('customer_id');
		if (!$customerId) { $customerId = Session::get('idCustomer'); }
		$guestToken = $request->input('guest_token');
		$subject = $request->input('subject');

		if (!$customerId && !$guestToken) {
			$guestToken = bin2hex(random_bytes(16));
		}

		$existing = DB::table('chat_threads')
			->when($customerId, function ($q) use ($customerId) { $q->where('customer_id', $customerId); })
			->when(!$customerId && $guestToken, function ($q) use ($guestToken) { $q->where('guest_token', $guestToken); })
			->where('is_closed', false)
			->first();

		if ($existing) {
			$threadId = $existing->id;
		} else {
			$threadId = DB::table('chat_threads')->insertGetId([
				'customer_id' => $customerId,
				'guest_token' => $guestToken,
				'subject' => $subject,
				'is_closed' => false,
				'created_by_admin_id' => null,
				'created_at' => now(),
				'updated_at' => now(),
			]);

			DB::table('chat_messages')->insert([
				'thread_id' => $threadId,
				'sender_admin_id' => null,
				'sender_customer_id' => $customerId,
				'sender_guest_token' => $guestToken,
				'message' => 'Xin chào! Chúng tôi đã nhận được yêu cầu của bạn. Nhấn "Tư vấn ngay" để bắt đầu.',
				'is_system' => true,
				'read_at' => null,
				'created_at' => now(),
				'updated_at' => now(),
			]);

			DB::table('chat_threads')->where('id', $threadId)->update(['updated_at' => now()]);
		}

		return response()->json([
			'thread_id' => $threadId,
			'guest_token' => $guestToken,
		]);
	}

	public function send(Request $request)
	{
		$validator = Validator::make($request->all(), [
			'thread_id' => 'required|integer|exists:chat_threads,id',
			'message' => 'required|string',
			'customer_id' => 'nullable|integer|exists:customer,idCustomer',
			'guest_token' => 'nullable|string|max:100',
		]);
		if ($validator->fails()) {
			return response()->json(['errors' => $validator->errors()], 422);
		}

		$threadId = (int) $request->input('thread_id');
		$message = $request->input('message');
		$customerId = $request->input('customer_id') ?: Session::get('idCustomer');
		$guestToken = $request->input('guest_token');

		$messageId = DB::table('chat_messages')->insertGetId([
			'thread_id' => $threadId,
			'sender_admin_id' => null,
			'sender_customer_id' => $customerId,
			'sender_guest_token' => $guestToken,
			'message' => $message,
			'is_system' => false,
			'read_at' => null,
			'created_at' => now(),
			'updated_at' => now(),
		]);

		DB::table('chat_threads')->where('id', $threadId)->update(['updated_at' => now()]);

		// Notify admins by email
		$admins = DB::table('admin')->select('Email')->whereNotNull('Email')->get();
		foreach ($admins as $a) {
			try {
				Mail::raw('Có tin nhắn mới từ khách hàng trong thread #' . $threadId . ': ' . $message, function ($m) use ($a) {
					$m->to($a->Email)->subject('Tin nhắn mới từ khách hàng');
				});
			} catch (\Throwable $e) {}
		}

		// Get the created message
		$createdMessage = DB::table('chat_messages')
			->where('id', $messageId)
			->first();

		return response()->json([
			'status' => 'ok',
			'message' => $createdMessage
		]);
	}

	public function getUnreadCountForCustomer(Request $request, int $threadId)
	{
		// Count unread admin messages in this thread
		$unreadCount = DB::table('chat_messages')
			->where('thread_id', $threadId)
			->whereNotNull('sender_admin_id') // Admin messages
			->whereNull('read_at')
			->count();

		return response()->json(['unread_count' => $unreadCount]);
	}

	public function listMessages(Request $request, int $threadId)
	{
		$since = $request->query('since');
		
		$query = DB::table('chat_messages')
			->where('thread_id', $threadId);
			
		// If 'since' parameter provided, only get messages after that ID
		if ($since) {
			$query->where('id', '>', $since);
		}
		
		$messages = $query->orderBy('id')->get();

		// Auto mark messages as read based on who is fetching
		$adminId = Session::get('idAdmin');
		if ($adminId) {
			// Admin is fetching - mark customer messages as read
			DB::table('chat_messages')
				->where('thread_id', $threadId)
				->whereNull('sender_admin_id') // Customer messages
				->whereNull('read_at')
				->update(['read_at' => now()]);
		} else {
			// Customer is fetching - mark admin messages as read
			DB::table('chat_messages')
				->where('thread_id', $threadId)
				->whereNotNull('sender_admin_id') // Admin messages
				->whereNull('read_at')
				->update(['read_at' => now()]);
		}

		return response()->json(['messages' => $messages]);
	}

	public function adminReply(Request $request, int $threadId)
	{
		$validator = Validator::make($request->all(), [
			'admin_id' => 'nullable|integer|exists:admin,idAdmin',
			'message' => 'required|string',
		]);
		if ($validator->fails()) {
			return response()->json(['errors' => $validator->errors()], 422);
		}

		$adminId = $request->input('admin_id') ?: Session::get('idAdmin');
		if (!$adminId) {
			return response()->json(['errors' => ['admin_id' => ['Thiếu admin đăng nhập']]], 422);
		}

		DB::table('chat_messages')->insert([
			'thread_id' => $threadId,
			'sender_admin_id' => (int) $adminId,
			'sender_customer_id' => null,
			'sender_guest_token' => null,
			'message' => $request->input('message'),
			'is_system' => false,
			'read_at' => null,
			'created_at' => now(),
			'updated_at' => now(),
		]);

		DB::table('chat_threads')->where('id', $threadId)->update(['updated_at' => now()]);

		return response()->json(['status' => 'ok']);
	}

	public function unreadCount(Request $request)
	{
		$adminId = Session::get('idAdmin');
		if (!$adminId) {
			return response()->json(['unread_count' => 0]);
		}

		// Count unread customer messages across all threads
		$unreadCount = DB::table('chat_messages')
			->whereNull('sender_admin_id') // Customer messages
			->whereNull('read_at') // Not read yet
			->count();

		return response()->json(['unread_count' => $unreadCount]);
	}

	public function markAsRead(Request $request, int $threadId)
	{
		$adminId = Session::get('idAdmin');
		\Log::info('markAsRead called', [
			'thread_id' => $threadId,
			'admin_id' => $adminId,
			'session_data' => Session::all()
		]);

		if (!$adminId) {
			return response()->json(['error' => 'Admin not logged in', 'session' => Session::all()], 401);
		}

		// Mark all customer messages in this thread as read
		$updated = DB::table('chat_messages')
			->where('thread_id', $threadId)
			->whereNull('sender_admin_id') // Customer messages only
			->whereNull('read_at')
			->update(['read_at' => now()]);

		\Log::info('Messages marked as read', [
			'thread_id' => $threadId,
			'updated_count' => $updated
		]);

		return response()->json([
			'status' => 'ok',
			'marked_count' => $updated,
			'thread_id' => $threadId
		]);
	}

	public function getThreadUnreadCounts(Request $request)
	{
		$adminId = Session::get('idAdmin');
		if (!$adminId) {
			return response()->json(['counts' => []]);
		}

		// Get unread counts for each thread
		$counts = DB::table('chat_messages')
			->select('thread_id', DB::raw('COUNT(*) as unread_count'))
			->whereNull('sender_admin_id') // Customer messages
			->whereNull('read_at') // Not read yet
			->groupBy('thread_id')
			->pluck('unread_count', 'thread_id');

		return response()->json(['counts' => $counts]);
	}
}


