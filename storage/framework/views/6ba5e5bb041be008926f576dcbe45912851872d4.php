
<?php $__env->startSection('content'); ?>

<!--Page Banner Start-->
<div class="page-banner" style="background-image: url(../public/ericshop/images/banner/banner-shop.png)">
    <div class="container">
        <div class="page-banner-content text-center">
            <h2 class="title">Chi tiết sản phẩm</h2>
            <ol class="breadcrumb justify-content-center">
                <li class="breadcrumb-item"><a href="<?php echo e(URL::to('/home')); ?>">Trang chủ</a></li>
                <li class="breadcrumb-item">Chi tiết sản phẩm</li>
            </ol>
        </div>
    </div>
</div>
<!--Page Banner End-->

<?php
    use App\Http\Controllers\ProductController;
    use Illuminate\Support\Facades\Session;

    $image = json_decode($product->ImageName)[0];
   
?>

<!--Shop Single Start-->
<div class="shop-single-page section-padding-4">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-8">
                <div class="shop-image">
                    <div class="shop-single-preview-image">
                        <img class="product-zoom" src="<?php echo e(asset('public/storage/admin/images/product/'.$image)); ?>" alt="">
                        
                        
                        <?php if($product->QuantityTotal == '0'): ?> <span class="sticker-new label-sale">HẾT HÀNG</span> <?php endif; ?>
                    </div>
                    <div id="gallery_01" class="shop-single-thumb-image shop-thumb-active swiper-container">
                        <div class="swiper-wrapper">
                            <?php $__currentLoopData = json_decode($product->ImageName); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $img): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="swiper-slide single-product-thumb">
                                <a class="active" href="#" data-image="<?php echo e(asset('public/storage/admin/images/product/'.$img)); ?>">
                                    <img src="<?php echo e(asset('public/storage/admin/images/product/'.$img)); ?>" alt="">
                                </a>
                            </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>

                        <!-- Add Arrows -->
                        <div class="swiper-thumb-next"><i class="fa fa-angle-right"></i></div>
                        <div class="swiper-thumb-prev"><i class="fa fa-angle-left"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="shop-single-content">
                    <h3 class="title"><?php echo e($product->ProductName); ?></h3>
                    <span class="product-sku">Mã sản phẩm: <span><?php echo e($product->idProduct); ?></span></span>
                    <div class="text-primary">Đã Bán: <?php echo e($product->Sold); ?> sản phẩm</div>
                    <div class="text-primary">Còn Lại: <?php echo e($product->QuantityTotal); ?> sản phẩm</div>
               
                  
                    <div class="thumb-price">
                      
                            <span class="current-price"><?php echo e(number_format($product->Price,0,',','.')); ?>đ</span>
                       
                    </div>
                    <div><?php echo $product->ShortDes; ?></div>

                    <div class="shop-single-material pt-3">
                        <div class="material-title col-lg-2"><?php echo e($name_attribute->AttributeName); ?>:</div>
                        <ul class="material-list">
                            <?php $__currentLoopData = $list_pd_attr; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $pd_attr): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li>
                                <div class="material-radio">
                                    <input type="radio" value="<?php echo e($pd_attr->idProAttr); ?>" class="AttrValName" name="material" id="<?php echo e($pd_attr->idProAttr); ?>" data-name="<?php echo e($pd_attr->AttrValName); ?>" data-qty="<?php echo e($pd_attr->Quantity); ?>">
                                    <label for="<?php echo e($pd_attr->idProAttr); ?>"><?php echo e($pd_attr->AttrValName); ?></label>
                                </div>
                            </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                    

                    <div class="mt-20 qty-of-attr-label">Còn Lại: <?php echo e($name_attribute->Quantity); ?></div>

                    <form method="POST">
                        <?php echo csrf_field(); ?>
                    <div class="product-quantity d-flex flex-wrap align-items-center pt-30">
                        <span class="quantity-title">Số Lượng: </span>
                        <div class="quantity d-flex align-items-center">
                            <button type="button" class="sub-qty"><i class="ti-minus"></i></button>
                            <input type="number" class="qty-buy" name="qty_buy" value="1" />
                            <button type="button" class="add-qty"><i class="ti-plus"></i></button>
                        </div>
                    </div>
                    
                    <input type="hidden" name="idProduct" id="idProduct" value="<?php echo e($product->idProduct); ?>">
                    <input type="hidden" name="PriceNew" id="PriceNew" value="<?php echo e($product->Price); ?>">
                    <input class="qty-of-attr" name="qty_of_attr" type="hidden" value="<?php echo e($name_attribute->Quantity); ?>">

                    <input type="hidden" id="AttributeName" name="AttributeName" value="<?php echo e($name_attribute->AttributeName); ?>">
                    <input type="hidden" id="AttributeProduct" name="AttributeProduct">
                    <input type="hidden" id="idProAttr" name="idProAttr">
                    
                    <div class="text-primary alert-qty"></div>

                    <div class="product-action d-flex flex-wrap">
                        <div class="action">
                            <button type="button" class="btn btn-primary add-to-cart">Thêm vào giỏ hàng</button>
                        </div>
                      
                    </div>
                    <div class="text-primary alert-add-to-cart"></div>

                    <div class="dynamic-checkout-button">
                        <!-- <div class="checkout-checkbox">
                            <input type="checkbox" id="disabled">
                            <label for="disabled"><span></span> I agree with the terms and conditions </label>
                        </div> -->
                        <div class="checkout-btn">
                            <input type="submit" formaction="<?php echo e(URL::to('/buy-now')); ?>" class="btn btn-primary buy-now" value="Mua ngay"/>
                            <!-- <button type="button" class="btn btn-primary buy-now">Mua ngay</button> -->
                        </div>
                    </div>
                    <div class="text-primary alert-buy-now"></div>
                    <?php
                        $error = Session::get('error');
                        if($error){
                            echo '<div class="text-danger">'.$error.'</div>';
                            Session::put('error', null);
                        }
                    ?>    
                    </form>

                    <div class="custom-payment-options">
                        <p>Phương thức thanh toán</p>

                        <ul class="payment-options">
                            <li><img src="<?php echo e(asset('public/ericshop/images/payment-icon/payment-1.svg')); ?>" alt=""></li>
                            <li><img src="<?php echo e(asset('public/ericshop/images/payment-icon/payment-2.svg')); ?>" alt=""></li>
                            <li><img src="<?php echo e(asset('public/ericshop/images/payment-icon/payment-3.svg')); ?>" alt=""></li>
                            <li><img src="<?php echo e(asset('public/ericshop/images/payment-icon/payment-4.svg')); ?>" alt=""></li>
                            <li><img src="<?php echo e(asset('public/ericshop/images/payment-icon/payment-5.svg')); ?>" alt=""></li>
                            <li><img src="<?php echo e(asset('public/ericshop/images/payment-icon/payment-7.svg')); ?>" alt=""></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!--Shop Single End-->



        <!--Shop Single info Start-->
        <div class="shop-single-info">
            <div class="shop-info-tab">
                <ul class="nav justify-content-center" role="tablist">
                    <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#tab1" role="tab">Mô tả/Chi tiết</a></li>
                </ul>
            </div>

            <div class="tab-content">
                <div class="tab-pane fade show active" id="tab1" role="tabpanel">
                    <div class="description">
                        <p><?php echo $product->DesProduct; ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--Shop Single End-->

