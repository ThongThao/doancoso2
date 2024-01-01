
<?php $__env->startSection('content_dash'); ?>

<div class="content-page">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="d-flex flex-wrap align-items-center justify-content-between mb-4">
                    <div>
                        <h4 class="mb-3">Danh Sách Đơn Hàng ( Tổng: <?php echo e($list_bill->count()); ?> đơn hàng )</h4>
                   
                    </div>
                </div>
            </div>

            <div class="col-lg-12">
                <div class="table-responsive rounded mb-3">
                    <table class="data-tables table mb-0 tbl-server-info">
                        <thead class="bg-white text-uppercase">
                            <tr class="ligth ligth-data">
                                <th>Mã ĐH</th>
                                <th>Tên Tài Khoản</th>
                                <th>SĐT</th>
                                <th>Thanh Toán</th>
                                <th>Ngày Đặt Hàng</th>
                                <th>Ngày Giao Hàng</th>
                                <th>Trạng Thái</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody class="ligth-body" id="load-bill">
                            <?php $__currentLoopData = $list_bill; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $bill): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($bill->idBill); ?></td>
                                <td><?php echo e($bill->username); ?></td>
                                <td><?php echo e($bill->CusPhone); ?></td>
                                <td><?php if($bill->Payment == 'vnpay'): ?> VNPay <?php else: ?> Khi nhận hàng <?php endif; ?></td>
                                <td><?php echo e($bill->created_at); ?></td>

                                <?php if($bill->ReceiveDate != null): ?> <td><?php echo e($bill->ReceiveDate); ?></td>
                                <?php else: ?> <td class="text-center"><div class="align-items-center badge badge-warning">Chưa giao</div></td> <?php endif; ?>
                                
                                <?php if($bill->Status == 0): ?> <td><div class=" align-items-center badge badge-warning">Chờ xác nhận</div></td>
                                <?php elseif($bill->Status == 1): ?> <td><div class=" align-items-center badge badge-info">Đang giao</div></td>
                                <?php elseif($bill->Status == 2): ?> <td><div class=" align-items-center badge badge-success">Đã giao</div></td>
                                <?php else: ?> <td><div class=" align-items-center badge badge-success">Đã hủy</div></td> <?php endif; ?>

                                <td>
                                    <form action="<?php echo e(URL::to('/confirm-bill/'.$bill->idBill)); ?>" method="POST"> <?php echo csrf_field(); ?>
                                    <div class="d-flex align-items-center list-action">
                                        <a class="badge badge-success mr-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Xem chi tiết" 
                                            href="<?php echo e(URL::to('/bill-info/'.$bill->idBill)); ?>"><i class="ri-eye-line mr-0"></i>
                                        </a>
                                        <?php if($bill->Status == 0): ?>
                                        <button class="badge badge-info mr-2 momo" style="border:none;" data-toggle="tooltip" data-placement="top" title="" 
                                            data-original-title="Xác nhận đơn hàng"><i class="ri-thumb-up-line mr-0"></i>
                                        </button>
                                        <input type="hidden" name="Status" value="1">
                                        <a class="badge bg-warning mr-2 delete-bill-btn" data-toggle="modal" data-target="#modal-delete-bill" data-placement="top" data-original-title="Hủy đơn hàng"
                                            data-id="<?php echo e($bill->idBill); ?>" style="cursor:pointer;"><i class="ri-delete-bin-line mr-0"></i>
                                        </a>
                                        <?php elseif($bill->Status == 1): ?>
                                        <button class="badge badge-info mr-2 momo" style="border:none;" data-toggle="tooltip" data-placement="top" title="" 
                                            data-original-title="Xác nhận hoàn thành"><i class="ri-thumb-up-line mr-0"></i>
                                        </button>
                                        <input type="hidden" name="Status" value="2">
                                        <?php endif; ?>   
                                    </div>
                                    </form>
                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Page end  -->

<!-- Modal hủy đơn hàng -->
<div class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" id="modal-delete-bill"  aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Thông báo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <p class="content-delete"></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-dismiss="modal">Trở về</button>
                <button id="delete-bill-confirm" type="button" class="btn btn-primary">Xác nhận</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){  
        APP_URL = '<?php echo e(url('/')); ?>' ;
        $(".delete-bill-btn").on("click", function() {
            var idBill = $(this).data("id");
            $(".content-delete").html("Bạn có muốn hủy đơn hàng #" +idBill+ " không?");

            $("#delete-bill-confirm").on("click", function() {
                var _token = $('input[name="_token"]').val();

                $.ajax({
                    url: APP_URL + '/delete-bill/' +idBill,
                    method: 'POST',
                    data: {_token:_token},
                    success:function(data){
                        location.reload();
                    }
                });
            });
        });
    });
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin_layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\ericshop\resources\views/admin/bill/list-bill.blade.php ENDPATH**/ ?>