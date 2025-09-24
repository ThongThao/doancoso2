@extends('admin_layout')

@section('content_dash')
<?php use Illuminate\Support\Facades\Session; ?>
<link rel="stylesheet" href="{{ asset('admin/css/admin-chat.css') }}">

<div class="content-page">
<div class="container-fluid">
	<div class="row g-0 chat-container">
		<div class="col-md-4 col-lg-3">
			<div class="chat-sidebar">
				<div class="chat-sidebar-header">
					<div class="d-flex align-items-center justify-content-between">
						<div class="d-flex align-items-center">
							<div class="admin-avatar me-3">
								<i class="fas fa-user-shield"></i>
							</div>
							<div>
								<h6 class="mb-0 text-white">Admin Chat</h6>
								<small class="text-white-50">Hỗ trợ khách hàng</small>
							</div>
						</div>
						<div class="chat-actions">
							<button class="btn btn-sm btn-outline-light" id="refresh-threads" title="Làm mới">
								<i class="fas fa-sync-alt"></i>
							</button>
						</div>
					</div>
				</div>
				<div class="chat-search">
					<div class="position-relative">
						<input type="text" class="form-control" id="search-threads" placeholder="Tìm kiếm cuộc trò chuyện...">
						<i class="fas fa-search search-icon"></i>
					</div>
				</div>
				<div class="chat-threads">
					<ul id="threads" class="thread-list"></ul>
				</div>
			</div>
		</div>
		<div class="col-md-8 col-lg-9">
			<div class="chat-main">
				<div class="chat-header" id="chat-header">
					<div class="d-flex align-items-center">
						<div class="customer-avatar me-3" id="customer-avatar">
							<span>?</span>
						</div>
						<div class="flex-grow-1">
							<h6 class="mb-0" id="chat-title">Chọn cuộc trò chuyện</h6>
							<small class="text-muted" id="chat-status">Sẵn sàng hỗ trợ</small>
						</div>
						<div class="chat-header-actions">
							<button class="btn btn-sm btn-outline-secondary me-2" id="chat-info" title="Thông tin">
								<i class="fas fa-info-circle"></i>
							</button>
							<button class="btn btn-sm btn-outline-secondary" id="chat-settings" title="Cài đặt">
								<i class="fas fa-cog"></i>
							</button>
						</div>
					</div>
				</div>
				<div id="messages" class="chat-messages">
					<div class="welcome-message">
						<div class="welcome-icon">
							<i class="fas fa-comments"></i>
						</div>
						<h5>Chào mừng đến với Admin Chat</h5>
						<p class="text-muted">Chọn một cuộc trò chuyện để bắt đầu hỗ trợ khách hàng</p>
					</div>
				</div>
					<div class="chat-input-area">
					<div class="typing-indicator" id="typing-indicator" style="display: none;">
						<div class="typing-dots">
							<span></span>
							<span></span>
							<span></span>
						</div>
						<span class="typing-text">Khách hàng đang nhập...</span>
					</div>
					<div class="chat-input-container">
							<input id="admin_id" type="hidden" value="{{ Session::get('idAdmin') }}" />
						<div class="input-group">
							<button class="btn btn-outline-secondary" type="button" id="attach-file" title="Đính kèm file">
								<i class="fas fa-paperclip"></i>
							</button>
							<input id="reply" type="text" class="form-control chat-input" placeholder="Nhập tin nhắn..." autocomplete="off" />
							<button class="btn btn-outline-secondary" type="button" id="emoji-picker" title="Emoji">
								<i class="fas fa-smile"></i>
							</button>
							<button id="send" class="btn btn-primary send-btn" disabled>
								<i class="fas fa-paper-plane"></i>
							</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</div>

<script>
let currentThreadId = null;
let threadsData = {};
let messagePollingInterval = null;
let threadPollingInterval = null;
let notificationPollingInterval = null;
let lastMessageCount = 0; // Đếm tin nhắn để detect tin nhắn mới
let lastThreadUpdate = new Date(); // Track last update time
let isTyping = false;
let threadUnreadCounts = {}; // Track unread counts per thread
let lastReadMessageId = {}; // Track last read message ID per thread

// Helpers: extract customer info and resolve avatar URL
function isAbsoluteUrl(url) {
	return /^https?:\/\//i.test(url) || url?.startsWith('/');
}

