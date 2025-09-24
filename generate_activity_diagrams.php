<?php
/**
 * Tạo 7 Activity Diagrams cho các chức năng chính
 * Sử dụng Mermaid flowchart syntax
 */

class ActivityDiagramGenerator
{
    private $activities = [];

    public function __construct()
    {
        echo "🔄 Tạo 7 Activity Diagrams...\n";
    }

    /**
     * Định nghĩa 7 activity diagrams
     */
    public function defineActivityDiagrams()
    {
        $this->activities = [
            'user_authentication_activity' => [
                'title' => 'User Authentication Activity',
                'description' => 'User login process flow',
                'flowchart' => 'flowchart TD
    A[Start: User visits login page] --> B[Enter email and password]
    B --> C{Validate input format}
    C -->|Invalid| D[Display validation errors]
    D --> B
    C -->|Valid| E[Submit credentials to server]
    E --> F[Check user exists in database]
    F --> G{User found?}
    G -->|No| H[Display "Invalid credentials"]
    H --> B
    G -->|Yes| I[Verify password hash]
    I --> J{Password correct?}
    J -->|No| K[Increment failed attempts]
    K --> L{Account locked?}
    L -->|Yes| M[Display "Account locked"]
    M --> N[End: Login failed]
    L -->|No| H
    J -->|Yes| O[Create user session]
    O --> P[Set authentication cookies]
    P --> Q[Log successful login]
    Q --> R[Redirect to dashboard]
    R --> S[End: Login successful]'
            ],

            'product_browsing_activity' => [
                'title' => 'Product Browsing & Search Activity',
                'description' => 'Product discovery and search flow',
                'flowchart' => 'flowchart TD
    A[Start: User visits store] --> B[Load product catalog]
    B --> C[Display products with pagination]
    C --> D{User action}
    D -->|Filter by category| E[Apply category filter]
    E --> F[Reload filtered products]
    F --> C
    D -->|Filter by brand| G[Apply brand filter]
    G --> F
    D -->|Filter by price| H[Apply price range filter]
    H --> F
    D -->|Search by keyword| I[Enter search term]
    I --> J[Execute fulltext search]
    J --> K{Results found?}
    K -->|No| L[Display "No results found"]
    L --> M[Show search suggestions]
    M --> C
    K -->|Yes| N[Display search results]
    N --> C
    D -->|View product details| O[Click on product]
    O --> P[Load product details page]
    P --> Q[Display product info, images, reviews]
    Q --> R[End: Product viewed]'
            ],

            'shopping_cart_activity' => [
                'title' => 'Shopping Cart Management Activity',
                'description' => 'Add to cart and cart management flow',
                'flowchart' => 'flowchart TD
    A[Start: User selects product] --> B[Choose quantity and attributes]
    B --> C[Click "Add to Cart"]
    C --> D[Check product availability]
    D --> E{Stock available?}
    E -->|No| F[Display "Out of stock"]
    F --> G[End: Cannot add to cart]
    E -->|Yes| H[Add item to cart session]
    H --> I[Update cart counter]
    I --> J[Display success message]
    J --> K{Continue shopping?}
    K -->|Yes| L[Return to product browsing]
    L --> A
    K -->|No| M[View cart]
    M --> N[Display cart items]
    N --> O{Cart actions}
    O -->|Update quantity| P[Change item quantity]
    P --> Q{New quantity > 0?}
    Q -->|No| R[Remove item from cart]
    R --> N
    Q -->|Yes| S[Update item quantity]
    S --> T[Recalculate totals]
    T --> N
    O -->|Remove item| R
    O -->|Apply voucher| U[Enter voucher code]
    U --> V{Valid voucher?}
    V -->|No| W[Display voucher error]
    W --> N
    V -->|Yes| X[Apply discount]
    X --> T
    O -->|Proceed to checkout| Y[Go to payment]
    Y --> Z[End: Ready for payment]'
            ],

            'vietqr_payment_activity' => [
                'title' => 'VietQR Payment Process Activity',
                'description' => 'VietQR payment workflow',
                'flowchart' => 'flowchart TD
    A[Start: User selects VietQR payment] --> B[Validate order data]
    B --> C{Order valid?}
    C -->|No| D[Display validation errors]
    D --> E[End: Payment failed]
    C -->|Yes| F[Create payment request]
    F --> G[Generate QR code via Casso API]
    G --> H{QR generation successful?}
    H -->|No| I[Display API error]
    I --> J[Offer alternative payment]
    J --> E
    H -->|Yes| K[Display QR code to user]
    K --> L[Start payment status polling]
    L --> M[User scans QR with banking app]
    M --> N[User confirms payment in bank app]
    N --> O[Bank processes transfer]
    O --> P[Bank sends webhook to Casso]
    P --> Q[Casso forwards webhook to system]
    Q --> R[Validate webhook signature]
    R --> S{Webhook valid?}
    S -->|No| T[Log security incident]
    T --> U[End: Payment verification failed]
    S -->|Yes| V[Update order status to paid]
    V --> W[Send payment confirmation email]
    W --> X[Clear shopping cart]
    X --> Y[Redirect to success page]
    Y --> Z[End: Payment successful]
    L --> AA{Payment timeout?}
    AA -->|Yes| BB[Cancel payment request]
    BB --> CC[Display timeout message]
    CC --> E'
            ],

            'order_management_admin_activity' => [
                'title' => 'Order Management Admin Activity',
                'description' => 'Admin order processing workflow',
                'flowchart' => 'flowchart TD
    A[Start: Admin accesses order management] --> B[Load pending orders list]
    B --> C[Display orders with filters]
    C --> D{Admin action}
    D -->|Filter orders| E[Apply status/date filters]
    E --> F[Reload filtered orders]
    F --> C
    D -->|View order details| G[Click on order]
    G --> H[Load complete order information]
    H --> I[Display order details, customer info, items]
    I --> J{Order action}
    J -->|Confirm order| K{Stock available?}
    K -->|No| L[Display stock shortage]
    L --> M[Contact customer for alternatives]
    M --> I
    K -->|Yes| N[Update order status to confirmed]
    N --> O[Update inventory quantities]
    O --> P[Send confirmation email to customer]
    P --> Q[Create order fulfillment task]
    Q --> R[Log admin action]
    R --> S[Display success message]
    S --> C
    J -->|Cancel order| T[Enter cancellation reason]
    T --> U[Update order status to cancelled]
    U --> V[Release reserved inventory]
    V --> W[Send cancellation email]
    W --> X[Process refund if needed]
    X --> R
    J -->|Ship order| Y[Update status to shipping]
    Y --> Z[Generate shipping label]
    Z --> AA[Send tracking info to customer]
    AA --> R
    J -->|Mark as delivered| BB[Update status to delivered]
    BB --> CC[Request customer feedback]
    CC --> R'
            ],

            'product_review_activity' => [
                'title' => 'Product Review System Activity',
                'description' => 'Review submission and moderation flow',
                'flowchart' => 'flowchart TD
    A[Start: Customer wants to review product] --> B[Check if customer purchased product]
    B --> C{Purchase verified?}
    C -->|No| D[Display "Must purchase to review"]
    D --> E[End: Review not allowed]
    C -->|Yes| F[Check if already reviewed]
    F --> G{Already reviewed?}
    G -->|Yes| H[Display "Already reviewed"]
    H --> E
    G -->|No| I[Show review form]
    I --> J[Customer enters rating and comment]
    J --> K[Optional: Upload review images]
    K --> L[Submit review]
    L --> M[Validate review data]
    M --> N{Valid data?}
    N -->|No| O[Display validation errors]
    O --> I
    N -->|Yes| P[Run spam detection]
    P --> Q{Spam detected?}
    Q -->|Yes| R[Auto-reject review]
    R --> S[Log spam attempt]
    S --> T[Display generic success message]
    T --> E
    Q -->|No| U[Save review with pending status]
    U --> V[Notify admin of new review]
    V --> W[Display "Review submitted for approval"]
    W --> X[Admin reviews content]
    X --> Y{Admin decision}
    Y -->|Approve| Z[Update review status to approved]
    Z --> AA[Update product rating average]
    AA --> BB[Send approval email to customer]
    BB --> CC[Display review on product page]
    CC --> DD[End: Review published]
    Y -->|Reject| EE[Update review status to rejected]
    EE --> FF[Send rejection email with reason]
    FF --> GG[End: Review rejected]'
            ],

            'inventory_product_activity' => [
                'title' => 'Inventory & Product Management Activity',
                'description' => 'Product creation and inventory management flow',
                'flowchart' => 'flowchart TD
    A[Start: Admin adds new product] --> B[Access product management panel]
    B --> C[Click "Add New Product"]
    C --> D[Display product creation form]
    D --> E[Enter basic product information]
    E --> F[Enter pricing and inventory data]
    F --> G[Select product category and brand]
    G --> H[Upload product images]
    H --> I[Add product attributes and variants]
    I --> J[Enter SEO data]
    J --> K[Preview product information]
    K --> L{Information correct?}
    L -->|No| M[Edit product data]
    M --> E
    L -->|Yes| N[Submit product creation]
    N --> O[Validate all product data]
    O --> P{Validation passed?}
    P -->|No| Q[Display validation errors]
    Q --> M
    P -->|Yes| R[Process and resize images]
    R --> S[Generate product slug]
    S --> T[Save product to database]
    T --> U[Initialize inventory record]
    U --> V[Set initial stock quantity]
    V --> W[Create product history log]
    W --> X[Index product for search]
    X --> Y{Auto-publish?}
    Y -->|No| Z[Set status to draft]
    Z --> AA[Notify admin for review]
    AA --> BB[End: Product saved as draft]
    Y -->|Yes| CC[Set status to active]
    CC --> DD[Send to product feed]
    DD --> EE[Notify relevant staff]
    EE --> FF[End: Product published]
    
    GG[Start: Inventory Update] --> HH[Scan product barcode or search]
    HH --> II[Load current inventory data]
    II --> JJ[Enter new stock quantity]
    JJ --> KK[Select adjustment reason]
    KK --> LL[Submit inventory update]
    LL --> MM[Calculate quantity difference]
    MM --> NN[Update product inventory]
    NN --> OO[Log inventory transaction]
    OO --> PP{Stock below minimum?}
    PP -->|Yes| QQ[Generate low stock alert]
    QQ --> RR[Notify purchasing team]
    RR --> SS[End: Inventory updated with alert]
    PP -->|No| TT[End: Inventory updated]'
            ]
        ];
        
        echo "✅ Định nghĩa " . count($this->activities) . " activity diagrams\n";
    }

