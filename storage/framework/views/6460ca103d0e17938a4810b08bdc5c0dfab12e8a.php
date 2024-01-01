
<?php $__env->startSection('content'); ?>

<!--Page Banner Start-->
<div class="page-banner" style="background-image: url(public/ericshop/images/banner/banner-shop.png);">
    <div class="container">
        <div class="page-banner-content text-center">
            <h2 class="title">Giỏ hàng</h2>
            <ol class="breadcrumb justify-content-center">
                <li class="breadcrumb-item"><a href="<?php echo e(URL::to('/home')); ?>">Trang chủ</a></li>
                <li class="breadcrumb-item active" aria-current="page">Giỏ hàng</li>
            </ol>
        </div>
    </div>
</div>
<!--Page Banner End-->

<!--Empty Cart Start-->
<div class="empty-cart-page section-padding-5">
    <div class="container">
        <div class="empty-cart-content text-center d-flex flex-column align-items-center">
            <div class="empty-cart-img">
                <img src="public/ericshop/images/cart.png" alt="">
            </div>
            <p>Giỏ hàng của bạn chưa có sản phẩm!</p>
            <a href="<?php echo e(URL::to('/store')); ?>" class="btn btn-primary"><i class="fa fa-angle-left"></i> Tiếp tục mua sắm</a>
        </div>
    </div>
</div>
<!--Empty Cart End-->

<?php $__env->stopSection(); ?>
<?php echo $__env->make('shop_layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\ericshop\resources\views/shop/cart/empty-cart.blade.php ENDPATH**/ ?>