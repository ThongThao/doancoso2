
<?php $__env->startSection('content_dash'); ?>

<?php use Illuminate\Support\Facades\Session; ?>

<div class="content-page">
    <div class="container-fluid add-form-list">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">Chỉnh Sửa Phân Loại</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="<?php echo e(URL::to('/submit-edit-attr-value/'.$select_attr_value->idAttrValue)); ?>" method="POST" data-toggle="validator">
                            <?php echo csrf_field(); ?>
                            <div class="row"> 
                                <?php
                                    $message = Session::get('message');
                                    $error = Session::get('error');
                                    if($message){
                                        echo '<span class="text-success ml-3">'.$message.'</span>';
                                        Session::put('message', null);
                                    }else if($error){
                                        echo '<span class="text-danger ml-3">'.$error.'</span>';
                                        Session::put('error', null);
                                    }
                                ?>            
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="idAttribute">Nhóm phân loại *</label>
                                        <select id="idAttribute" name="idAttribute" class="selectpicker form-control" data-style="py-0" required>
                                            <option value="<?php echo e($select_attr_value->idAttribute); ?>"><?php echo e($select_attr_value->AttributeName); ?></option>
                                            <?php $__currentLoopData = $list_attribute; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $attribute): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($attribute->idAttribute); ?>"><?php echo e($attribute->AttributeName); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>          
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Tên phân loại</label>
                                        <input type="text" name="AttrValName" class="form-control" value="<?php echo e($select_attr_value->AttrValName); ?>" placeholder="Nhập tên phân loại" required>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>    
                            </div>                             
                            <input type="submit" class="btn btn-primary mr-2" value="Sửa phân loại">
                            <a href="<?php echo e(URL::to('/manage-attr-value')); ?>" class="btn btn-light mr-2">Trở Về</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Page end  -->


<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin_layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\ericshop\resources\views/admin/product/product-attribute/attribute-value/edit-attr-value.blade.php ENDPATH**/ ?>