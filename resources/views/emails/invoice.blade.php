<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hóa đơn điện tử</title>
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
            border-bottom: 2px solid #e74c3c;
            padding-bottom: 20px;
            margin-bottom: 30px;
        }
        .invoice-info {
            display: flex;
            justify-content: space-between;
            margin-bottom: 30px;
        }
        .invoice-info div {
            flex: 1;
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
            background-color: #e74c3c;
            color: white;
        }
        .product-table tr:nth-child(even) {
            background-color: #f8f9fa;
        }
        .total-section {
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 5px;
            margin: 20px 0;
        }
        .total-row {
            display: flex;
            justify-content: space-between;
            margin: 10px 0;
        }
        .total-final {
            font-size: 1.2em;
            font-weight: bold;
            color: #e74c3c;
            border-top: 2px solid #e74c3c;
            padding-top: 10px;
        }
        .status-paid {
            background-color: #27ae60;
            color: white;
            padding: 10px 20px;
            border-radius: 25px;
            display: inline-block;
            font-weight: bold;
            margin: 10px 0;
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            color: #7f8c8d;
            font-size: 0.9em;
            border-top: 1px solid #bdc3c7;
            padding-top: 20px;
        }
        .company-info {
            background-color: #34495e;
            color: white;
            padding: 20px;
            border-radius: 5px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="company-info">
            <h2>🏪 EricShop</h2>
            <p>Địa chỉ: 123 Đường ABC, Quận XYZ, TP.HCM</p>
            <p>Điện thoại: 1900-xxxx | Email: info@ericshop.com</p>
            <p>Website: www.ericshop.com</p>
        </div>

        <div class="header">
            <h1>🧾 HÓA ĐƠN ĐIỆN TỬ</h1>
            <div class="status-paid">✅ ĐÃ THANH TOÁN</div>
        </div>

        <div class="invoice-info">
            <div>
                <h3>📋 Thông tin hóa đơn</h3>
                <p><strong>Số hóa đơn:</strong> HD{{ $bill->idBill }}</p>
                <p><strong>Mã đơn hàng:</strong> #{{ $bill->idBill }}</p>
                <p><strong>Ngày xuất:</strong> {{ now()->format('d/m/Y H:i') }}</p>
                <p><strong>Ngày đặt hàng:</strong> {{ $bill->created_at->format('d/m/Y H:i') }}</p>
            </div>
            <div>
                <h3>👤 Thông tin khách hàng</h3>
                <p><strong>Họ tên:</strong> {{ $bill->CustomerName }}</p>
                <p><strong>Điện thoại:</strong> {{ $bill->PhoneNumber }}</p>
                <p><strong>Địa chỉ:</strong> {{ $bill->Address }}</p>
            </div>
        </div>

        <div class="order-info">
            <h3>🚚 Thông tin giao hàng</h3>
            <p><strong>Phương thức thanh toán:</strong> 
                @if($bill->Payment == 'cash')
                    Thanh toán khi nhận hàng
                @elseif($bill->Payment == 'vnpay')
                    VNPay
                @elseif($bill->Payment == 'casso_vietqr')
                    VietQR
                @else
                    {{ $bill->Payment }}
                @endif
            </p>
            <p><strong>Trạng thái:</strong> 
                @if($bill->Status == 0)
                    Chờ xác nhận
                @elseif($bill->Status == 1)
                    Đã xác nhận
                @elseif($bill->Status == 2)
                    Đang giao hàng
                @elseif($bill->Status == 3)
                    Đã giao hàng
                @else
                    Đã hủy
                @endif
            </p>
        </div>

        <h3>📦 Chi tiết sản phẩm</h3>
        <table class="product-table">
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Tên sản phẩm</th>
                    <th>Phân loại</th>
                    <th>SL</th>
                    <th>Đơn giá</th>
                    <th>Thành tiền</th>
                </tr>
            </thead>
            <tbody>
                @foreach($billItems as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $item->product->ProductName ?? 'N/A' }}</td>
                    <td>{{ $item->AttributeProduct ?? 'Không có' }}</td>
                    <td>{{ $item->QuantityBuy }}</td>
                    <td>{{ number_format($item->Price, 0, ',', '.') }}đ</td>
                    <td>{{ number_format($item->Price * $item->QuantityBuy, 0, ',', '.') }}đ</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="total-section">
            <div class="total-row">
                <span>Tạm tính:</span>
                <span>{{ number_format($bill->TotalBill, 0, ',', '.') }}đ</span>
            </div>
            @if($bill->Voucher && $bill->Voucher > 0)
            <div class="total-row">
                <span>Giảm giá:</span>
                <span>-{{ number_format($bill->Voucher, 0, ',', '.') }}đ</span>
            </div>
            @endif
            <div class="total-row">
                <span>Phí vận chuyển:</span>
                <span>Miễn phí</span>
            </div>
            <div class="total-row total-final">
                <span>TỔNG CỘNG:</span>
                <span>{{ number_format($bill->TotalBill, 0, ',', '.') }}đ</span>
            </div>
        </div>

        <div style="background-color: #d5f4e6; padding: 15px; border-radius: 5px; margin: 20px 0;">
            <h4>✅ Cảm ơn bạn đã mua hàng!</h4>
            <p>Đơn hàng của bạn đã được xử lý thành công. Chúng tôi sẽ giao hàng trong thời gian sớm nhất.</p>
        </div>

        <div style="background-color: #f8f9fa; padding: 15px; border-radius: 5px; margin-top: 20px;">
            <h4>📞 Cần hỗ trợ?</h4>
            <p>Nếu bạn có bất kỳ câu hỏi nào về hóa đơn hoặc đơn hàng, vui lòng liên hệ:</p>
            <p>📧 Email: support@ericshop.com</p>
            <p>📱 Hotline: 1900-xxxx</p>
        </div>

        <div class="footer">
            <p>Hóa đơn này được tạo tự động bởi hệ thống EricShop.</p>
            <p>Vui lòng lưu trữ hóa đơn để làm căn cứ bảo hành và đổi trả.</p>
            <p>&copy; {{ date('Y') }} EricShop. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