function resolveAvatarUrl(rawPath) {
	if (!rawPath) return null;
	if (isAbsoluteUrl(rawPath)) return rawPath;
	
	// Kiểm tra các đường dẫn phổ biến cho avatar
	const possiblePaths = [
    "{{asset('storage/admin/images/customer')}}/" + rawPath
];

	console.log('Avatar paths to try:', possiblePaths); // Debug
	
	// Trả về đường dẫn đầu tiên (storage)
	return possiblePaths[0];
}

function extractCustomerInfo(source) {
	// Dựa trên API ChatController::threads() - các field đã được JOIN từ customer table
	const id = source?.customer_id || source?.idCustomer || null;
	const name = source?.CustomerName || null; // Field từ customer.CustomerName 
	const avatarRaw = source?.Avatar || null; // Field từ customer.Avatar
	const avatarUrl = resolveAvatarUrl(avatarRaw);
	const isGuest = !id;
	const initial = isGuest ? 'G' : (name ? name.charAt(0).toUpperCase() : 'U');
	
	console.log('Customer info extracted:', { id, name, avatarRaw, avatarUrl, isGuest, initial }); // Debug
	
	return { id, name, avatarUrl, isGuest, initial };
}

// Initialize chat interface
document.addEventListener('DOMContentLoaded', function() {
	initializeChatInterface();
	requestNotificationPermission();
});

// Stop polling when leaving the page
window.addEventListener('beforeunload', function() {
	stopPolling();
});

// Stop polling when page becomes hidden (tab switch)
document.addEventListener('visibilitychange', function() {
	if (document.hidden) {
		console.log('Page hidden, reducing polling frequency...');
		// Keep polling but at lower frequency when page is hidden
		stopPolling();
		
		// Restart with lower frequency
		notificationPollingInterval = setInterval(() => {
			refreshUnreadCounts();
			if (window.updateChatUnreadBadge && typeof window.updateChatUnreadBadge === 'function') {
				window.updateChatUnreadBadge();
			}
		}, 10000); // 10 seconds when hidden
	} else {
		console.log('Page visible, resuming normal polling...');
		// Resume normal polling when page becomes visible
		stopPolling();
		startPolling();
	}
});

// Yêu cầu quyền thông báo
function requestNotificationPermission() {
	if ('Notification' in window && Notification.permission === 'default') {
		Notification.requestPermission().then(permission => {
			if (permission === 'granted') {
				console.log('Notification permission granted');
			}
		});
	}
}

function initializeChatInterface() {
	// Add event listeners
	document.getElementById('search-threads').addEventListener('input', handleThreadSearch);
	document.getElementById('refresh-threads').addEventListener('click', fetchThreads);
	document.getElementById('reply').addEventListener('input', handleInputChange);
	document.getElementById('reply').addEventListener('keypress', handleKeyPress);
	document.getElementById('send').addEventListener('click', sendMessage);
	document.getElementById('attach-file').addEventListener('click', handleFileAttach);
	document.getElementById('emoji-picker').addEventListener('click', handleEmojiPicker);
	
	// Initial load
	fetchThreads();
	startPolling();
}

