
<?php $__env->startSection('content_dash'); ?>

<?php use Illuminate\Support\Facades\Session; ?>

<form action="<?php echo e(URL::to('/submit-edit-sale/'.$sale_product->idSale.'/'.$sale_product->idProduct)); ?>" method="POST" id="form-edit-sale" data-toggle="validator" enctype="multipart/form-data" autocomplete="off">
<?php echo csrf_field(); ?>
<div class="content-page">
    <div class="container-fluid add-form-list">
        <div class="row">
            <div class="col-sm-12 alert-pd">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">Sửa khuyến mãi</h4>
                        </div>
                    </div>
                    <?php
                        $message = Session::get('message');
                        $error = Session::get('error');
                        if($message){
                            echo '<span class="text-success ml-3 mt-3">'.$message.'</span>';
                            Session::put('message', null);
                        }else if($error){
                            echo '<span class="text-danger ml-3 mt-3">'.$error.'</span>';
                            Session::put('error', null);
                        }
                    ?> 
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">  
                                <label>Sản phẩm</label>                    
                                <div class="d-flex align-items-center mb-3">
                                    <?php $image = json_decode($sale_product->ImageName)[0];?>
                                    <img src="<?php echo e(asset('public/storage/kidoldash/images/product/'.$image)); ?>" class="img-fluid rounded avatar-50 mr-3" alt="image">
                                    <div style="color:#000;"><?php echo e($sale_product->ProductName); ?></div>
                                </div>
                            </div>
                            <div class="col-md-12">                      
                                <div class="form-group">
                                    <label>Tên chương trình khuyến mãi</label>
                                    <input id="SaleName" name="SaleName" type="text" value="<?php echo e($sale_product->SaleName); ?>" class="form-control" placeholder="Vui lòng nhập tên" data-errors="Please Enter Name." required>
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>  
                            <div class="col-md-6">                      
                                <div class="form-group">
                                    <label>Thời gian bắt đầu</label>
                                    <input type='text' name="SaleStart" id='SaleStart' value="<?php echo e($sale_product->SaleStart); ?>" placeholder="Nhập thời gian bắt đầu" class="form-control" />
                                    <span class="text-danger"></span>
                                </div>
                            </div>  
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Thời gian kết thúc</label>
                                    <input type='text' name="SaleEnd" id='SaleEnd' value="<?php echo e($sale_product->SaleEnd); ?>" placeholder="Nhập thời gian kết thúc" class="form-control" />
                                    <span class="text-danger"></span>
                                </div>
                            </div>
                            <div class="col-md-12">                                    
                                <div class="form-group">
                                    <label>Giảm giá</label>
                                    <input id="Percent" name="Percent" type="number" value="<?php echo e($sale_product->Percent); ?>" min="1" max="100" class="form-control" placeholder="% Giảm" required>
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                        </div>                            
                        <input type="submit" class="btn btn-primary mr-2" value="Sửa khuyến mãi" data-toggle="modal" data-target=".bd-example-modal-sm">
                        <a href="<?php echo e(URL::to('/manage-sale')); ?>" class="btn btn-light">Trở về</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Page end  -->
</form>

<!-- Tạo datetimepicker form -->
<script>
    $(document).ready(function(){  
        jQuery.datetimepicker.setLocale('vi');
        // $.datetimepicker.setDateFormatter('moment');
        jQuery(function(){
            jQuery('#SaleStart').datetimepicker({
                // format: 'DD-MM-YYYY HH:mm',
                format:'Y-m-d H:i',
                // timepicker: false,
                onShow:function( ct ){
                    this.setOptions({
                        maxDate:jQuery('#SaleEnd').val()?jQuery('#SaleEnd').val():false
                    })
                }
            });
            jQuery('#SaleEnd').datetimepicker({
                // format: 'DD-MM-YYYY HH:mm',
                format:'Y-m-d H:i',
                // timepicker: false,
                onShow:function( ct ){
                    this.setOptions({
                        minDate:jQuery('#SaleStart').val()?jQuery('#SaleStart').val():false
                    })
                }
            });
        });
    });
</script>

<!-- Validate thời gian sale -->
<script>
    $(document).ready(function(){  
        Validator({
            form: "#form-add-sale",
            errorSelector: ".text-danger",
            parentSelector: ".form-group",
            rules:[
                Validator.isRequired("#SaleStart"),
                Validator.isRequired("#SaleEnd"),
                Validator.isSaleEndTimeSysdate("#SaleEnd"),
                Validator.isSaleEndTime("#SaleEnd",function(){
                return  document.querySelector("#form-add-sale #SaleStart").value;
                }),
                Validator.isSaleStartTime("#SaleStart",function(){
                return  document.querySelector("#form-add-sale #SaleEnd").value;
                })
            ]
        })
    });
</script>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('admin_layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\ericshop\resources\views/admin/product/sale/edit-sale.blade.php ENDPATH**/ ?>