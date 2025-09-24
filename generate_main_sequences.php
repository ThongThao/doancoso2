<?php
/**
 * Tạo 7 sequence diagrams chính với tên phương thức và bước rõ ràng
 * Chỉ xuất Mermaid format
 */

class MainSequenceGenerator
{
    private $sequences = [];

    public function __construct()
    {
        echo "🎯 Tạo 7 Sequence Diagrams chính...\n";
    }

    /**
     * Định nghĩa 7 sequence diagrams chính
     */
    public function defineMainSequences()
    {
        $this->sequences = [
            'user_authentication' => [
                'title' => 'User Authentication Flow',
                'actors' => ['Customer', 'LoginForm', 'CustomerController', 'Database', 'Session'],
                'steps' => [
                    ['Customer', 'LoginForm', 'enterCredentials(email, password)'],
                    ['LoginForm', 'CustomerController', 'submit_login(email, password)'],
                    ['CustomerController', 'CustomerController', 'validateInput(email, password)'],
                    ['CustomerController', 'Database', 'findUserByEmail(email)'],
                    ['Database', 'CustomerController', 'return userData'],
                    ['CustomerController', 'CustomerController', 'verifyPassword(password, hash)'],
                    ['CustomerController', 'Session', 'createSession(userId)'],
                    ['Session', 'CustomerController', 'return sessionId'],
                    ['CustomerController', 'Customer', 'redirect("/dashboard")'],
                ]
            ],

            'product_browsing' => [
                'title' => 'Product Browsing & Search',
                'actors' => ['Customer', 'ProductPage', 'ProductController', 'Database', 'SearchEngine'],
                'steps' => [
                    ['Customer', 'ProductPage', 'visitStore()'],
                    ['ProductPage', 'ProductController', 'show_all_product()'],
                    ['ProductController', 'Database', 'getProducts(filters)'],
                    ['Database', 'ProductController', 'return productList'],
                    ['ProductController', 'ProductPage', 'displayProducts(products)'],
                    ['Customer', 'ProductPage', 'searchProducts(keyword)'],
                    ['ProductPage', 'SearchEngine', 'fullTextSearch(keyword)'],
                    ['SearchEngine', 'Database', 'executeSearchQuery()'],
                    ['Database', 'SearchEngine', 'return searchResults'],
                    ['SearchEngine', 'ProductPage', 'displaySearchResults()'],
                ]
            ],

            'shopping_cart_management' => [
                'title' => 'Shopping Cart Management',
                'actors' => ['Customer', 'ProductPage', 'CartController', 'Database', 'Session'],
                'steps' => [
                    ['Customer', 'ProductPage', 'selectProduct(productId)'],
                    ['ProductPage', 'ProductPage', 'chooseQuantity(qty)'],
                    ['ProductPage', 'CartController', 'add_to_cart(productId, qty)'],
                    ['CartController', 'Database', 'checkProductStock(productId)'],
                    ['Database', 'CartController', 'return stockQuantity'],
                    ['CartController', 'Session', 'saveCartData(cartItems)'],
                    ['CartController', 'CartController', 'calculateSubtotal()'],
                    ['Customer', 'CartController', 'viewCart()'],
                    ['CartController', 'CartController', 'update_qty_cart(itemId, newQty)'],
                    ['CartController', 'Customer', 'displayCartSummary()'],
                ]
            ],

            'vietqr_payment_process' => [
                'title' => 'VietQR Payment Process',
                'actors' => ['Customer', 'PaymentPage', 'CassoPaymentController', 'CassoService', 'BankAPI', 'Database'],
                'steps' => [
                    ['Customer', 'PaymentPage', 'selectVietQRPayment()'],
                    ['PaymentPage', 'CassoPaymentController', 'createVietQRPayment(orderData)'],
                    ['CassoPaymentController', 'CassoService', 'generateQRCode(amount, orderInfo)'],
                    ['CassoService', 'BankAPI', 'requestQRGeneration()'],
                    ['BankAPI', 'CassoService', 'return qrCodeData'],
                    ['CassoService', 'CassoPaymentController', 'return qrInfo'],
                    ['CassoPaymentController', 'PaymentPage', 'displayQRCode(qrData)'],
                    ['Customer', 'BankAPI', 'scanAndPay(qrCode)'],
                    ['BankAPI', 'CassoService', 'webhook(paymentData)'],
                    ['CassoService', 'Database', 'updateOrderStatus(orderId, "paid")'],
                    ['CassoService', 'Customer', 'redirectToSuccessPage()'],
                ]
            ],

            'order_management_admin' => [
                'title' => 'Order Management (Admin)',
                'actors' => ['Admin', 'AdminPanel', 'BillController', 'Database', 'EmailService', 'Customer'],
                'steps' => [
                    ['Admin', 'AdminPanel', 'accessOrderManagement()'],
                    ['AdminPanel', 'BillController', 'list_bill(status, page)'],
                    ['BillController', 'Database', 'getPendingOrders()'],
                    ['Database', 'BillController', 'return orderList'],
                    ['BillController', 'AdminPanel', 'displayOrderList(orders)'],
                    ['Admin', 'AdminPanel', 'selectOrder(orderId)'],
                    ['AdminPanel', 'BillController', 'bill_info(orderId)'],
                    ['BillController', 'Database', 'getOrderDetails(orderId)'],
                    ['Admin', 'BillController', 'confirm_bill(orderId)'],
                    ['BillController', 'Database', 'updateOrderStatus(orderId, "confirmed")'],
                    ['BillController', 'EmailService', 'sendOrderConfirmation(orderData)'],
                    ['EmailService', 'Customer', 'deliverConfirmationEmail()'],
                ]
            ],

            'product_review_system' => [
                'title' => 'Product Review System',
                'actors' => ['Customer', 'ProductPage', 'ProductReviewController', 'Database', 'AdminNotificationService', 'Admin'],
                'steps' => [
                    ['Customer', 'ProductPage', 'accessReviewSection()'],
                    ['ProductPage', 'ProductReviewController', 'canReview(customerId, productId)'],
                    ['ProductReviewController', 'Database', 'checkPurchaseHistory(customerId, productId)'],
                    ['Database', 'ProductReviewController', 'return purchaseStatus'],
                    ['Customer', 'ProductReviewController', 'submitReview(rating, comment)'],
                    ['ProductReviewController', 'ProductReviewController', 'validateReviewData()'],
                    ['ProductReviewController', 'Database', 'saveReview(reviewData, status="pending")'],
                    ['ProductReviewController', 'AdminNotificationService', 'notifyNewReview()'],
                    ['AdminNotificationService', 'Admin', 'sendReviewNotification()'],
                    ['Admin', 'ProductReviewController', 'approveReview(reviewId)'],
                    ['ProductReviewController', 'Database', 'updateReviewStatus(reviewId, "approved")'],
                    ['ProductReviewController', 'Customer', 'notifyReviewApproved()'],
                ]
            ],

            'inventory_product_management' => [
                'title' => 'Inventory & Product Management',
                'actors' => ['Admin', 'AdminPanel', 'ProductController', 'Database', 'ImageService', 'InventoryService'],
                'steps' => [
                    ['Admin', 'AdminPanel', 'accessProductManagement()'],
                    ['AdminPanel', 'ProductController', 'manage_products()'],
                    ['ProductController', 'Database', 'getAllProducts(pagination)'],
                    ['Admin', 'ProductController', 'add_product()'],
                    ['ProductController', 'AdminPanel', 'showProductForm()'],
                    ['Admin', 'ProductController', 'submit_add_product(productData)'],
                    ['ProductController', 'ProductController', 'validateProductData()'],
                    ['ProductController', 'ImageService', 'uploadProductImages(images)'],
                    ['ImageService', 'ProductController', 'return imagePaths'],
                    ['ProductController', 'Database', 'insertProduct(productData)'],
                    ['ProductController', 'InventoryService', 'initializeStock(productId, quantity)'],
                    ['InventoryService', 'Database', 'updateInventory(productId, quantity)'],
                    ['ProductController', 'Admin', 'redirectWithSuccess()'],
                ]
            ]
        ];
        
        echo "✅ Định nghĩa " . count($this->sequences) . " sequence diagrams chính\n";
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
        echo "💾 Đang lưu Mermaid sequence diagrams...\n";
        
        foreach ($this->sequences as $key => $sequence) {
            $mermaid = $this->generateMermaid($key);
            $filename = "main_sequence_{$key}.txt";
            
            if (file_put_contents($filename, $mermaid)) {
                echo "✅ Đã lưu: $filename\n";
            } else {
                echo "❌ Lỗi lưu: $filename\n";
            }
        }
        
        return true;
    }

