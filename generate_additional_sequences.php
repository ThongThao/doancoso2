<?php
/**
 * Tạo thêm 3 sequence diagrams cho các chức năng quan trọng khác
 * Chỉ xuất Mermaid format
 */

class AdditionalSequenceGenerator
{
    private $sequences = [];

    public function __construct()
    {
        echo "📊 Tạo thêm 3 Sequence Diagrams...\n";
    }

    /**
     * Định nghĩa 3 sequence diagrams bổ sung
     */
    public function defineAdditionalSequences()
    {
        $this->sequences = [
            'blog_management' => [
                'title' => 'Blog Management System',
                'description' => 'Admin manages blog posts and customer reads blogs',
                'actors' => ['Admin', 'BlogController', 'Database', 'ImageService', 'Customer', 'BlogPage'],
                'steps' => [
                    ['Admin', 'BlogController', 'manage_blog()'],
                    ['BlogController', 'Database', 'getAllBlogs(pagination)'],
                    ['Database', 'BlogController', 'return blogList'],
                    ['Admin', 'BlogController', 'add_blog()'],
                    ['BlogController', 'Admin', 'showBlogForm()'],
                    ['Admin', 'BlogController', 'submit_add_blog(title, content, images)'],
                    ['BlogController', 'BlogController', 'validateBlogData()'],
                    ['BlogController', 'ImageService', 'uploadBlogImages(images)'],
                    ['ImageService', 'BlogController', 'return imagePaths'],
                    ['BlogController', 'Database', 'insertBlog(blogData)'],
                    ['BlogController', 'Admin', 'redirectWithSuccess()'],
                    ['Customer', 'BlogPage', 'visitBlog()'],
                    ['BlogPage', 'BlogController', 'show_blog()'],
                    ['BlogController', 'Database', 'getPublishedBlogs()'],
                    ['Database', 'BlogController', 'return blogList'],
                    ['BlogPage', 'Customer', 'displayBlogs()'],
                    ['Customer', 'BlogPage', 'readBlogPost(blogSlug)'],
                    ['BlogPage', 'BlogController', 'blog_details(blogSlug)'],
                    ['BlogController', 'Database', 'getBlogBySlug(slug)'],
                    ['Database', 'BlogController', 'return blogDetails'],
                    ['BlogController', 'BlogPage', 'displayBlogContent()'],
                ]
            ],

            'statistics_reporting' => [
                'title' => 'Statistics & Reporting System',
                'description' => 'Admin views various reports and analytics',
                'actors' => ['Admin', 'AdminController', 'Database', 'ChartService', 'StatisticService'],
                'steps' => [
                    ['Admin', 'AdminController', 'show_dashboard()'],
                    ['AdminController', 'StatisticService', 'getDashboardStats()'],
                    ['StatisticService', 'Database', 'getTotalOrders()'],
                    ['StatisticService', 'Database', 'getTotalRevenue()'],
                    ['StatisticService', 'Database', 'getTotalCustomers()'],
                    ['StatisticService', 'Database', 'getTotalProducts()'],
                    ['Database', 'StatisticService', 'return statisticsData'],
                    ['StatisticService', 'AdminController', 'return dashboardStats'],
                    ['Admin', 'AdminController', 'statistic_by_date(startDate, endDate)'],
                    ['AdminController', 'StatisticService', 'getRevenueByDateRange()'],
                    ['StatisticService', 'Database', 'SELECT revenue WHERE date BETWEEN'],
                    ['Database', 'StatisticService', 'return revenueData'],
                    ['Admin', 'AdminController', 'chart_7days()'],
                    ['AdminController', 'ChartService', 'generateWeeklyChart()'],
                    ['ChartService', 'Database', 'getLast7DaysData()'],
                    ['Database', 'ChartService', 'return weeklyData'],
                    ['ChartService', 'AdminController', 'return chartData'],
                    ['Admin', 'AdminController', 'topPro_sort_by_date(date)'],
                    ['AdminController', 'StatisticService', 'getTopProducts(date)'],
                    ['StatisticService', 'Database', 'SELECT products ORDER BY sold DESC'],
                    ['Database', 'StatisticService', 'return topProductsData'],
                    ['StatisticService', 'AdminController', 'return topProducts'],
                ]
            ],

            'notification_system' => [
                'title' => 'Notification & Communication System',
                'description' => 'System handles various notifications and email communications',
                'actors' => ['System', 'NotificationService', 'AdminNotificationService', 'EmailService', 'Customer', 'Admin'],
                'steps' => [
                    ['System', 'NotificationService', 'createNotification(type, data)'],
                    ['NotificationService', 'NotificationService', 'determineRecipients(type)'],
                    ['NotificationService', 'NotificationService', 'formatNotificationMessage()'],
                    ['NotificationService', 'AdminNotificationService', 'sendAdminNotification()'],
                    ['AdminNotificationService', 'Database', 'INSERT INTO admin_notifications'],
                    ['AdminNotificationService', 'Admin', 'displayRealTimeNotification()'],
                    ['Admin', 'AdminNotificationService', 'getUnreadCount()'],
                    ['AdminNotificationService', 'Database', 'COUNT unread notifications'],
                    ['Database', 'AdminNotificationService', 'return unreadCount'],
                    ['Admin', 'AdminNotificationService', 'markAsRead(notificationId)'],
                    ['AdminNotificationService', 'Database', 'UPDATE notification SET read = 1'],
                    ['NotificationService', 'EmailService', 'sendCustomerEmail(template, data)'],
                    ['EmailService', 'EmailService', 'loadEmailTemplate(template)'],
                    ['EmailService', 'EmailService', 'populateTemplateData(data)'],
                    ['EmailService', 'EmailService', 'sendEmail(to, subject, body)'],
                    ['EmailService', 'Customer', 'deliverEmail()'],
                    ['System', 'NotificationService', 'sendBulkNotification(userList, message)'],
                    ['NotificationService', 'EmailService', 'prepareBulkEmail()'],
                    ['EmailService', 'EmailService', 'sendBulkEmail(recipients)'],
                    ['EmailService', 'NotificationService', 'return sendStatus'],
                ]
            ]
        ];
        
        echo "✅ Định nghĩa " . count($this->sequences) . " sequence diagrams bổ sung\n";
    }

