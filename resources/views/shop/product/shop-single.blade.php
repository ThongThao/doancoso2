@extends('shop_layout')
@section('content')

<!--Page Banner Start-->
<div class="page-banner" style="background-image: url(../ericshop/images/banner/banner-shop.png)">
    <div class="container">
        <div class="page-banner-content text-center">
            <h2 class="title">Chi tiết sản phẩm</h2>
            <ol class="breadcrumb justify-content-center">
                <li class="breadcrumb-item"><a href="{{URL::to('/home')}}">Trang chủ</a></li>
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
    $get_time_sale = ProductController::get_sale_pd($product->idProduct);
    $SalePrice = $product->Price;
    if($get_time_sale) $SalePrice = $product->Price - ($product->Price/100) * $get_time_sale->Percent;
?>

<!--Shop Single Start-->
<div class="shop-single-page section-padding-4">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-8">
                <div class="shop-image">
                    <div class="shop-single-preview-image">
                        <img class="product-zoom" src="{{asset('storage/admin/images/product/'.$image)}}" alt="">
                        
                        @if($get_time_sale) 
                            @if($product->QuantityTotal == '0') <span class="sticker-new label-sale">HẾT HÀNG</span>
                            @else <span class="sticker-new label-sale">-{{$get_time_sale->Percent}}%</span> @endif
                        @elseif($product->QuantityTotal == '0') <span class="sticker-new label-sale">HẾT HÀNG</span> @endif
                    </div>
                    <div id="gallery_01" class="shop-single-thumb-image shop-thumb-active swiper-container">
                        <div class="swiper-wrapper">
                            @foreach(json_decode($product->ImageName) as $img)
                            <div class="swiper-slide single-product-thumb">
                                <a class="active" href="#" data-image="{{asset('storage/admin/images/product/'.$img)}}">
                                    <img src="{{asset('storage/admin/images/product/'.$img)}}" alt="">
                                </a>
                            </div>
                            @endforeach
                        </div>

                        <!-- Add Arrows -->
                        <div class="swiper-thumb-next"><i class="fa fa-angle-right"></i></div>
                        <div class="swiper-thumb-prev"><i class="fa fa-angle-left"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="shop-single-content">
                    <h3 class="title">{{$product->ProductName}}</h3>
                    <span class="product-sku">Mã sản phẩm: <span>{{$product->idProduct}}</span></span>
                    <div class="text-primary">Đã Bán: {{$product->Sold}} sản phẩm</div>
                    <div class="text-primary">Còn Lại: {{$product->QuantityTotal}} sản phẩm</div>
                    <div class="product-rating" id="product-rating-header">
                        <div class="rating-stars">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                        </div>
                        <span class="rating-text">(<span id="header-rating">0</span>/5 - <span id="header-total-reviews">0</span> đánh giá)</span>
                    </div>
                    <div class="thumb-price">
                        @if($SalePrice < $product->Price)
                            <span class="old-price">{{number_format($product->Price,0,',','.')}}đ</span>
                            <span class="current-price">{{number_format(round($SalePrice,-3),0,',','.')}}đ</span>
                            <span class="discount">-{{$get_time_sale->Percent}}%</span>
                        @else
                            <span class="current-price">{{number_format($product->Price,0,',','.')}}đ</span>
                        @endif
                    </div>
                    <div>{!!$product->ShortDes!!}</div>

                    <div class="shop-single-material pt-3">
                        <div class="material-title col-lg-2">{{$name_attribute->AttributeName}}:</div>
                        <ul class="material-list">
                            @foreach($list_pd_attr as $key => $pd_attr)
                            <li>
                                <div class="material-radio">
                                    <input type="radio" value="{{$pd_attr->idProAttr}}" class="AttrValName" name="material" id="{{$pd_attr->idProAttr}}" data-name="{{$pd_attr->AttrValName}}" data-qty="{{$pd_attr->Quantity}}">
                                    <label for="{{$pd_attr->idProAttr}}">{{$pd_attr->AttrValName}}</label>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>

                    <div class="mt-20 qty-of-attr-label">Còn Lại: {{$name_attribute->Quantity}}</div>

                    <form method="POST">
                        @csrf
                    <div class="product-quantity d-flex flex-wrap align-items-center pt-30">
                        <span class="quantity-title">Số Lượng: </span>
                        <div class="quantity d-flex align-items-center">
                            <button type="button" class="sub-qty"><i class="ti-minus"></i></button>
                            <input type="number" class="qty-buy" name="qty_buy" value="1" />
                            <button type="button" class="add-qty"><i class="ti-plus"></i></button>
                        </div>
                    </div>
                    
                    <input type="hidden" name="idProduct" id="idProduct" value="{{$product->idProduct}}">
                    <input type="hidden" name="PriceNew" id="PriceNew" value="{{round($SalePrice,-3)}}">
                    <input class="qty-of-attr" name="qty_of_attr" type="hidden" value="{{$name_attribute->Quantity}}">

                    <input type="hidden" id="AttributeName" name="AttributeName" value="{{$name_attribute->AttributeName}}">
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
                            <input type="submit" formaction="{{URL::to('/buy-now')}}" class="btn btn-primary buy-now" value="Mua ngay"/>
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
                            <li><img src="{{asset('ericshop/images/payment-icon/payment-1.svg')}}" alt=""></li>
                            <li><img src="{{asset('ericshop/images/payment-icon/payment-2.svg')}}" alt=""></li>
                            <li><img src="{{asset('ericshop/images/payment-icon/payment-3.svg')}}" alt=""></li>
                            <li><img src="{{asset('ericshop/images/payment-icon/payment-4.svg')}}" alt=""></li>
                            <li><img src="{{asset('ericshop/images/payment-icon/payment-5.svg')}}" alt=""></li>
                            <li><img src="{{asset('ericshop/images/payment-icon/payment-7.svg')}}" alt=""></li>
                        </ul>
                    </div>

                    <!-- <div class="social-share">
                        <span class="share-title">Share:</span>
                        <ul class="social">
                            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fa fa-pinterest-p"></i></a></li>
                        </ul>
                    </div> -->
                </div>
            </div>
        </div>
        <!--Shop Single End-->



        <!--Shop Single info Start-->
        <div class="shop-single-info">
            <div class="shop-info-tab">
                <ul class="nav justify-content-center" role="tablist">
                    <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#tab1" role="tab">Mô tả/Chi tiết</a></li>
                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#tab2" role="tab">Nhận xét</a></li>
                </ul>
            </div>

            <div class="tab-content">
                <div class="tab-pane fade show active" id="tab1" role="tabpanel">
                    <div class="description">
                        <p>{!!$product->DesProduct!!}</p>
                    </div>
                </div>
                <div class="tab-pane fade" id="tab2" role="tabpanel">
                    <div class="reviews">
                        <h3 class="review-title">Customer Reviews</h3>

                        <ul class="reviews-items">
                            <li>
                                <div class="single-review">
                                    <h6 class="name">Rosie Silva</h6>
                                    <div class="rating-date">
                                        <ul class="rating">
                                            <li class="rating-on"><i class="fa fa-star"></i></li>
                                            <li class="rating-on"><i class="fa fa-star"></i></li>
                                            <li class="rating-on"><i class="fa fa-star"></i></li>
                                            <li class="rating-on"><i class="fa fa-star"></i></li>
                                            <li class="rating-on"><i class="fa fa-star"></i></li>
                                        </ul>
                                        <span class="date">Oct 20, 2020</span>
                                    </div>

                                    <p>Proin bibendum dolor vitae neque ornare, vel mollis est venenatis. Orci varius natoque penatibus et magnis dis parturient montes, nascet</p>
                                </div>
                            </li>
                            <li>
                                <div class="single-review">
                                    <h6 class="name">Rosie Silva</h6>
                                    <div class="rating-date">
                                        <ul class="rating">
                                            <li class="rating-on"><i class="fa fa-star"></i></li>
                                            <li class="rating-on"><i class="fa fa-star"></i></li>
                                            <li class="rating-on"><i class="fa fa-star"></i></li>
                                            <li class="rating-on"><i class="fa fa-star"></i></li>
                                            <li class="rating-on"><i class="fa fa-star"></i></li>
                                        </ul>
                                        <span class="date">Oct 20, 2020</span>
                                    </div>

                                    <p>Proin bibendum dolor vitae neque ornare, vel mollis est venenatis. Orci varius natoque penatibus et magnis dis parturient montes, nascet</p>
                                </div>
                            </li>
                            <li>
                                <div class="single-review">
                                    <h6 class="name">Rosie Silva</h6>
                                    <div class="rating-date">
                                        <ul class="rating">
                                            <li class="rating-on"><i class="fa fa-star"></i></li>
                                            <li class="rating-on"><i class="fa fa-star"></i></li>
                                            <li class="rating-on"><i class="fa fa-star"></i></li>
                                            <li class="rating-on"><i class="fa fa-star"></i></li>
                                            <li class="rating-on"><i class="fa fa-star"></i></li>
                                        </ul>
                                        <span class="date">Oct 20, 2020</span>
                                    </div>

                                    <p>Proin bibendum dolor vitae neque ornare, vel mollis est venenatis. Orci varius natoque penatibus et magnis dis parturient montes, nascet</p>
                                </div>
                            </li>
                        </ul>

                        <div class="reviews-form">
                            <form action="#">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="single-form">
                                            <label>Name</label>
                                            <input type="text" placeholder="Enter your name">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="single-form">
                                            <label>Email</label>
                                            <input type="text" placeholder="john.smith@example.com">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="reviews-rating">
                                            <label>Rating</label>
                                            <ul id="rating" class="rating">
                                                <li class="star" title='Poor' data-value='1'><i class="fa fa-star-o"></i></li>
                                                <li class="star" title='Poor' data-value='2'><i class="fa fa-star-o"></i></li>
                                                <li class="star" title='Poor' data-value='3'><i class="fa fa-star-o"></i></li>
                                                <li class="star" title='Poor' data-value='4'><i class="fa fa-star-o"></i></li>
                                                <li class="star" title='Poor' data-value='5'><i class="fa fa-star-o"></i></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="single-form">
                                            <label>Body of Review (1500)</label>
                                            <textarea placeholder="Write your comments here"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="single-form">
                                            <button class="btn btn-dark">Submit Review</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--Shop Single End-->

