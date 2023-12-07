<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>EricShop</title>
    <meta name="robots" content="noindex, follow" />
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- <meta name="csrf-token" content="{{ csrf_token() }}"> -->
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('public/ericshop/images/shortlogo.png')}}">

    <!-- CSS
	============================================ -->

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{asset('public/ericshop/css/vendor/bootstrap.min.css')}}">

    <!-- Icon Font CSS -->
    <link rel="stylesheet" href="{{asset('public/ericshop/css/vendor/plazaicon.css')}}">
    <link rel="stylesheet" href="{{asset('public/ericshop/css/vendor/themify-icons.css')}}">
    <link rel="stylesheet" href="{{asset('public/ericshop/css/vendor/font-awesome.min.css')}}">

    <!-- Plugins CSS -->
    <link rel="stylesheet" href="{{asset('public/ericshop/css/plugins/animate.css')}}">
    <link rel="stylesheet" href="{{asset('public/ericshop/css/plugins/swiper-bundle.min.css')}}">
    <link rel="stylesheet" href="{{asset('public/ericshop/css/plugins/select2.min.css')}}">

    <!-- Helper CSS -->
    <link rel="stylesheet" href="{{asset('public/ericshop/css/helper.css')}}">
    <link rel="stylesheet" href="{{asset('public/ericshop/css/dataTables.bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('public/ericshop/css/responsive.bootstrap.min.css')}}">

    <!-- Main Style CSS -->
    <link rel="stylesheet" href="{{asset('public/ericshop/css/style.css')}}">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Kanit:wght@600&display=swap');
    </style>
    <!-- Modernizer JS -->
    <script src="{{asset('public/ericshop/js/vendor/modernizr-3.6.0.min.js')}}"></script>
    <!-- jQuery JS -->
    <script src="{{asset('public/ericshop/js/vendor/jquery-3.3.1.min.js')}}"
        integrity="sha384-tsQFqpEReu7ZLhBV2VZlAu7zcOV+rXbYlF2cqB8txI/8aZajjp4Bqd+V6D5IgvKT" crossorigin="anonymous">
        </script>
    <script src="{{asset('public/ericshop/js/jquery.preloadinator.min.js')}}"></script>




</head>

