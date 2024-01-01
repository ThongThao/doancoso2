
<?php $__env->startSection('content_dash'); ?>

<?php use Illuminate\Support\Facades\Session; ?>

<div class="content-page">
    <div class="container-fluid">
        <div class="row">
        <div class="col-lg-12">
            <div class="iq-edit-list-data">
                <div class="tab-content">
                    <div class="tab-pane fade active show" id="personal-information" role="tabpanel">
                        <?php
                            $message = Session::get('message');
                            $error = Session::get('error');
                            if($message){
                                echo '<span class="text-success">'.$message.'</span>';
                                Session::put('message', null);
                            }else if($error){
                                echo '<span class="text-danger">'.$error.'</span>';
                                Session::put('error', null);
                            }
                        ?>     
                        <div class="card">
                            <div class="card-header d-flex justify-content-between">
                                <div class="iq-header-title">
                                    <h4 class="card-title">Chỉnh Sửa Hồ Sơ</h4>
                                </div>
                            </div>
                            <div class="card-body">
                                <form method="POST" action="<?php echo e(URL::to('/submit-edit-adprofile')); ?>" id="form-profile-edit" enctype="multipart/form-data">
                                    <?php echo csrf_field(); ?>
                                    <div class="form-group row align-items-center">
                                        <div class="col-md-12">
                                            <div class="profile-img-edit">
                                                <div class="crm-profile-img-edit">
                                                        <img class="crm-profile-pic rounded-circle avatar-100 replace-avt" src="public/admin/images/user/12.png" alt="profile-pic">
                                                </div>                                          
                                            </div>
                                        </div>
                                        <div class="text-danger alert-img ml-3 mt-3"></div>
                                    </div>
                                    <div class=" row align-items-center">
                                        <div class="form-group col-sm-6">
                                            <label for="fname">Họ Và Tên:</label>
                                            <input type="text" name="AdminName" class="form-control" id="fname" value="<?php echo Session::get('AdminName')?>">
                                            <span class="text-danger"></span>
                                        </div>
                                        <div class="form-group col-sm-6">
                                            <label for="nmphone">Số Điện Thoại:</label>
                                            <input type="text" name="NumberPhone" class="form-control" id="nmphone" value="<?php echo Session::get('NumberPhone')?>">
                                            <span class="text-danger"></span>
                                        </div>
                                        <div class="form-group col-sm-6">
                                            <label for="editmail">Email:</label>
                                            <input type="email" name="Email" class="form-control" id="editmail" value="<?php echo Session::get('Email')?>">
                                            <span class="text-danger"></span>
                                        </div>
                                        <div class="form-group col-sm-6">
                                            <label for="address">Địa Chỉ:</label>
                                            <input type="text" name="Address" class="form-control" id="address" value="<?php echo Session::get('Address')?>">
                                            <span class="text-danger"></span>
                                        </div>
                                    </div>
                                    <input type="submit" class="btn btn-primary mr-2" value="Lưu"/>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){  
        Validator({
            form: "#form-profile-edit",
            errorSelector: ".text-danger",
            parentSelector: ".form-group",
            rules:[
            Validator.isRequired("#fname"),
            Validator.isRequired("#nmphone"),
            Validator.isRequired("#editmail"),  
            Validator.isRequired("#address"),
            Validator.isEmail("#editmail"),
            Validator.isPhone("#nmphone")
            ]
        });
    });
</script>



<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin_layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\ericshop\resources\views/admin/my-account/edit-adprofile.blade.php ENDPATH**/ ?>