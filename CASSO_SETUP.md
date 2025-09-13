# Hướng dẫn tích hợp Casso VietQR

## Tổng quan
Hệ thống đã được tích hợp thành công với Casso để hỗ trợ thanh toán bằng VietQR thay thế cho VNPay.

## Các tính năng đã triển khai
- ✅ Tạo mã QR VietQR tự động
- ✅ Kiểm tra giao dịch real-time
- ✅ Xử lý thanh toán tự động
- ✅ Webhook để nhận thông báo từ Casso
- ✅ Interface thanh toán thân thiện

## Cấu hình

### 1. Biến môi trường (.env)
Thêm các biến sau vào file `.env`:

```env
# Casso API Configuration
CASSO_API_KEY=your_casso_api_key
CASSO_API_SECRET=your_casso_api_secret
CASSO_BANK_ACCOUNT=your_bank_account_number
CASSO_BANK_ID=970415
CASSO_ACCOUNT_NAME=your_account_name
```

### 2. Mã ngân hàng phổ biến
| Ngân hàng | Mã | Tên viết tắt |
|-----------|-----|-------------|
| Vietinbank | 970415 | ICB |
| Vietcombank | 970436 | VCB |
| BIDV | 970418 | BIDV |
| Techcombank | 970407 | TCB |
| ACB | 970416 | ACB |
| VPBank | 970432 | VPB |
| TPBank | 970423 | TPB |
| Sacombank | 970403 | STB |
| MBBank | 970422 | MBB |
| AgriBank | 970405 | AGB |

### 3. Webhook URL (Tùy chọn)
Để nhận thông báo real-time, cấu hình webhook trong tài khoản Casso:
```
https://yourdomain.com/casso/webhook
```

## Quy trình thanh toán

### 1. Khách hàng chọn "Chuyển khoản qua VietQR"
- Hệ thống tạo mã QR tự động
- Hiển thị thông tin chuyển khoản

### 2. Khách hàng quét mã QR và chuyển khoản
- Ứng dụng ngân hàng tự động điền thông tin
- Khách hàng xác nhận chuyển khoản

### 3. Hệ thống xác nhận thanh toán
- Kiểm tra giao dịch mỗi 3 giây
- Tự động tạo đơn hàng khi phát hiện thanh toán
- Chuyển hướng đến trang thành công

## Files đã được tạo/sửa đổi

### Mới tạo:
- `app/Services/CassoService.php` - Service xử lý Casso API
- `app/Http/Controllers/CassoPaymentController.php` - Controller xử lý thanh toán
- `database/migrations/2025_01_21_000000_add_casso_fields_to_bills_table.php`
- `database/migrations/2025_01_21_000001_add_note_to_billhistory_table.php`
- `resources/views/admin/casso-setup.blade.php` - Trang hướng dẫn admin

### Đã sửa đổi:
- `routes/web.php` - Thêm routes cho Casso
- `resources/views/shop/cart/payment.blade.php` - Giao diện thanh toán
- `app/Http/Controllers/CartController.php` - Xử lý form thanh toán
- `app/Providers/AppServiceProvider.php` - Đăng ký service

## Kiểm tra hoạt động

### 1. Kiểm tra API Casso
```bash
php artisan tinker
```

```php
$casso = app(\App\Services\CassoService::class);
$result = $casso->generateVietQR(100000, 'Test payment', 'TEST123');
dd($result);
```

### 2. Kiểm tra routes
```bash
php artisan route:list | grep casso
```

### 3. Log kiểm tra
Xem file `storage/logs/laravel.log` để theo dõi quá trình thanh toán.

## Bảo mật

### 1. Webhook Security
- Xác thực signature từ Casso
- Validate dữ liệu webhook

### 2. API Security
- Bảo vệ API keys trong .env
- Sử dụng HTTPS cho production

## Troubleshooting

### 1. Không tạo được mã QR
- Kiểm tra API keys trong .env
- Kiểm tra kết nối internet
- Xem log error trong `storage/logs/laravel.log`

### 2. Không phát hiện thanh toán
- Kiểm tra số tiền chính xác
- Kiểm tra nội dung chuyển khoản
- Đảm bảo API Casso hoạt động

### 3. Lỗi database
- Chạy `php artisan migrate` để cập nhật cấu trúc
- Kiểm tra kết nối database

## Hỗ trợ
- Tài liệu Casso API: https://developer.casso.vn
- VietQR API: https://www.vietqr.io/intro
- Laravel Documentation: https://laravel.com/docs

## Ghi chú quan trọng
- Đây là môi trường test, hãy thay đổi cấu hình cho production
- Backup database trước khi deploy
- Test kỹ lưỡng trước khi go-live
