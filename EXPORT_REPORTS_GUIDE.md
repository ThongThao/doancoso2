# Hướng dẫn sử dụng tính năng xuất báo cáo thống kê

## Tổng quan
Tính năng xuất báo cáo thống kê cho phép quản trị viên xuất dữ liệu thống kê của cửa hàng dưới hai định dạng:
- **Excel (.xlsx)**: Phù hợp để phân tích và xử lý dữ liệu
- **PDF (.pdf)**: Phù hợp để in ấn và báo cáo chính thức

## Cài đặt

### 1. Cài đặt các package cần thiết
```bash
composer install
```

Các package đã được thêm vào `composer.json`:
- `dompdf/dompdf`: Để xuất file PDF
- `maatwebsite/excel`: Để xuất file Excel

### 2. Cấu hình (nếu cần)
Không cần cấu hình thêm, tất cả đã được tích hợp sẵn.

## Cách sử dụng

### 1. Truy cập Dashboard
- Đăng nhập vào admin panel
- Vào trang Dashboard (`/dashboard`)

### 2. Xuất báo cáo
1. **Chọn khoảng thời gian**:
   - Sử dụng bộ lọc "7 ngày qua", "30 ngày qua", "365 ngày qua"
   - Hoặc chọn khoảng thời gian tùy chỉnh bằng "Từ ngày" và "Đến ngày"

2. **Nhấn nút xuất**:
   - **Nút Excel (màu xanh)**: Xuất file .xlsx
   - **Nút PDF (màu đỏ)**: Xuất file .pdf

### 3. Tải file
- File sẽ được tải xuống tự động với tên có định dạng:
  - Excel: `bao-cao-thong-ke-YYYY-MM-DD-HH-mm-ss.xlsx`
  - PDF: `bao-cao-thong-ke-YYYY-MM-DD-HH-mm-ss.pdf`

## Nội dung báo cáo

### Tổng quan
- Tổng doanh thu
- Tổng sản phẩm bán ra  
- Tổng đơn hàng
- Tổng khách hàng mới
- Giá trị đơn hàng trung bình

### Thống kê theo ngày
- Doanh thu từng ngày
- Số lượng sản phẩm bán từng ngày
- Số đơn hàng từng ngày

### Top sản phẩm bán chạy (Top 10)
- Thứ hạng
- Tên sản phẩm
- Giá bán
- Số lượng đã bán
- Tổng doanh thu

### Top khách hàng (Top 10)
- Thứ hạng
- Tên khách hàng
- Email
- Số điện thoại
- Số đơn hàng
- Tổng chi tiêu

## Đặc điểm kỹ thuật

### File Excel
- **Định dạng**: .xlsx (Excel 2007+)
- **Cấu trúc**: 4 sheet riêng biệt cho từng loại dữ liệu
- **Tính năng**: 
  - Auto-size columns
  - Header được định dạng đẹp
  - Dữ liệu được format (số tiền, số lượng)

### File PDF
- **Định dạng**: A4, portrait
- **Font**: DejaVu Sans (hỗ trợ tiếng Việt)
- **Tính năng**:
  - Header và footer chuyên nghiệp
  - Bảng dữ liệu có màu sắc xen kẽ
  - Page break tự động
  - Logo và thông tin công ty

## API Endpoints

### Xuất Excel
```
GET /export-statistics-excel?DateFrom=YYYY-MM-DD&DateTo=YYYY-MM-DD&Days=lastweek
```

### Xuất PDF  
```
GET /export-statistics-pdf?DateFrom=YYYY-MM-DD&DateTo=YYYY-MM-DD&Days=lastweek
```

### Parameters
- `DateFrom` (optional): Ngày bắt đầu (YYYY-MM-DD)
- `DateTo` (optional): Ngày kết thúc (YYYY-MM-DD)  
- `Days` (optional): lastweek|lastmonth|lastyear

**Lưu ý**: Nếu có `DateFrom` và `DateTo`, sẽ ưu tiên sử dụng khoảng thời gian này thay vì `Days`.

## Bảo mật
- Yêu cầu đăng nhập admin
- Kiểm tra quyền quản lý (chỉ Quản lý mới được xuất báo cáo)
- Validate dữ liệu đầu vào

## Troubleshooting

### Lỗi thường gặp
1. **"Class not found"**: Chạy `composer install` để cài đặt dependencies
2. **PDF không hiển thị tiếng Việt**: Font DejaVu Sans đã được cấu hình sẵn
3. **Excel bị lỗi format**: Đảm bảo PhpSpreadsheet được cài đặt đầy đủ

### Performance
- Báo cáo lớn (>1000 records) có thể mất 10-30 giây để tạo
- Khuyến nghị giới hạn khoảng thời gian xuất báo cáo để tối ưu hiệu suất

## Tùy chỉnh

### Thêm dữ liệu mới
1. Cập nhật `ReportExportService::getStatisticsData()`
2. Thêm sheet mới trong `StatisticsExport`
3. Cập nhật template PDF

### Thay đổi giao diện PDF
- Chỉnh sửa file `resources/views/admin/reports/statistics-pdf.blade.php`
- Tùy chỉnh CSS trong template

### Thay đổi format Excel
- Chỉnh sửa các class Sheet trong `app/Exports/StatisticsExport.php`
- Thêm styling, charts, formulas theo nhu cầu
