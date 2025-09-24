<?php

namespace App\Services;

use App\Models\Bill;
use App\Models\BillInfo;
use App\Models\Product;
use App\Models\Customer;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ReportExportService
{
    /**
     * Lấy dữ liệu thống kê theo khoảng thời gian
     */
    public function getStatisticsData($dateFrom = null, $dateTo = null, $days = null)
    {
        // Xác định khoảng thời gian
        if ($dateFrom && $dateTo) {
            $startDate = $dateFrom;
            $endDate = $dateTo;
        } elseif ($days) {
            switch ($days) {
                case 'lastweek':
                    $startDate = Carbon::now()->subDays(7)->toDateString();
                    break;
                case 'lastmonth':
                    $startDate = Carbon::now()->subDays(30)->toDateString();
                    break;
                case 'lastyear':
                    $startDate = Carbon::now()->subDays(365)->toDateString();
                    break;
                default:
                    $startDate = Carbon::now()->subDays(7)->toDateString();
            }
            $endDate = now()->toDateString();
        } else {
            $startDate = Carbon::now()->subDays(7)->toDateString();
            $endDate = now()->toDateString();
        }

        // Dữ liệu tổng quan
        $totalRevenue = Bill::where('Status', 2)
            ->whereBetween('created_at', [$startDate, $endDate])
            ->sum('TotalBill');

        $totalProducts = BillInfo::join('bill', 'bill.idBill', '=', 'billinfo.idBill')
            ->where('bill.Status', 2)
            ->whereBetween('bill.created_at', [$startDate, $endDate])
            ->sum('QuantityBuy');

        $totalOrders = Bill::where('Status', 2)
            ->whereBetween('created_at', [$startDate, $endDate])
            ->count();

        $totalCustomers = Customer::whereBetween('created_at', [$startDate, $endDate])->count();

        // Dữ liệu theo ngày
        $dailyStats = Bill::whereNotIn('bill.Status', [99])
            ->whereBetween('created_at', [$startDate, $endDate])
            ->selectRaw('sum(TotalBill) as Sale, count(idBill) as QtyBill, date(created_at) as Date')
            ->groupBy('Date')
            ->orderBy('Date')
            ->get();

        $dailySold = BillInfo::join('bill', 'bill.idBill', '=', 'billinfo.idBill')
            ->whereNotIn('bill.Status', [99])
            ->whereBetween('bill.created_at', [$startDate, $endDate])
            ->selectRaw('sum(QuantityBuy) as TotalSold, date(bill.created_at) as Date')
            ->groupBy('Date')
            ->orderBy('Date')
            ->get();

        // Top sản phẩm bán chạy
        $topProducts = Product::join('productimage', 'productimage.idProduct', '=', 'product.idProduct')
            ->join('billinfo', 'billinfo.idProduct', '=', 'product.idProduct')
            ->join('bill', 'bill.idBill', '=', 'billinfo.idBill')
            ->whereNotIn('bill.Status', [99])
            ->whereBetween('bill.created_at', [$startDate, $endDate])
            ->select('ProductName', 'product.Price')
            ->selectRaw('sum(QuantityBuy) as Sold')
            ->selectRaw('sum(QuantityBuy * billinfo.Price) as Revenue')
            ->groupBy('ProductName', 'product.Price')
            ->orderBy('Sold', 'DESC')
            ->take(10)
            ->get();

        // Top khách hàng
        $topCustomers = Customer::join('bill', 'bill.idCustomer', '=', 'customer.idCustomer')
            ->where('bill.Status', 2)
            ->whereBetween('bill.created_at', [$startDate, $endDate])
            ->select('customer.CustomerName', 'customer.username as Email', 'customer.PhoneNumber')
            ->selectRaw('count(bill.idBill) as TotalOrders')
            ->selectRaw('sum(bill.TotalBill) as TotalSpent')
            ->groupBy('customer.CustomerName', 'customer.username', 'customer.PhoneNumber')
            ->orderBy('TotalSpent', 'DESC')
            ->take(10)
            ->get();

        return [
            'period' => [
                'start_date' => $startDate,
                'end_date' => $endDate,
                'type' => $days ?: 'custom'
            ],
            'summary' => [
                'total_revenue' => $totalRevenue,
                'total_products' => $totalProducts,
                'total_orders' => $totalOrders,
                'total_customers' => $totalCustomers,
                'average_order_value' => $totalOrders > 0 ? $totalRevenue / $totalOrders : 0
            ],
            'daily_stats' => $dailyStats,
            'daily_sold' => $dailySold,
            'top_products' => $topProducts,
            'top_customers' => $topCustomers
        ];
    }

    /**
     * Format số tiền thành chuỗi có dấu phẩy
     */
    public function formatCurrency($amount)
    {
        return number_format($amount, 0, ',', '.') . 'đ';
    }

    /**
     * Format số lượng
     */
    public function formatNumber($number)
    {
        return number_format($number, 0, ',', '.');
    }

    /**
     * Lấy tên khoảng thời gian
     */
    public function getPeriodName($days, $dateFrom, $dateTo)
    {
        if ($dateFrom && $dateTo) {
            return "Từ {$dateFrom} đến {$dateTo}";
        }

        switch ($days) {
            case 'lastweek':
                return '7 ngày qua';
            case 'lastmonth':
                return '30 ngày qua';
            case 'lastyear':
                return '365 ngày qua';
            default:
                return '7 ngày qua';
        }
    }
}
