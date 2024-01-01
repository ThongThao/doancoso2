
<?php $__env->startSection('content'); ?>

<!--Page Banner Start-->
<div class="page-banner" style="background-image: url(public/ericshop/images/oso.png);">
    <div class="container">
        <div class="page-banner-content text-center">
            <h2 class="title">Đơn đặt hàng</h2>
            <ol class="breadcrumb justify-content-center">
                <li class="breadcrumb-item"><a href="<?php echo e(URL::to('/home')); ?>">Trang chủ</a></li>
                <li class="breadcrumb-item active" aria-current="page">Đơn đặt hàng</li>
            </ol>
        </div>
    </div>
</div>
<!--Page Banner End-->


<!--My Account Start-->
<div class="register-page section-padding-5">
    <div class="container">
        <div class="row">
            <div class="col-xl-3 col-md-4">
                <div class="my-account-menu mt-30">
                    <ul class="nav account-menu-list flex-column">
                        <li>
                            <a href="<?php echo e(URL::to('/account')); ?>"><i class="fa fa-user"></i> Hồ Sơ</a>
                        </li>
                        <li>
                            <a href="<?php echo e(URL::to('/change-password')); ?>"><i class="fa fa-key"></i> Đổi Mật Khẩu</a>
                        </li>
                        <li>
                            <a class="active"><i class="fa fa-shopping-cart"></i> Đơn Đặt Hàng</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-xl-9 col-md-8">
                <div class="tab-content my-account-tab mt-30" id="pills-tabContent">
                    <div class="tab-pane fade active show">
                        <div class="my-account-order account-wrapper">
                            <h4 class="account-title mb-15">Đơn Đặt Hàng</h4>
                                <table id="example" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%;">
                                    <thead>
                                        <tr>
                                            <th class="no">Mã ĐH</th>
                                            <th class="name">Tên người nhận</th>
                                            <th class="date">Ngày đặt</th>
                                            <th class="status">Trạng thái</th>
                                            <th class="total">Tổng tiền</th>
                                            <th class="total">Xem chi tiết</th>
                                        </tr>
                                    </thead>
                                    <tbody>             
                                        <?php $__currentLoopData = $list_bill; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $bill): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>                     
                                        <tr>
                                            <td><?php echo e($bill->idBill); ?></td>
                                            <td><?php echo e($bill->CustomerName); ?></td>
                                            <td><?php echo e($bill->created_at); ?></td>           

                                            <?php if($bill->Status == 0): ?> <td>Chờ xác nhận...</td>
                                            <?php elseif($bill->Status == 1): ?> <td>Đang giao</td>
                                            <?php elseif($bill->Status == 2): ?> <td>Đã giao</td>
                                            <?php else: ?> <td>Đã hủy</td> <?php endif; ?>

                                            <td><?php echo e(number_format($bill->TotalBill,0,',','.')); ?>đ</td>

                                            <form action="<?php echo e(URL::to('/confirm-bill/'.$bill->idBill)); ?>" method="POST"> <?php echo csrf_field(); ?>
                                            <td class="d-flex justify-content-center">
                                                <a class="view-hover h3 mr-2" href="<?php echo e(URL::to('/ordered-info/'.$bill->idBill)); ?>" data-toggle="tooltip" data-placement="top" title="" data-original-title="Xem chi tiết"><i class="fa fa-eye"></i></a>
                                            </td>
                                            </form>
                                        </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                  
                                </table>
                            <!-- </div> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--My Account End-->



<script>
    window.scrollBy(0,300);
    $(document).ready(function(){  
        $('#example').DataTable();
        $('body').tooltip({selector: '[data-toggle="tooltip"]'});
        APP_URL = '<?php echo e(url('/')); ?>' ;

       
    });
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('shop_layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\ericshop\resources\views/shop/customer/ordered.blade.php ENDPATH**/ ?>