<!--New Product Start-->
<?php if($list_related_product->count() > 0): ?>
<div class="new-product-area section-padding-2">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-9 col-sm-11">
                <div class="section-title text-center">
                    <h2 class="title">Sản Phẩm Liên Quan</h2>
                </div>
            </div>
        </div>
        <div class="product-wrapper">
            <div class="swiper-container product-active">
                <div class="swiper-wrapper">
                    <?php $__currentLoopData = $list_related_product; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $related_product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="swiper-slide">
                        <div class="single-product">
                            <div class="product-image">
                                <?php $image = json_decode($related_product->ImageName)[0];?>
                                <a href="<?php echo e(URL::to('/shop-single/'.$related_product->ProductSlug)); ?>">
                                    <img src="<?php echo e(asset('public/storage/admin/images/product/'.$image)); ?>" alt="">
                                </a>

                             
                                <?php if($related_product->QuantityTotal == '0'): ?> <span class="sticker-new soldout-title">Hết hàng</span>;
                              <?php endif; ?>

                                <div class="action-links">
                                    <ul>
                                        <li><a class="quick-view-pd" data-id="<?php echo e($related_product->idProduct); ?>" data-tooltip="tooltip" data-placement="left" title="Xem nhanh"><i class="icon-eye"></i></a></li> 
                                    </ul>
                                </div>
                            </div>
                            <div class="product-content text-center">
                              
                                <h4 class="product-name"><a href="<?php echo e(URL::to('/shop-single/'.$related_product->ProductSlug)); ?>"><?php echo e($related_product->ProductName); ?></a></h4>
                                <div class="price-box">
                                   
                                        <span class="current-price"><?php echo e(number_format($related_product->Price,0,',','.')); ?>đ</span>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>

                <!-- Add Arrows -->
                <div class="swiper-next"><i class="fa fa-angle-right"></i></div>
                <div class="swiper-prev"><i class="fa fa-angle-left"></i></div>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>