    /**
     * Tạo file tổng hợp tất cả sequences
     */
    public function generateAllInOneFile()
    {
        echo "📄 Đang tạo file tổng hợp...\n";
        
        $allInOne = "# 7 MAIN SEQUENCE DIAGRAMS - ERICSHOP E-COMMERCE\n\n";
        $allInOne .= "Generated: " . date('Y-m-d H:i:s') . "\n\n";
        $allInOne .= "## Overview\n";
        $allInOne .= "This document contains 7 main sequence diagrams for EricShop e-commerce system.\n";
        $allInOne .= "Each diagram focuses on core business functions with clear method names.\n\n";
        
        $index = 1;
        foreach ($this->sequences as $key => $sequence) {
            $allInOne .= "## $index. " . $sequence['title'] . "\n\n";
            $allInOne .= "**Actors:** " . implode(', ', $sequence['actors']) . "\n";
            $allInOne .= "**Steps:** " . count($sequence['steps']) . "\n\n";
            
            $allInOne .= "### Mermaid Code:\n";
            $allInOne .= "```mermaid\n";
            $allInOne .= $this->generateMermaid($key);
            $allInOne .= "```\n\n";
            
            $allInOne .= "### Step-by-step:\n";
            $step_num = 1;
            foreach ($sequence['steps'] as $step) {
                $allInOne .= "$step_num. **{$step[0]}** → **{$step[1]}**: `{$step[2]}`\n";
                $step_num++;
            }
            $allInOne .= "\n---\n\n";
            $index++;
        }
        
        $allInOne .= "## Usage Instructions\n\n";
        $allInOne .= "### Method 1: Mermaid Live Editor\n";
        $allInOne .= "1. Visit: https://mermaid.live/\n";
        $allInOne .= "2. Copy any mermaid code block above\n";
        $allInOne .= "3. Paste in the editor\n";
        $allInOne .= "4. View and export diagram\n\n";
        
        $allInOne .= "### Method 2: Individual Files\n";
        $allInOne .= "- Use individual `main_sequence_*.txt` files\n";
        $allInOne .= "- Each file contains one diagram\n";
        $allInOne .= "- Import to draw.io or other tools\n\n";
        
        $allInOne .= "### Method 3: VS Code with Mermaid Extension\n";
        $allInOne .= "1. Install Mermaid Preview extension\n";
        $allInOne .= "2. Create .md file with mermaid code blocks\n";
        $allInOne .= "3. Preview in VS Code\n\n";
        
        file_put_contents('ALL_MAIN_SEQUENCES.md', $allInOne);
        echo "✅ Đã tạo file tổng hợp: ALL_MAIN_SEQUENCES.md\n";
    }

