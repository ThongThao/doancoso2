<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xác nhận đơn hàng</title>
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
        .header {
            text-align: center;
            color: #2c3e50;
            border-bottom: 2px solid #3498db;
            padding-bottom: 20px;
            margin-bottom: 30px;
        }
        .order-info {
            background-color: #ecf0f1;
            padding: 20px;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        .product-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .product-table th,
        .product-table td {
            border: 1px solid #bdc3c7;
            padding: 12px;
            text-align: left;
        }
        .product-table th {
            background-color: #3498db;
            color: white;
        }
        .product-table tr:nth-child(even) {
            background-color: #f8f9fa;
        }
        .total-row {
            font-weight: bold;
            background-color: #e8f4f8 !important;
        }
        .confirm-button {
            display: inline-block;
            background-color: #27ae60;
            color: white;
            padding: 15px 30px;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            margin: 20px 0;
            text-align: center;
        }
        .confirm-button:hover {
            background-color: #229954;
        }
        .warning {
            background-color: #fff3cd;
            border: 1px solid #ffeaa7;
            color: #856404;
            padding: 15px;
            border-radius: 5px;
            margin: 20px 0;
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
        <div class="header">
            <h1>🛒 Xác nhận đơn hàng</h1>
            <p>Cảm ơn bạn đã đặt hàng tại EricShop!</p>
        </div>

        <div class="order-info">
            <h3>📋 Thông tin đơn hàng</h3>
            <p><strong>Mã đơn hàng:</strong> #{{ $bill->idBill }}</p>
            <p><strong>Ngày đặt:</strong> {{ $bill->created_at->format('d/m/Y H:i') }}</p>
            <p><strong>Khách hàng:</strong> {{ $bill->CustomerName }}</p>
            <p><strong>Số điện thoại:</strong> {{ $bill->PhoneNumber }}</p>
            <p><strong>Địa chỉ giao hàng:</strong> {{ $bill->Address }}</p>
            <p><strong>Phương thức thanh toán:</strong> 
                @if($bill->Payment == 'cash')
                    Thanh toán khi nhận hàng
                @else
                    {{ $bill->Payment }}
                @endif
            </p>
        </div>

        <h3>📦 Chi tiết sản phẩm</h3>
        <table class="product-table">
            <thead>
                <tr>
                    <th>Sản phẩm</th>
                    <th>Phân loại</th>
                    <th>Số lượng</th>
                    <th>Đơn giá</th>
                    <th>Thành tiền</th>
                </tr>
            </thead>
            <tbody>
                @foreach($billItems as $item)
                <tr>
                    <td>{{ $item->product->ProductName ?? 'N/A' }}</td>
                    <td>{{ $item->AttributeProduct ?? 'Không có' }}</td>
                    <td>{{ $item->QuantityBuy }}</td>
                    <td>{{ number_format($item->Price, 0, ',', '.') }}đ</td>
                    <td>{{ number_format($item->Price * $item->QuantityBuy, 0, ',', '.') }}đ</td>
                </tr>
                @endforeach
                <tr class="total-row">
                    <td colspan="4"><strong>Tổng cộng:</strong></td>
                    <td><strong>{{ number_format($bill->TotalBill, 0, ',', '.') }}đ</strong></td>
                </tr>
            </tbody>
        </table>

        <div class="warning">
            <h4>⚠️ Quan trọng:</h4>
            <p>Để hoàn tất đơn hàng, vui lòng click vào nút "XÁC NHẬN ĐƠN HÀNG" bên dưới. Đơn hàng sẽ chỉ được xử lý sau khi bạn xác nhận.</p>
        </div>

        <div style="text-align: center;">
            <a href="{{ $confirmUrl }}" class="confirm-button">
                ✅ XÁC NHẬN ĐƠN HÀNG
            </a>
        </div>

        <div style="background-color: #f8f9fa; padding: 15px; border-radius: 5px; margin-top: 20px;">
            <h4>📞 Cần hỗ trợ?</h4>
            <p>Nếu bạn có bất kỳ câu hỏi nào về đơn hàng, vui lòng liên hệ:</p>
            <p>📧 Email: support@ericshop.com</p>
            <p>📱 Hotline: 1900-xxxx</p>
        </div>

        <div class="footer">
            <p>Email này được gửi tự động, vui lòng không trả lời.</p>
            <p>&copy; {{ date('Y') }} EricShop. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
