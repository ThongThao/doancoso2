
<?php $__env->startSection('content_dash'); ?>

<div class="content-page">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="d-flex flex-wrap flex-wrap align-items-center justify-content-between mb-4">
                    <div>
                        <h4 class="mb-3">Danh Sách Sản Phẩm ( Tổng: <?php echo e($count_product); ?> sản phẩm )</h4>
                    </div>
                    <a href="<?php echo e(URL::to('/add-product')); ?>" class="btn btn-primary add-list"><i class="las la-plus mr-3"></i>Thêm sản phẩm</a>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="table-responsive rounded mb-3">
                    <table class="data-tables table mb-0 tbl-server-info">
                        <thead class="bg-white text-uppercase">
                            <tr class="ligth ligth-data">
                                    <th> Mã SP</th>
                                    <th> Sản phẩm </th>
                                    <th> Danh mục </th>
                                    <th> Thương hiệu </th>
                                    <th> Số lượng </th>
                                    <th> Trạng Thái </th>
                                    <th> Thao tác </th>
                            </tr>
                        </thead>
                        <tbody class="ligth-body">
                            <?php $__currentLoopData = $list_product; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($product->idProduct); ?></td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <?php $image = json_decode($product->ImageName)[0];?>
                                        <img src="<?php echo e(asset('public/storage/admin/images/product/'.$image)); ?>" class="img-fluid rounded avatar-50 mr-3" alt="image">
                                        <div><?php echo e($product->ProductName); ?></div>        
                                    </div>
                                </td>
                                <td><?php echo e($product->CategoryName); ?></td>
                                <td><?php echo e($product->BrandName); ?></td>
                                <td><?php echo e($product->QuantityTotal); ?></td>
                                <?php if($product->StatusPro == 1): ?> <td><strong>Đang Hiện</strong></td>
                                <?php else: ?> <td><strong>Đang Ẩn</strong></td> <?php endif; ?>
                                <td>
                                    <form> <?php echo csrf_field(); ?>
                                    <div class="d-flex align-items-center list-action">
                                        <?php if($product->StatusPro == 0): ?>
                                        <button type="button" class="badge badge-dark mr-2 btn-StatusPro" data-toggle="tooltip" data-placement="top" title="" data-original-title="Hiện"
                                            style="border:none;" data-id="<?php echo e($product->idProduct); ?>" data-statuspro="1"><i class="fa fa-eye-slash"></i></i></button>
                                        <?php else: ?>
                                        <button type="button" class="badge badge-primary mr-2 btn-StatusPro" data-toggle="tooltip" data-placement="top" title="" data-original-title="Ẩn"
                                            style="border:none;" data-id="<?php echo e($product->idProduct); ?>" data-statuspro="0"><i class="fa fa-eye"></i></i></button>
                                        <?php endif; ?>
                                        <a class="badge bg-success mr-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Sửa"
                                            href="<?php echo e(URL::to('/edit-product/'.$product->idProduct)); ?>"><i class="ri-pencil-line mr-0"></i></a>
                                        <a class="badge bg-warning mr-2" data-toggle="modal" data-tooltip="tooltip" data-target="#modal-delete-<?php echo e($product->idProduct); ?>" data-placement="top" title="Xóa" data-original-title="Xóa"
                                            style="cursor:pointer;"><i class="ri-delete-bin-line mr-0"></i></a>
                                    </div>
                                    </form>
                                </td>
                            </tr>

                            <div class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" id="modal-delete-<?php echo e($product->idProduct); ?>"  aria-hidden="true">
                                <div class="modal-dialog modal-sm">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Thông báo</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Bạn có muốn xóa sản phẩm <?php echo e($product->ProductName); ?> không?</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-light" data-dismiss="modal">Trở về</button>
                                            <a href="<?php echo e(URL::to('/delete-product/'.$product->idProduct)); ?>" type="button" class="btn btn-primary">Xác nhận</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Page end  -->

<script>
    $(document).ready(function(){  
        APP_URL = '<?php echo e(url('/')); ?>' ;

        $('.btn-StatusPro').on('click',function(){
            var idProduct = $(this).data("id");
            var StatusPro = $(this).data("statuspro");
            var _token = $('input[name="_token"]').val();

            $.ajax({
                    url: APP_URL + '/change-status-product/' +idProduct,
                    method: 'POST',
                    data: {StatusPro:StatusPro,_token:_token},
                    success:function(data){
                        location.reload();
                    }
            });
        });
    });
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin_layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\ericshop\resources\views/admin/product/manage-products.blade.php ENDPATH**/ ?>