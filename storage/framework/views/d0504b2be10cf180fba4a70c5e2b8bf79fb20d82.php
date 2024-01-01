
<?php $__env->startSection('content'); ?>

<!--Page Banner Start-->
<div class="page-banner" style="background-image: url(../public/ericshop/images/banner/banner-blog.png);">
    <div class="container">
        <div class="page-banner-content text-center">
            <h2 class="title">Chi Tiết Bài Viết</h2>
            <ol class="breadcrumb justify-content-center">
                <li class="breadcrumb-item"><a href="<?php echo e(URL::to('/home')); ?>">Trang chủ</a></li>
                <li class="breadcrumb-item active" aria-current="page"><a href="<?php echo e(URL::to('/blog')); ?>">Tin tức</a></li>
                <li class="breadcrumb-item active" aria-current="page"><?php echo e($Blog->BlogTitle); ?></li>
            </ol>
        </div>
    </div>
</div>
<!--Page Banner End-->

<!--Empty Cart Start-->
<div class="empty-cart-page section-padding-5">
    <div class="container">
        <div class="row flex-row-reverse">
            <div class="col-lg-9">
                <div class="blog-single">
                    <h2 class="title text-primary"><?php echo e($Blog->BlogTitle); ?></h2>
                    <div class="articles-date"><?php echo e($Blog->created_at); ?></div>
                    <div class="blogDesc mb-30"><?php echo $Blog->BlogDesc; ?></div>
                    <?php echo $Blog->BlogContent; ?>

                </div>
            </div>
            <div class="col-lg-3">
                <div class="sidebar-post">
                    <h3 class="widget-title">Bài viết gần đây</h3>
                    <ul class="post-items">
                        <?php $__currentLoopData = $list_new_blog; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $new_blog): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li>
                            <div class="single-post">
                                <div class="post-thumb">
                                    <a href="<?php echo e(URL::to('/blog/'.$new_blog->BlogSlug)); ?>"><img src="<?php echo e(asset('public/storage/admin/images/blog/'.$new_blog->BlogImage)); ?>" alt=""></a>
                                </div>
                                <div class="post-content">
                                    <div class="post-title"><a class="two-line" href="<?php echo e(URL::to('/blog/'.$new_blog->BlogSlug)); ?>"><?php echo e($new_blog->BlogTitle); ?></a></div>
                                    <span class="date"><?php echo e($new_blog->created_at); ?></span>
                                </div>
                            </div>
                        </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!--Empty Cart End-->

<?php $__env->stopSection(); ?>
<?php echo $__env->make('shop_layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\ericshop\resources\views/shop/blog/blog-details.blade.php ENDPATH**/ ?>