    /**
     * Tạo Mermaid format
     */
    public function generateMermaid($sequenceKey)
    {
        if (!isset($this->sequences[$sequenceKey])) {
            return false;
        }

        $sequence = $this->sequences[$sequenceKey];
        
        $mermaid = "sequenceDiagram\n";
        $mermaid .= "    title " . $sequence['title'] . "\n\n";
        
        // Participants
        foreach ($sequence['actors'] as $actor) {
            $mermaid .= "    participant $actor\n";
        }
        $mermaid .= "\n";
        
        // Steps with clear numbering
        $step_num = 1;
        foreach ($sequence['steps'] as $step) {
            $from = $step[0];
            $to = $step[1];
            $method = $step[2];
            
            if ($from === $to) {
                $mermaid .= "    $from->>+$from: $step_num. $method\n";
                $mermaid .= "    $from-->>-$from: \n";
            } else {
                $mermaid .= "    $from->>$to: $step_num. $method\n";
            }
            $step_num++;
        }
        
        return $mermaid;
    }

    /**
     * Lưu tất cả Mermaid files
     */
    public function saveAllMermaidFiles()
    {
        echo "💾 Đang lưu additional sequence diagrams...\n";
        
        foreach ($this->sequences as $key => $sequence) {
            $mermaid = $this->generateMermaid($key);
            $filename = "additional_sequence_{$key}.txt";
            
            if (file_put_contents($filename, $mermaid)) {
                echo "✅ Đã lưu: $filename\n";
            } else {
                echo "❌ Lỗi lưu: $filename\n";
            }
        }
        
        return true;
    }