    /**
     * Tạo file index cho dễ navigation
     */
    public function generateIndexFile()
    {
        $index = "# SEQUENCE DIAGRAMS INDEX\n\n";
        $index .= "## Quick Access Links\n\n";
        
        $num = 1;
        foreach ($this->sequences as $key => $sequence) {
            $index .= "$num. **{$sequence['title']}**\n";
            $index .= "   - File: `main_sequence_{$key}.txt`\n";
            $index .= "   - Actors: " . count($sequence['actors']) . "\n";
            $index .= "   - Steps: " . count($sequence['steps']) . "\n";
            $index .= "   - Key Methods: `" . implode('`, `', array_slice(array_column($sequence['steps'], 2), 0, 3)) . "`...\n\n";
            $num++;
        }
        
        $index .= "## Method Names Reference\n\n";
        $allMethods = [];
        foreach ($this->sequences as $sequence) {
            foreach ($sequence['steps'] as $step) {
                $method = $step[2];
                if (!in_array($method, $allMethods)) {
                    $allMethods[] = $method;
                }
            }
        }
        
        sort($allMethods);
        foreach ($allMethods as $method) {
            $index .= "- `$method`\n";
        }
        
        file_put_contents('SEQUENCE_INDEX.md', $index);
        echo "✅ Đã tạo file index: SEQUENCE_INDEX.md\n";
    }

    /**
     * Chạy tất cả
     */
    public function run()
    {
        echo "\n🎯 ========== MAIN SEQUENCE GENERATOR ========== 🎯\n";
        echo "🏪 Tạo 7 sequence diagrams chính cho EricShop\n";
        echo "📅 Ngày: " . date('d/m/Y H:i:s') . "\n";
        echo "================================================\n\n";

        $this->defineMainSequences();
        $this->saveAllMermaidFiles();
        $this->generateAllInOneFile();
        $this->generateIndexFile();
        
        echo "\n🎉 ========== HOÀN THÀNH ========== 🎉\n";
        echo "✅ Đã tạo thành công 7 main sequence diagrams!\n\n";
        
        echo "📊 Thống kê:\n";
        echo "   - 7 sequence diagrams chính\n";
        echo "   - " . $this->getTotalSteps() . " tổng steps\n";
        echo "   - " . $this->getTotalActors() . " unique actors\n";
        echo "   - " . $this->getTotalMethods() . " unique methods\n\n";
        
        echo "📁 Files được tạo:\n";
        foreach ($this->sequences as $key => $sequence) {
            echo "   📊 " . $sequence['title'] . ":\n";
            echo "      - main_sequence_{$key}.txt\n";
        }
        echo "   📖 ALL_MAIN_SEQUENCES.md (File tổng hợp)\n";
        echo "   📋 SEQUENCE_INDEX.md (File index)\n\n";
        
        echo "🚀 Sử dụng ngay:\n";
        echo "   1. Mermaid Live: https://mermaid.live/\n";
        echo "   2. Copy từ main_sequence_*.txt\n";
        echo "   3. Hoặc dùng ALL_MAIN_SEQUENCES.md\n\n";
        echo "================================================\n";
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
    $generator = new MainSequenceGenerator();
    $generator->run();
} catch (Exception $e) {
    echo "❌ Lỗi: " . $e->getMessage() . "\n";
}
?>