function fetchThreads(showLoading = true) {
	const refreshBtn = document.getElementById('refresh-threads');
	if (showLoading) {
		refreshBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';
	}
	
	// Fetch both threads and unread counts (sử dụng web routes)
	Promise.all([
		fetch('{{ url('admin/api/chat/threads') }}').then(r => r.json()),
		fetch('{{ url('admin/api/chat/thread-unread-counts') }}').then(r => r.json())
	])
		.then(([threadsResponse, unreadResponse]) => {
			console.log('Threads API Response:', threadsResponse); // Debug
			console.log('Unread counts:', unreadResponse); // Debug
			
			// Update unread counts
			threadUnreadCounts = unreadResponse.counts || {};
			
			const ul = document.getElementById('threads');
			ul.innerHTML = '';
			
			if (threadsResponse.threads && threadsResponse.threads.length > 0) {
				threadsResponse.threads.forEach(t => {
					console.log('Processing thread:', t); // Debug mỗi thread
					threadsData[t.id] = t;
					const li = document.createElement('li');
					li.className = 'thread-item fade-in';
					li.dataset.threadId = t.id; // Store thread ID for easy access
					li.onclick = (e) => {
						e.preventDefault();
						selectThread(t.id, li);
					};
					
					// Extract customer info based on DB structure
					const info = extractCustomerInfo(t);
					const displayName = info.isGuest ? 'Khách vãng lai' : (info.name || ('Khách hàng #' + (info.id || 'N/A')));
					
					// Get actual unread count for this thread
					const unreadCount = threadUnreadCounts[t.id] || 0;
					
					li.innerHTML = `
						<div class="d-flex align-items-center">
							<div class="thread-avatar ${info.isGuest ? 'guest' : 'user'}">${info.avatarUrl ? `<img class="avatar-img" src="${info.avatarUrl}" alt="avatar" />` : info.initial}</div>
							<div class="thread-info">
								<div class="thread-name">${displayName}</div>
								<div class="thread-last-message">${t.last_message || 'Chưa có tin nhắn'}</div>
							</div>
							<div class="d-flex flex-column align-items-end">
								<div class="thread-time">${formatTime(t.updated_at)}</div>
								${unreadCount > 0 ? `<div class="thread-unread">${unreadCount}</div>` : ''}
							</div>
						</div>
					`;
					
					// Add visual indicator for threads with unread messages
					if (unreadCount > 0) {
						li.classList.add('has-unread');
					}
					
					ul.appendChild(li);
				});
			} else {
				// Demo data nếu không có threads
				console.log('No threads, creating demo data');
				const demoThreads = [
					{
						id: 1,
						customer_id: 1,
						CustomerName: 'Nguyễn Văn A',
						Avatar: 'avatars/demo1.jpg',
						last_message: 'Xin chào, tôi cần hỗ trợ',
						updated_at: new Date().toISOString()
					},
					{
						id: 2,
						customer_id: null,
						CustomerName: null,
						Avatar: null,
						last_message: 'Tôi muốn tư vấn sản phẩm',
						updated_at: new Date(Date.now() - 300000).toISOString() // 5 phút trước
					}
				];
				
				demoThreads.forEach(t => {
					threadsData[t.id] = t;
					const li = document.createElement('li');
					li.className = 'thread-item fade-in';
					li.onclick = (e) => {
						e.preventDefault();
						selectThread(t.id, li);
					};
					
					const info = extractCustomerInfo(t);
					const displayName = info.isGuest ? 'Khách vãng lai' : (info.name || ('Khách hàng #' + (info.id || 'N/A')));
					
					li.innerHTML = `
						<div class="d-flex align-items-center">
							<div class="thread-avatar ${info.isGuest ? 'guest' : 'user'}">${info.avatarUrl ? `<img class="avatar-img" src="${info.avatarUrl}" alt="avatar" />` : info.initial}</div>
							<div class="thread-info">
								<div class="thread-name">${displayName}</div>
								<div class="thread-last-message">${t.last_message || 'Chưa có tin nhắn'}</div>
							</div>
							<div class="d-flex flex-column align-items-end">
							<div class="thread-time">${formatTime(t.updated_at)}</div>
							</div>
						</div>
					`;
					
					ul.appendChild(li);
				});
			}
		})
		.catch(error => {
			console.error('Error fetching threads:', error);
			if (showLoading) {
				document.getElementById('threads').innerHTML = `
					<li class="text-center text-danger p-4">
						<i class="fas fa-exclamation-triangle mb-2"></i><br>
						Lỗi khi tải danh sách
					</li>
				`;
			}
		})
		.finally(() => {
			if (showLoading) {
				refreshBtn.innerHTML = '<i class="fas fa-sync-alt"></i>';
			}
		});
}

// Kiểm tra tin nhắn chưa đọc và thông báo
function checkUnreadMessages() {
	fetch('{{ url('admin/api/chat/unread-count') }}')
		.then(r => r.json())
		.then(data => {
			if (data.unread_count > 0) {
				updateUnreadBadge(data.unread_count);
				// Thông báo browser notification nếu được phép
				if (Notification.permission === 'granted') {
					new Notification(`Có ${data.unread_count} tin nhắn mới`, {
						icon: '{{ asset("admin/images/chat-icon.png") }}',
						tag: 'new-messages'
					});
				}
			}
		})
		.catch(error => console.error('Error checking unread messages:', error));
}

// Cập nhật badge số tin nhắn chưa đọc
function updateUnreadBadge(count) {
	let badge = document.getElementById('unread-badge');
	if (!badge) {
		badge = document.createElement('span');
		badge.id = 'unread-badge';
		badge.className = 'badge badge-danger';
		badge.style.cssText = 'position: absolute; top: -5px; right: -5px; font-size: 10px;';
		document.querySelector('.chat-header h4').style.position = 'relative';
		document.querySelector('.chat-header h4').appendChild(badge);
	}
	
	if (count > 0) {
		badge.textContent = count > 99 ? '99+' : count;
		badge.style.display = 'inline-block';
	} else {
		badge.style.display = 'none';
	}
}

