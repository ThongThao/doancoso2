@extends('shop_layout')
@section('content')

<?php use App\Http\Controllers\ProductController; ?>
<!--Slider Start-->
<div class="slider-area">
    <div class="swiper-container slider-active">
        <div class="swiper-wrapper">
            <!--Single Slider Start-->
            <div class="single-slider swiper-slide animation-style-01" style="background-image: url('{{asset('ericshop/images/slider/ERICBanner.png')}}');">
                <div class="container">
                    <div class="slider-content">
                        <ul class="slider-btn" >
                            <li><a href="{{URL::to('/store')}}" class="btn btn-round btn-primary">Bắt đầu mua sắm</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <!--Single Slider End-->

            <!--Single Slider Start-->
            <div class="single-slider swiper-slide animation-style-01" style="background-image: url('{{asset('ericshop/images/slider/ERICBanner2.png')}}');">
                <div class="container" style="text-align:right;">
                    <div class="slider-content">
                        <ul class="slider-btn" style=" padding-top: 400px; padding-right: 250px;animation-delay: 0.5s;">
                            <li><a href="{{URL::to('/store')}}" class="btn btn-round btn-primary">Bắt đầu mua sắm</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <!--Single Slider End-->
        </div>
        <!--Swiper Wrapper End-->

        <!-- Add Arrows -->
        <div class="swiper-next"><i class="fa fa-angle-right"></i></div>
        <div class="swiper-prev"><i class="fa fa-angle-left"></i></div>

        <!-- Add Pagination -->
        <div class="swiper-pagination"></div>

    </div>
    <!--Swiper Container End-->
</div>
<!--Slider End-->



<!--Shipping Start-->
<div class="shipping-area section-padding-3">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-sm-6">
                <div class="single-shipping">
                    <div class="shipping-icon">
                        <img src="ericshop/images/shipping-icon/Free-Delivery.png" alt="">
                    </div>
                    <div class="shipping-content">
                        <h5 class="title">Miễn Phí Vận Chuyển</h5>
                        <p>Giao hàng miễn phí cho tất cả các đơn đặt hàng trên 1.000.000đ</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="single-shipping">
                    <div class="shipping-icon">
                        <img src="ericshop/images/shipping-icon/Online-Order.png" alt="">
                    </div>
                    <div class="shipping-content">
                        <h5 class="title">Đặt Hàng Online</h5>
                        <p>Đừng lo lắng, bạn có thể đặt hàng Trực tuyến trên Trang web của chúng tôi</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="single-shipping">
                    <div class="shipping-icon">
                        <img src="ericshop/images/shipping-icon/Freshness.png" alt="">
                    </div>
                    <div class="shipping-content">
                        <h5 class="title">Hiện Đại</h5>
                        <p>Cập nhật những sản phẩm mới nhất</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="single-shipping">
                    <div class="shipping-icon">
                        <img src="ericshop/images/shipping-icon/247.png" alt="">
                    </div>
                    <div class="shipping-content">
                        <h5 class="title">Hỗ Trợ 24/7</h5>
                        <p>Đội ngũ hỗ trợ trưc tuyến chuyên nghiệp</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--Shipping End-->
<!--New Product Start-->
<div class="new-product-area section-padding-2">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-9 col-sm-11">
                <div class="section-title text-center">
                    <h2 class="title">Sản Phẩm Mới</h2>
            
                </div>
            </div>
        </div>
        <div class="product-wrapper">
            <div class="swiper-container product-active">
                <div class="swiper-wrapper">
                    @foreach($list_new_pd as $key => $new_pd)
                    <div class="swiper-slide">
                        <div class="single-product">
                            <div class="product-image">
                                <?php $image = json_decode($new_pd->ImageName)[0];?>
                                <a href="{{URL::to('/shop-single/'.$new_pd->ProductSlug)}}">
                                    <img src="{{asset('storage/admin/images/product/'.$image)}}" alt="">
                                </a>

                              
                                @if($new_pd->QuantityTotal == '0') <span class="sticker-new soldout-title">Hết hàng</span>;
                                @endif

                                <div class="action-links">
                                    <ul>
                                        <li><a class="add-to-wishlist" data-id="{{$new_pd->idProduct}}" data-tooltip="tooltip" data-placement="left" title="Thêm vào danh sách yêu thích"><i class="icon-heart"></i></a></li>
                                        <li><a class="quick-view-pd" data-id="{{$new_pd->idProduct}}" data-tooltip="tooltip" data-placement="left" title="Xem nhanh"><i class="icon-eye"></i></a></li> 
                                    </ul>
                                </div>
                            </div>
                            <div class="product-content text-center">
                                <h4 class="product-name"><a href="{{URL::to('/shop-single/'.$new_pd->ProductSlug)}}">{{$new_pd->ProductName}}</a></h4>
                                <div class="price-box">
                                   
                                        <span class="current-price">{{number_format($new_pd->Price,0,',','.')}}đ</span>
                         
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
<!--New Product End-->

