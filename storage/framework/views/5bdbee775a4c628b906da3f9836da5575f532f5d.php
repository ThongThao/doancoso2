
<?php $__env->startSection('content'); ?>

<?php use Illuminate\Support\Facades\Session; ?>

<!--Page Banner Start-->
<div class="page-banner" style="background-image: url(../public/ericshop/images/oso.png);">
    <div class="container">
        <div class="page-banner-content text-center">
            <h2 class="title">Chi Tiết Đơn Hàng</h2>
            <ol class="breadcrumb justify-content-center">
                <li class="breadcrumb-item"><a href="<?php echo e(URL::to('/home')); ?>">Trang chủ</a></li>
                <li class="breadcrumb-item active" aria-current="page">Chi tiết đơn hàng</li>
            </ol>
        </div>
    </div>
</div>
<!--Page Banner End-->

<!--Cart Start-->
<div class="cart-page section-padding-5">
    <div class="container">
        <div class="container__address">
            <div class="container__address-css"></div>
            <div class="container__address-content">
                <div class="container__address-content-hd justify-content-between">
                    <div><i class="container__address-content-hd-icon fa fa-map-marker"></i>Địa Chỉ Nhận Hàng</div>
                </div>
                <ul class="shipping-list list-address">
                    <li class="cus-radio align-items-center" style="font-size:20px;">
                        <span class="mr-2"><?php echo e($address->CustomerName); ?></span>
                        <span class="mr-2"><?php echo e($address->PhoneNumber); ?></span>
                        <span><?php echo e($address->Address); ?></span>
                    </li>
                </ul>
            </div>
        </div>

        <div class="cart-table table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th class="image">Hình Ảnh</th>
                        <th class="product">Sản Phẩm</th>
                        <th class="price">Giá</th>
                        <th class="quantity" style="width:10%">Số Lượng</th>
                        <th class="total">Tổng</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $Total = 0; $ship = 0; $total_bill = 0; $discount = 0; ?>
                    <?php $__currentLoopData = $list_bill_info; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $bill_info): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php $Total += ($bill_info->Price * $bill_info->QuantityBuy); ?>
                    <tr class="product-item">
                        <?php $image = json_decode($bill_info->ImageName)[0]; ?>
                        <td class="image">
                            <a href="<?php echo e(URL::to('/shop-single/'.$bill_info->ProductSlug)); ?>"><img src="<?php echo e(asset('public/storage/admin/images/product/'.$image)); ?>" alt=""></a>
                        </td>
                        <td class="product">
                            <a href="<?php echo e(URL::to('/shop-single/'.$bill_info->ProductSlug)); ?>"><?php echo e($bill_info->ProductName); ?></a>
                            <span>Mã sản phẩm: <?php echo e($bill_info->idProduct); ?></span>
                            <span><?php echo e($bill_info->AttributeProduct); ?></span>
                        </td>
                        <td class="price"><?php echo e(number_format($bill_info->Price,0,',','.')); ?>đ</td>
                        <td class="quantity"><?php echo e($bill_info->QuantityBuy); ?></td>
                        <td class="total"><?php echo e(number_format($bill_info->Price * $bill_info->QuantityBuy,0,',','.')); ?>đ</td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="cart-totals shop-single-content">
                    <div class="cart-title">
                        <h4 class="title">Tổng giỏ hàng</h4>
                    </div>
                    <div class="cart-total-table mt-25" style="position:relative;">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td>Tổng tiền hàng</td>
                                    <td class="text-right"><?php echo e(number_format($Total,0,',','.')); ?>đ</td>
                                </tr>
                                <?php if($Total < 1000000): ?> <?php $ship = '30000'; $total_bill = $Total + $ship; ?>
                                <?php else: ?> <?php $ship = 'Miễn phí'; $total_bill = $Total; ?> <?php endif; ?>
                                <tr class="shipping">
                                    <td>Phí vận chuyển (Miễn phí vận chuyển cho đơn hàng trên 1.000.000đ)</td>
                                    <td class="text-right">
                                            <?php if($ship > 0): ?> <?php echo e(number_format(floatval($ship),0,',','.')); ?>đ
                                            <?php else: ?> <?php echo e($ship); ?> <?php endif; ?>
                                    </td>
                                </tr>

                                <?php if($address->Voucher != ''): ?> 
                                <tr>
                                    <td width="70%">Mã giảm giá</td>
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
                                    <td class="text-right totalBill">- <?php echo e(number_format($discount,0,',','.')); ?>đ</td>
                                </tr>
                                <?php endif; ?>

                                <tr>
                                    <td width="70%">Thành tiền</td>
                                    <td class="text-right totalBill"><?php echo e(number_format($total_bill,0,',','.')); ?>đ</td>
                                </tr>

                                <input type="hidden" class="subtotal" value="<?php echo e($Total); ?>">
                                <input type="hidden" name="TotalBill" class="totalBillVal" value="<?php echo e($total_bill); ?>">    
                                <input type="hidden" name="idVoucher" class="idVoucher" value="0">                                
                            </tbody>
                        </table>
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
<!--Cart End-->

<?php $__env->stopSection(); ?>
<?php echo $__env->make('shop_layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\ericshop\resources\views/shop/customer/ordered-info.blade.php ENDPATH**/ ?>