function handleThreadSearch(e) {
	const searchTerm = e.target.value.toLowerCase();
	const threadItems = document.querySelectorAll('.thread-item');
	
	threadItems.forEach(item => {
		const threadName = item.querySelector('.thread-name').textContent.toLowerCase();
		const lastMessage = item.querySelector('.thread-last-message').textContent.toLowerCase();
		
		if (threadName.includes(searchTerm) || lastMessage.includes(searchTerm)) {
			item.style.display = 'block';
		} else {
			item.style.display = 'none';
		}
	});
}

function startPolling() {
	console.log('Starting chat page polling...');
	
	// Stop global badge auto-update to prevent conflicts
	if (window.stopChatAutoUpdate && typeof window.stopChatAutoUpdate === 'function') {
		window.stopChatAutoUpdate();
	}
	
	// Poll for threads every 8 seconds (tăng tần suất)
	threadPollingInterval = setInterval(() => {
		fetchThreads(false); // false = không scroll, không làm gián đoạn UI
	}, 8000);
	
	// Poll for new messages in current thread every 2 seconds
	messagePollingInterval = setInterval(() => {
		if (currentThreadId) {
			fetchMessages(currentThreadId, false); // false = không scroll tự động
		}
	}, 2000);
	
	// Poll for unread counts every 2 seconds (tăng tần suất cho responsive hơn)
	notificationPollingInterval = setInterval(() => {
		refreshUnreadCounts();
		checkUnreadMessages();
		
		// Update global badge as well
		if (window.updateChatUnreadBadge && typeof window.updateChatUnreadBadge === 'function') {
			window.updateChatUnreadBadge();
		}
	}, 2000);
}

// Stop polling when leaving chat page
function stopPolling() {
	console.log('Stopping chat page polling...');
	
	if (threadPollingInterval) {
		clearInterval(threadPollingInterval);
		threadPollingInterval = null;
	}
	
	if (messagePollingInterval) {
		clearInterval(messagePollingInterval);
		messagePollingInterval = null;
	}
	
	if (notificationPollingInterval) {
		clearInterval(notificationPollingInterval);
		notificationPollingInterval = null;
	}
	
	// Restart global badge auto-update
	if (window.startChatAutoUpdate && typeof window.startChatAutoUpdate === 'function') {
		window.startChatAutoUpdate();
	}
}

function selectThread(id, threadElement) {
	currentThreadId = id;
	
	// Update active state
	document.querySelectorAll('.thread-item').forEach(item => item.classList.remove('active'));
	if (threadElement) {
		threadElement.classList.add('active');
	}
	
	// Update chat header
	const thread = threadsData[id];
	const info = extractCustomerInfo(thread);
	const displayName = info.isGuest ? 'Khách vãng lai' : (info.name || ('Khách hàng #' + (info.id || 'N/A')));
	
	document.getElementById('chat-title').textContent = displayName;
	document.getElementById('chat-status').textContent = info.isGuest ? 'Khách vãng lai' : 'Khách hàng đã đăng ký';
	
	// Update customer avatar
	const customerAvatar = document.getElementById('customer-avatar');
	customerAvatar.innerHTML = info.avatarUrl ? `<img class="avatar-img" src="${info.avatarUrl}" alt="avatar" />` : `<span>${info.initial}</span>`;
	customerAvatar.className = `customer-avatar ${info.isGuest ? 'guest' : 'user'}`;
	
	// Mark thread as read and update UI
	markThreadAsRead(id);
	updateThreadUnreadBadge(threadElement, 0);
	threadUnreadCounts[id] = 0;
	
	// Fetch and display messages
	fetchMessages(id, true);
}

