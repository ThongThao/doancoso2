<?php
/**
 * Mô tả chi tiết 10 sequence diagrams của hệ thống EricShop
 */

class DiagramDescriptor
{
    private $diagrams = [];

    public function __construct()
    {
        echo "📝 Mô tả 10 Sequence Diagrams của EricShop...\n";
    }

    /**
     * Định nghĩa mô tả chi tiết cho 10 diagrams
     */
    public function defineDiagramDescriptions()
    {
        $this->diagrams = [
            // 7 MAIN DIAGRAMS
            'main_user_authentication' => [
                'title' => '1. User Authentication Flow',
                'type' => 'Sequence Diagram',
                'category' => 'Core Business Function',
                'file' => 'main_sequence_user_authentication.txt',
                'actors' => ['Customer', 'LoginForm', 'CustomerController', 'Database', 'Session'],
                'steps' => 9,
                'complexity' => '⭐⭐⭐',
                'description' => 'Sơ đồ tuần tự mô tả quy trình đăng nhập của khách hàng',
                'purpose' => 'Hiển thị cách người dùng đăng nhập vào hệ thống, từ việc nhập thông tin đến tạo session',
                'main_flow' => [
                    'Customer nhập email/password vào LoginForm',
                    'LoginForm gửi thông tin đến CustomerController',
                    'CustomerController validate dữ liệu input',
                    'Tìm kiếm user trong Database bằng email',
                    'Xác minh password với hash đã lưu',
                    'Tạo session cho user đã đăng nhập',
                    'Redirect user đến dashboard'
                ],
                'key_methods' => ['enterCredentials()', 'submit_login()', 'validateInput()', 'findUserByEmail()', 'verifyPassword()', 'createSession()'],
                'business_value' => 'Đảm bảo chỉ người dùng hợp lệ mới truy cập được hệ thống',
                'technical_details' => 'Sử dụng password hashing, session management, validation'
            ],

            'main_product_browsing' => [
                'title' => '2. Product Browsing & Search',
                'type' => 'Sequence Diagram',
                'category' => 'Core Business Function',
                'file' => 'main_sequence_product_browsing.txt',
                'actors' => ['Customer', 'ProductPage', 'ProductController', 'Database', 'SearchEngine'],
                'steps' => 10,
                'complexity' => '⭐⭐⭐⭐',
                'description' => 'Sơ đồ tuần tự mô tả cách khách hàng duyệt và tìm kiếm sản phẩm',
                'purpose' => 'Cho phép khách hàng khám phá sản phẩm và tìm kiếm theo nhu cầu',
                'main_flow' => [
                    'Customer truy cập trang cửa hàng',
                    'ProductController lấy danh sách sản phẩm từ Database',
                    'Hiển thị sản phẩm với filter và pagination',
                    'Customer có thể search bằng từ khóa',
                    'SearchEngine thực hiện fulltext search',
                    'Trả về kết quả tìm kiếm phù hợp'
                ],
                'key_methods' => ['visitStore()', 'show_all_product()', 'getProducts()', 'searchProducts()', 'fullTextSearch()'],
                'business_value' => 'Giúp khách hàng tìm được sản phẩm mong muốn, tăng conversion rate',
                'technical_details' => 'Full-text search, filtering, pagination, product catalog management'
            ],

            'main_shopping_cart' => [
                'title' => '3. Shopping Cart Management',
                'type' => 'Sequence Diagram',
                'category' => 'Core Business Function',
                'file' => 'main_sequence_shopping_cart_management.txt',
                'actors' => ['Customer', 'ProductPage', 'CartController', 'Database', 'Session'],
                'steps' => 10,
                'complexity' => '⭐⭐⭐⭐',
                'description' => 'Sơ đồ tuần tự mô tả quy trình quản lý giỏ hàng',
                'purpose' => 'Cho phép khách hàng thêm, sửa, xóa sản phẩm trong giỏ hàng',
                'main_flow' => [
                    'Customer chọn sản phẩm và số lượng',
                    'Kiểm tra tồn kho sản phẩm',
                    'Thêm sản phẩm vào giỏ hàng (session)',
                    'Cập nhật counter giỏ hàng',
                    'Customer có thể xem và chỉnh sửa giỏ hàng',
                    'Tính toán lại tổng tiền khi có thay đổi'
                ],
                'key_methods' => ['selectProduct()', 'add_to_cart()', 'checkProductStock()', 'saveCartData()', 'calculateSubtotal()', 'update_qty_cart()'],
                'business_value' => 'Tăng trải nghiệm mua sắm, giảm tỷ lệ bỏ giỏ hàng',
                'technical_details' => 'Session-based cart, stock validation, real-time calculation'
            ],

            'main_vietqr_payment' => [
                'title' => '4. VietQR Payment Process',
                'type' => 'Sequence Diagram',
                'category' => 'Core Business Function',
                'file' => 'main_sequence_vietqr_payment_process.txt',
                'actors' => ['Customer', 'PaymentPage', 'CassoPaymentController', 'CassoService', 'BankAPI', 'Database'],
                'steps' => 11,
                'complexity' => '⭐⭐⭐⭐',
                'description' => 'Sơ đồ tuần tự mô tả quy trình thanh toán qua VietQR',
                'purpose' => 'Cho phép khách hàng thanh toán bằng mã QR ngân hàng',
                'main_flow' => [
                    'Customer chọn phương thức thanh toán VietQR',
                    'Hệ thống tạo yêu cầu thanh toán qua Casso API',
                    'Tạo mã QR từ ngân hàng',
                    'Hiển thị mã QR cho customer',
                    'Customer quét QR và thanh toán',
                    'Ngân hàng gửi webhook xác nhận',
                    'Cập nhật trạng thái đơn hàng'
                ],
                'key_methods' => ['selectVietQRPayment()', 'createVietQRPayment()', 'generateQRCode()', 'scanAndPay()', 'webhook()', 'updateOrderStatus()'],
                'business_value' => 'Thanh toán nhanh chóng, tiện lợi cho khách hàng Việt Nam',
                'technical_details' => 'API integration, webhook handling, real-time payment verification'
            ],

            'main_order_management' => [
                'title' => '5. Order Management (Admin)',
                'type' => 'Sequence Diagram',
                'category' => 'Core Business Function',
                'file' => 'main_sequence_order_management_admin.txt',
                'actors' => ['Admin', 'AdminPanel', 'BillController', 'Database', 'EmailService', 'Customer'],
                'steps' => 12,
                'complexity' => '⭐⭐⭐⭐⭐',
                'description' => 'Sơ đồ tuần tự mô tả cách admin quản lý đơn hàng',
                'purpose' => 'Cho phép admin xem, xác nhận và xử lý đơn hàng',
                'main_flow' => [
                    'Admin truy cập trang quản lý đơn hàng',
                    'Lấy danh sách đơn hàng chờ xử lý',
                    'Admin xem chi tiết đơn hàng',
                    'Xác nhận đơn hàng',
                    'Cập nhật trạng thái trong database',
                    'Gửi email xác nhận cho customer'
                ],
                'key_methods' => ['accessOrderManagement()', 'list_bill()', 'getPendingOrders()', 'bill_info()', 'confirm_bill()', 'sendOrderConfirmation()'],
                'business_value' => 'Quản lý hiệu quả đơn hàng, cải thiện customer service',
                'technical_details' => 'Order workflow, status management, email notifications'
            ],

            'main_product_review' => [
                'title' => '6. Product Review System',
                'type' => 'Sequence Diagram',
                'category' => 'Core Business Function',
                'file' => 'main_sequence_product_review_system.txt',
                'actors' => ['Customer', 'ProductPage', 'ProductReviewController', 'Database', 'AdminNotificationService', 'Admin'],
                'steps' => 12,
                'complexity' => '⭐⭐⭐⭐⭐',
                'description' => 'Sơ đồ tuần tự mô tả hệ thống đánh giá sản phẩm',
                'purpose' => 'Cho phép khách hàng đánh giá sản phẩm và admin kiểm duyệt',
                'main_flow' => [
                    'Kiểm tra customer đã mua sản phẩm chưa',
                    'Customer gửi đánh giá (rating + comment)',
                    'Validate dữ liệu đánh giá',
                    'Lưu đánh giá với trạng thái pending',
                    'Thông báo admin có đánh giá mới',
                    'Admin duyệt và approve đánh giá'
                ],
                'key_methods' => ['canReview()', 'checkPurchaseHistory()', 'submitReview()', 'validateReviewData()', 'approveReview()', 'notifyReviewApproved()'],
                'business_value' => 'Tăng độ tin cậy sản phẩm, cải thiện SEO và conversion',
                'technical_details' => 'Content moderation, purchase verification, notification system'
            ],

            'main_inventory_product' => [
                'title' => '7. Inventory & Product Management',
                'type' => 'Sequence Diagram',
                'category' => 'Core Business Function',
                'file' => 'main_sequence_inventory_product_management.txt',
                'actors' => ['Admin', 'AdminPanel', 'ProductController', 'Database', 'ImageService', 'InventoryService'],
                'steps' => 13,
                'complexity' => '⭐⭐⭐⭐⭐',
                'description' => 'Sơ đồ tuần tự mô tả quản lý sản phẩm và tồn kho',
                'purpose' => 'Cho phép admin thêm sản phẩm mới và quản lý inventory',
                'main_flow' => [
                    'Admin truy cập trang quản lý sản phẩm',
                    'Tạo sản phẩm mới với thông tin chi tiết',
                    'Upload và xử lý hình ảnh sản phẩm',
                    'Validate dữ liệu sản phẩm',
                    'Lưu sản phẩm vào database',
                    'Khởi tạo inventory record',
                    'Cập nhật số lượng tồn kho'
                ],
                'key_methods' => ['manage_products()', 'add_product()', 'submit_add_product()', 'uploadProductImages()', 'insertProduct()', 'initializeStock()'],
                'business_value' => 'Quản lý catalog hiệu quả, theo dõi tồn kho chính xác',
                'technical_details' => 'Product CRUD, image processing, inventory tracking, SEO optimization'
            ],

            // 3 ADDITIONAL DIAGRAMS
            'additional_blog_management' => [
                'title' => '8. Blog Management System',
                'type' => 'Sequence Diagram',
                'category' => 'Supporting Function',
                'file' => 'additional_sequence_blog_management.txt',
                'actors' => ['Admin', 'BlogController', 'Database', 'ImageService', 'Customer', 'BlogPage'],
                'steps' => 21,
                'complexity' => '⭐⭐⭐⭐⭐',
                'description' => 'Sơ đồ tuần tự mô tả hệ thống quản lý blog',
                'purpose' => 'Cho phép admin tạo blog content và customer đọc blog',
                'main_flow' => [
                    'Admin quản lý danh sách blog',
                    'Tạo blog mới với title, content, images',
                    'Upload và xử lý hình ảnh blog',
                    'Lưu blog vào database',
                    'Customer truy cập trang blog',
                    'Xem danh sách và chi tiết blog',
                    'Đọc nội dung blog theo slug'
                ],
                'key_methods' => ['manage_blog()', 'add_blog()', 'submit_add_blog()', 'uploadBlogImages()', 'show_blog()', 'blog_details()'],
                'business_value' => 'Content marketing, SEO, tăng engagement với khách hàng',
                'technical_details' => 'Content management, image processing, SEO-friendly URLs'
            ],

            'additional_statistics_reporting' => [
                'title' => '9. Statistics & Reporting System',
                'type' => 'Sequence Diagram',
                'category' => 'Supporting Function',
                'file' => 'additional_sequence_statistics_reporting.txt',
                'actors' => ['Admin', 'AdminController', 'Database', 'ChartService', 'StatisticService'],
                'steps' => 22,
                'complexity' => '⭐⭐⭐⭐⭐',
                'description' => 'Sơ đồ tuần tự mô tả hệ thống thống kê và báo cáo',
                'purpose' => 'Cung cấp insights kinh doanh cho admin thông qua các báo cáo',
                'main_flow' => [
                    'Admin truy cập dashboard',
                    'Lấy thống kê tổng quan (orders, revenue, customers)',
                    'Xem báo cáo theo khoảng thời gian',
                    'Tạo biểu đồ 7 ngày gần nhất',
                    'Xem top sản phẩm bán chạy',
                    'Phân tích dữ liệu kinh doanh'
                ],
                'key_methods' => ['show_dashboard()', 'getDashboardStats()', 'statistic_by_date()', 'chart_7days()', 'getTopProducts()'],
                'business_value' => 'Business intelligence, data-driven decisions, performance monitoring',
                'technical_details' => 'Data aggregation, chart generation, real-time analytics'
            ],

            'additional_notification_system' => [
                'title' => '10. Notification & Communication System',
                'type' => 'Sequence Diagram',
                'category' => 'Supporting Function',
                'file' => 'additional_sequence_notification_system.txt',
                'actors' => ['System', 'NotificationService', 'AdminNotificationService', 'EmailService', 'Customer', 'Admin'],
                'steps' => 20,
                'complexity' => '⭐⭐⭐⭐⭐',
                'description' => 'Sơ đồ tuần tự mô tả hệ thống thông báo và giao tiếp',
                'purpose' => 'Quản lý tất cả thông báo và email trong hệ thống',
                'main_flow' => [
                    'System tạo notification khi có sự kiện',
                    'Xác định người nhận notification',
                    'Gửi thông báo real-time cho admin',
                    'Admin xem và đánh dấu đã đọc',
                    'Gửi email cho customer khi cần',
                    'Gửi email hàng loạt cho marketing'
                ],
                'key_methods' => ['createNotification()', 'sendAdminNotification()', 'getUnreadCount()', 'markAsRead()', 'sendCustomerEmail()', 'sendBulkEmail()'],
                'business_value' => 'Improved communication, customer engagement, admin efficiency',
                'technical_details' => 'Real-time notifications, email templates, bulk messaging'
            ]
        ];
        
        echo "✅ Định nghĩa mô tả cho " . count($this->diagrams) . " diagrams\n";
    }

