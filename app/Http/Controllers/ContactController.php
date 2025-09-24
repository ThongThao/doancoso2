<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Brand;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function contact()
    {
        $list_category = Category::get();
        $list_brand = Brand::get();

        return view('shop.contact.contact')->with(compact('list_category','list_brand'));
    }

    public function send(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'subject' => 'required|string|max:255',
            'message' => 'required|string'
        ]);

        // Xử lý gửi email ở đây
        // Có thể sử dụng Mail facade hoặc lưu vào database

        return redirect()->back()->with('success', 'Tin nhắn của bạn đã được gửi thành công!');
    }
}