<body data-aos-easing="ease" data-aos-duration="400" data-aos-delay="0" class="preloader-deactive">
    <div class="main-wrapper">
        <!--Top Notification Start-->

        <!--Top Notification End-->

        <div class="preloader js-preloader flex-center">
            <div class="dots">
                <!-- <div class="dot"></div>
                <div class="dot"></div>
                <div class="dot"></div> -->
            </div>
        </div>

        <!--Header Section Start-->
        <?php 
            use App\Http\Controllers\CartController;
            use App\Http\Controllers\ProductController;
            use Illuminate\Support\Facades\Session;
        ?>
        <input id="quick-view-token" name="_token" type="hidden" value="{{csrf_token()}}">
        <div class="header-section d-none d-lg-block">
            <div class="main-header">
                <div class="container position-relative">
                    <div class="row align-items-center">
                        <div class="col-lg-2">
                            <div class="header-logo">
                                <a href="{{URL::to('/home')}}"><img src="{{asset('public/ericshop/images/logoo.png')}}"
                                        alt=""></a>
                            </div>
                        </div>
                        <div class="col-lg-7 position-static">
                            <div class="site-main-nav">
                                <nav class="site-nav">
                                    <ul>
                                        <li><a href="{{URL::to('/home')}}">Trang chủ</a></li>
                                        <li>
                                            <a href="{{URL::to('/store')}}">Cửa hàng </a>

                                            <ul class="mega-sub-menu"
                                                style=" width: 850px;justify-content: space-evenly;">
                                                <li class="mega-dropdown">
                                                    <a class="mega-title" href="{{URL::to('/store')}}">Danh mục</a>

                                                    <ul class="mega-item">
                                                        @foreach($list_category as $key => $category)
                                                        <li><a
                                                                href="{{URL::to('/store?show=all&category='.$category->idCategory.'&sort_by=new')}}">{{$category->CategoryName}}</a>
                                                        </li>
                                                        @endforeach
                                                    </ul>
                                                </li>
                                                <li class="mega-dropdown">
                                                    <a class="mega-title" href="{{URL::to('/store')}}">Thương hiệu</a>

                                                    <ul class="mega-item">
                                                        @foreach($list_brand as $key => $brand)
                                                        <li><a
                                                                href="{{URL::to('/store?show=all&brand='.$brand->idBrand.'&sort_by=new')}}">{{$brand->BrandName}}</a>
                                                        </li>
                                                        @endforeach
                                                    </ul>
                                                </li>
                                                <li class="mega-dropdown">
                                                    <a class="mega-title" href="{{URL::to('/store')}}">Danh Mục Khác</a>

                                                    <ul class="mega-item">
                                                        <li><a href="{{URL::to('/store?show=all&sort_by=new')}}">Sản
                                                                phẩm mới</a></li>
                                                        <li><a
                                                                href="{{URL::to('/store?show=all&sort_by=bestsellers')}}">Sản
                                                                phẩm bán chạy</a></li>
                                                        <li><a href="{{URL::to('/store?show=all&sort_by=featured')}}">Sản
                                                                phẩm nổi bật</a></li>
                                                    </ul>
                                                </li>

                                            </ul>
                                        </li>
                                        <li><a href="{{URL::to('/blog')}}">Tin tức</a></li>
                                        <li><a href="{{URL::to('/about_us')}}">Giới thiệu</a></li>

                                    </ul>
                                </nav>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="header-meta-info" style="position:relative;">
                                <div class="header-search">
                                    <form type="GET" action="{{URL::to('/search')}}">
                                        <input type="text" name="keyword" id="search-input"
                                            placeholder="Tìm kiếm sản phẩm " autocomplete="off">
                                        <button class="search-btn"><i class="icon-search"></i></button>
                                    </form>
                                </div>
                                <ul class="search-product">

                                </ul>
                                <div class="header-account">
                                    <div class="header-account-list dropdown top-link">
                                        @if(Session::get('idCustomer'))
                                        @if(Session::get('AvatarCus') != '')
                                        <a href="#" role="button" data-toggle="dropdown"><img style="border-radius:50%;"
                                                width="70px" height="24px"
                                                src="{{asset('public/storage/admin/images/customer/'.Session::get('AvatarCus'))}}"
                                                alt=""></a>
                                        @else <a href="#" role="button" data-toggle="dropdown"><i
                                                class="icon-users"></i></a> @endif
                                        <ul class="dropdown-menu">
                                            <li><a href="{{URL::to('/account')}}">Tài khoản của tôi</a></li>
                                            <li><a href="{{URL::to('/ordered')}}">Đơn mua</a></li>
                                            <li><a href="{{URL::to('/logout')}}">Đăng xuất</a></li>
                                        </ul>
                                        <input type="hidden" id="idCustomer" value="{{Session::get('idCustomer')}}">
                                        @else
                                        <a href="#" role="button" data-toggle="dropdown"><i class="icon-users"></i></a>
                                        <ul class="dropdown-menu">
                                            <li><a href="{{URL::to('/register')}}">Đăng ký</a></li>
                                            <li><a href="{{URL::to('/login')}}">Đăng nhập</a></li>
                                        </ul>
                                        <input type="hidden" id="idCustomer" value="">
                                        @endif
                                    </div>
                                    <div class="header-account-list dropdown mini-cart">
                                        <?php 
                                            $get_cart_header = CartController::get_cart_header();
                                            $sum_cart = $get_cart_header['sum_cart'];
                                            $carts = $get_cart_header['get_cart_header']; 
                                            $Total = 0; 
                                        ?>
                                        @if($sum_cart > 0)
                                        <a href="#" role="button" data-toggle="dropdown">
                                            <i class="icon-shopping-bag"></i>
                                            <span class="item-count ">{{$sum_cart}}</span>
                                        </a>
                                        <ul class="dropdown-menu ">
                                            <li class="product-cart">
                                                @foreach($carts as $key => $cart)
                                                @php
                                                $Total += ($cart->PriceNew * $cart->QuantityBuy);
                                                @endphp
                                                <div class="single-cart-box">
                                                    <div class="cart-img">
                                                        <?php $image = json_decode($cart->ImageName)[0]; ?>
                                                        <a href="{{URL::to('shop-single/'.$cart->ProductSlug)}}"><img
                                                                src="{{asset('public/storage/admin/images/product/'.$image)}}"
                                                                alt=""></a>
                                                        <span class="pro-quantity">{{$cart->QuantityBuy}}</span>
                                                    </div>
                                                    <div class="cart-content">
                                                        <h6 class="title"><a
                                                                href="{{URL::to('shop-single/'.$cart->ProductSlug)}}">{{$cart->ProductName}}</a>
                                                        </h6>
                                                        <span class="title"
                                                            style="font-size:13px;">{{$cart->AttributeProduct}}</span>
                                                        <div class="cart-price d-flex">
                                                            <span class="sale-price">{{number_format($cart->Price, 0,
                                                                ',', '.')}}đ</span>
                                                        </div>
                                                    </div>
                                                    <a class="del-icon delete-pd-cart" data-id="{{$cart->idCart}}"
                                                        data-token="{{csrf_token()}}"><i class="fa fa-trash"></i></a>
                                                </div>
                                                @endforeach
                                            </li>
                                            <li class="product-total">
                                                <ul class="cart-total">
                                                    <li> Tổng : <span>{{number_format($Total, 0, ',', '.')}}đ</span>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li class="product-btn">
                                                <a href="{{URL::to('/cart')}}" class="btn btn-dark btn-block">Xem giỏ
                                                    hàng</a>
                                            </li>
                                        </ul>
                                        @else
                                        <a href="#" role="button" data-toggle="dropdown">
                                            <i class="icon-shopping-bag"></i>
                                        </a>
                                        <ul class="dropdown-menu" style="height:250px; width:250px;">
                                            <li
                                                style="height:100%; display:flex; flex-direction:column; align-items:center; justify-content:center;">
                                                <img src="{{asset('public/ericshop/images/no_cart.png')}}" alt=""
                                                    style="width: 80%;" class="product-image">
                                                <span class="mt-10 d-block text-align-center">Giỏ hàng trống</span>
                                            </li>
                                        </ul>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--Header Section End-->


        <!--Header Mobile Start-->
        <div class="header-mobile d-lg-none">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-6">
                        <div class="header-logo">
                            <a href="{{URL::to('/home')}}"><img src="{{asset('public/ericshop/images/logo/logo.png')}}"
                                    alt=""></a>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="header-meta-info">
                            <div class="header-account">
                                <div class="header-account-list dropdown top-link">
                                    @if(Session::get('idCustomer'))
                                    @if(Session::get('AvatarCus') != '')
                                    <a href="#" role="button" data-toggle="dropdown" style="top:-3px;"><img
                                            style="border-radius:50%;" width="24px" height="24px"
                                            src="{{asset('public/storage/admin/images/customer/'.Session::get('AvatarCus'))}}"
                                            alt=""></a>
                                    @else <a href="#" role="button" data-toggle="dropdown"><i
                                            class="icon-users"></i></a> @endif
                                    <ul class="dropdown-menu">
                                        <li><a href="{{URL::to('/account')}}">Tài khoản của tôi</a></li>
                                        <li><a href="{{URL::to('/ordered')}}">Đơn mua</a></li>
                                        <li><a href="{{URL::to('/logout')}}">Đăng xuất</a></li>
                                    </ul>
                                    <input type="hidden" id="idCustomer" value="{{Session::get('idCustomer')}}">
                                    @else
                                    <a href="#" role="button" data-toggle="dropdown"><i class="icon-users"></i></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="{{URL::to('/register')}}">Đăng ký</a></li>
                                        <li><a href="{{URL::to('/login')}}">Đăng nhập</a></li>
                                    </ul>
                                    <input type="hidden" id="idCustomer" value="">
                                    @endif
                                </div>
                                <div class="header-account-list dropdown mini-cart">
                                    <?php 
                                        $get_cart_header = CartController::get_cart_header();
                                        $sum_cart = $get_cart_header['sum_cart'];
                                        $carts = $get_cart_header['get_cart_header']; 
                                        $Total = 0; 
                                    ?>
                                    @if($sum_cart > 0)
                                    <a href="#" role="button" data-toggle="dropdown">
                                        <i class="icon-shopping-bag"></i>
                                        <span class="item-count ">{{$sum_cart}}</span>
                                    </a>
                                    <ul class="dropdown-menu ">
                                        <li class="product-cart">
                                            @foreach($carts as $key => $cart)
                                            @php
                                            $Total += ($cart->PriceNew * $cart->QuantityBuy);
                                            @endphp
                                            <div class="single-cart-box">
                                                <div class="cart-img">
                                                    <?php $image = json_decode($cart->ImageName)[0]; ?>
                                                    <a href="{{URL::to('shop-single/'.$cart->ProductSlug)}}"><img
                                                            src="{{asset('public/storage/admin/images/product/'.$image)}}"
                                                            alt=""></a>
                                                    <span class="pro-quantity">{{$cart->QuantityBuy}}</span>
                                                </div>
                                                <div class="cart-content">
                                                    <h6 class="title"><a
                                                            href="{{URL::to('shop-single/'.$cart->ProductSlug)}}">{{$cart->ProductName}}</a>
                                                    </h6>
                                                    <span class="title"
                                                        style="font-size:13px;">{{$cart->AttributeProduct}}</span>
                                                    <div class="cart-price d-flex">
                                                        <span class="sale-price">{{number_format($cart->Price, 0, ',',
                                                            '.')}}đ</span>
                                                    </div>
                                                </div>
                                                <a class="del-icon delete-pd-cart" data-id="{{$cart->idCart}}"
                                                    data-token="{{csrf_token()}}"><i class="fa fa-trash"></i></a>
                                            </div>
                                            @endforeach
                                        </li>
                                        <li class="product-total">
                                            <ul class="cart-total">
                                                <li> Tổng : <span>{{number_format($Total, 0, ',', '.')}}đ</span></li>
                                            </ul>
                                        </li>
                                        <li class="product-btn">
                                            <a href="{{URL::to('/cart')}}" class="btn btn-dark btn-block">Xem giỏ
                                                hàng</a>
                                        </li>
                                    </ul>
                                    @else
                                    <a href="#" role="button" data-toggle="dropdown">
                                        <i class="icon-shopping-bag"></i>
                                    </a>
                                    <ul class="dropdown-menu" style="height:250px; width:250px;">
                                        <li
                                            style="height:100%; display:flex; flex-direction:column; align-items:center; justify-content:center;">
                                            <img src="{{asset('public/ericshop/images/no_cart.png')}}" alt=""
                                                style="width: 80%;" class="product-image">
                                            <span class="mt-10 d-block text-align-center">Giỏ hàng trống</span>
                                        </li>
                                    </ul>
                                    @endif
                                </div>
                                <div class="header-account-list mobile-menu-trigger">
                                    <button id="menu-trigger">
                                        <span></span>
                                        <span></span>
                                        <span></span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--Header Mobile End-->

        <!--Header Mobile Menu Start-->
        <div class="header-mobile-menu d-lg-none">

            <a href="javascript:void(0)" class="mobile-menu-close">
                <span></span>
                <span></span>
            </a>

            <div class="header-meta-info">
                <div class="header-search">
                    <form type="GET" action="{{URL::to('/search')}}">
                        <input type="text" name="keyword" id="search-input" placeholder="Tìm kiếm sản phẩm "
                            autocomplete="off">
                        <button class="search-btn"><i class="icon-search"></i></button>
                    </form>
                </div>
            </div>

            <div class="site-main-nav">
                <nav class="site-nav">
                    <ul class="navbar-mobile-wrapper">
                        <li><a href="{{URL::to('/home')}}">Trang chủ</a></li>
                        <li><a href="{{URL::to('/store')}}">Cửa hàng</a></li>
                        <li>
                            <a href="#">Sản phẩm <span class="new">Mới</span></a>

                            <ul class="mega-sub-menu">
                                <li class="mega-dropdown">
                                    <a class="mega-title" href="#">Danh mục</a>

                                    <ul class="mega-item">
                                        @foreach($list_category as $key => $category)
                                        <li><a
                                                href="{{URL::to('/store?show=all&category='.$category->idCategory.'&sort_by=new')}}">{{$category->CategoryName}}</a>
                                        </li>
                                        @endforeach
                                    </ul>
                                </li>
                                <li class="mega-dropdown">
                                    <a class="mega-title" href="#">Thương hiệu</a>

                                    <ul class="mega-item">
                                        @foreach($list_brand as $key => $brand)
                                        <li><a
                                                href="{{URL::to('/store?show=all&brand='.$brand->idBrand.'&sort_by=new')}}">{{$brand->BrandName}}</a>
                                        </li>
                                        @endforeach
                                    </ul>
                                </li>
                                <li class="mega-dropdown">
                                    <a class="mega-title" href="#">Danh mục khác</a>

                                    <ul class="mega-item">
                                        <li><a href="{{URL::to('/store?show=all&sort_by=new')}}">Sản phẩm mới</a></li>
                                        <li><a href="{{URL::to('/store?show=all&sort_by=bestsellers')}}">Sản phẩm bán
                                                chạy</a></li>
                                        <li><a href="{{URL::to('/store?show=all&sort_by=featured')}}">Sản phẩm nổi
                                                bật</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <li><a href="{{URL::to('/blog')}}">Tin tức</a></li>
                        <li><a href="{{URL::to('/about_us')}}">Giới thiệu</a></li>
                        <li><a href="{{URL::to('/contact')}}">Liên hệ</a></li>
                    </ul>
                </nav>
            </div>

            <div class="header-social">
                <ul class="social">
                    <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                    <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                    <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                    <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                    <li><a href="#"><i class="fa fa-pinterest"></i></a></li>
                </ul>
            </div>

        </div>
        <!--Header Mobile Menu End-->

        <div class="overlay"></div>
        <!--Overlay-->


        @yield('content')



        <!--Footer Section Start-->
        <div class="footer-area">
            <div class="container">
                <div class="footer-widget-area section-padding-6">
                    <div class="row justify-content-between">

                        <!--Footer Widget Start-->
                        <div class="col-lg-4 col-md-6">
                            <div class="footer-widget">
                                <a class="footer-logo" href="#"><img
                                        src="{{asset('public/ericshop/images/logo/logo.png')}}" alt=""></a>
                                <div class="footer-widget-text">
                                    <p>Nếu bạn chưa từng đi giày thể thao thì bạn hãy nên thử đi một lần, tôi tin rằng
                                        bạn sẽ rất “bảnh” nếu biết chọn lấy 1 đôi giày tốt. </p>
                                </div>
                                <div class="widget-social">
                                    <ul>
                                        <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                        <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                        <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                                        <li><a href="#"><i class="fa fa-youtube"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            <!--Footer Widget End-->
                        </div>

                        <div class="col-lg-2 col-md-4 col-sm-6">
                            <div class="footer-widget">
                                <h4 class="footer-widget-title">Danh mục</h4>

                                <div class="footer-widget-menu">
                                    <ul>
                                        <li><a href="{{URL::to('/home')}}">Trang chủ</a></li>
                                        <li><a href="{{URL::to('/store')}}">Cửa hàng</a></li>
                                        <li><a href="{{URL::to('/blog')}}">Tin tức</a></li>
                                        <li><a href="{{URL::to('/about_us')}}">Giới thiệu</a></li>
                                        <li><a href="{{URL::to('/contact')}}">Liên hệ</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-2 col-md-4 col-sm-6">
                            <div class="footer-widget">
                                <h4 class="footer-widget-title">Hỗ trợ khách hàng</h4>

                                <div class="footer-widget-menu">
                                    <ul>
                                        <li><a href="#">Hỏi Đáp</a></li>
                                        <li><a href="#">Hướng dẫn đặt hàng</a></li>
                                        <li><a href="#">Phương thức thanh toán</a></li>
                                        <li><a href="#">Hướng dẫn chăm sóc sản phẩm</a></li>
                                        <li><a href="about.html">Chính sách bảo mật</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>


                        <div class="col-lg-2 col-md-4 col-sm-6">
                            <div class="footer-widget">
                                <h4 class="footer-widget-title">DỊCH VỤ KHÁCH HÀNG</h4>

                                <div class="footer-widget-menu">
                                    <ul>
                                        <li><a href="{{URL::to('/account')}}">Tài khoản</a></li>
                                        <li><a href="#">Điều khoản sử dụng</a></li>
                                        <li><a href="#">Chính sách đổi trả, bảo hành</a></li>
                                        <li><a href="#">Mã giảm giá</a></li>

                                    </ul>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <!--Footer Section End-->


        <!--Back To Start-->
        <a href="#" class="back-to-top">
            <i class="fa fa-angle-double-up"></i>
        </a>


    </div>

    <!-- JS
    ============================================ -->


    <!-- Bootstrap JS -->
    <script src="{{asset('public/ericshop/js/vendor/popper.min.js')}}"></script>
    <script src="{{asset('public/ericshop/js/vendor/bootstrap.min.js')}}"></script>

    <!-- Plugins JS -->
    <script src="{{asset('public/ericshop/js/plugins/swiper-bundle.min.js')}}"></script>
    <script src="{{asset('public/ericshop/js/plugins/jquery.countdown.min.js')}}"></script>
    <script src="{{asset('public/ericshop/js/plugins/jquery.elevateZoom.min.js')}}"></script>
    <script src="{{asset('public/ericshop/js/plugins/select2.min.js')}}"></script>
    <script src="{{asset('public/ericshop/js/plugins/ajax-contact.js')}}"></script>


    <!--====== Use the minified version files listed below for better performance and remove the files listed above ======-->
    <!-- <script src="assets/js/plugins.min.js"></script> -->

    <!-- Main JS -->
    <script src="{{asset('public/ericshop/js/main.js')}}"></script>


    <!-- Google Map js -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBQ5y0EF8dE6qwc03FcbXHJfXr4vEa7z54"></script>
    <script src="{{asset('public/ericshop/js/map-script.js')}}"></script>
    <script src="{{asset('public/ericshop/js/form-validate.js')}}"></script>
    <script src="{{asset('public/ericshop/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('public/ericshop/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('public/ericshop/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('public/ericshop/js/responsive.bootstrap.min.js')}}"></script>

    <!-- Modal quick view JS -->
    <script>
        $('.js-preloader').preloadinator();
        $('.js-preloader').preloadinator({
            scroll: false
        });
        $('.js-preloader').preloadinator({
            minTime: 2000
        });
        $('.js-preloader').preloadinator({
            animation: 'fadeOut',
            animationDuration: 400
        });

        $(document).ready(function () {
            APP_URL = '{{url(' / ')}}';

            // Quick view sản phẩm
            $('.quick-view-pd').on('click', function () {
                var idProduct = $(this).data('id');
                var _token = $('input[name="_token"]').val();

                $.ajax({
                    url: '{{url("/quick-view-pd")}}',
                    method: 'POST',
                    data: { idProduct: idProduct, _token: _token },
                    success: function (data) {
                        $('.main-wrapper').append(data);
                        $('#modal-pd-' + idProduct).modal('show');
                    }
                });
            });




            // Xoá 1 sp trong giỏ hàng
            $('.delete-pd-cart').on('click', function () {
                var idCart = $(this).data("id");
                var _token = $(this).data("token");

                $.ajax({
                    url: APP_URL + '/delete-pd-cart/' + idCart,
                    method: 'DELETE',
                    data: { idCart: idCart, _token: _token },
                    success: function (data) {
                        location.reload();
                    }
                });
            });

            // Gợi ý tìm kiếm sản phẩm
            $('#search-input').on('keyup', function () {
                var value = $(this).val();
                var _token = $('input[name="_token"]').val();
                if (value != '') {
                    $.ajax({
                        url: '{{url("/search-suggestions")}}',
                        method: 'POST',
                        data: { value: value, _token: _token },
                        success: function (data) {
                            $('.search-product').fadeIn();
                            $('.search-product').html(data);

                            $('.search-product-item').on('click', function () {
                                $('#search-input').val($(this).text());
                                $('.search-product').fadeOut();
                            });
                        }
                    });
                } else $('.search-product').fadeOut();
            });

            $('#search-input').on('blur', function () {
                $('.search-product').fadeOut();
            });

            // Bộ lọc tìm kiếm
            var category = [], tempArrayCat = [], brand = [], tempArrayBrand = [];
            url = window.location.href;

            $(".filter-product").on("click", function () {
                var sort_by = $('.select-input__sort').data("sort");
                var min_price = $('.input-filter-price.min').val();
                var max_price = $('.input-filter-price.max').val();
                var min_price_filter = '';
                var max_price_filter = '';

                if (url.indexOf("search?keyword=") != -1) {
                    var keyword = $('#keyword-link').val();
                    page = 'search?keyword=' + keyword;
                } else page = 'store?show=all';

                $.each($("[data-filter='brand']:checked"), function () {
                    tempArrayBrand.push($(this).val());
                });
                tempArrayBrand.reverse();

                $.each($("[data-filter='category']:checked"), function () {
                    tempArrayCat.push($(this).val());
                });
                tempArrayCat.reverse();

                if (min_price != '' && max_price != '' && parseInt(min_price) > parseInt(max_price)) $('.alert-filter-price').removeClass("d-none");
                else {
                    if (min_price != '') min_price_filter = '&priceMin=' + min_price;
                    else min_price_filter = '';

                    if (max_price != '') max_price_filter = '&priceMax=' + max_price;
                    else max_price_filter = '';

                    if (tempArrayBrand.length !== 0 && tempArrayCat.length !== 0) {
                        brand += '&brand=' + tempArrayBrand.toString();
                        category += '&category=' + tempArrayCat.toString();
                        window.location.href = page + brand + category + min_price_filter + max_price_filter + sort_by;
                    } else if (tempArrayCat.length !== 0) {
                        category += '&category=' + tempArrayCat.toString();
                        window.location.href = page + category + min_price_filter + max_price_filter + sort_by;
                    } else if (tempArrayBrand.length !== 0) {
                        brand += '&brand=' + tempArrayBrand.toString();
                        window.location.href = page + brand + min_price_filter + max_price_filter + sort_by;
                    } else window.location.href = page + min_price_filter + max_price_filter + sort_by;
                }
            });

            $('.select-input__item').on('click', function () {
                var sort_by = $(this).data("sort");
                split_url = url.split("&sort_by");
                if (url.indexOf("?show=all") != -1 || url.indexOf("?keyword") != -1) window.location.href = split_url[0] + sort_by;
                else window.location.href = url + '?show=all' + sort_by;
            });

            $('.btn-filter-price').on('click', function () {
                var min_price = $('.input-filter-price.min').val();
                var max_price = $('.input-filter-price.max').val();
                var min_price_filter = '';
                var max_price_filter = '';

                if (min_price != '' && max_price != '' && parseInt(min_price) > parseInt(max_price)) $('.alert-filter-price').removeClass("d-none");
                else {
                    if (min_price != '') min_price_filter = '&priceMin=' + min_price;
                    else min_price_filter = '';

                    if (max_price != '') max_price_filter = '&priceMax=' + max_price;
                    else max_price_filter = '';

                    if (url.indexOf("&sort_by") != -1) {
                        split_url = url.split("&sort_by");
                        if (url.indexOf("&price") != -1) {
                            split_url_price = url.split("&price");
                            window.location.href = split_url_price[0] + min_price_filter + max_price_filter + "&sort_by" + split_url[1];
                        }
                        else window.location.href = split_url[0] + min_price_filter + max_price_filter + "&sort_by" + split_url[1];
                    } else {
                        split_url = url.split("&price");
                        if (url.indexOf("?show=all") != -1 || url.indexOf("?keyword") != -1)
                            window.location.href = split_url[0] + min_price_filter + max_price_filter;
                        else window.location.href = url + '?show=all' + min_price_filter + max_price_filter;
                    }
                }
            });
        });
    </script>
</body>

</html>