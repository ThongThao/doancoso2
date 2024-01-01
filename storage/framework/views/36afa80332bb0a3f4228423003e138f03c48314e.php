
<?php $__env->startSection('content_dash'); ?>

<div class="content-page">
    <div class="container-fluid">
        <div class="row">                  
            <div class="col-lg-12">
                <div class="card card-block card-stretch card-height print rounded">
                    <div class="card-header d-flex justify-content-between bg-primary header-invoice">
                        <div class="iq-header-title">
                            <h4 class="card-title mb-0">Đơn hàng #<?php echo e($address->idBill); ?></h4>
                        </div>
                        <!-- <div class="invoice-btn">
                            <button type="button" class="btn btn-primary-dark mr-2"><i class="las la-print"></i> Print
                                Print</button>
                            <button type="button" class="btn btn-primary-dark"><i class="las la-file-download"></i>PDF</button>
                        </div> -->
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="table-responsive-sm">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th scope="col">Họ và tên người nhận</th>
                                                <th scope="col">Số điện thoại</th>
                                                <th scope="col">Địa chỉ</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td style="padding-left:12px !important;"><?php echo e($address->CustomerName); ?></td>
                                                <td style="padding-left:12px !important;"><?php echo e($address->PhoneNumber); ?></td>
                                                <td style="padding-left:12px !important;"><?php echo e($address->Address); ?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <h5 class="mb-3">Chi tiết đơn hàng</h5>
                                <div class="table-responsive-sm">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th class="text-center" scope="col">STT</th>
                                                <th scope="col">Sản phẩm</th>
                                                <th class="text-center" scope="col">Giá</th>
                                                <th class="text-center" scope="col">Số lượng</th>
                                                <th class="text-center" scope="col">Tổng</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $Total = 0; $ship = 0; $total_bill = 0; $discount = 0; ?>
                                            <?php $__currentLoopData = $list_bill_info; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $bill_info): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php $Total += ($bill_info->Price * $bill_info->QuantityBuy); ?>
                                            <tr>
                                                <th class="text-center" scope="row"><?php echo e($key + 1); ?></th>
                                                <td class="row" style="border-bottom:0;">
                                                        <?php $image = json_decode($bill_info->ImageName)[0]; ?>
                                                        <img class="avatar-70 rounded" src="<?php echo e(asset('public/storage/admin/images/product/'.$image)); ?>" alt="">
                                                        <div class="ml-2" style="flex:1;">
                                                            <h6 class="mb-0"><?php echo e($bill_info->ProductName); ?></h6>
                                                            <p class="mb-0">Mã sản phẩm: <?php echo e($bill_info->idProduct); ?></p>
                                                            <span><?php echo e($bill_info->AttributeProduct); ?></span>
                                                        </div>
                                                </td>
                                                <td class="text-center" style="border-bottom:0;"><?php echo e(number_format($bill_info->Price,0,',','.')); ?>đ</td>
                                                <td class="text-center" style="border-bottom:0;"><?php echo e($bill_info->QuantityBuy); ?></td>
                                                <td class="text-center" style="border-bottom:0;"><b><?php echo e(number_format($bill_info->Price * $bill_info->QuantityBuy,0,',','.')); ?>đ</b></td>
                                            </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>                              
                        </div>
                        <!-- <div class="row">
                            <div class="col-sm-12">
                                <b class="text-danger">Notes:</b>
                                <p class="mb-0">a</p>
                            </div>
                        </div> -->
                        <div class="row mt-4 mb-3">
                            <div class="col-lg-12">
                                <div class="or-detail rounded">
                                    <div class="p-3 row">
                                        <h5 class="mb-3 col-lg-12">Order Details</h5>
                                        <div class="mb-2 col-lg-10">
                                            <h6>Tổng tiền hàng</h6>
                                        </div>
                                        <div class="mb-2 col-lg-2 text-right">
                                            <h6><?php echo e(number_format($Total,0,',','.')); ?>đ</h6>
                                        </div>

                                        <?php if($Total < 1000000): ?> <?php $ship = '30000'; $total_bill = $Total + $ship; ?>
                                        <?php else: ?> <?php $ship = 'Miễn phí'; $total_bill = $Total; ?> <?php endif; ?>
                                        <div class="mb-2 col-lg-10">
                                            <h6>Phí vận chuyển (Miễn phí vận chuyển cho đơn hàng trên 1.000.000đ)</h6>
                                        </div>
                                        <div class="mb-2 col-lg-2 text-right">
                                            <h6><?php if($ship > 0): ?> <?php echo e(number_format(floatval($ship),0,',','.')); ?>đ
                                                <?php else: ?> <?php echo e($ship); ?> <?php endif; ?>
                                            </h6>
                                        </div>

                                        <?php if($address->Voucher != ''): ?> 
                                            <div class="mb-2 col-lg-10">
                                                <h6>Mã giảm giá</h6>
                                            </div>
                                            <?php
                                                $Voucher = explode("-",$address->Voucher);
                                                $VoucherCondition = $Voucher[1];
                                                $VoucherNumber = $Voucher[2];
                                                if($VoucherCondition == 1) $discount = ($Total/100) * $VoucherNumber;
                                                else{
                                                    $discount = $VoucherNumber;
                                                    if($discount > $Total) $discount = $Total;
                                                } 

                                                $total_bill =  $total_bill - $discount;
                                                if($total_bill < 0) $total_bill = $ship;
                                            ?>
                                            <div class="mb-2 col-lg-2 text-right">
                                                <h6>- <?php echo e(number_format($discount,0,',','.')); ?>đ</h6>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="ttl-amt py-2 px-3 d-flex justify-content-between align-items-center">
                                        <h6>Thành tiền</h6>
                                        <h3 class="text-primary font-weight-700"><?php echo e(number_format($total_bill,0,',','.')); ?>đ</h3>
                                    </div>
                                </div>
                                <?php if($address->Payment == 'vnpay'): ?>
                                <div class="col-lg-3 paid_tag">
                                    <div class="h3 p-3 mb-0 text-primary">Đã thanh toán</div>
                                </div>
                                <?php endif; ?>
                            </div>
                        </div>                            
                    </div>
                </div>
            </div>                                    
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin_layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\ericshop\resources\views/admin/bill/bill-info.blade.php ENDPATH**/ ?>