<!--New Product Start-->
@if($list_related_product->count() > 0)
<div class="new-product-area section-padding-2">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-9 col-sm-11">
                <div class="section-title text-center">
                    <h2 class="title">Sản Phẩm Liên Quan</h2>
                    <p>A perfect blend of creativity, energy, communication, happiness and love. Let us arrange a smile for you.</p>
                </div>
            </div>
        </div>
        <div class="product-wrapper">
            <div class="swiper-container product-active">
                <div class="swiper-wrapper">
                    @foreach($list_related_product as $key => $related_product)
                    <div class="swiper-slide">
                        <div class="single-product">
                            <div class="product-image">
                                <?php $image = json_decode($related_product->ImageName)[0];?>
                                <a href="{{URL::to('/shop-single/'.$related_product->ProductSlug)}}">
                                    <img src="{{asset('storage/admin/images/product/'.$image)}}" alt="">
                                </a>

                                <?php
                                    $SalePrice = $related_product->Price;  
                                    $get_time_sale = ProductController::get_sale_pd($related_product->idProduct); 
                                ?>

                                @if($get_time_sale)
                                    <?php $SalePrice = $related_product->Price - ($related_product->Price/100) * $get_time_sale->Percent; ?>
                                    <div class="product-countdown">
                                        <div data-countdown="{{$get_time_sale->SaleEnd}}"></div>
                                    </div>
                                    @if($related_product->QuantityTotal == '0') <span class="sticker-new soldout-title">Hết hàng</span>
                                    @else <span class="sticker-new label-sale">-{{$get_time_sale->Percent}}%</span>
                                    @endif
                                @elseif($related_product->QuantityTotal == '0') <span class="sticker-new soldout-title">Hết hàng</span>;
                                @endif

                                <div class="action-links">
                                    <ul>
                                        <!-- <li><a class="AddToCart-Single" data-id="{{$related_product->idProduct}}" data-PriceNew="{{$SalePrice}}" data-token="{{csrf_token()}}" data-tooltip="tooltip" data-placement="left" title="Thêm vào giỏ hàng"><i class="icon-shopping-bag"></i></a></li> -->
                                        <li><a class="add-to-compare" data-idcat="{{$related_product->idCategory}}" id="{{$related_product->idProduct}}" data-tooltip="tooltip" data-placement="left" title="So sánh"><i class="icon-sliders"></i></a></li>
                                        <li><a class="add-to-wishlist" data-id="{{$related_product->idProduct}}" data-tooltip="tooltip" data-placement="left" title="Thêm vào danh sách yêu thích"><i class="icon-heart"></i></a></li>
                                        <li><a class="quick-view-pd" data-id="{{$related_product->idProduct}}" data-tooltip="tooltip" data-placement="left" title="Xem nhanh"><i class="icon-eye"></i></a></li> 
                                    </ul>
                                </div>
                            </div>
                            <div class="product-content text-center">
                                <!-- <ul class="rating">
                                    <li class="rating-on"><i class="fa fa-star-o"></i></li>
                                    <li class="rating-on"><i class="fa fa-star-o"></i></li>
                                    <li class="rating-on"><i class="fa fa-star-o"></i></li>
                                    <li class="rating-on"><i class="fa fa-star-o"></i></li>
                                    <li class="rating-on"><i class="fa fa-star-o"></i></li>
                                </ul> -->
                                <h4 class="product-name"><a href="{{URL::to('/shop-single/'.$related_product->ProductSlug)}}">{{$related_product->ProductName}}</a></h4>
                                <div class="price-box">
                                    @if($SalePrice < $related_product->Price)
                                        <span class="old-price">{{number_format($related_product->Price,0,',','.')}}đ</span>
                                        <span class="current-price">{{number_format(round($SalePrice,-3),0,',','.')}}đ</span>
                                    @else
                                        <span class="current-price">{{number_format($related_product->Price,0,',','.')}}đ</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <!-- Add Arrows -->
                <div class="swiper-next"><i class="fa fa-angle-right"></i></div>
                <div class="swiper-prev"><i class="fa fa-angle-left"></i></div>
            </div>
        </div>
    </div>