<!--About Start-->
<div class="about-area section-padding-4">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="about-image">
                        <img src="ericshop/images/banner/banner_home.png" alt="">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="about-content">
                    <h2 class="title">Sưởi ấm bước chân, đón mùa đông thật phong cách.</h2>
                    <p>Các mã giảm giá hiện có trên cửa hàng:</p>
                    <ul>
                        <li> SALE100K: Giảm 100K trên tổng giá trị đơn hàng. </li>
                        <li> SALE10: Giảm 10% trên tổng giá trị đơn hàng. </li>
                    </ul>
                    <div class="about-btn">
                        <a href="{{URL::to('/store')}}" class="btn btn-primary btn-round">Mua Ngay</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--About End-->



<!--New Product Start-->
<div class="features-product-area section-padding-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-9 col-sm-11">
                <div class="section-title text-center">
                    <h2 class="title">Sản Phẩm</h2>
                    
                </div>
            </div>
        </div>
        <div class="product-wrapper">
            <div class="product-tab-menu">
                <ul class="nav justify-content-center" role="tablist">
                    <li>
                        <a class="active" data-toggle="tab" href="#tab3" role="tab">Bán chạy</a>
                    </li>
                    <li>
                        <a data-toggle="tab" href="#tab2" role="tab">Nổi bật</a>
                    </li>
                  
                </ul>
            </div>

            <div class="tab-content product-items-tab">
                <div class="tab-pane fade show active" id="tab3" role="tabpanel">
                    <div class="swiper-container product-active">
                        <div class="swiper-wrapper">
                            @foreach($list_bestsellers_pd as $key => $bestsellers_pd)
                            <div class="swiper-slide">
                                <div class="single-product">
                                    <div class="product-image">
                                        <?php $image = json_decode($bestsellers_pd->ImageName)[0];?>
                                        <a href="{{URL::to('/shop-single/'.$bestsellers_pd->ProductSlug)}}">
                                            <img src="{{asset('storage/admin/images/product/'.$image)}}" alt="">
                                        </a>

                                       
                                        @if($bestsellers_pd->QuantityTotal == '0') <span class="sticker-new soldout-title">Hết hàng</span>;
                                        @endif

                                        <div class="action-links">
                                            <ul>
                                                <li><a class="add-to-wishlist" data-id="{{$bestsellers_pd->idProduct}}" data-tooltip="tooltip" data-placement="left" title="Thêm vào danh sách yêu thích"><i class="icon-heart"></i></a></li>
                                                <li><a class="quick-view-pd" data-id="{{$bestsellers_pd->idProduct}}" data-tooltip="tooltip" data-placement="left" title="Xem nhanh"><i class="icon-eye"></i></a></li> 
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="product-content text-center">
                                     
                                        <h4 class="product-name"><a href="{{URL::to('/shop-single/'.$bestsellers_pd->ProductSlug)}}">{{$bestsellers_pd->ProductName}}</a></h4>
                                        <div class="price-box">
                                           
                                                <span class="current-price">{{number_format($bestsellers_pd->Price,0,',','.')}}đ</span>
                                        
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
                <div class="tab-pane fade" id="tab2" role="tabpanel">
                    <div class="swiper-container product-active">
                        <div class="swiper-wrapper">
                            @foreach($list_featured_pd as $key => $featured_pd)
                            <div class="swiper-slide">
                                <div class="single-product">
                                    <div class="product-image">
                                        <?php $image = json_decode($featured_pd->ImageName)[0];?>
                                        <a href="{{URL::to('/shop-single/'.$featured_pd->ProductSlug)}}">
                                            <img src="{{asset('storage/admin/images/product/'.$image)}}" alt="">
                                        </a>

                                       
                                        @if($featured_pd->QuantityTotal == '0') <span class="sticker-new soldout-title">Hết hàng</span>;
                                        @endif

                                        <div class="action-links">
                                            <ul>
                                                <li><a class="add-to-wishlist" data-id="{{$featured_pd->idProduct}}" data-tooltip="tooltip" data-placement="left" title="Thêm vào danh sách yêu thích"><i class="icon-heart"></i></a></li>
                                                <li><a class="quick-view-pd" data-id="{{$featured_pd->idProduct}}" data-tooltip="tooltip" data-placement="left" title="Xem nhanh"><i class="icon-eye"></i></a></li> 
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="product-content text-center">
                                        <h4 class="product-name"><a href="{{URL::to('/shop-single/'.$featured_pd->ProductSlug)}}">{{$featured_pd->ProductName}}</a></h4>
                                        <div class="price-box">
                                          
                                                <span class="current-price">{{number_format($featured_pd->Price,0,',','.')}}đ</span>
                                      
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
                <div class="tab-pane fade" id="tab1" role="tabpanel">
                    <div class="swiper-container product-active">
                        <div class="swiper-wrapper">
                        @foreach($list_featured_pd as $key => $featured_pd)
    <div class="swiper-slide">
        <div class="single-product">
            <div class="product-image">
                <?php $image = json_decode($featured_pd->ImageName)[0];?>
                <a href="{{URL::to('/shop-single/'.$featured_pd->ProductSlug)}}">
                    <img src="{{asset('storage/admin/images/product/'.$image)}}" alt="">
                </a>

                <div class="action-links">
                    <ul>
                        <li><a class="add-to-wishlist" data-id="{{$featured_pd->idProduct}}" data-tooltip="tooltip" data-placement="left" title="Thêm vào danh sách yêu thích"><i class="icon-heart"></i></a></li>
                        <li><a class="quick-view-pd" data-id="{{$featured_pd->idProduct}}" data-tooltip="tooltip" data-placement="left" title="Xem nhanh"><i class="icon-eye"></i></a></li> 
                    </ul>
                </div>
            </div>
            <div class="product-content text-center">
                <h4 class="product-name"><a href="{{URL::to('/shop-single/'.$featured_pd->ProductSlug)}}">{{$featured_pd->ProductName}}</a></h4>
                <div class="price-box">
                    <span class="current-price">{{number_format($featured_pd->Price,0,',','.')}}đ</span>
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
    </div>