function fetchMessages(threadId, scrollToBottom = true) {
	console.log('Fetching messages for thread:', threadId, 'scrollToBottom:', scrollToBottom); // Debug
	
	fetch(`{{ url('admin/api/chat') }}/${threadId}/messages`)
		.then(r => {
			console.log('Messages API response status:', r.status); // Debug
			if (!r.ok) {
				throw new Error(`HTTP ${r.status}: ${r.statusText}`);
			}
			return r.json();
		})
		.then(data => {
			console.log('Messages data:', data); // Debug
			const box = document.getElementById('messages');
			if (!box) {
				console.error('Messages container not found');
				return;
			}
			
			const currentScrollTop = box.scrollTop;
			const currentScrollHeight = box.scrollHeight;
			let newMessagesCount = 0;
			
			if (scrollToBottom) {
			box.innerHTML = '';
				box.style.display = 'block';
				box.style.flexDirection = 'column';
				lastMessageCount = data.messages ? data.messages.length : 0;
			}
			
			if (data.messages && data.messages.length > 0) {
				const thread = threadsData[threadId];
				data.messages.forEach(m => {
					if (!scrollToBottom) {
						// Check if message already exists
						const existingMessage = box.querySelector(`[data-message-id="${m.id}"]`);
						if (!existingMessage) {
							appendMessage(m, thread);
							newMessagesCount++;
							
							// Hiển thị notification cho tin nhắn mới (không phải từ admin)
							if (!m.sender_admin_id && threadId === currentThreadId) {
								showNewMessageNotification(m, thread);
							}
						}
					} else {
					appendMessage(m, thread);
					}
				});
				
				// Cập nhật số lượng tin nhắn để track changes
				if (!scrollToBottom && data.messages.length > lastMessageCount) {
					newMessagesCount = data.messages.length - lastMessageCount;
					lastMessageCount = data.messages.length;
				}
				
				if (scrollToBottom) {
					box.scrollTop = box.scrollHeight;
				} else {
					// Auto scroll nếu có tin nhắn mới và user đang ở gần cuối
					const isNearBottom = (box.scrollTop + box.clientHeight) >= (box.scrollHeight - 50);
					if (newMessagesCount > 0 && isNearBottom) {
						box.scrollTop = box.scrollHeight;
					} else if (newMessagesCount > 0) {
						// Hiển thị badge "tin nhắn mới" nếu user không ở cuối
						showNewMessagesBadge(newMessagesCount);
					}
				}
			} else if (scrollToBottom) {
				// Demo messages nếu không có tin nhắn thật
				const thread = threadsData[threadId];
				if (thread) {
					const demoMessages = [
						{
							id: 1,
							message: 'Xin chào! Tôi cần hỗ trợ về sản phẩm.',
							sender_admin_id: null,
							sender_customer_id: thread.customer_id,
							created_at: new Date(Date.now() - 600000).toISOString() // 10 phút trước
						},
						{
							id: 2,
							message: 'Chào bạn! Chúng tôi sẵn sàng hỗ trợ bạn. Bạn cần tư vấn sản phẩm gì?',
							sender_admin_id: 1,
							sender_customer_id: null,
							created_at: new Date(Date.now() - 300000).toISOString() // 5 phút trước
						},
						{
							id: 3,
							message: 'Tôi muốn biết thêm về dòng sản phẩm mới nhất.',
							sender_admin_id: null,
							sender_customer_id: thread.customer_id,
							created_at: new Date().toISOString()
						}
					];
					
					demoMessages.forEach(m => appendMessage(m, thread));
					box.scrollTop = box.scrollHeight;
			} else {
				showEmptyState();
			}
			}
		})
		.catch(error => {
			console.error('Error fetching messages:', error);
			
			// Show error in UI
			const box = document.getElementById('messages');
			if (box && scrollToBottom) {
				box.innerHTML = `
					<div class="text-center text-danger p-4">
						<i class="fas fa-exclamation-triangle mb-2" style="font-size: 24px;"></i><br>
						Không thể tải tin nhắn. Vui lòng thử lại sau.
						<br><button class="btn btn-sm btn-outline-primary mt-2" onclick="fetchMessages(${threadId}, true)">
							<i class="fas fa-redo"></i> Thử lại
						</button>
					</div>
				`;
			}
		});
}

// Hiển thị thông báo tin nhắn mới
function showNewMessageNotification(message, thread) {
	const info = extractCustomerInfo(thread);
	const senderName = info.isGuest ? 'Khách vãng lai' : (info.name || 'Khách hàng');
	
	// Toast notification trong UI
	showToast(`Tin nhắn mới từ ${senderName}`, message.message.substring(0, 50) + '...');
	
	// Browser notification
	if (Notification.permission === 'granted') {
		new Notification(`Tin nhắn mới từ ${senderName}`, {
			body: message.message.substring(0, 100),
			icon: info.avatarUrl || '{{ asset("admin/images/default-avatar.png") }}',
			tag: `message-${message.id}`
		});
	}
	
	// Sound notification (optional)
	playNotificationSound();
	
	// Update global navbar badge
	if (window.updateChatUnreadBadge && typeof window.updateChatUnreadBadge === 'function') {
		setTimeout(() => {
			window.updateChatUnreadBadge();
		}, 500); // Small delay to ensure DB is updated
	}
}