</div>
@endif
<!--New Product End-->

<!--Product Reviews Start-->
<div class="product-reviews-section section-padding">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-title text-center">
                    <h2 class="title">Đánh giá sản phẩm</h2>
                </div>
                
                <!-- Review Summary -->
                <div class="review-summary" id="review-summary">
                    <div class="row align-items-center">
                        <div class="col-md-4">
                            <div class="overall-rating text-center">
                                <div class="rating-score">
                                    <span class="score" id="average-rating">0</span>
                                    <span class="max-score">/5</span>
                                </div>
                                <div class="rating-stars" id="overall-stars">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                </div>
                                <div class="total-reviews">
                                    <span id="total-reviews">0</span> đánh giá
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="rating-breakdown">
                                <div class="rating-row" data-rating="5">
                                    <span class="rating-label">5 sao</span>
                                    <div class="rating-bar">
                                        <div class="rating-fill" style="width: 0%"></div>
                                    </div>
                                    <span class="rating-count">0</span>
                                </div>
                                <div class="rating-row" data-rating="4">
                                    <span class="rating-label">4 sao</span>
                                    <div class="rating-bar">
                                        <div class="rating-fill" style="width: 0%"></div>
                                    </div>
                                    <span class="rating-count">0</span>
                                </div>
                                <div class="rating-row" data-rating="3">
                                    <span class="rating-label">3 sao</span>
                                    <div class="rating-bar">
                                        <div class="rating-fill" style="width: 0%"></div>
                                    </div>
                                    <span class="rating-count">0</span>
                                </div>
                                <div class="rating-row" data-rating="2">
                                    <span class="rating-label">2 sao</span>
                                    <div class="rating-bar">
                                        <div class="rating-fill" style="width: 0%"></div>
                                    </div>
                                    <span class="rating-count">0</span>
                                </div>
                                <div class="rating-row" data-rating="1">
                                    <span class="rating-label">1 sao</span>
                                    <div class="rating-bar">
                                        <div class="rating-fill" style="width: 0%"></div>
                                    </div>
                                    <span class="rating-count">0</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Review Actions -->
                <div class="review-actions mt-4">
                    <div class="row">
                        <div class="col-md-6">
                            <button class="btn btn-primary btn-write-review" id="btn-write-review">
                                <i class="fa fa-edit"></i> Viết đánh giá
                            </button>
                        </div>
                        <div class="col-md-6">
                            <div class="review-filters">
                                <select class="form-control" id="review-sort">
                                    <option value="newest">Mới nhất</option>
                                    <option value="oldest">Cũ nhất</option>
                                    <option value="rating_high">Đánh giá cao nhất</option>
                                    <option value="rating_low">Đánh giá thấp nhất</option>
                                    <option value="helpful">Hữu ích nhất</option>
                                </select>
                                <select class="form-control ml-2" id="rating-filter">
                                    <option value="">Tất cả đánh giá</option>
                                    <option value="5">5 sao</option>
                                    <option value="4">4 sao</option>
                                    <option value="3">3 sao</option>
                                    <option value="2">2 sao</option>
                                    <option value="1">1 sao</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Review List -->
                <div class="reviews-list mt-4" id="reviews-list">
                    <!-- Reviews will be loaded here -->
                </div>

                <!-- Load More Button -->
                <div class="text-center mt-4">
                    <button class="btn btn-outline-primary" id="load-more-reviews" style="display: none;">
                        Xem thêm đánh giá
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
<!--Product Reviews End-->