    /**
     * Tạo Mermaid activity diagram
     */
    public function generateActivityMermaid($activityKey)
    {
        if (!isset($this->activities[$activityKey])) {
            return false;
        }

        $activity = $this->activities[$activityKey];
        
        $mermaid = "---\n";
        $mermaid .= "title: " . $activity['title'] . "\n";
        $mermaid .= "---\n";
        $mermaid .= $activity['flowchart'];
        
        return $mermaid;
    }

    /**
     * Lưu tất cả Activity Diagrams
     */
    public function saveAllActivityFiles()
    {
        echo "💾 Đang lưu activity diagrams...\n";
        
        foreach ($this->activities as $key => $activity) {
            $mermaid = $this->generateActivityMermaid($key);
            $filename = "activity_{$key}.txt";
            
            if (file_put_contents($filename, $mermaid)) {
                echo "✅ Đã lưu: $filename\n";
            } else {
                echo "❌ Lỗi lưu: $filename\n";
            }
        }
        
        return true;
    }

    /**
     * Tạo file tổng hợp tất cả activity diagrams
     */
    public function generateAllActivitiesFile()
    {
        echo "📄 Đang tạo file tổng hợp activity diagrams...\n";
        
        $allActivities = "# 7 ACTIVITY DIAGRAMS - ERICSHOP E-COMMERCE\n\n";
        $allActivities .= "Generated: " . date('Y-m-d H:i:s') . "\n\n";
        $allActivities .= "## Overview\n";
        $allActivities .= "This document contains 7 activity diagrams (flowcharts) for EricShop e-commerce system.\n";
        $allActivities .= "Each diagram shows the process flow with decision points and alternative paths.\n\n";
        
        $index = 1;
        foreach ($this->activities as $key => $activity) {
            $allActivities .= "## $index. " . $activity['title'] . "\n\n";
            $allActivities .= "**Description:** " . $activity['description'] . "\n\n";
            
            $allActivities .= "### Mermaid Flowchart:\n";
            $allActivities .= "```mermaid\n";
            $allActivities .= $activity['flowchart'];
            $allActivities .= "\n```\n\n";
            
            $allActivities .= "---\n\n";
            $index++;
        }
        
        $allActivities .= "## Usage Instructions\n\n";
        $allActivities .= "### Method 1: Mermaid Live Editor\n";
        $allActivities .= "1. Visit: https://mermaid.live/\n";
        $allActivities .= "2. Copy any flowchart code block above\n";
        $allActivities .= "3. Paste in the editor\n";
        $allActivities .= "4. View and export diagram\n\n";
        
        $allActivities .= "### Method 2: Draw.io Import\n";
        $allActivities .= "1. Visit: https://app.diagrams.net/\n";
        $allActivities .= "2. File → Import from → Text\n";
        $allActivities .= "3. Select Mermaid format\n";
        $allActivities .= "4. Paste flowchart code\n\n";
        
        $allActivities .= "### Method 3: Individual Files\n";
        $allActivities .= "- Use individual `activity_*.txt` files\n";
        $allActivities .= "- Each file contains one activity diagram\n";
        $allActivities .= "- Import to any Mermaid-compatible tool\n\n";
        
        $allActivities .= "## Diagram Types Explained\n\n";
        $allActivities .= "### Flowchart Elements:\n";
        $allActivities .= "- **Rectangle [ ]**: Process/Action step\n";
        $allActivities .= "- **Diamond { }**: Decision point\n";
        $allActivities .= "- **Rounded [ ]**: Start/End terminal\n";
        $allActivities .= "- **Arrow -->**: Process flow direction\n";
        $allActivities .= "- **Labels |text|**: Condition descriptions\n\n";
        
        $allActivities .= "### Flow Patterns:\n";
        $allActivities .= "- **Linear Flow**: Sequential steps A → B → C\n";
        $allActivities .= "- **Decision Flow**: A → {Decision?} → B or C\n";
        $allActivities .= "- **Loop Flow**: A → B → {Continue?} → A\n";
        $allActivities .= "- **Parallel Flow**: A → B and A → C\n\n";
        
        file_put_contents('ALL_ACTIVITY_DIAGRAMS.md', $allActivities);
        echo "✅ Đã tạo file tổng hợp: ALL_ACTIVITY_DIAGRAMS.md\n";
    }