// Hiển thị badge tin nhắn mới
function showNewMessagesBadge(count) {
	let badge = document.getElementById('new-messages-badge');
	if (!badge) {
		badge = document.createElement('div');
		badge.id = 'new-messages-badge';
		badge.className = 'new-messages-badge';
		badge.onclick = scrollToBottom;
		document.getElementById('messages').parentNode.appendChild(badge);
	}
	
	badge.textContent = `${count} tin nhắn mới`;
	badge.style.display = 'block';
	
	// Auto hide after 5 seconds
	setTimeout(() => {
		if (badge) badge.style.display = 'none';
	}, 5000);
}

// Scroll to bottom function
function scrollToBottom() {
	const box = document.getElementById('messages');
	box.scrollTop = box.scrollHeight;
	const badge = document.getElementById('new-messages-badge');
	if (badge) badge.style.display = 'none';
}

// Hiển thị toast notification
function showToast(title, message) {
	const toast = document.createElement('div');
	toast.className = 'toast-notification';
	toast.innerHTML = `
		<div class="toast-header">
			<i class="fas fa-comment-alt"></i>
			<strong>${title}</strong>
			<button type="button" class="close" onclick="this.parentElement.parentElement.remove()">×</button>
		</div>
		<div class="toast-body">${message}</div>
	`;
	
	document.body.appendChild(toast);
	
	// Auto remove after 4 seconds
	setTimeout(() => {
		if (toast.parentNode) toast.remove();
	}, 4000);
}

// Play notification sound
function playNotificationSound() {
	try {
		// Try to play notification sound
		const audio = new Audio('{{ asset("admin/sounds/notification.mp3") }}');
		audio.volume = 0.5;
		audio.play().catch(e => {
			console.log('Could not play notification sound file, using system sound');
			// Fallback to system beep if file not available
			playSystemBeep();
		});
	} catch (e) {
		console.log('Notification sound not available, using system beep');
		playSystemBeep();
	}
}

// System beep fallback
function playSystemBeep() {
	try {
		// Create short beep sound using Web Audio API
		const audioContext = new (window.AudioContext || window.webkitAudioContext)();
		const oscillator = audioContext.createOscillator();
		const gainNode = audioContext.createGain();
		
		oscillator.connect(gainNode);
		gainNode.connect(audioContext.destination);
		
		oscillator.frequency.setValueAtTime(800, audioContext.currentTime);
		gainNode.gain.setValueAtTime(0.3, audioContext.currentTime);
		gainNode.gain.exponentialRampToValueAtTime(0.01, audioContext.currentTime + 0.3);
		
		oscillator.start(audioContext.currentTime);
		oscillator.stop(audioContext.currentTime + 0.3);
	} catch (e) {
		console.log('Web Audio API not supported');
	}
}

// Mark thread messages as read
function markThreadAsRead(threadId) {
	console.log('Marking thread as read:', threadId); // Debug
	
	// Add admin_id to body if available
	const adminId = '{{ Session::get("idAdmin") }}' || null;
	console.log('Admin ID:', adminId); // Debug
	
	fetch(`{{ url('admin/api/chat') }}/${threadId}/mark-read`, {
		method: 'POST',
		headers: {
			'Content-Type': 'application/json',
			'X-CSRF-TOKEN': '{{ csrf_token() }}'
		},
		body: JSON.stringify({
			admin_id: adminId
		})
	})
	.then(r => {
		console.log('Mark read response status:', r.status); // Debug
		if (!r.ok) {
			throw new Error(`HTTP ${r.status}: ${r.statusText}`);
		}
		return r.json();
	})
	.then(data => {
		console.log('Mark read response:', data); // Debug
		if (data.error) {
			console.error('Server error:', data.error);
			return;
		}
		console.log(`Marked ${data.marked_count} messages as read for thread ${threadId}`);
		
		// Update global badge in navbar if it exists
		if (window.updateChatUnreadBadge && typeof window.updateChatUnreadBadge === 'function') {
			window.updateChatUnreadBadge();
		}
	})
	.catch(error => {
		console.error('Error marking messages as read:', error);
	});
}