<!-- Review Form Modal -->
<div class="modal fade" id="reviewModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Viết đánh giá sản phẩm</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="review-form" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="product_id" value="{{$product->idProduct}}">
                    
                    <div class="form-group">
                        <label>Đánh giá của bạn <span class="text-danger">*</span></label>
                        <div class="review-rating-input">
                            <i class="fa fa-star" data-rating="1"></i>
                            <i class="fa fa-star" data-rating="2"></i>
                            <i class="fa fa-star" data-rating="3"></i>
                            <i class="fa fa-star" data-rating="4"></i>
                            <i class="fa fa-star" data-rating="5"></i>
                        </div>
                        <input type="hidden" name="rating" id="rating-input" required>
                        <div class="rating-text">Chọn số sao</div>
                    </div>

                    <div class="form-group">
                        <label>Tiêu đề đánh giá</label>
                        <input type="text" class="form-control" name="title" placeholder="Tóm tắt đánh giá của bạn">
                    </div>

                    <div class="form-group">
                        <label>Chi tiết đánh giá <span class="text-danger">*</span></label>
                        <textarea class="form-control" name="review_text" rows="5" placeholder="Chia sẻ chi tiết về trải nghiệm của bạn với sản phẩm này..." required></textarea>
                    </div>

                    <div class="form-group">
                        <label>Hình ảnh (tùy chọn)</label>
                        <input type="file" class="form-control-file" name="images[]" multiple accept="image/*">
                        <small class="form-text text-muted">Bạn có thể tải lên tối đa 5 hình ảnh, mỗi hình không quá 5MB</small>
                        <div class="image-preview mt-2" id="image-preview"></div>
                    </div>

                    <div class="alert alert-info">
                        <i class="fa fa-info-circle"></i>
                        Bạn chỉ có thể đánh giá sản phẩm đã mua.
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                <button type="submit" form="review-form" class="btn btn-primary">Gửi đánh giá</button>
            </div>
        </div>
    </div>
