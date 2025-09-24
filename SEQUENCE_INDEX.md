# SEQUENCE DIAGRAMS INDEX

## Quick Access Links

1. **User Authentication Flow**
   - File: `main_sequence_user_authentication.txt`
   - Actors: 5
   - Steps: 9
   - Key Methods: `enterCredentials(email, password)`, `submit_login(email, password)`, `validateInput(email, password)`...

2. **Product Browsing & Search**
   - File: `main_sequence_product_browsing.txt`
   - Actors: 5
   - Steps: 10
   - Key Methods: `visitStore()`, `show_all_product()`, `getProducts(filters)`...

3. **Shopping Cart Management**
   - File: `main_sequence_shopping_cart_management.txt`
   - Actors: 5
   - Steps: 10
   - Key Methods: `selectProduct(productId)`, `chooseQuantity(qty)`, `add_to_cart(productId, qty)`...

4. **VietQR Payment Process**
   - File: `main_sequence_vietqr_payment_process.txt`
   - Actors: 6
   - Steps: 11
   - Key Methods: `selectVietQRPayment()`, `createVietQRPayment(orderData)`, `generateQRCode(amount, orderInfo)`...

5. **Order Management (Admin)**
   - File: `main_sequence_order_management_admin.txt`
   - Actors: 6
   - Steps: 12
   - Key Methods: `accessOrderManagement()`, `list_bill(status, page)`, `getPendingOrders()`...

6. **Product Review System**
   - File: `main_sequence_product_review_system.txt`
   - Actors: 6
   - Steps: 12
   - Key Methods: `accessReviewSection()`, `canReview(customerId, productId)`, `checkPurchaseHistory(customerId, productId)`...

7. **Inventory & Product Management**
   - File: `main_sequence_inventory_product_management.txt`
   - Actors: 6
   - Steps: 13
   - Key Methods: `accessProductManagement()`, `manage_products()`, `getAllProducts(pagination)`...

## Method Names Reference

- `accessOrderManagement()`
- `accessProductManagement()`
- `accessReviewSection()`
- `add_product()`
- `add_to_cart(productId, qty)`
- `approveReview(reviewId)`
- `bill_info(orderId)`
- `calculateSubtotal()`
- `canReview(customerId, productId)`
- `checkProductStock(productId)`
- `checkPurchaseHistory(customerId, productId)`
- `chooseQuantity(qty)`
- `confirm_bill(orderId)`
- `createSession(userId)`
- `createVietQRPayment(orderData)`
- `deliverConfirmationEmail()`
- `displayCartSummary()`
- `displayOrderList(orders)`
- `displayProducts(products)`
- `displayQRCode(qrData)`
- `displaySearchResults()`
- `enterCredentials(email, password)`
- `executeSearchQuery()`
- `findUserByEmail(email)`
- `fullTextSearch(keyword)`
- `generateQRCode(amount, orderInfo)`
- `getAllProducts(pagination)`
- `getOrderDetails(orderId)`
- `getPendingOrders()`
- `getProducts(filters)`
- `initializeStock(productId, quantity)`
- `insertProduct(productData)`
- `list_bill(status, page)`
- `manage_products()`
- `notifyNewReview()`
- `notifyReviewApproved()`
- `redirect("/dashboard")`
- `redirectToSuccessPage()`
- `redirectWithSuccess()`
- `requestQRGeneration()`
- `return imagePaths`
- `return orderList`
- `return productList`
- `return purchaseStatus`
- `return qrCodeData`
- `return qrInfo`
- `return searchResults`
- `return sessionId`
- `return stockQuantity`
- `return userData`
- `saveCartData(cartItems)`
- `saveReview(reviewData, status="pending")`
- `scanAndPay(qrCode)`
- `searchProducts(keyword)`
- `selectOrder(orderId)`
- `selectProduct(productId)`
- `selectVietQRPayment()`
- `sendOrderConfirmation(orderData)`
- `sendReviewNotification()`
- `showProductForm()`
- `show_all_product()`
- `submitReview(rating, comment)`
- `submit_add_product(productData)`
- `submit_login(email, password)`
- `updateInventory(productId, quantity)`
- `updateOrderStatus(orderId, "confirmed")`
- `updateOrderStatus(orderId, "paid")`
- `updateReviewStatus(reviewId, "approved")`
- `update_qty_cart(itemId, newQty)`
- `uploadProductImages(images)`
- `validateInput(email, password)`
- `validateProductData()`
- `validateReviewData()`
- `verifyPassword(password, hash)`
- `viewCart()`
- `visitStore()`
- `webhook(paymentData)`