// Update unread badge for a specific thread element
function updateThreadUnreadBadge(threadElement, count) {
	if (!threadElement) return;
	
	// Remove existing badge
	const existingBadge = threadElement.querySelector('.thread-unread');
	if (existingBadge) {
		existingBadge.remove();
	}
	
	// Remove has-unread class
	threadElement.classList.remove('has-unread');
	
	// Add new badge if count > 0
	if (count > 0) {
		const badge = document.createElement('div');
		badge.className = 'thread-unread';
		badge.textContent = count;
		
		const timeContainer = threadElement.querySelector('.d-flex.flex-column.align-items-end');
		if (timeContainer) {
			timeContainer.appendChild(badge);
		}
		
		threadElement.classList.add('has-unread');
	}
}

// Refresh unread counts for all threads
function refreshUnreadCounts() {
	fetch('{{ url('admin/api/chat/thread-unread-counts') }}')
		.then(r => r.json())
		.then(data => {
			threadUnreadCounts = data.counts || {};
			
			// Update UI for all threads
			document.querySelectorAll('.thread-item').forEach(threadElement => {
				const threadId = getThreadIdFromElement(threadElement);
				if (threadId) {
					const unreadCount = threadUnreadCounts[threadId] || 0;
					updateThreadUnreadBadge(threadElement, unreadCount);
				}
			});
		})
		.catch(error => {
			console.error('Error refreshing unread counts:', error);
		});
}

// Helper to get thread ID from DOM element
function getThreadIdFromElement(threadElement) {
	return threadElement.dataset.threadId ? parseInt(threadElement.dataset.threadId) : null;
}

function appendMessage(message, thread) {
	const info = extractCustomerInfo(thread);
	const isAdmin = message.sender_admin_id;
	
	const messageDiv = document.createElement('div');
	messageDiv.className = `chat-message ${isAdmin ? 'admin' : (info.isGuest ? 'guest' : 'user')} slide-up`;
	messageDiv.setAttribute('data-message-id', message.id);
	
	// Create message content container
	const messageContent = document.createElement('div');
	messageContent.className = 'chat-message-content';
	
	// Create message bubble
	const bubble = document.createElement('div');
	bubble.className = `chat-bubble ${isAdmin ? 'admin' : (info.isGuest ? 'guest' : 'user')}`;
	bubble.textContent = message.message;
	
	// Create time display
	const timeDiv = document.createElement('div');
	timeDiv.className = 'message-time';
	timeDiv.textContent = formatTime(message.created_at);
	
	// Create avatar (only for non-admin messages on the left)
	if (!isAdmin) {
		const avatar = document.createElement('div');
		avatar.className = `message-avatar ${info.isGuest ? 'guest' : 'user'}`;
		if (info.avatarUrl) {
			avatar.innerHTML = `<img class="avatar-img" src="${info.avatarUrl}" alt="avatar" />`;
	} else {
			avatar.textContent = info.initial;
		}
		messageDiv.appendChild(avatar);
	}
	
	// Add bubble and time to content
	messageContent.appendChild(bubble);
	messageContent.appendChild(timeDiv);
	messageDiv.appendChild(messageContent);
	
	document.getElementById('messages').appendChild(messageDiv);
}

function showEmptyState() {
	const box = document.getElementById('messages');
	box.style.display = 'flex';
	box.style.flexDirection = 'column';
	box.innerHTML = `
		<div class="welcome-message fade-in">
			<div class="welcome-icon">
				<i class="fas fa-comments"></i>
			</div>
			<h5>Chưa có tin nhắn nào</h5>
			<p class="text-muted">Hãy bắt đầu cuộc trò chuyện với khách hàng!</p>
		</div>
	`;
}

function handleInputChange(e) {
	const sendBtn = document.getElementById('send');
	const message = e.target.value.trim();
	
	// Enable/disable send button
	sendBtn.disabled = !message;
	
	// Show typing indicator (simulate)
	if (message && !isTyping) {
		isTyping = true;
		// In a real implementation, you would send typing status to server
	} else if (!message && isTyping) {
		isTyping = false;
	}
}

function handleKeyPress(e) {
	if (e.key === 'Enter' && !e.shiftKey) {
		e.preventDefault();
		sendMessage();
	}
}