</div>

<div id="modal-AddToCart">
    
</div>

<!--Brand Start-->
<div class="brand-area">
    <div class="container">
        <div class="brand-active swiper-container">
            <div class="swiper-wrapper">
                <div class="single-brand swiper-slide">
                    <img src="{{asset('ericshop/images/brand/brand-1.jpg')}}" alt="">
                </div>
                <div class="single-brand swiper-slide">
                    <img src="{{asset('ericshop/images/brand/brand-2.jpg')}}" alt="">
                </div>
                <div class="single-brand swiper-slide">
                            <img src="{{asset('ericshop/images/brand/brand-3.jpg')}}" alt="">
                </div>
                <div class="single-brand swiper-slide">
                    <img src="{{asset('ericshop/images/brand/brand-4.jpg')}}" alt="">
                </div>
                <div class="single-brand swiper-slide">
                    <img src="{{asset('ericshop/images/brand/brand-5.jpg')}}" alt="">
                </div>
                <div class="single-brand swiper-slide">
                    <img src="{{asset('ericshop/images/brand/brand-6.jpg')}}" alt="">
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
                    url: '{{url("/add-to-cart")}}',
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

    // Product Review System
    const productId = {{$product->idProduct}};
    let currentPage = 1;
    let currentSort = 'newest';
    let currentRatingFilter = '';

    // Initialize reviews
    $(document).ready(function() {
        loadReviewStats();
        loadReviews();
        initializeReviewForm();
        checkCanReview();
    });

    // Load review statistics
    function loadReviewStats() {
        $.get(`{{ url("/api/products") }}/${productId}/reviews/stats`, function(stats) {
            updateReviewSummary(stats);
        });
    }

    // Update review summary display
    function updateReviewSummary(stats) {
        $('#average-rating').text(stats.average_rating || 0);
        $('#total-reviews').text(stats.total_reviews || 0);
        
        // Update header rating
        $('#header-rating').text(stats.average_rating || 0);
        $('#header-total-reviews').text(stats.total_reviews || 0);
        
        // Update star display
        updateStarRating('#overall-stars', stats.average_rating || 0);
        updateStarRating('#product-rating-header .rating-stars', stats.average_rating || 0);
        
        // Update rating breakdown
        const total = stats.total_reviews || 1;
        for (let rating = 1; rating <= 5; rating++) {
            const count = stats.rating_distribution[rating] || 0;
            const percentage = (count / total) * 100;
            
            const row = $(`.rating-row[data-rating="${rating}"]`);
            row.find('.rating-fill').css('width', percentage + '%');
            row.find('.rating-count').text(count);
        }
    }

    // Load reviews
    function loadReviews(page = 1, append = false) {
        const params = {
            per_page: 5,
            sort_by: currentSort,
            rating: currentRatingFilter,
            page: page
        };

        $.get(`{{ url("/api/products") }}/${productId}/reviews`, params, function(response) {
            if (append) {
                appendReviews(response.reviews.data);
            } else {
                displayReviews(response.reviews.data);
            }
            
            // Show/hide load more button
            if (response.reviews.next_page_url) {
                $('#load-more-reviews').show();
            } else {
                $('#load-more-reviews').hide();
            }
            
            currentPage = page;
        });
    }

    // Display reviews
    function displayReviews(reviews) {
        const container = $('#reviews-list');
        container.empty();
        
        if (reviews.length === 0) {
            container.html('<div class="no-reviews text-center"><p>Chưa có đánh giá nào cho sản phẩm này.</p></div>');
            return;
        }
        
        reviews.forEach(review => {
            container.append(createReviewHTML(review));
        });
    }

    // Append reviews (for load more)
    function appendReviews(reviews) {
        const container = $('#reviews-list');
        reviews.forEach(review => {
            container.append(createReviewHTML(review));
        });
    }


    // Create review HTML
    function createReviewHTML(review) {
        const customerName = review.customer ? review.customer.CustomerName : review.customer_name;
        const customerAvatar = review.customer && review.customer.Avatar ? 
            `{{asset('storage/admin/images/customer')}}/${review.customer.Avatar}` : 
            'data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 24 24" fill="%23ccc"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 3c1.66 0 3 1.34 3 3s-1.34 3-3 3-3-1.34-3-3 1.34-3 3-3zm0 14.2c-2.5 0-4.71-1.28-6-3.22.03-1.99 4-3.08 6-3.08 1.99 0 5.97 1.09 6 3.08-1.29 1.94-3.5 3.22-6 3.22z"/></svg>';
        
        const reviewDate = new Date(review.created_at).toLocaleDateString('vi-VN');
        const isVerified = review.is_verified_purchase ? '<span class="verified-purchase"><i class="fa fa-check-circle"></i> Đã mua hàng</span>' : '';
        
        let imagesHTML = '';
        if (review.images && review.images.length > 0) {
            imagesHTML = '<div class="review-images">';
            review.images.forEach(image => {
                imagesHTML += `<img src="/storage/reviews/${image}" alt="Review image" class="review-image">`;
            });
            imagesHTML += '</div>';
        }
        
        return `
            <div class="review-item" data-review-id="${review.id}">
                <div class="review-header">
                    <div class="reviewer-info">
                        <img src="${customerAvatar}" alt="${customerName}" class="reviewer-avatar">
                        <div class="reviewer-details">
                            <h6 class="reviewer-name">${customerName}</h6>
                            <div class="review-meta">
                                <div class="review-rating">
                                    ${generateStarHTML(review.rating)}
                                </div>
                                <span class="review-date">${reviewDate}</span>
                                ${isVerified}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="review-content">
                    ${review.title ? `<h6 class="review-title">${review.title}</h6>` : ''}
                    <p class="review-text">${review.review_text}</p>
                    ${imagesHTML}
                </div>
                <div class="review-actions">
                    <button class="btn btn-sm btn-outline-secondary helpful-btn" data-review-id="${review.id}">
                        <i class="fa fa-thumbs-up"></i> Hữu ích (${review.helpful_count || 0})
                    </button>
                </div>
            </div>
        `;
    }

    // Generate star HTML
    function generateStarHTML(rating) {
        let html = '';
        for (let i = 1; i <= 5; i++) {
            if (i <= rating) {
                html += '<i class="fa fa-star active"></i>';
            } else {
                html += '<i class="fa fa-star"></i>';
            }
        }
        return html;
    }

    // Update star rating display
    function updateStarRating(selector, rating) {
        const stars = $(selector).find('.fa-star');
        stars.removeClass('active');
        
        for (let i = 0; i < Math.floor(rating); i++) {
            stars.eq(i).addClass('active');
        }
    }

    // Initialize review form
    function initializeReviewForm() {
        // Star rating input
        $('.review-rating-input .fa-star').click(function() {
            const rating = $(this).data('rating');
            $('#rating-input').val(rating);
            
            $('.review-rating-input .fa-star').removeClass('active');
            for (let i = 0; i < rating; i++) {
                $('.review-rating-input .fa-star').eq(i).addClass('active');
            }
            
            $('.rating-text').text(`${rating} sao`);
        });

        // Image preview
        $('input[name="images[]"]').change(function() {
            const files = this.files;
            const preview = $('#image-preview');
            preview.empty();
            
            for (let i = 0; i < Math.min(files.length, 5); i++) {
                const file = files[i];
                const reader = new FileReader();
                
                reader.onload = function(e) {
                    preview.append(`
                        <div class="preview-image">
                            <img src="${e.target.result}" alt="Preview">
                            <button type="button" class="remove-image" data-index="${i}">&times;</button>
                        </div>
                    `);
                };
                
                reader.readAsDataURL(file);
            }
        });

        // Submit review form
        $('#review-form').submit(function(e) {
            e.preventDefault();
            
            console.log('Form submitted'); // Debug log
            
            const formData = new FormData(this);
            
            // Debug: Log form data
            for (let [key, value] of formData.entries()) {
                console.log('Form data:', key, value);
            }
            
            $.ajax({
                url: '{{ url("/api/reviews") }}',
                method: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    console.log('Success response:', response); // Debug log
                    if (response.success) {
                        $('#reviewModal').modal('hide');
                        $('#review-form')[0].reset();
                        $('.review-rating-input .fa-star').removeClass('active');
                        $('.rating-text').text('Chọn số sao');
                        $('#image-preview').empty();
                        
                        // Reload reviews and stats
                        loadReviewStats();
                        loadReviews();
                        
                        alert('Đánh giá của bạn đã được gửi thành công!');
                    }
                },
                error: function(xhr) {
                    console.error('Error response:', xhr); // Debug log
                    console.error('Response text:', xhr.responseText); // Debug log
                    
                    const errors = xhr.responseJSON?.errors;
                    if (errors) {
                        let errorMessage = 'Vui lòng kiểm tra lại:\n';
                        Object.values(errors).forEach(errorArray => {
                            errorArray.forEach(error => {
                                errorMessage += '- ' + error + '\n';
                            });
                        });
                        alert(errorMessage);
                    } else {
                        alert(xhr.responseJSON?.message || 'Có lỗi xảy ra: ' + xhr.status + ' - ' + xhr.statusText);
                    }
                }
            });
        });
    }

    // Check if customer can review
    function checkCanReview() {
        console.log('Checking if customer can review for product:', productId); // Debug log
        
        $.get(`{{ url("/api/products") }}/${productId}/can-review`, function(response) {
            console.log('Can review response:', response); // Debug log
            
            if (!response.can_review) {
                $('#btn-write-review').prop('disabled', true).attr('title', response.reason);
                console.log('Review disabled:', response.reason); // Debug log
            } else {
                $('#btn-write-review').prop('disabled', false);
                console.log('Review enabled'); // Debug log
            }
        }).fail(function(xhr) {
            console.error('Error checking can review:', xhr); // Debug log
        });
    }

    // Event handlers
    $('#btn-write-review').click(function() {
        console.log('Write review button clicked'); // Debug log
        console.log('Button disabled:', $(this).prop('disabled')); // Debug log
        
        if (!$(this).prop('disabled')) {
            console.log('Opening review modal'); // Debug log
            $('#reviewModal').modal('show');
        } else {
            console.log('Button is disabled, not opening modal'); // Debug log
            alert($(this).attr('title') || 'Bạn không thể đánh giá sản phẩm này.');
        }
    });

    $('#review-sort, #rating-filter').change(function() {
        currentSort = $('#review-sort').val();
        currentRatingFilter = $('#rating-filter').val();
        currentPage = 1;
        loadReviews();
    });

    $('#load-more-reviews').click(function() {
        loadReviews(currentPage + 1, true);
    });

    // Helpful button handler
    $(document).on('click', '.helpful-btn', function() {
        const reviewId = $(this).data('review-id');
        const btn = $(this);
        
        $.post(`{{ url("/api/reviews") }}/${reviewId}/helpful`, function(response) {
            if (response.success) {
                btn.find('i').removeClass('fa-thumbs-up').addClass('fa-thumbs-up text-primary');
                btn.html(`<i class="fa fa-thumbs-up text-primary"></i> Hữu ích (${response.helpful_count})`);
                btn.prop('disabled', true);
            } else {
                alert(response.message);
            }
        }).fail(function(xhr) {
            alert(xhr.responseJSON?.message || 'Có lỗi xảy ra.');
        });
    });