    /**
     * Tạo file tổng hợp 10 sequences (7 + 3)
     */
    public function generateCompleteSequenceIndex()
    {
        echo "📋 Đang tạo complete sequence index...\n";
        
        $index = "# COMPLETE SEQUENCE DIAGRAMS INDEX - ERICSHOP\n\n";
        $index .= "Generated: " . date('Y-m-d H:i:s') . "\n\n";
        $index .= "## Overview\n";
        $index .= "This document contains the complete list of **10 sequence diagrams** for EricShop e-commerce system.\n";
        $index .= "**7 Main Functions + 3 Additional Functions**\n\n";
        
        $index .= "## 📊 Main Functions (7)\n\n";
        
        $mainFunctions = [
            ['title' => 'User Authentication Flow', 'file' => 'main_sequence_user_authentication.txt', 'actors' => 5, 'steps' => 9],
            ['title' => 'Product Browsing & Search', 'file' => 'main_sequence_product_browsing.txt', 'actors' => 5, 'steps' => 10],
            ['title' => 'Shopping Cart Management', 'file' => 'main_sequence_shopping_cart_management.txt', 'actors' => 5, 'steps' => 10],
            ['title' => 'VietQR Payment Process', 'file' => 'main_sequence_vietqr_payment_process.txt', 'actors' => 6, 'steps' => 11],
            ['title' => 'Order Management (Admin)', 'file' => 'main_sequence_order_management_admin.txt', 'actors' => 6, 'steps' => 12],
            ['title' => 'Product Review System', 'file' => 'main_sequence_product_review_system.txt', 'actors' => 6, 'steps' => 12],
            ['title' => 'Inventory & Product Management', 'file' => 'main_sequence_inventory_product_management.txt', 'actors' => 6, 'steps' => 13]
        ];
        
        $num = 1;
        foreach ($mainFunctions as $func) {
            $index .= "$num. **{$func['title']}**\n";
            $index .= "   - File: `{$func['file']}`\n";
            $index .= "   - Actors: {$func['actors']} | Steps: {$func['steps']}\n";
            $index .= "   - Category: Core Business Function\n\n";
            $num++;
        }
        
        $index .= "## 📋 Additional Functions (3)\n\n";
        
        $num = 8;
        foreach ($this->sequences as $key => $sequence) {
            $index .= "$num. **{$sequence['title']}**\n";
            $index .= "   - File: `additional_sequence_{$key}.txt`\n";
            $index .= "   - Actors: " . count($sequence['actors']) . " | Steps: " . count($sequence['steps']) . "\n";
            $index .= "   - Category: Supporting Function\n";
            $index .= "   - Description: {$sequence['description']}\n\n";
            $num++;
        }
        
        $index .= "## 📈 Statistics Summary\n\n";
        $index .= "| Category | Diagrams | Total Steps | Avg Steps/Diagram |\n";
        $index .= "|----------|----------|-------------|-------------------|\n";
        $index .= "| **Main Functions** | 7 | 77 | 11.0 |\n";
        $index .= "| **Additional Functions** | 3 | " . $this->getTotalSteps() . " | " . round($this->getTotalSteps() / 3, 1) . " |\n";
        $index .= "| **TOTAL** | **10** | **" . (77 + $this->getTotalSteps()) . "** | **" . round((77 + $this->getTotalSteps()) / 10, 1) . "** |\n\n";
        
        $index .= "## 🎯 Function Categories\n\n";
        $index .= "### Core Business Functions\n";
        $index .= "Essential e-commerce operations that directly impact revenue:\n";
        $index .= "- User Authentication, Product Browsing, Shopping Cart\n";
        $index .= "- Payment Processing, Order Management, Reviews\n";
        $index .= "- Inventory Management\n\n";
        
        $index .= "### Supporting Functions\n";
        $index .= "Administrative and communication features that support the business:\n";
        $index .= "- Blog Management (Content marketing)\n";
        $index .= "- Statistics & Reporting (Business intelligence)\n";
        $index .= "- Notification System (Communication)\n\n";
        
        $index .= "## 🚀 Usage Instructions\n\n";
        $index .= "### For Developers\n";
        $index .= "- Use **Main Functions** for understanding core system architecture\n";
        $index .= "- Use **Additional Functions** for admin features and integrations\n\n";
        
        $index .= "### For Business Analysts\n";
        $index .= "- **Main Functions** show customer journey and revenue flow\n";
        $index .= "- **Additional Functions** show content management and analytics\n\n";
        
        $index .= "### For Project Managers\n";
        $index .= "- **Main Functions** are high priority for MVP\n";
        $index .= "- **Additional Functions** can be in later phases\n\n";
        
        $index .= "## 📁 All Files Reference\n\n";
        $index .= "### Main Sequence Files\n";
        foreach ($mainFunctions as $func) {
            $index .= "- `{$func['file']}`\n";
        }
        
        $index .= "\n### Additional Sequence Files\n";
        foreach ($this->sequences as $key => $sequence) {
            $index .= "- `additional_sequence_{$key}.txt`\n";
        }
        
        $index .= "\n### Activity Diagram Files\n";
        $index .= "- `activity_user_authentication_activity.txt`\n";
        $index .= "- `activity_product_browsing_activity.txt`\n";
        $index .= "- `activity_shopping_cart_activity.txt`\n";
        $index .= "- `activity_vietqr_payment_activity.txt`\n";
        $index .= "- `activity_order_management_admin_activity.txt`\n";
        $index .= "- `activity_product_review_activity.txt`\n";
        $index .= "- `activity_inventory_product_activity.txt`\n\n";
        
        $index .= "### Summary Documents\n";
        $index .= "- `ALL_MAIN_SEQUENCES.md` - Main sequences documentation\n";
        $index .= "- `ALL_ACTIVITY_DIAGRAMS.md` - Activity diagrams documentation\n";
        $index .= "- `SEQUENCE_ACTIVITY_MAPPING.md` - Mapping between sequence & activity\n";
        $index .= "- `SEQUENCE_INDEX.md` - Original sequence index\n";
        $index .= "- `COMPLETE_SEQUENCE_INDEX.md` - This file (complete index)\n\n";
        
        file_put_contents('COMPLETE_SEQUENCE_INDEX.md', $index);
        echo "✅ Đã tạo complete index: COMPLETE_SEQUENCE_INDEX.md\n";
    }