    /**
     * Tạo file mô tả chi tiết tất cả diagrams
     */
    public function generateDetailedDescriptions()
    {
        echo "📖 Đang tạo mô tả chi tiết...\n";
        
        $description = "# CHI TIẾT 10 SƠ ĐỒ SEQUENCE DIAGRAMS - ERICSHOP\n\n";
        $description .= "Generated: " . date('Y-m-d H:i:s') . "\n\n";
        
        $description .= "## Tổng quan\n";
        $description .= "Hệ thống EricShop được mô tả bằng **10 sơ đồ tuần tự (Sequence Diagrams)** chia làm 2 nhóm:\n";
        $description .= "- **7 chức năng chính** (Core Business Functions)\n";
        $description .= "- **3 chức năng hỗ trợ** (Supporting Functions)\n\n";
        
        $description .= "---\n\n";
        
        foreach ($this->diagrams as $key => $diagram) {
            $description .= "## " . $diagram['title'] . "\n\n";
            
            $description .= "### 📋 Thông tin cơ bản\n";
            $description .= "- **Loại sơ đồ:** " . $diagram['type'] . "\n";
            $description .= "- **Phân loại:** " . $diagram['category'] . "\n";
            $description .= "- **File:** `" . $diagram['file'] . "`\n";
            $description .= "- **Số actors:** " . count($diagram['actors']) . "\n";
            $description .= "- **Số bước:** " . $diagram['steps'] . "\n";
            $description .= "- **Độ phức tạp:** " . $diagram['complexity'] . "\n\n";
            
            $description .= "### 🎯 Mô tả\n";
            $description .= $diagram['description'] . "\n\n";
            
            $description .= "### 💡 Mục đích\n";
            $description .= $diagram['purpose'] . "\n\n";
            
            $description .= "### 👥 Actors tham gia\n";
            foreach ($diagram['actors'] as $actor) {
                $description .= "- **$actor**\n";
            }
            $description .= "\n";
            
            $description .= "### 🔄 Luồng chính\n";
            foreach ($diagram['main_flow'] as $index => $step) {
                $description .= ($index + 1) . ". $step\n";
            }
            $description .= "\n";
            
            $description .= "### ⚙️ Phương thức chính\n";
            $description .= "```\n";
            foreach ($diagram['key_methods'] as $method) {
                $description .= "- $method\n";
            }
            $description .= "```\n\n";
            
            $description .= "### 💰 Giá trị kinh doanh\n";
            $description .= $diagram['business_value'] . "\n\n";
            
            $description .= "### 🔧 Chi tiết kỹ thuật\n";
            $description .= $diagram['technical_details'] . "\n\n";
            
            $description .= "---\n\n";
        }
        
        // Thêm phần tổng kết
        $description .= "## 📊 Tổng kết phân tích\n\n";
        
        $description .= "### Phân loại theo độ phức tạp\n\n";
        $description .= "#### ⭐⭐⭐⭐⭐ Rất phức tạp (20+ bước)\n";
        foreach ($this->diagrams as $diagram) {
            if ($diagram['steps'] >= 20) {
                $description .= "- " . $diagram['title'] . " (" . $diagram['steps'] . " bước)\n";
            }
        }
        
        $description .= "\n#### ⭐⭐⭐⭐ Phức tạp (11-19 bước)\n";
        foreach ($this->diagrams as $diagram) {
            if ($diagram['steps'] >= 11 && $diagram['steps'] < 20) {
                $description .= "- " . $diagram['title'] . " (" . $diagram['steps'] . " bước)\n";
            }
        }
        
        $description .= "\n#### ⭐⭐⭐ Trung bình (6-10 bước)\n";
        foreach ($this->diagrams as $diagram) {
            if ($diagram['steps'] >= 6 && $diagram['steps'] < 11) {
                $description .= "- " . $diagram['title'] . " (" . $diagram['steps'] . " bước)\n";
            }
        }
        
        $description .= "\n### Phân loại theo chức năng\n\n";
        $description .= "#### 🛒 Core Business Functions (7)\n";
        $description .= "Các chức năng trực tiếp liên quan đến doanh thu:\n";
        foreach ($this->diagrams as $diagram) {
            if ($diagram['category'] === 'Core Business Function') {
                $description .= "- " . $diagram['title'] . "\n";
            }
        }
        
        $description .= "\n#### 🔧 Supporting Functions (3)\n";
        $description .= "Các chức năng hỗ trợ vận hành và quản lý:\n";
        foreach ($this->diagrams as $diagram) {
            if ($diagram['category'] === 'Supporting Function') {
                $description .= "- " . $diagram['title'] . "\n";
            }
        }
        
        $description .= "\n### Actors xuất hiện nhiều nhất\n\n";
        $actorCount = [];
        foreach ($this->diagrams as $diagram) {
            foreach ($diagram['actors'] as $actor) {
                $actorCount[$actor] = ($actorCount[$actor] ?? 0) + 1;
            }
        }
        arsort($actorCount);
        
        foreach (array_slice($actorCount, 0, 10) as $actor => $count) {
            $description .= "- **$actor**: xuất hiện trong $count diagrams\n";
        }
        
        $description .= "\n## 🚀 Kết luận\n\n";
        $description .= "Hệ thống 10 sequence diagrams này cung cấp:\n";
        $description .= "- **Comprehensive coverage**: Bao phủ toàn bộ chức năng hệ thống\n";
        $description .= "- **Technical documentation**: Chi tiết cho developers\n";
        $description .= "- **Business understanding**: Rõ ràng cho business analysts\n";
        $description .= "- **Implementation guide**: Hướng dẫn phát triển từng module\n\n";
        
        $description .= "Sử dụng các sơ đồ này để:\n";
        $description .= "1. **Hiểu architecture** - Xem cách các components tương tác\n";
        $description .= "2. **Plan development** - Ưu tiên các chức năng theo độ phức tạp\n";
        $description .= "3. **API design** - Thiết kế interfaces giữa các services\n";
        $description .= "4. **Testing strategy** - Tạo test cases cho từng luồng\n";
        $description .= "5. **Documentation** - Tài liệu hóa system behavior\n\n";
        
        file_put_contents('DETAILED_DIAGRAMS_DESCRIPTION.md', $description);
        echo "✅ Đã tạo mô tả chi tiết: DETAILED_DIAGRAMS_DESCRIPTION.md\n";
    }