</script>

<!-- Review System CSS -->
<style>
/* Product header rating */
.product-rating {
    margin: 10px 0;
    display: flex;
    align-items: center;
    gap: 10px;
}

.product-rating .rating-stars {
    display: flex;
    gap: 2px;
}

.product-rating .rating-stars .fa-star {
    color: #e4e5e9;
    font-size: 1rem;
}

.product-rating .rating-stars .fa-star.active {
    color: #ffc107;
}

.product-rating .rating-text {
    color: #666;
    font-size: 0.9rem;
}

.product-reviews-section {
    background: #f8f9fa;
    padding: 60px 0;
}

.review-summary {
    background: white;
    padding: 30px;
    border-radius: 10px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    margin-bottom: 30px;
}

.overall-rating .score {
    font-size: 3rem;
    font-weight: bold;
    color: #ffc107;
}

.overall-rating .max-score {
    font-size: 1.5rem;
    color: #6c757d;
}

.rating-stars {
    margin: 10px 0;
}

.rating-stars .fa-star {
    color: #e4e5e9;
    font-size: 1.2rem;
    margin: 0 2px;
}

.rating-stars .fa-star.active {
    color: #ffc107;
}

.rating-breakdown .rating-row {
    display: flex;
    align-items: center;
    margin-bottom: 8px;
}

