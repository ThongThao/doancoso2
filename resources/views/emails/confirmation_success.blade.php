<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xác nhận đơn hàng thành công</title>
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
        .success-header {
            text-align: center;
            color: #27ae60;
            border-bottom: 2px solid #27ae60;
            padding-bottom: 20px;
            margin-bottom: 30px;
        }
        .success-icon {
            font-size: 4rem;
            color: #27ae60;
            margin-bottom: 20px;
        }
        .order-info {
            background-color: #d5f4e6;
            padding: 20px;
            border-radius: 5px;
            margin: 20px 0;
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
        <div class="success-header">
            <div class="success-icon">✅</div>
            <h1>{{ $already_confirmed ? 'Đơn hàng đã được xác nhận' : 'Xác nhận thành công!' }}</h1>
        </div>

        <div class="order-info">
            <h3>📋 Thông tin đơn hàng</h3>
            <p><strong>Mã đơn hàng:</strong> #{{ $bill->idBill }}</p>
            <p><strong>Khách hàng:</strong> {{ $bill->CustomerName }}</p>
            <p><strong>Tổng tiền:</strong> {{ number_format($bill->TotalBill, 0, ',', '.') }}đ</p>
            <p><strong>Trạng thái:</strong> 
                @if($bill->Status == 1)
                    <span style="color: #27ae60; font-weight: bold;">Đã xác nhận</span>
                @elseif($bill->Status == 2)
                    <span style="color: #3498db; font-weight: bold;">Đang giao hàng</span>
                @elseif($bill->Status == 3)
                    <span style="color: #27ae60; font-weight: bold;">Đã giao hàng</span>
                @endif
            </p>
        </div>

        <div style="text-align: center; margin: 30px 0;">
            <h3>{{ $message }}</h3>
            @if(!$already_confirmed)
                <p>Cảm ơn bạn đã xác nhận đơn hàng. Chúng tôi sẽ xử lý và giao hàng trong thời gian sớm nhất.</p>
            @endif
        </div>

        <div style="background-color: #f8f9fa; padding: 20px; border-radius: 5px; margin: 20px 0;">
            <h4>📞 Cần hỗ trợ?</h4>
            <p>Nếu bạn có bất kỳ câu hỏi nào về đơn hàng, vui lòng liên hệ:</p>
            <p>📧 Email: support@ericshop.com</p>
            <p>📱 Hotline: 1900-xxxx</p>
        </div>

        <div style="text-align: center;">
            <a href="{{ url('/') }}" class="btn">🏠 Về trang chủ</a>
            <a href="{{ url('/ordered') }}" class="btn">📦 Xem đơn hàng của tôi</a>
        </div>

        <div class="footer">
            <p>Cảm ơn bạn đã mua sắm tại EricShop!</p>
            <p>&copy; {{ date('Y') }} EricShop. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