    /**
     * Tạo bảng so sánh nhanh
     */
    public function generateQuickComparison()
    {
        echo "📊 Đang tạo bảng so sánh nhanh...\n";
        
        $comparison = "# BẢNG SO SÁNH NHANH 10 SEQUENCE DIAGRAMS\n\n";
        $comparison .= "| # | Tên Sơ đồ | Actors | Steps | Complexity | Category | Mô tả ngắn |\n";
        $comparison .= "|---|------------|--------|-------|------------|----------|------------|\n";
        
        $index = 1;
        foreach ($this->diagrams as $diagram) {
            $comparison .= "| $index | **{$diagram['title']}** | " . count($diagram['actors']) . " | {$diagram['steps']} | {$diagram['complexity']} | {$diagram['category']} | {$diagram['description']} |\n";
            $index++;
        }
        
        $comparison .= "\n## Chú thích\n\n";
        $comparison .= "### Complexity Levels\n";
        $comparison .= "- ⭐⭐⭐ **Medium**: 6-10 steps, basic business logic\n";
        $comparison .= "- ⭐⭐⭐⭐ **High**: 11-19 steps, complex interactions\n";
        $comparison .= "- ⭐⭐⭐⭐⭐ **Very High**: 20+ steps, multiple integrations\n\n";
        
        $comparison .= "### Categories\n";
        $comparison .= "- **Core Business Function**: Trực tiếp tạo doanh thu\n";
        $comparison .= "- **Supporting Function**: Hỗ trợ vận hành và quản lý\n\n";
        
        file_put_contents('QUICK_DIAGRAMS_COMPARISON.md', $comparison);
        echo "✅ Đã tạo bảng so sánh: QUICK_DIAGRAMS_COMPARISON.md\n";
    }