    /**
     * Tạo file so sánh các chức năng
     */
    public function generateFunctionComparison()
    {
        $comparison = "# FUNCTION COMPLEXITY COMPARISON\n\n";
        $comparison .= "## Sequence Diagram Complexity Analysis\n\n";
        
        $comparison .= "### Main Functions Ranking (by complexity)\n\n";
        $comparison .= "| Rank | Function | Actors | Steps | Complexity |\n";
        $comparison .= "|------|----------|--------|-------|------------|\n";
        $comparison .= "| 1 | Inventory & Product Management | 6 | 13 | ⭐⭐⭐⭐⭐ |\n";
        $comparison .= "| 2 | Product Review System | 6 | 12 | ⭐⭐⭐⭐⭐ |\n";
        $comparison .= "| 3 | Order Management (Admin) | 6 | 12 | ⭐⭐⭐⭐⭐ |\n";
        $comparison .= "| 4 | VietQR Payment Process | 6 | 11 | ⭐⭐⭐⭐ |\n";
        $comparison .= "| 5 | Product Browsing & Search | 5 | 10 | ⭐⭐⭐⭐ |\n";
        $comparison .= "| 6 | Shopping Cart Management | 5 | 10 | ⭐⭐⭐⭐ |\n";
        $comparison .= "| 7 | User Authentication Flow | 5 | 9 | ⭐⭐⭐ |\n\n";
        
        $comparison .= "### Additional Functions\n\n";
        $comparison .= "| Rank | Function | Actors | Steps | Complexity |\n";
        $comparison .= "|------|----------|--------|-------|------------|\n";
        
        $rank = 1;
        $sortedSequences = $this->sequences;
        uasort($sortedSequences, function($a, $b) {
            return count($b['steps']) - count($a['steps']);
        });
        
        foreach ($sortedSequences as $key => $sequence) {
            $stars = str_repeat('⭐', min(5, ceil(count($sequence['steps']) / 4)));
            $comparison .= "| $rank | {$sequence['title']} | " . count($sequence['actors']) . " | " . count($sequence['steps']) . " | $stars |\n";
            $rank++;
        }
        
        $comparison .= "\n## Complexity Factors\n\n";
        $comparison .= "### ⭐⭐⭐⭐⭐ Very High (12+ steps)\n";
        $comparison .= "- Multiple business rules and validations\n";
        $comparison .= "- Complex data processing\n";
        $comparison .= "- Multiple external integrations\n";
        $comparison .= "- Admin approval workflows\n\n";
        
        $comparison .= "### ⭐⭐⭐⭐ High (9-11 steps)\n";
        $comparison .= "- External API integrations\n";
        $comparison .= "- Real-time processing\n";
        $comparison .= "- Multiple decision points\n\n";
        
        $comparison .= "### ⭐⭐⭐ Medium (6-8 steps)\n";
        $comparison .= "- Standard CRUD operations\n";
        $comparison .= "- Basic validation\n";
        $comparison .= "- Simple business logic\n\n";
        
        $comparison .= "## Development Priority Recommendations\n\n";
        $comparison .= "### Phase 1: MVP (Essential)\n";
        $comparison .= "1. User Authentication Flow\n";
        $comparison .= "2. Product Browsing & Search\n";
        $comparison .= "3. Shopping Cart Management\n\n";
        
        $comparison .= "### Phase 2: Core E-commerce\n";
        $comparison .= "4. VietQR Payment Process\n";
        $comparison .= "5. Order Management (Admin)\n\n";
        
        $comparison .= "### Phase 3: Advanced Features\n";
        $comparison .= "6. Product Review System\n";
        $comparison .= "7. Inventory & Product Management\n\n";
        
        $comparison .= "### Phase 4: Supporting Features\n";
        $comparison .= "8. Blog Management System\n";
        $comparison .= "9. Statistics & Reporting System\n";
        $comparison .= "10. Notification & Communication System\n\n";
        
        file_put_contents('FUNCTION_COMPLEXITY_COMPARISON.md', $comparison);
        echo "✅ Đã tạo comparison: FUNCTION_COMPLEXITY_COMPARISON.md\n";
    }

