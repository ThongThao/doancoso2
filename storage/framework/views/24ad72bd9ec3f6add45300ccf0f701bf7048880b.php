
<?php $__env->startSection('content_dash'); ?>

<?php use Illuminate\Support\Facades\Session; ?>

<div class="content-page">
    <div class="container-fluid add-form-list">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                        <h4 class="card-title">Chỉnh Sửa Thương Hiệu</h4>
                    </div>
                </div>
                <div class="card-body">
                    <form action="<?php echo e(URL::to('/submit-edit-brand/'.$select_brand->idBrand)); ?>" method="POST" data-toggle="validator">
                        <?php echo csrf_field(); ?>
                        <div class="row"> 
                            <div class="col-md-12">
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
                                <div class="form-group">
                                    <label>Tên thương hiệu</label>
                                    <input type="text" name="BrandName" class="form-control slug" onkeyup="ChangeToSlug()" value="<?php echo e($select_brand->BrandName); ?>" placeholder="Nhập tên thương hiệu" required>
                                    <div class="help-block with-errors"></div>
                                </div>
                                <input type="hidden" name="BrandSlug" value="<?php echo e($select_brand->BrandSlug); ?>" class="form-control" id="convert_slug">
                            </div>    
                        </div>                             
                        <input type="submit" class="btn btn-primary mr-2" value="Sửa thương hiệu">
                        <a href="<?php echo e(URL::to('/manage-brand')); ?>" class="btn btn-light mr-2">Trở Về</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Page end  -->
</div>
</div>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin_layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\ericshop\resources\views/admin/brand/edit-brand.blade.php ENDPATH**/ ?>