</div>
<!--New Product End-->

            <!-- Add Arrows -->
            <div class="swiper-next"><i class="fa fa-angle-right"></i></div>
            <div class="swiper-prev"><i class="fa fa-angle-left"></i></div>
        </div>
    </div>
</div> 


<!--Blog Start-->
<div class="blog-area blog-bg section-padding-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-9 col-sm-11">
                <div class="section-title text-center">
                    <h2 class="title">Bài Viết Của Chúng Tôi</h2>
                </div>
            </div>
        </div>
        <div class="blog-wrapper mt-30">
            <div class="swiper-container blog-active">
                <div class="swiper-wrapper">
                    @foreach($list_blog as $key => $blog)
                    <div class="swiper-slide">
                        <div class="single-blog">
                            <div class="blog-image">
                                <a href="{{URL::to('/blog/'.$blog->BlogSlug)}}"><img src="{{asset('storage/admin/images/blog/'.$blog->BlogImage)}}" alt=""></a>
                            </div>
                            <div class="blog-content">
                                <h4 class="title"><a href="{{URL::to('/blog/'.$blog->BlogSlug)}}">{{$blog->BlogTitle}}</a></h4>
                                <div class="articles-date">
                                    <p><span>{{$blog->created_at}}</span></p>
                                </div>
                                <div class="four-line mb-4">{!!$blog->BlogDesc!!}</div>

                                <div class="blog-footer">
                                    <a class="more" href="{{URL::to('/blog/'.$blog->BlogSlug)}}">Tìm hiểu thêm</a>
                                    <!-- <p class="comment-count"><i class="icon-message-circle"></i> 0</p> -->
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
<!--Blog End-->


@endsection