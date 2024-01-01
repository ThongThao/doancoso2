
<?php $__env->startSection('content'); ?>

<!-- Page Banner Start -->
<div class="page-banner" style="background-image: url(public/ericshop/images/banner/banner-contact.png);">
    <div class="container">
        <div class="page-banner-content text-center">
            <h2 class="title">Liên hệ</h2>
            <ol class="breadcrumb justify-content-center">
                <li class="breadcrumb-item"><a href="<?php echo e(URL::to('/home')); ?>">Trang chủ</a></li>
                <li class="breadcrumb-item active" aria-current="page">Liên hệ</li>
            </ol>
        </div>
    </div>
</div>
<!-- Page Banner End -->

<section class="section-contact pt-120 pb-120">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
            <form method="post" action="<?php echo e(route('contact.send')); ?>">
    <?php echo csrf_field(); ?>
    <input type="email" name="email" placeholder="Your email"><br>
    <textarea name="message" placeholder="Your message"></textarea><br>
    <button type="submit">Send</button>
</form>

            </div>
            <div class="col-lg-6">
                <div class="contact-info">
                    <ul>
                        <li><i class="fa fa-map-marker"></i> Địa chỉ của bạn</li>
                        <li><i class="fa fa-envelope"></i> example@example.com</li>
                        <li><i class="fa fa-phone"></i> +123456789</li>
                    </ul>
                </div>
                <div class="map"><iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3835.7332975516088!2d108.24978007465472!3d15.975298241946646!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3142108997dc971f%3A0x1295cb3d313469c9!2zVHLGsOG7nW5nIMSQ4bqhaSBo4buNYyBDw7RuZyBuZ2jhu4cgVGjDtG5nIHRpbiB2w6AgVHJ1eeG7gW4gdGjDtG5nIFZp4buHdCAtIEjDoG4!5e0!3m2!1svi!2s!4v1700659216650!5m2!1svi!2s" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>

                </div>
            </div>
            <!-- ... -->
        </div>
        
    </div>
   

</section>

<!-- Contact Information and Map Section -->

<?php $__env->stopSection(); ?>


<?php echo $__env->make('shop_layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\ericshop\resources\views/shop/contact/contact.blade.php ENDPATH**/ ?>