.rating-label {
    width: 50px;
    font-size: 0.9rem;
}

.rating-bar {
    flex: 1;
    height: 8px;
    background: #e4e5e9;
    border-radius: 4px;
    margin: 0 15px;
    overflow: hidden;
}

.rating-fill {
    height: 100%;
    background: #ffc107;
    transition: width 0.3s ease;
}

.rating-count {
    width: 30px;
    text-align: right;
    font-size: 0.9rem;
    color: #6c757d;
}

.review-actions {
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.review-filters {
    display: flex;
    gap: 10px;
}

.reviews-list {
    background: white;
    border-radius: 10px;
    padding: 20px;
}

.review-item {
    border-bottom: 1px solid #eee;
    padding: 20px 0;
}

.review-item:last-child {
    border-bottom: none;
}

.review-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    margin-bottom: 15px;
}

.reviewer-info {
    display: flex;
    align-items: center;
}

.reviewer-avatar {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    margin-right: 15px;
    object-fit: cover;
}

.reviewer-name {
    margin: 0 0 5px 0;
    font-weight: 600;
}

.review-meta {
    display: flex;
    align-items: center;
    gap: 15px;
}

.review-rating .fa-star {
    color: #e4e5e9;
    font-size: 0.9rem;
}

.review-rating .fa-star.active {
    color: #ffc107;
}