    /**
     * Chạy tất cả
     */
    public function run()
    {
        echo "\n📝 ========== DIAGRAM DESCRIPTOR ========== 📝\n";
        echo "🏪 Mô tả chi tiết 10 sequence diagrams của EricShop\n";
        echo "📅 Ngày: " . date('d/m/Y H:i:s') . "\n";
        echo "============================================\n\n";

        $this->defineDiagramDescriptions();
        $this->generateDetailedDescriptions();
        $this->generateQuickComparison();
        
        echo "\n🎉 ========== HOÀN THÀNH ========== 🎉\n";
        echo "✅ Đã tạo thành công mô tả chi tiết!\n\n";
        
        echo "📁 Files được tạo:\n";
        echo "   📖 DETAILED_DIAGRAMS_DESCRIPTION.md (Mô tả chi tiết từng diagram)\n";
        echo "   📊 QUICK_DIAGRAMS_COMPARISON.md (Bảng so sánh nhanh)\n\n";
        
        echo "📊 Tổng kết 10 diagrams:\n";
        $totalSteps = 0;
        $coreCount = 0;
        $supportCount = 0;
        
        foreach ($this->diagrams as $diagram) {
            $totalSteps += $diagram['steps'];
            if ($diagram['category'] === 'Core Business Function') {
                $coreCount++;
            } else {
                $supportCount++;
            }
        }
        
        echo "   - Core Functions: $coreCount diagrams\n";
        echo "   - Supporting Functions: $supportCount diagrams\n";
        echo "   - Total Steps: $totalSteps\n";
        echo "   - Average Steps: " . round($totalSteps / 10, 1) . " per diagram\n\n";
        
        echo "🎯 Sử dụng:\n";
        echo "   1. Đọc DETAILED_DIAGRAMS_DESCRIPTION.md để hiểu từng diagram\n";
        echo "   2. Xem QUICK_DIAGRAMS_COMPARISON.md để so sánh nhanh\n";
        echo "   3. Sử dụng để lập kế hoạch development\n\n";
        echo "============================================\n";
    }
}

// Chạy descriptor
try {
    $descriptor = new DiagramDescriptor();
    $descriptor->run();
} catch (Exception $e) {
    echo "❌ Lỗi: " . $e->getMessage() . "\n";
}
?>
