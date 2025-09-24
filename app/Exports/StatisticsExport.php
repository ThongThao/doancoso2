<?php

namespace App\Exports;

use App\Services\ReportExportService;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Font;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class StatisticsExport implements WithMultipleSheets
{
    protected $data;
    protected $reportService;

    public function __construct($dateFrom = null, $dateTo = null, $days = null)
    {
        $this->reportService = new ReportExportService();
        $this->data = $this->reportService->getStatisticsData($dateFrom, $dateTo, $days);
    }

    public function sheets(): array
    {
        return [
            new SummarySheet($this->data, $this->reportService),
            new DailyStatsSheet($this->data, $this->reportService),
            new TopProductsSheet($this->data, $this->reportService),
            new TopCustomersSheet($this->data, $this->reportService),
        ];
    }
}

class SummarySheet implements FromCollection, WithHeadings, WithTitle, ShouldAutoSize, WithStyles
{
    protected $data;
    protected $reportService;

    public function __construct($data, $reportService)
    {
        $this->data = $data;
        $this->reportService = $reportService;
    }

    public function collection()
    {
        $period = $this->reportService->getPeriodName(
            $this->data['period']['type'],
            $this->data['period']['start_date'],
            $this->data['period']['end_date']
        );

        return collect([
            ['Khoảng thời gian', $period],
            ['Tổng doanh thu', $this->reportService->formatCurrency($this->data['summary']['total_revenue'])],
            ['Tổng sản phẩm bán ra', $this->reportService->formatNumber($this->data['summary']['total_products'])],
            ['Tổng đơn hàng', $this->reportService->formatNumber($this->data['summary']['total_orders'])],
            ['Tổng khách hàng mới', $this->reportService->formatNumber($this->data['summary']['total_customers'])],
            ['Giá trị đơn hàng trung bình', $this->reportService->formatCurrency($this->data['summary']['average_order_value'])],
        ]);
    }

    public function headings(): array
    {
        return ['Chỉ số', 'Giá trị'];
    }

    public function title(): string
    {
        return 'Tổng quan';
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => [
                'font' => ['bold' => true, 'size' => 12],
                'fill' => ['fillType' => Fill::FILL_SOLID, 'color' => ['rgb' => 'E8F4FD']],
                'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
            ],
            'A:B' => [
                'alignment' => ['horizontal' => Alignment::HORIZONTAL_LEFT],
            ],
        ];
    }
}

class DailyStatsSheet implements FromCollection, WithHeadings, WithTitle, ShouldAutoSize, WithStyles
{
    protected $data;
    protected $reportService;

    public function __construct($data, $reportService)
    {
        $this->data = $data;
        $this->reportService = $reportService;
    }

    public function collection()
    {
        $dailyStats = $this->data['daily_stats'];
        $dailySold = $this->data['daily_sold'];

        $result = collect();

        foreach ($dailyStats as $key => $stat) {
            $soldData = $dailySold->where('Date', $stat->Date)->first();
            $result->push([
                $stat->Date,
                $this->reportService->formatCurrency($stat->Sale),
                $this->reportService->formatNumber($soldData ? $soldData->TotalSold : 0),
                $this->reportService->formatNumber($stat->QtyBill),
            ]);
        }

        return $result;
    }

    public function headings(): array
    {
        return ['Ngày', 'Doanh thu', 'Sản phẩm bán', 'Số đơn hàng'];
    }

    public function title(): string
    {
        return 'Thống kê theo ngày';
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => [
                'font' => ['bold' => true, 'size' => 12],
                'fill' => ['fillType' => Fill::FILL_SOLID, 'color' => ['rgb' => 'E8F4FD']],
                'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
            ],
        ];
    }
}

class TopProductsSheet implements FromCollection, WithHeadings, WithTitle, ShouldAutoSize, WithStyles
{
    protected $data;
    protected $reportService;

    public function __construct($data, $reportService)
    {
        $this->data = $data;
        $this->reportService = $reportService;
    }

    public function collection()
    {
        return collect($this->data['top_products'])->map(function ($product, $index) {
            return [
                $index + 1,
                $product->ProductName,
                $this->reportService->formatCurrency($product->Price),
                $this->reportService->formatNumber($product->Sold),
                $this->reportService->formatCurrency($product->Revenue),
            ];
        });
    }

    public function headings(): array
    {
        return ['Thứ hạng', 'Tên sản phẩm', 'Giá', 'Số lượng bán', 'Doanh thu'];
    }

    public function title(): string
    {
        return 'Top sản phẩm bán chạy';
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => [
                'font' => ['bold' => true, 'size' => 12],
                'fill' => ['fillType' => Fill::FILL_SOLID, 'color' => ['rgb' => 'E8F4FD']],
                'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
            ],
        ];
    }
}

class TopCustomersSheet implements FromCollection, WithHeadings, WithTitle, ShouldAutoSize, WithStyles
{
    protected $data;
    protected $reportService;

    public function __construct($data, $reportService)
    {
        $this->data = $data;
        $this->reportService = $reportService;
    }

    public function collection()
    {
        return collect($this->data['top_customers'])->map(function ($customer, $index) {
            return [
                $index + 1,
                $customer->CustomerName,
                $customer->Email,
                $customer->PhoneNumber,
                $this->reportService->formatNumber($customer->TotalOrders),
                $this->reportService->formatCurrency($customer->TotalSpent),
            ];
        });
    }

    public function headings(): array
    {
        return ['Thứ hạng', 'Tên khách hàng', 'Username/Email', 'Số điện thoại', 'Số đơn hàng', 'Tổng chi tiêu'];
    }

    public function title(): string
    {
        return 'Top khách hàng';
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => [
                'font' => ['bold' => true, 'size' => 12],
                'fill' => ['fillType' => Fill::FILL_SOLID, 'color' => ['rgb' => 'E8F4FD']],
                'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
            ],
        ];
    }
}