    /**
     * Tạo mapping file giữa sequence và activity diagrams
     */
    public function generateMappingFile()
    {
        $mapping = "# SEQUENCE ↔ ACTIVITY DIAGRAMS MAPPING\n\n";
        $mapping .= "## Relationship Between Diagrams\n\n";
        $mapping .= "Each business function has both a **Sequence Diagram** (showing actor interactions) and an **Activity Diagram** (showing process flow).\n\n";
        
        $functions = [
            'User Authentication' => ['sequence' => 'main_sequence_user_authentication.txt', 'activity' => 'activity_user_authentication_activity.txt'],
            'Product Browsing & Search' => ['sequence' => 'main_sequence_product_browsing.txt', 'activity' => 'activity_product_browsing_activity.txt'],
            'Shopping Cart Management' => ['sequence' => 'main_sequence_shopping_cart_management.txt', 'activity' => 'activity_shopping_cart_activity.txt'],
            'VietQR Payment Process' => ['sequence' => 'main_sequence_vietqr_payment_process.txt', 'activity' => 'activity_vietqr_payment_activity.txt'],
            'Order Management (Admin)' => ['sequence' => 'main_sequence_order_management_admin.txt', 'activity' => 'activity_order_management_admin_activity.txt'],
            'Product Review System' => ['sequence' => 'main_sequence_product_review_system.txt', 'activity' => 'activity_product_review_activity.txt'],
            'Inventory & Product Management' => ['sequence' => 'main_sequence_inventory_product_management.txt', 'activity' => 'activity_inventory_product_activity.txt']
        ];
        
        $index = 1;
        foreach ($functions as $function => $files) {
            $mapping .= "### $index. $function\n\n";
            $mapping .= "| Diagram Type | File | Purpose |\n";
            $mapping .= "|--------------|------|----------|\n";
            $mapping .= "| **Sequence** | `{$files['sequence']}` | Shows **who** does **what** and **when** |\n";
            $mapping .= "| **Activity** | `{$files['activity']}` | Shows **how** the process flows with **decisions** |\n\n";
            
            $mapping .= "**When to use:**\n";
            $mapping .= "- **Sequence Diagram**: For understanding system architecture, API calls, actor responsibilities\n";
            $mapping .= "- **Activity Diagram**: For understanding business logic, decision points, alternative flows\n\n";
            
            $mapping .= "---\n\n";
            $index++;
        }
        
        $mapping .= "## Quick Reference\n\n";
        $mapping .= "### Sequence Diagrams\n";
        $mapping .= "- **Focus**: Actor interactions and method calls\n";
        $mapping .= "- **Format**: Vertical timeline showing message passing\n";
        $mapping .= "- **Best for**: Technical documentation, API design\n\n";
        
        $mapping .= "### Activity Diagrams\n";
        $mapping .= "- **Focus**: Process flow and business logic\n";
        $mapping .= "- **Format**: Flowchart with decision points\n";
        $mapping .= "- **Best for**: Business process documentation, user training\n\n";
        
        file_put_contents('SEQUENCE_ACTIVITY_MAPPING.md', $mapping);
        echo "✅ Đã tạo file mapping: SEQUENCE_ACTIVITY_MAPPING.md\n";
    }

