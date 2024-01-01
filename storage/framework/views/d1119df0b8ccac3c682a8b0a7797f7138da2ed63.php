
<?php $__env->startSection('content'); ?>

<?php use Illuminate\Support\Facades\Session; ?>

<!--Page Banner Start-->
<div class="page-banner" style="background-image: url(public/ericshop/images/oso.png);">
    <div class="container">
        <div class="page-banner-content text-center">
            <h2 class="title">Đăng Nhập</h2>
            <ol class="breadcrumb justify-content-center">
                <li class="breadcrumb-item"><a href="<?php echo e(URL::to('/home')); ?>">Trang Chủ</a></li>
                <li class="breadcrumb-item active" aria-current="page">Đăng Nhập</li>
            </ol>
        </div>
    </div>
</div>
<!--Page Banner End-->

<!--Login Start-->
<div class="login-page section-padding-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="login-register-content">
                    <h4 class="title">Đăng Nhập Tài Khoản</h4>

                    <div class="login-register-form">
                        <form method="POST" action="<?php echo e(URL::to('/submit-login')); ?>" id="form-login">
                            <?php echo csrf_field(); ?>
                            <?php
                                $message = Session::get('message');
                                if($message){
                                    echo '<span class="text-danger">'.$message.'</span>';
                                    Session::put('message', null);
                                }
                                ?>
                            <div class="form-group mt-15">
                                <label for="username">Tên tài khoản</label>
                                <input id="username" type="text" name="username" required>
                                <span class="text-danger"></span>
                            </div>
                            <div class="form-group mt-15">
                                <label for="passsword">Mật khẩu</label>
                                <input id="password" type="password" name="password" required>
                                <span class="text-danger"></span>
                            </div>
                            <div class="form-group mt-15">
                                <input type="submit" class="btn btn-primary btn-block" value="Đăng nhập"/>
                            </div>
                            <div class="form-group mt-15">
                                <label>Bạn chưa có tài khoản?</label>
                                <a href="<?php echo e(URL::to('/register')); ?>" class="btn btn-dark btn-block">Đăng ký ngay</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--Login End-->

<!-- Validate form đăng nhập -->
<script>
    $(document).ready(function(){  
        Validator({
            form: "#form-login",
            errorSelector: ".text-danger",
            parentSelector: ".form-group",
            rules:[
            Validator.isRequired("#username"),
            Validator.isRequired("#password")
            ]
        });
    });
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('shop_layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\ericshop\resources\views/shop/customer/login.blade.php ENDPATH**/ ?>