.review-date {
    color: #6c757d;
    font-size: 0.9rem;
}

.verified-purchase {
    color: #28a745;
    font-size: 0.8rem;
    font-weight: 500;
}

.verified-purchase .fa-check-circle {
    margin-right: 4px;
}

.review-title {
    font-weight: 600;
    margin-bottom: 10px;
}

.review-text {
    line-height: 1.6;
    margin-bottom: 15px;
}

.review-images {
    display: flex;
    gap: 10px;
    margin: 15px 0;
}

.review-image {
    width: 80px;
    height: 80px;
    object-fit: cover;
    border-radius: 8px;
    cursor: pointer;
    transition: transform 0.2s;
}

.review-image:hover {
    transform: scale(1.1);
}

.review-actions {
    display: flex;
    gap: 10px;
}

.helpful-btn {
    border: none;
    background: #f8f9fa;
    color: #6c757d;
    padding: 5px 15px;
    border-radius: 20px;
    font-size: 0.85rem;
    transition: all 0.2s;
}

.helpful-btn:hover {
    background: #e9ecef;
}

.helpful-btn:disabled {
    opacity: 0.7;
}

/* Review Form Modal */
.review-rating-input {
    margin: 10px 0;
}

.review-rating-input .fa-star {
    font-size: 2rem;
    color: #e4e5e9;
    cursor: pointer;
    margin: 0 5px;
    transition: color 0.2s;
}

.review-rating-input .fa-star:hover,
.review-rating-input .fa-star.active {
    color: #ffc107;
}

.rating-text {
    margin-top: 10px;
    font-size: 0.9rem;
    color: #6c757d;
}

.image-preview {
    display: flex;
    gap: 10px;
    flex-wrap: wrap;
}

.preview-image {
    position: relative;
    width: 80px;
    height: 80px;
}

.preview-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: 8px;
}

.remove-image {
    position: absolute;
    top: -5px;
    right: -5px;
    width: 20px;
    height: 20px;
    border-radius: 50%;
    background: #dc3545;
    color: white;
    border: none;
    font-size: 12px;
    cursor: pointer;
}

.no-reviews {
    padding: 40px;
    color: #6c757d;
}

@media (max-width: 768px) {
    .review-filters {
        flex-direction: column;
    }
    
    .review-actions {
        flex-direction: column;
        gap: 15px;
    }
    
    .rating-breakdown .rating-row {
        font-size: 0.8rem;
    }
}
</style>

@endsection