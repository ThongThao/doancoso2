
<?php $__env->startSection('content_dash'); ?>

<div class="content-page">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="d-flex flex-wrap align-items-center justify-content-between mb-4">
                    <div>
                        <h4 class="mb-3">Danh Sách Đơn Đã Giao ( Tổng: <?php echo e($list_bill->count()); ?> đơn hàng )</h4>
                        <p class="mb-0">Trang tổng quan mua hàng cho phép người quản lý mua hàng theo dõi, đánh giá một cách hiệu quả,<br>
                            và tối ưu hóa tất cả các quy trình mua lại trong một công ty.</p>
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
                                <td><?php echo e($bill->ReceiveDate); ?></td>

                                <td>
                                    <div class="d-flex align-items-center list-action">
                                        <a class="badge badge-success mr-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Xem chi tiết" 
                                            href="<?php echo e(URL::to('/bill-info/'.$bill->idBill)); ?>"><i class="ri-eye-line mr-0"></i>
                                        </a>
                                    </div>
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

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin_layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\shoopp\kidolshop\resources\views/admin/bill/shipped-bill.blade.php ENDPATH**/ ?>