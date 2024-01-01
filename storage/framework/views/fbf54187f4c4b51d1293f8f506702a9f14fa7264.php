
<?php $__env->startSection('content'); ?>

<!--Page Banner Start-->
<div class="page-banner" style="background-image: url(public/ericshop/images/banner/banner-blog.png);">
    <div class="container">
        <div class="page-banner-content text-center">
            <h2 class="title">Tin Tức</h2>
            <ol class="breadcrumb justify-content-center">
                <li class="breadcrumb-item"><a href="<?php echo e(URL::to('/home')); ?>">Trang chủ</a></li>
                <li class="breadcrumb-item active" aria-current="page">Tin tức</li>
            </ol>
        </div>
    </div>
</div>
<!--Page Banner End-->

<!--Empty Cart Start-->
<div class="empty-cart-page section-padding-5">
    <div class="container">
        <div class="row">
            <?php $__currentLoopData = $list_blog; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $blog): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-lg-4 col-md-6 mb-30">
                <div class="single-blog">
                    <div class="blog-image">
                        <a href="<?php echo e(URL::to('/blog/'.$blog->BlogSlug)); ?>"><img src="<?php echo e(asset('public/storage/admin/images/blog/'.$blog->BlogImage)); ?>" alt=""></a>
                    </div>
                    <div class="blog-content">
                        <h5 class="title"><a href="<?php echo e(URL::to('/blog/'.$blog->BlogSlug)); ?>" class="new-block"><?php echo e($blog->BlogTitle); ?></a></h5>
                        <div class="articles-date">
                            <p><span><?php echo e($blog->created_at); ?></span></p>
                        </div>
                        <div class="four-line mb-4"><?php echo $blog->BlogDesc; ?></div>

                        <div class="blog-footer">
                            <a class="more" href="<?php echo e(URL::to('/blog/'.$blog->BlogSlug)); ?>">Tìm hiểu thêm</a>
                            <!-- <p class="comment-count"><i class="icon-message-circle"></i> 0</p> -->
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            <!--Pagination Start-->
            <div class="page-pagination">
                <?php echo e($list_blog->appends(request()->input())->links()); ?>

            </div>
            <!--Pagination End-->
        </div>
    </div>
</div>
<!--Empty Cart End-->

<?php $__env->stopSection(); ?>
<?php echo $__env->make('shop_layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\ericshop\resources\views/shop/blog/blog.blade.php ENDPATH**/ ?>