<!--New Product End-->



<div id="modal-AddToCart">
    
</div>

<!--Brand Start-->
<div class="brand-area">
    <div class="container">
        <div class="brand-active swiper-container">
            <div class="swiper-wrapper">
                <div class="single-brand swiper-slide">
                    <img src="<?php echo e(asset('public/ericshop/images/brand/brand-1.jpg')); ?>" alt="">
                </div>
                <div class="single-brand swiper-slide">
                <img src="<?php echo e(asset('public/ericshop/images/brand/brand-2.jpg')); ?>" alt="">
                </div>
                <div class="single-brand swiper-slide">
                <img src="<?php echo e(asset('public/ericshop/images/brand/brand-3.jpg')); ?>" alt="">
                </div>
                <div class="single-brand swiper-slide">
                <img src="<?php echo e(asset('public/ericshop/images/brand/brand-4.jpg')); ?>" alt="">
                </div>
                <div class="single-brand swiper-slide">
                <img src="<?php echo e(asset('public/ericshop/images/brand/brand-5.jpg')); ?>" alt="">
                </div>
            </div>
        </div>
    </div>
</div>
<!--Brand End-->

<!-- Validate QuantityBuy & Add To Cart & Buy Now -->
<script>
    $(document).ready(function(){  
        var idCustomer = '<?php echo Session::get('idCustomer'); ?>';
        var $Quantity = parseInt($('.qty-of-attr').val());
        $("input:radio[name=material]:first").attr('checked', true);
        $('#idProAttr').val($("input:radio[name=material]:first").val());

        var AttributeProduct = $('#AttributeName').val() + ': ' + $('.AttrValName').data("name");
        $('#AttributeProduct').val(AttributeProduct);

        $("input:radio[name=material]").on('click',function(){
            $(".qty-buy").val("1");
            $('.alert-qty').html("");
            $('.alert-add-to-cart').html("");
            $('.alert-buy-now').html("");
            $idAttribute = $(this).attr("id");
            $AttrValName = $(this).data("name");
            $Quantity = $(this).data("qty");
            $('.qty-of-attr-label').html("Còn Lại: " +$Quantity);
            $('.qty-of-attr').val($Quantity);
            
            AttributeProduct = $('#AttributeName').val() + ': ' + $AttrValName;
            $('#AttributeProduct').val(AttributeProduct);

            $('#idProAttr').val($("#"+$idAttribute).val());
        });

        $('.add-qty').on('click',function(){
            var $input = $(this).prev();
            var currentValue = parseInt($input.val());
            if(currentValue >= $Quantity){
                $('.alert-qty').html("Vượt quá số lượng sản phẩm hiện có!");
            }else{
                $input.val(currentValue + 1);
            }
        });

        $('.sub-qty').on('click',function(){
            var $input = $(this).next();
            var currentValue = parseInt($input.val());
            (currentValue == 1)? currentValue : $input.val(currentValue - 1);
        });

        $('.buy-now').on('click',function(e){
            if($(".qty-buy").val() > $Quantity){
                $('.alert-buy-now').html("Vượt quá số lượng sản phẩm hiện có!");
                e.preventDefault();
            }
        });

        $('.add-to-cart').on('click',function(){
            if(idCustomer == "")
            {
                window.location.href='../login';
            }else if($(".qty-buy").val() > $Quantity)
            {
                $('.alert-add-to-cart').html("Vượt quá số lượng sản phẩm hiện có!");
            }else
            {
                var idProduct = $('#idProduct').val();
                var AttributeProduct = $('#AttributeProduct').val();
                var QuantityBuy = $('.qty-buy').val();
                var PriceNew = $('#PriceNew').val();
                var _token = $('input[name="_token"]').val();
                var qty_of_attr = $('.qty-of-attr').val();
                var idProAttr = $('#idProAttr').val();

                $.ajax({
                    url: '<?php echo e(url("/add-to-cart")); ?>',
                    method: 'POST',
                    data: {idProduct:idProduct,idProAttr:idProAttr,AttributeProduct:AttributeProduct,QuantityBuy:QuantityBuy,PriceNew:PriceNew,qty_of_attr:qty_of_attr, _token:_token},
                    success:function(data){
                        $('#modal-AddToCart').html(data);
                        $('.modal-AddToCart').modal('show');
                    }
                });
            }        
        });
    });
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('shop_layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\ericshop\resources\views/shop/product/shop-single.blade.php ENDPATH**/ ?>