    /**
     * Chạy tất cả
     */
    public function run()
    {
        echo "\n🔄 ========== ACTIVITY DIAGRAM GENERATOR ========== 🔄\n";
        echo "🏪 Tạo 7 activity diagrams cho EricShop\n";
        echo "📅 Ngày: " . date('d/m/Y H:i:s') . "\n";
        echo "=================================================\n\n";

        $this->defineActivityDiagrams();
        $this->saveAllActivityFiles();
        $this->generateAllActivitiesFile();
        $this->generateMappingFile();
        
        echo "\n🎉 ========== HOÀN THÀNH ========== 🎉\n";
        echo "✅ Đã tạo thành công 7 activity diagrams!\n\n";
        
        echo "📊 Thống kê:\n";
        echo "   - 7 activity diagrams (flowcharts)\n";
        echo "   - " . $this->getTotalNodes() . " tổng nodes/steps\n";
        echo "   - " . $this->getTotalDecisions() . " decision points\n\n";
        
        echo "📁 Files được tạo:\n";
        foreach ($this->activities as $key => $activity) {
            echo "   🔄 " . $activity['title'] . ":\n";
            echo "      - activity_{$key}.txt\n";
        }
        echo "   📖 ALL_ACTIVITY_DIAGRAMS.md (File tổng hợp)\n";
        echo "   🔗 SEQUENCE_ACTIVITY_MAPPING.md (Mapping)\n\n";
        
        echo "🚀 Sử dụng ngay:\n";
        echo "   1. Mermaid Live: https://mermaid.live/\n";
        echo "   2. Draw.io: https://app.diagrams.net/\n";
        echo "   3. Copy từ activity_*.txt\n\n";
        echo "=================================================\n";
    }

    /**
     * Tính tổng số nodes
     */
    private function getTotalNodes()
    {
        $total = 0;
        foreach ($this->activities as $activity) {
            // Count approximate nodes based on flowchart content
            $nodeCount = substr_count($activity['flowchart'], '[') + substr_count($activity['flowchart'], '{');
            $total += $nodeCount;
        }
        return $total;
    }

    /**
     * Tính tổng số decision points
     */
    private function getTotalDecisions()
    {
        $total = 0;
        foreach ($this->activities as $activity) {
            // Count decision points (diamond shapes)
            $decisionCount = substr_count($activity['flowchart'], '{');
            $total += $decisionCount;
        }
        return $total;
    }
}

// Chạy generator
try {
    $generator = new ActivityDiagramGenerator();
    $generator->run();
} catch (Exception $e) {
    echo "❌ Lỗi: " . $e->getMessage() . "\n";
}
?>