    /**
     * Chạy tất cả
     */
    public function run()
    {
        echo "\n📊 ========== ADDITIONAL SEQUENCE GENERATOR ========== 📊\n";
        echo "🏪 Tạo 3 sequence diagrams bổ sung cho EricShop\n";
        echo "📅 Ngày: " . date('d/m/Y H:i:s') . "\n";
        echo "======================================================\n\n";

        $this->defineAdditionalSequences();
        $this->saveAllMermaidFiles();
        $this->generateCompleteSequenceIndex();
        $this->generateFunctionComparison();
        
        echo "\n🎉 ========== HOÀN THÀNH ========== 🎉\n";
        echo "✅ Đã tạo thành công 3 additional sequence diagrams!\n\n";
        
        echo "📊 Thống kê bổ sung:\n";
        echo "   - 3 additional sequence diagrams\n";
        echo "   - " . $this->getTotalSteps() . " tổng steps\n";
        echo "   - " . $this->getTotalActors() . " unique actors\n";
        echo "   - " . $this->getTotalMethods() . " unique methods\n\n";
        
        echo "📊 Tổng thống kê (7 + 3 = 10):\n";
        echo "   - 10 sequence diagrams (7 main + 3 additional)\n";
        echo "   - " . (77 + $this->getTotalSteps()) . " tổng steps\n";
        echo "   - 7 activity diagrams tương ứng\n\n";
        
        echo "📁 Files mới được tạo:\n";
        foreach ($this->sequences as $key => $sequence) {
            echo "   📊 " . $sequence['title'] . ":\n";
            echo "      - additional_sequence_{$key}.txt\n";
        }
        echo "   📖 COMPLETE_SEQUENCE_INDEX.md (Index đầy đủ)\n";
        echo "   📈 FUNCTION_COMPLEXITY_COMPARISON.md (So sánh độ phức tạp)\n\n";
        
        echo "🚀 Sử dụng ngay:\n";
        echo "   1. Mermaid Live: https://mermaid.live/\n";
        echo "   2. Copy từ additional_sequence_*.txt\n";
        echo "   3. Xem COMPLETE_SEQUENCE_INDEX.md để tổng quan\n\n";
        echo "======================================================\n";
    }

    /**
     * Tính tổng số steps
     */
    private function getTotalSteps()
    {
        $total = 0;
        foreach ($this->sequences as $sequence) {
            $total += count($sequence['steps']);
        }
        return $total;
    }

    /**
     * Tính tổng số actors unique
     */
    private function getTotalActors()
    {
        $allActors = [];
        foreach ($this->sequences as $sequence) {
            $allActors = array_merge($allActors, $sequence['actors']);
        }
        return count(array_unique($allActors));
    }

    /**
     * Tính tổng số methods unique
     */
    private function getTotalMethods()
    {
        $allMethods = [];
        foreach ($this->sequences as $sequence) {
            foreach ($sequence['steps'] as $step) {
                $allMethods[] = $step[2];
            }
        }
        return count(array_unique($allMethods));
    }
}

// Chạy generator
try {
    $generator = new AdditionalSequenceGenerator();
    $generator->run();
} catch (Exception $e) {
    echo "❌ Lỗi: " . $e->getMessage() . "\n";
}
?>
