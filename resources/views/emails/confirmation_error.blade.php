<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lỗi xác nhận đơn hàng</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f4f4f4;
        }
        .container {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .error-header {
            text-align: center;
            color: #e74c3c;
            border-bottom: 2px solid #e74c3c;
            padding-bottom: 20px;
            margin-bottom: 30px;
        }
        .error-icon {
            font-size: 4rem;
            color: #e74c3c;
            margin-bottom: 20px;
        }
        .error-info {
            background-color: #ffebee;
            padding: 20px;
            border-radius: 5px;
            margin: 20px 0;
            border-left: 4px solid #e74c3c;
        }
        .btn {
            display: inline-block;
            background-color: #3498db;
            color: white;
            padding: 12px 24px;
            text-decoration: none;
            border-radius: 5px;
            margin: 10px 5px;
        }
        .btn:hover {
            background-color: #2980b9;
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            color: #7f8c8d;
            font-size: 0.9em;
            border-top: 1px solid #bdc3c7;
            padding-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="error-header">
            <div class="error-icon">❌</div>
            <h1>Không thể xác nhận đơn hàng</h1>
        </div>

        <div class="error-info">
            <h3>⚠️ Có lỗi xảy ra:</h3>
            <p>{{ $message }}</p>
        </div>

        <div style="text-align: center; margin: 30px 0;">
            <h3>Hướng dẫn giải quyết:</h3>
            <ul style="text-align: left; display: inline-block;">
                <li>Kiểm tra lại link trong email xác nhận</li>
                <li>Đảm bảo bạn click vào link trong vòng 24 giờ</li>
                <li>Liên hệ bộ phận hỗ trợ nếu vấn đề vẫn tiếp tục</li>
            </ul>
        </div>

        <div style="background-color: #f8f9fa; padding: 20px; border-radius: 5px; margin: 20px 0;">
            <h4>📞 Cần hỗ trợ?</h4>
            <p>Nếu bạn gặp khó khăn trong việc xác nhận đơn hàng, vui lòng liên hệ:</p>
            <p>📧 Email: support@ericshop.com</p>
            <p>📱 Hotline: 1900-xxxx</p>
            <p>💬 Live Chat: Truy cập website chúng tôi</p>
        </div>

        <div style="text-align: center;">
            <a href="{{ url('/') }}" class="btn">🏠 Về trang chủ</a>
            <a href="{{ url('/contact') }}" class="btn">📞 Liên hệ hỗ trợ</a>
        </div>

        <div class="footer">
            <p>Chúng tôi xin lỗi vì sự bất tiện này!</p>
            <p>&copy; {{ date('Y') }} EricShop. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
