<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Báo cáo thống kê</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            line-height: 1.4;
            color: #333;
        }
        
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #007bff;
            padding-bottom: 20px;
        }
        
        .header h1 {
            color: #007bff;
            margin: 0;
            font-size: 24px;
        }
        
        .header h2 {
            color: #666;
            margin: 5px 0 0 0;
            font-size: 16px;
        }
        
        .summary-section {
            margin-bottom: 30px;
        }
        
        .section-title {
            background-color: #f8f9fa;
            padding: 10px;
            margin: 20px 0 10px 0;
            font-weight: bold;
            font-size: 14px;
            color: #495057;
            border-left: 4px solid #007bff;
        }
        
        .summary-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-bottom: 20px;
        }
        
        .summary-card {
            border: 1px solid #dee2e6;
            border-radius: 5px;
            padding: 15px;
            background-color: #f8f9fa;
        }
        
        .summary-card h3 {
            margin: 0 0 10px 0;
            color: #495057;
            font-size: 14px;
        }
        
        .summary-card .value {
            font-size: 18px;
            font-weight: bold;
            color: #007bff;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            font-size: 11px;
        }
        
        table th {
            background-color: #007bff;
            color: white;
            padding: 8px;
            text-align: left;
            font-weight: bold;
        }
        
        table td {
            padding: 6px 8px;
            border-bottom: 1px solid #dee2e6;
        }
        
        table tr:nth-child(even) {
            background-color: #f8f9fa;
        }
        
        .text-center {
            text-align: center;
        }
        
        .text-right {
            text-align: right;
        }
        
        .page-break {
            page-break-before: always;
        }
        
        .footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            text-align: center;
            font-size: 10px;
            color: #666;
        }
        
        .report-info {
            margin: 20px 0;
            padding: 10px;
            background-color: #e3f2fd;
            border-radius: 5px;
        }
        
        .period-info {
            font-weight: bold;
            color: #1976d2;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>BÁO CÁO THỐNG KÊ</h1>
        <h2>Cửa hàng EricShop</h2>
    </div>

    <div class="report-info">
        <div class="period-info">
            Khoảng thời gian: {{ $periodName }}
        </div>
        <div>
            Ngày tạo báo cáo: {{ date('d/m/Y H:i:s') }}
        </div>
    </div>

    <div class="section-title">TỔNG QUAN</div>
    
    <div class="summary-grid">
        <div class="summary-card">
            <h3>Tổng doanh thu</h3>
            <div class="value">{{ $reportService->formatCurrency($data['summary']['total_revenue']) }}</div>
        </div>
        
        <div class="summary-card">
            <h3>Tổng sản phẩm bán ra</h3>
            <div class="value">{{ $reportService->formatNumber($data['summary']['total_products']) }}</div>
        </div>
        
        <div class="summary-card">
            <h3>Tổng đơn hàng</h3>
            <div class="value">{{ $reportService->formatNumber($data['summary']['total_orders']) }}</div>
        </div>
        
        <div class="summary-card">
            <h3>Giá trị đơn hàng TB</h3>
            <div class="value">{{ $reportService->formatCurrency($data['summary']['average_order_value']) }}</div>
        </div>
    </div>

    @if(count($data['daily_stats']) > 0)
    <div class="section-title">THỐNG KÊ THEO NGÀY</div>
    
    <table>
        <thead>
            <tr>
                <th class="text-center">Ngày</th>
                <th class="text-right">Doanh thu</th>
                <th class="text-center">SP bán</th>
                <th class="text-center">Đơn hàng</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data['daily_stats'] as $key => $stat)
                @php
                    $soldData = collect($data['daily_sold'])->where('Date', $stat->Date)->first();
                @endphp
                <tr>
                    <td class="text-center">{{ date('d/m/Y', strtotime($stat->Date)) }}</td>
                    <td class="text-right">{{ $reportService->formatCurrency($stat->Sale) }}</td>
                    <td class="text-center">{{ $reportService->formatNumber($soldData ? $soldData->TotalSold : 0) }}</td>
                    <td class="text-center">{{ $reportService->formatNumber($stat->QtyBill) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @endif

    @if(count($data['top_products']) > 0)
    <div class="section-title">TOP SẢN PHẨM BÁN CHẠY</div>
    
    <table>
        <thead>
            <tr>
                <th class="text-center">#</th>
                <th>Tên sản phẩm</th>
                <th class="text-right">Giá</th>
                <th class="text-center">SL bán</th>
                <th class="text-right">Doanh thu</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data['top_products'] as $key => $product)
                <tr>
                    <td class="text-center">{{ $key + 1 }}</td>
                    <td>{{ $product->ProductName }}</td>
                    <td class="text-right">{{ $reportService->formatCurrency($product->Price) }}</td>
                    <td class="text-center">{{ $reportService->formatNumber($product->Sold) }}</td>
                    <td class="text-right">{{ $reportService->formatCurrency($product->Revenue) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @endif

    @if(count($data['top_customers']) > 0)
    <div class="page-break"></div>
    <div class="section-title">TOP KHÁCH HÀNG</div>
    
    <table>
        <thead>
            <tr>
                <th class="text-center">#</th>
                <th>Tên khách hàng</th>
                <th>Username/Email</th>
                <th>Số điện thoại</th>
                <th class="text-center">Đơn hàng</th>
                <th class="text-right">Tổng chi tiêu</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data['top_customers'] as $key => $customer)
                <tr>
                    <td class="text-center">{{ $key + 1 }}</td>
                    <td>{{ $customer->CustomerName }}</td>
                    <td>{{ $customer->Email }}</td>
                    <td>{{ $customer->PhoneNumber }}</td>
                    <td class="text-center">{{ $reportService->formatNumber($customer->TotalOrders) }}</td>
                    <td class="text-right">{{ $reportService->formatCurrency($customer->TotalSpent) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @endif

    <div class="footer">
        <p>© {{ date('Y') }} EricShop - Báo cáo được tạo tự động</p>
    </div>
</body>
</html>