function sendMessage() {
	if (!currentThreadId) {
		showNotification('Vui lòng chọn cuộc trò chuyện', 'warning');
		return;
	}
	
	const input = document.getElementById('reply');
	const msg = input.value.trim();
	if (!msg) return;
	
	const sendBtn = document.getElementById('send');
	sendBtn.disabled = true;
	sendBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';
	
	fetch(`{{ url('api/chat') }}/${currentThreadId}/admin-reply`, {
		method: 'POST',
		headers: {
			'Content-Type': 'application/json',
			'X-CSRF-TOKEN': '{{ csrf_token() }}'
		},
		body: JSON.stringify({
			admin_id: document.getElementById('admin_id').value || 1,
			message: msg
		})
	}).then(response => {
		if (response.ok) {
			input.value = '';
			fetchMessages(currentThreadId, true);
			showNotification('Tin nhắn đã được gửi', 'success');
		} else {
			throw new Error('Failed to send message');
		}
	}).catch(error => {
		console.error('Error sending message:', error);
		showNotification('Lỗi khi gửi tin nhắn', 'error');
	}).finally(() => {
		sendBtn.disabled = false;
		sendBtn.innerHTML = '<i class="fas fa-paper-plane"></i>';
	});
}

function handleFileAttach() {
	showNotification('Tính năng đính kèm file đang được phát triển', 'info');
}

function handleEmojiPicker() {
	showNotification('Tính năng emoji đang được phát triển', 'info');
}

function showNotification(message, type = 'info') {
	// Create notification element
	const notification = document.createElement('div');
	notification.className = `alert alert-${type === 'error' ? 'danger' : type} alert-dismissible fade show position-fixed`;
	notification.style.cssText = 'top: 20px; right: 20px; z-index: 9999; min-width: 300px;';
	notification.innerHTML = `
		${message}
		<button type="button" class="btn-close" data-bs-dismiss="alert"></button>
	`;
	
	document.body.appendChild(notification);
	
	// Auto remove after 3 seconds
	setTimeout(() => {
		if (notification.parentNode) {
			notification.remove();
		}
	}, 3000);
}

function formatTime(timestamp) {
	if (!timestamp) return '';
	const date = new Date(timestamp);
	const now = new Date();
	const diffMs = now - date;
	const diffMins = Math.floor(diffMs / 60000);
	const diffHours = Math.floor(diffMs / 3600000);
	const diffDays = Math.floor(diffMs / 86400000);
	
	if (diffMins < 1) return 'Vừa xong';
	if (diffMins < 60) return `${diffMins} phút trước`;
	if (diffHours < 24) return `${diffHours} giờ trước`;
	if (diffDays < 7) return `${diffDays} ngày trước`;
	return date.toLocaleDateString('vi-VN', {
		day: '2-digit',
		month: '2-digit',
		year: 'numeric',
		hour: '2-digit',
		minute: '2-digit'
	});
}

// Add some utility functions for better UX
function scrollToBottom() {
	const messagesContainer = document.getElementById('messages');
	messagesContainer.scrollTop = messagesContainer.scrollHeight;
}

function showTypingIndicator() {
	const typingIndicator = document.getElementById('typing-indicator');
	typingIndicator.style.display = 'flex';
	setTimeout(() => {
		typingIndicator.style.display = 'none';
	}, 3000);
}

// Update customer avatar styling based on type
function updateCustomerAvatarStyle(customerAvatar, isGuest) {
	if (isGuest) {
		customerAvatar.style.background = 'linear-gradient(135deg, #FF9800, #F57C00)';
	} else {
		customerAvatar.style.background = 'linear-gradient(135deg, #4CAF50, #45a049)';
	}
}

// Add keyboard shortcuts
document.addEventListener('keydown', function(e) {
	// Ctrl/Cmd + K to focus search
	if ((e.ctrlKey || e.metaKey) && e.key === 'k') {
		e.preventDefault();
		document.getElementById('search-threads').focus();
	}
	
	// Escape to clear search
	if (e.key === 'Escape') {
		const searchInput = document.getElementById('search-threads');
		if (searchInput === document.activeElement) {
			searchInput.value = '';
			searchInput.dispatchEvent(new Event('input'));
		}
	}
});

// Smooth scrolling for messages
function smoothScrollToBottom() {
	const messagesContainer = document.getElementById('messages');
	messagesContainer.scrollTo({
		top: messagesContainer.scrollHeight,
		behavior: 'smooth'
	});
}

// Add message delivery animations
function animateMessageDelivery(messageElement) {
	messageElement.style.transform = 'scale(0.8)';
	messageElement.style.opacity = '0';
	
	setTimeout(() => {
		messageElement.style.transition = 'all 0.3s ease';
		messageElement.style.transform = 'scale(1)';
		messageElement.style.opacity = '1';
	}, 100);
}
</script>
@endsection