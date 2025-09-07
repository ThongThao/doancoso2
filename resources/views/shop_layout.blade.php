<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>EricShop</title>
    <meta name="robots" content="noindex, follow" />
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
                                            placeholder="Tìm kiếm " autocomplete="off">
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
                                                width="140px" height="50px"
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
                                        src="{{asset('public/ericshop/images/logoo.png')}}" alt=""></a>
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

    <!-- Chat widget start -->
    <style>
      /* Chat Widget Animations */
      @keyframes slideUp {
        from { transform: translateY(100%); opacity: 0; }
        to { transform: translateY(0); opacity: 1; }
      }
      
      @keyframes fadeIn {
        from { opacity: 0; transform: scale(0.8); }
        to { opacity: 1; transform: scale(1); }
      }
      
      @keyframes pulse {
        0% { box-shadow: 0 0 0 0 rgba(13, 110, 253, 0.7); }
        70% { box-shadow: 0 0 0 10px rgba(13, 110, 253, 0); }
        100% { box-shadow: 0 0 0 0 rgba(13, 110, 253, 0); }
      }
      
      @keyframes messageSlide {
        from { transform: translateY(20px); opacity: 0; }
        to { transform: translateY(0); opacity: 1; }
      }
      
      /* Widget Container */
      #chat-widget {
        position: fixed;
        right: 20px;
        bottom: 20px;
        z-index: 10001;
        font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
      }
      
      /* Chat Button */
      #chat-button {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: #fff;
        border-radius: 50%;
        width: 60px;
        height: 60px;
        border: none;
        box-shadow: 0 8px 25px rgba(0,0,0,.15);
        cursor: pointer;
        font-size: 24px;
        transition: all 0.3s ease;
        animation: pulse 2s infinite;
        display: flex;
        align-items: center;
        justify-content: center;
      }
      
      #chat-button:hover {
        transform: scale(1.1);
        box-shadow: 0 12px 35px rgba(0,0,0,.25);
      }
      
      /* Chat Box */
      #chat-box {
        display: none;
        position: fixed;
        right: 20px;
        bottom: 100px;
        width: 380px;
        height: 520px;
        background: #fff;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 20px 60px rgba(0,0,0,.15);
        z-index: 10000;
        animation: slideUp 0.3s ease;
        border: 1px solid rgba(0,0,0,.1);
      }
      
      /* Chat Header */
      #chat-header {
        padding: 20px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: #fff;
        font-weight: 600;
        font-size: 16px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        box-shadow: 0 2px 10px rgba(0,0,0,.1);
      }
      
      #chat-header .logo {
        width: 32px;
        height: 32px;
        background: rgba(255,255,255,.2);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 12px;
      }
      
      #chat-close {
        background: rgba(255,255,255,.2);
        border: none;
        color: #fff;
        width: 32px;
        height: 32px;
        border-radius: 50%;
        cursor: pointer;
        transition: all 0.2s ease;
        display: flex;
        align-items: center;
        justify-content: center;
      }
      
      #chat-close:hover {
        background: rgba(255,255,255,.3);
        transform: scale(1.1);
      }
      
      /* Messages Area */
      #chat-messages {
        height: 360px;
        overflow-y: auto;
        padding: 20px;
        background: #f8f9fa;
        scroll-behavior: smooth;
      }
      
      #chat-messages::-webkit-scrollbar {
        width: 6px;
      }
      
      #chat-messages::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 3px;
      }
      
      #chat-messages::-webkit-scrollbar-thumb {
        background: #c1c1c1;
        border-radius: 3px;
      }
      
      #chat-messages::-webkit-scrollbar-thumb:hover {
        background: #a8a8a8;
      }
      
      /* Input Area */
      #chat-input {
        display: flex;
        gap: 12px;
        padding: 20px;
        border-top: 1px solid #e9ecef;
        background: #fff;
        align-items: flex-end;
      }
      
      #chat-input input {
        flex: 1;
        border: 2px solid #e9ecef;
        border-radius: 25px;
        padding: 12px 18px;
        font-size: 14px;
        outline: none;
        transition: all 0.2s ease;
        resize: none;
        max-height: 60px;
      }
      
      #chat-input input:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
      }
      
      #chat-input button {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: #fff;
        border: none;
        border-radius: 50%;
        width: 44px;
        height: 44px;
        cursor: pointer;
        transition: all 0.2s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 16px;
      }
      
      #chat-input button:hover {
        transform: scale(1.1);
        box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
      }
      
      #chat-input button:disabled {
        opacity: 0.6;
        cursor: not-allowed;
        transform: none;
      }
      
      /* Message Styles */
      .chat-message {
        display: flex;
        margin-bottom: 16px;
        align-items: flex-start;
        animation: messageSlide 0.3s ease;
      }
      
      .chat-message.user {
        flex-direction: row-reverse;
      }
      
      .chat-message.admin {
        flex-direction: row;
      }
      
      /* Avatar Styles */
      .chat-avatar {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        margin: 0 10px;
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 600;
        font-size: 14px;
        box-shadow: 0 2px 8px rgba(0,0,0,.1);
      }
      
      .chat-avatar.admin {
        color: #fff;
      }
      
      .chat-avatar.user {
        background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
        color: #fff;
      }
      
      .chat-avatar img {
        width: 100%;
        height: 100%;
        border-radius: 50%;
        object-fit: cover;
      }
      
      /* Content Styles */
      .chat-content {
        max-width: 75%;
        word-wrap: break-word;
      }
      
      .chat-bubble {
        padding: 12px 18px;
        border-radius: 20px;
        font-size: 14px;
        line-height: 1.4;
        position: relative;
        box-shadow: 0 2px 8px rgba(0,0,0,.08);
        margin-bottom: 4px;
      }
      
      .chat-bubble.admin {
        background: #fff;
        border: 1px solid #e9ecef;
        color: #333;
        border-bottom-left-radius: 6px;
      }
      
      .chat-bubble.user {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: #fff;
        border-bottom-right-radius: 6px;
      }
      
      .chat-time {
        font-size: 11px;
        color: #6c757d;
        margin-top: 2px;
        opacity: 0.8;
      }
      
      .chat-message.user .chat-time {
        text-align: right;
        color: rgba(255,255,255,.7);
      }
      
      .chat-message.admin .chat-time {
        text-align: left;
      }
      
      /* Welcome Message */
      .chat-welcome {
        text-align: center;
        padding: 40px 20px;
        color: #6c757d;
        font-size: 14px;
        animation: fadeIn 0.5s ease;
      }
      
      .chat-welcome-icon {
        font-size: 48px;
        margin-bottom: 16px;
        color: #667eea;
        animation: pulse 2s infinite;
      }
      
      .chat-welcome h4 {
        color: #495057;
        margin-bottom: 8px;
        font-weight: 600;
      }
      
      /* Typing Indicator */
      .typing-indicator {
        display: flex;
        align-items: center;
        padding: 12px 18px;
        background: #fff;
        border-radius: 20px;
        margin-bottom: 16px;
        box-shadow: 0 2px 8px rgba(0,0,0,.08);
        border-bottom-left-radius: 6px;
      }
      
      .typing-dots {
        display: flex;
        gap: 4px;
      }
      
      .typing-dots span {
        width: 8px;
        height: 8px;
        background: #6c757d;
        border-radius: 50%;
        animation: typing 1.4s infinite;
      }
      
      .typing-dots span:nth-child(2) { animation-delay: 0.2s; }
      .typing-dots span:nth-child(3) { animation-delay: 0.4s; }
      
      @keyframes typing {
        0%, 60%, 100% { transform: translateY(0); opacity: 0.4; }
        30% { transform: translateY(-10px); opacity: 1; }
      }
      
      @keyframes flash {
        0% { opacity: 0; }
        50% { opacity: 1; }
        100% { opacity: 0; }
      }
      
      @keyframes newMessage {
        0% { transform: translateX(-10px); opacity: 0; }
        100% { transform: translateX(0); opacity: 1; }
      }
      
      .chat-message.new {
        animation: newMessage 0.4s ease;
      }
      
      /* Unread Badge */
      .chat-unread-badge {
        position: absolute;
        top: -8px;
        right: -8px;
        background: #dc3545;
        color: white;
        border-radius: 50%;
        min-width: 20px;
        height: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 11px;
        font-weight: 600;
        border: 2px solid white;
        box-shadow: 0 2px 8px rgba(220, 53, 69, 0.3);
        animation: pulse 2s infinite, bounceIn 0.5s ease;
      }
      
      @keyframes bounceIn {
        0% { transform: scale(0); opacity: 0; }
        60% { transform: scale(1.3); opacity: 1; }
        100% { transform: scale(1); opacity: 1; }
      }
      
      @keyframes fastPulse {
        0% { box-shadow: 0 0 0 0 rgba(220, 53, 69, 0.8); }
        50% { box-shadow: 0 0 0 8px rgba(220, 53, 69, 0); }
        100% { box-shadow: 0 0 0 0 rgba(220, 53, 69, 0); }
      }
      
      #chat-button {
        position: relative;
      }
      
      /* Responsive */
      @media (max-width: 768px) {
        #chat-widget {
          right: 15px;
          bottom: 15px;
        }
        
        #chat-box {
          right: 15px;
          bottom: 85px;
          width: calc(100vw - 30px);
          max-width: 350px;
        }
        
        #chat-button {
          width: 56px;
          height: 56px;
          font-size: 20px;
        }
      }
    </style>

    <div id="chat-widget">
      <button id="chat-button">
        💬
        <span id="chat-unread-count" class="chat-unread-badge" style="display: none;">0</span>
      </button>
    </div>

    <div id="chat-box">
      <div id="chat-header">
        <div style="display: flex; align-items: center;">
          <div class="logo">
            <img src="{{asset('public/admin/images/logo.png')}}" alt="Logo" style="width: 20px; height: 20px;">
          </div>
          <div>
            <div style="font-weight: 600;">Tư vấn khách hàng</div>
            <div style="font-size: 12px; opacity: 0.8;" id="chat-status">Chúng tôi thường phản hồi ngay</div>
          </div>
        </div>
        <button id="chat-close">✖</button>
      </div>
      <div id="chat-messages"></div>
      <div id="chat-input">
        <input id="chat-text" type="text" placeholder="Nhập tin nhắn..." maxlength="1000" />
        <button id="chat-send" disabled>
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none">
            <path d="M2 21L23 12L2 3V10L17 12L2 14V21Z" fill="currentColor"/>
          </svg>
        </button>
      </div>
      <input type="hidden" id="chat-thread-id" />
      <input type="hidden" id="chat-guest-token" />
      <input type="hidden" id="chat-customer-id" value="{{ Session::get('idCustomer') }}" />
      <input type="hidden" id="chat-opened" value="0" />
      <input type="hidden" id="csrf" value="{{ csrf_token() }}" />
      <input type="hidden" id="apiBase" value="{{ url('api') }}" />
      <input type="hidden" id="assetBase" value="{{ url('/') }}" />
      
    </div>

    <script>
      (function(){
        const btn = document.getElementById('chat-button');
        const box = document.getElementById('chat-box');
        const closeBtn = document.getElementById('chat-close');
        const sendBtn = document.getElementById('chat-send');
        const messagesDiv = document.getElementById('chat-messages');
        const statusDiv = document.getElementById('chat-status');
        const apiBase = document.getElementById('apiBase').value;
        const csrf = document.getElementById('csrf').value;
        let customerId = document.getElementById('chat-customer-id').value || (document.getElementById('idCustomer') ? document.getElementById('idCustomer').value : null) || null;
        const textInput = document.getElementById('chat-text');
        const threadInput = document.getElementById('chat-thread-id');
        const tokenInput = document.getElementById('chat-guest-token');
        const opened = document.getElementById('chat-opened');
        
        let lastMessageCount = 0;
        let lastMessageId = 0;
        let isTyping = false;
        let typingTimeout = null;
        let refreshInterval = null;
        let fastPollInterval = null;
        let messageCache = [];
        let isConnected = false;
        let unreadCount = 0;
        let chatIsOpen = false;
        const unreadBadge = document.getElementById('chat-unread-count');

        // Restore guest token if exists
        try {
          const savedToken = localStorage.getItem('guest_token');
          if (savedToken && !tokenInput.value) tokenInput.value = savedToken;
        } catch (e) {}

        // Enable/disable send button based on input
        textInput.addEventListener('input', function() {
          const hasText = this.value.trim().length > 0;
          sendBtn.disabled = !hasText;
          sendBtn.style.opacity = hasText ? '1' : '0.6';
        });

        // Enter to send
        textInput.addEventListener('keypress', function(e) {
          if (e.key === 'Enter' && !e.shiftKey && this.value.trim()) {
            e.preventDefault();
            sendMessage();
          }
        });

        // Update unread badge with debug logging
        function updateUnreadBadge(count) {
          console.log('updateUnreadBadge called with count:', count, 'chatIsOpen:', chatIsOpen);
          
          const wasVisible = unreadBadge.style.display !== 'none';
          const countChanged = unreadCount !== count;
          
          unreadCount = count;
          if (count > 0 && !chatIsOpen) {
            console.log('Showing badge with count:', count);
            unreadBadge.textContent = count > 99 ? '99+' : count;
            unreadBadge.style.display = 'flex';
            
            if (!wasVisible) {
              // First time showing - use bounce animation
              unreadBadge.style.animation = 'fastPulse 1s infinite, bounceIn 0.3s ease';
              console.log('Badge shown for first time');
            } else if (countChanged) {
              // Count changed - quick flash
              unreadBadge.style.animation = 'fastPulse 1s infinite, bounceIn 0.2s ease';
              console.log('Badge count changed');
            } else {
              // Normal pulse
              unreadBadge.style.animation = 'fastPulse 1s infinite';
              console.log('Badge normal pulse');
            }
          } else {
            console.log('Hiding badge - count:', count, 'chatIsOpen:', chatIsOpen);
            unreadBadge.style.display = 'none';
          }
        }
        
        // Clear unread badge
        function clearUnreadBadge() {
          console.log('Clearing unread badge');
          unreadCount = 0;
          unreadBadge.style.display = 'none';
        }
        
        // Test function to force show badge (for debugging)
        function testBadge() {
          console.log('Testing badge...');
          updateUnreadBadge(5); // Force show with count 5
        }
        
        // Make test function global for console access
        window.testBadge = testBadge;
        window.getUnreadCount = getUnreadCount;
        
        function showBox(){ 
          box.style.display = 'block';
          chatIsOpen = true;
          clearUnreadBadge(); // Clear badge when opening chat
          textInput.focus();
        }
        
        function hideBox(){ 
          box.style.display = 'none';
          chatIsOpen = false;
          if (refreshInterval) {
            clearInterval(refreshInterval);
            refreshInterval = null;
          }
        }
        
        function showTyping() {
          if (isTyping) return;
          isTyping = true;
          
          const typingDiv = document.createElement('div');
          typingDiv.className = 'typing-indicator';
          typingDiv.id = 'typing-indicator';
          typingDiv.innerHTML = `
            <div class="typing-dots">
              <span></span>
              <span></span>
              <span></span>
            </div>
            <span style="margin-left: 8px; font-size: 12px; color: #6c757d;">Admin đang soạn tin...</span>
          `;
          
          messagesDiv.appendChild(typingDiv);
          messagesDiv.scrollTop = messagesDiv.scrollHeight;
        }
        
        function hideTyping() {
          const typingDiv = document.getElementById('typing-indicator');
          if (typingDiv) {
            typingDiv.remove();
          }
          isTyping = false;
        }
        
        // Create message element (reusable function)
        function createMessageElement(from, content, timestamp = null) {
          const messageDiv = document.createElement('div');
          messageDiv.className = `chat-message ${from}`;
          
          const avatar = document.createElement('div');
          avatar.className = `chat-avatar ${from}`;
          
          if (from === 'admin') {
            avatar.innerHTML = '<img src="{{asset("public/admin/images/logo.png")}}" alt="Admin">';
          } else {
            avatar.textContent = customerId ? 'B' : 'G';
          }
          
          const contentDiv = document.createElement('div');
          contentDiv.className = 'chat-content';
          
          const bubble = document.createElement('div');
          bubble.className = `chat-bubble ${from}`;
          bubble.textContent = content;
          
          const timeDiv = document.createElement('div');
          timeDiv.className = 'chat-time';
          timeDiv.textContent = timestamp || new Date().toLocaleTimeString('vi-VN', {hour: '2-digit', minute: '2-digit'});
          
          contentDiv.appendChild(bubble);
          contentDiv.appendChild(timeDiv);
          
          if (from === 'admin') {
            messageDiv.appendChild(avatar);
            messageDiv.appendChild(contentDiv);
          } else {
            messageDiv.appendChild(contentDiv);
            messageDiv.appendChild(avatar);
          }
          
          return messageDiv;
        }
        
        function appendMessage(from, content, timestamp = null){
          hideTyping();
          const messageElement = createMessageElement(from, content, timestamp);
          messagesDiv.appendChild(messageElement);
          messagesDiv.scrollTop = messagesDiv.scrollHeight;
        }
        
        // Show notification for new messages
        function showNewMessageNotification() {
          // Visual flash effect
          const flash = document.createElement('div');
          flash.style.cssText = `
            position: absolute;
            top: 0; left: 0; right: 0; bottom: 0;
            background: rgba(102, 126, 234, 0.1);
            pointer-events: none;
            animation: flash 0.5s ease;
          `;
          messagesDiv.style.position = 'relative';
          messagesDiv.appendChild(flash);
          
          setTimeout(() => flash.remove(), 500);
          
          // Play sound if possible
          try {
            const audio = new Audio('data:audio/wav;base64,UklGRnoGAABXQVZFZm10IBAAAAABAAEAQB8AAEAfAAABAAgAZGF0YQoGAACBhYqFbF1fdJivrJBhNjVgodDbq2EcBj+a2/LDciUFLIHO8tiJNwgZaLvt559NEAxQp+PwtmMcBjiR1/LMeSwFJHfH8N2QQAoUXrTp66hVFApGn+DyvmEfCjiR2e/NeSsFJXjI7+CQQAoUXrTp66hVFApGn+DyvmEfCjiS2e/Nep');
            audio.volume = 0.3;
            audio.play().catch(() => {});
          } catch(e) {}
        }

        function openThread(autoMessage){
          if (threadInput.value) { return Promise.resolve(); }
          return fetch(apiBase + '/chat/open', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': csrf },
            body: JSON.stringify({ customer_id: customerId ? parseInt(customerId) : null, guest_token: tokenInput.value || null })
          }).then(r=>r.json()).then(data=>{
            threadInput.value = data.thread_id;
            if (data.guest_token) {
              tokenInput.value = data.guest_token;
              try { localStorage.setItem('guest_token', data.guest_token); } catch (e) {}
            }
            refreshMessages();
          }).catch(error => {
            console.error('Error opening thread:', error);
            // Show welcome message on error
            messagesDiv.innerHTML = '';
            const welcomeDiv = document.createElement('div');
            welcomeDiv.className = 'chat-welcome';
            welcomeDiv.innerHTML = '<div class="chat-welcome-icon">💬</div><div>Chào mừng bạn đến với EricShop!<br>Hãy để lại tin nhắn, chúng tôi sẽ phản hồi sớm nhất.</div>';
            messagesDiv.appendChild(welcomeDiv);
          });
        }

        // Fast polling for new messages only
        function checkNewMessages() {
          const id = threadInput.value; if (!id) return;
          
          const url = lastMessageId > 0 
            ? `${apiBase}/chat/${id}/messages?since=${lastMessageId}`
            : `${apiBase}/chat/${id}/messages`;
            
          fetch(url)
            .then(r => {
              if (!r.ok) throw new Error('Network error');
              return r.json();
            })
            .then(data => {
              if (!isConnected) {
                isConnected = true;
                statusDiv.textContent = 'Trực tuyến';
              }
              
              if (data.messages && data.messages.length > 0) {
                let hasNewMessages = false;
                
                data.messages.forEach(m => {
                  // Check if message already exists in cache (including temp messages)
                  const existsInCache = messageCache.find(cached => 
                    cached.id === m.id || 
                    (cached.temp && cached.message === m.message && Math.abs(new Date(cached.created_at) - new Date(m.created_at)) < 5000)
                  );
                  
                  // Check if message already exists in DOM
                  const existsInDOM = messagesDiv.querySelector(`[data-message-id="${m.id}"]`);
                  
                  if (!existsInCache && !existsInDOM) {
                    messageCache.push(m);
                    hasNewMessages = true;
                    
                    const timestamp = m.created_at ? 
                      new Date(m.created_at).toLocaleTimeString('vi-VN', {hour: '2-digit', minute: '2-digit'}) : null;
                    
                    // Add message with animation
                    const messageElement = createMessageElement(m.sender_admin_id ? 'admin' : 'user', m.message, timestamp);
                    messageElement.classList.add('new');
                    messageElement.setAttribute('data-message-id', m.id);
                    messagesDiv.appendChild(messageElement);
                    
                    // Remove animation class after animation completes
                    setTimeout(() => messageElement.classList.remove('new'), 400);
                    
                    // Update last message ID
                    if (m.id > lastMessageId) {
                      lastMessageId = m.id;
                    }
                    
                    // Show notification for admin messages
                    if (m.sender_admin_id) {
                      if (chatIsOpen) {
                        showNewMessageNotification();
                      } else {
                        // Immediate increment unread count for admin messages when chat is closed
                        const newCount = unreadCount + 1;
                        updateUnreadBadge(newCount);
                        showNewMessageNotification();
                        
                        // Also trigger chat button animation
                        btn.style.animation = 'none';
                        btn.offsetHeight; // Trigger reflow
                        btn.style.animation = 'pulse 2s infinite, bounceIn 0.3s ease';
                      }
                    }
                  } else if (existsInCache && existsInCache.temp) {
                    // Replace temp message with real message
                    const tempIndex = messageCache.findIndex(cached => cached.id === existsInCache.id);
                    if (tempIndex !== -1) {
                      messageCache[tempIndex] = m; // Replace with real message
                      
                      // Update DOM element
                      const tempElement = messagesDiv.querySelector(`[data-temp-id="${existsInCache.id}"]`);
                      if (tempElement) {
                        tempElement.removeAttribute('data-temp-id');
                        tempElement.setAttribute('data-message-id', m.id);
                      }
                      
                      // Update last message ID
                      if (m.id > lastMessageId) {
                        lastMessageId = m.id;
                      }
                    }
                  }
                });
                
                if (hasNewMessages) {
                  // Smooth scroll to bottom
                  messagesDiv.scrollTo({
                    top: messagesDiv.scrollHeight,
                    behavior: 'smooth'
                  });
                  
                  // Update message count
                  lastMessageCount = messageCache.length;
                }
              }
            })
            .catch(error => {
              console.error('Error checking new messages:', error);
              if (isConnected) {
                isConnected = false;
                statusDiv.textContent = 'Mất kết nối';
              }
            });
        }
        
        // Get unread count from server
        function getUnreadCount() {
          const id = threadInput.value; 
          if (!id) {
            console.log('No thread ID, skipping unread count check');
            return;
          }
          if (chatIsOpen) {
            console.log('Chat is open, skipping unread count check');
            return;
          }
          
          console.log('Fetching unread count for thread:', id);
          fetch(apiBase + '/chat/' + id + '/unread-count')
            .then(r => {
              console.log('Unread count response status:', r.status);
              return r.json();
            })
            .then(data => {
              console.log('Unread count data:', data);
              if (data.unread_count !== undefined) {
                console.log('Updating badge with count:', data.unread_count);
                updateUnreadBadge(data.unread_count);
              }
            })
            .catch(error => {
              console.error('Error getting unread count:', error);
            });
        }
        
        // Full refresh for initial load
        function refreshMessages(){
          const id = threadInput.value; if (!id) return;
          
          statusDiv.textContent = 'Đang tải...';
          
          fetch(apiBase + '/chat/' + id + '/messages')
            .then(r => {
              if (!r.ok) throw new Error('Network error');
              return r.json();
            })
            .then(data => {
              isConnected = true;
              statusDiv.textContent = 'Trực tuyến';
              
              if (data.messages) {
                // Clear and rebuild cache
                messageCache = data.messages;
                lastMessageCount = data.messages.length;
                
                // Find highest message ID
                lastMessageId = data.messages.length > 0 
                  ? Math.max(...data.messages.map(m => m.id || 0))
                  : 0;
                
                // Clear and rebuild UI
              messagesDiv.innerHTML = '';
                
                if (data.messages.length > 0) {
                  data.messages.forEach(m => {
                    const timestamp = m.created_at ? 
                      new Date(m.created_at).toLocaleTimeString('vi-VN', {hour: '2-digit', minute: '2-digit'}) : null;
                    const messageElement = createMessageElement(m.sender_admin_id ? 'admin' : 'user', m.message, timestamp);
                    messagesDiv.appendChild(messageElement);
                });
              } else {
                  showWelcomeMessage();
                }
                
                // Scroll to bottom
                messagesDiv.scrollTop = messagesDiv.scrollHeight;
                
                // Get unread count if chat is closed
                if (!chatIsOpen) {
                  getUnreadCount();
                }
              }
            })
            .catch(error => {
              console.error('Error fetching messages:', error);
              isConnected = false;
              statusDiv.textContent = 'Lỗi kết nối';
              if (messagesDiv.children.length === 0) {
                showWelcomeMessage();
              }
            });
        }
        
        function showWelcomeMessage() {
              const welcomeDiv = document.createElement('div');
              welcomeDiv.className = 'chat-welcome';
          welcomeDiv.innerHTML = `
            <div class="chat-welcome-icon">💬</div>
            <h4>Chào mừng bạn đến với EricShop!</h4>
            <div>Hãy để lại tin nhắn, chúng tôi sẽ phản hồi sớm nhất có thể.</div>
          `;
              messagesDiv.appendChild(welcomeDiv);
        }

        function sendMessage(){
          const id = threadInput.value; if (!id) return;
          const msg = textInput.value.trim(); if (!msg) return;
          
          // Disable send button temporarily
          sendBtn.disabled = true;
          sendBtn.style.opacity = '0.6';
          
          // Create temporary unique ID for optimistic message
          const tempId = 'temp_' + Date.now() + '_' + Math.random().toString(36).substr(2, 9);
          
          // Add to cache immediately with temp ID to prevent duplicates
          const optimisticMessage = {
            id: tempId,
            message: msg,
            sender_admin_id: null,
            created_at: new Date().toISOString(),
            temp: true // Mark as temporary
          };
          messageCache.push(optimisticMessage);
          
          // Show message immediately (optimistic UI)
          const messageElement = createMessageElement('user', msg);
          messageElement.setAttribute('data-temp-id', tempId);
          messagesDiv.appendChild(messageElement);
          messagesDiv.scrollTop = messagesDiv.scrollHeight;
          
          textInput.value = '';
          statusDiv.textContent = 'Đang gửi...';
          
          fetch(apiBase + '/chat/send', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': csrf },
            body: JSON.stringify({ 
              thread_id: parseInt(id), 
              message: msg, 
              customer_id: customerId ? parseInt(customerId) : null, 
              guest_token: tokenInput.value || null 
            })
          })
          .then(r => {
            if (!r.ok) throw new Error('Send failed');
            return r.json();
          })
          .then(data => {
            statusDiv.textContent = 'Đã gửi';
            
            // Remove temp message from cache
            messageCache = messageCache.filter(m => m.id !== tempId);
            
            // If server returns the message, update cache with real ID
            if (data.message && data.message.id) {
              messageCache.push(data.message);
              lastMessageId = Math.max(lastMessageId, data.message.id);
              
              // Update the DOM element with real ID
              const tempElement = messagesDiv.querySelector(`[data-temp-id="${tempId}"]`);
              if (tempElement) {
                tempElement.removeAttribute('data-temp-id');
                tempElement.setAttribute('data-message-id', data.message.id);
              }
            }
            
            // Show typing indicator after a delay
            setTimeout(() => {
              if (Math.random() > 0.7) { // 30% chance to show typing
                showTyping();
                setTimeout(hideTyping, 2000 + Math.random() * 3000);
              }
            }, 1000);
          })
          .catch(error => {
            console.error('Error sending message:', error);
            statusDiv.textContent = 'Lỗi gửi tin nhắn';
            
            // Remove the optimistic message and from cache
            messageCache = messageCache.filter(m => m.id !== tempId);
            const tempElement = messagesDiv.querySelector(`[data-temp-id="${tempId}"]`);
            if (tempElement) {
              tempElement.remove();
            }
          })
          .finally(() => {
            // Re-enable send button
            sendBtn.disabled = false;
            sendBtn.style.opacity = '1';
            
            setTimeout(() => {
              statusDiv.textContent = 'Trực tuyến';
            }, 2000);
          });
        }

        // Start fast polling system
        function startFastPolling() {
          // Stop existing intervals
          stopPolling();
          
          // Fast polling for new messages every 1 second (balanced)
          fastPollInterval = setInterval(checkNewMessages, 1000);
          
          // Regular refresh every 30 seconds to ensure sync
          refreshInterval = setInterval(refreshMessages, 30000);
          
          console.log('Fast polling started (1s for new messages, 30s full refresh)');
        }
        
        function stopPolling() {
          if (fastPollInterval) {
            clearInterval(fastPollInterval);
            fastPollInterval = null;
          }
          if (refreshInterval) {
            clearInterval(refreshInterval);
            refreshInterval = null;
          }
        }

        if (btn) btn.addEventListener('click', function(){ 
          showBox(); 
          if (opened.value==='0'){ 
            opened.value='1'; 
            openThread(false).then(() => {
              // Initial load then start fast polling
            refreshMessages();
              startFastPolling();
            }); 
          }
        });
        
        if (closeBtn) closeBtn.addEventListener('click', function(){ 
          hideBox(); 
          stopPolling();
          // Start checking unread count when chat is closed
          setTimeout(getUnreadCount, 1000);
        });
        
        if (sendBtn) sendBtn.addEventListener('click', function(){ 
          openThread(false).then(sendMessage); 
        });
        
        // Optimize polling based on visibility
        document.addEventListener('visibilitychange', function() {
          if (document.hidden) {
            // Slower polling when tab is hidden
            stopPolling();
            if (box.style.display === 'block') {
              fastPollInterval = setInterval(checkNewMessages, 2000); // 2 seconds when hidden
            }
          } else {
            // Resume fast polling when tab is visible
            if (box.style.display === 'block') {
              startFastPolling();
            }
          }
        });
        
        // Reconnection logic
        let reconnectAttempts = 0;
        function attemptReconnect() {
          if (reconnectAttempts < 5 && box.style.display === 'block') {
            reconnectAttempts++;
            statusDiv.textContent = `Đang kết nối lại... (${reconnectAttempts}/5)`;
            
            setTimeout(() => {
              checkNewMessages();
              if (!isConnected) {
                attemptReconnect();
              } else {
                reconnectAttempts = 0;
              }
            }, 2000 * reconnectAttempts); // Exponential backoff
          } else {
            statusDiv.textContent = 'Mất kết nối';
          }
        }
        
        // Monitor connection and auto-reconnect
        setInterval(() => {
          if (box.style.display === 'block' && !isConnected && reconnectAttempts === 0) {
            attemptReconnect();
          }
        }, 10000);
        
        // Initial check for unread count when page loads
        setTimeout(() => {
          console.log('Initial unread count check...');
          if (!chatIsOpen && threadInput.value) {
            getUnreadCount();
          } else {
            console.log('Waiting for thread to be opened...');
            // Retry after 3 seconds if no thread yet
            setTimeout(() => {
              if (!chatIsOpen && threadInput.value) {
                console.log('Delayed initial unread count check...');
                getUnreadCount();
              }
            }, 3000);
          }
        }, 1000);

        // Background polling for unread count when chat is closed
        let backgroundPolling = setInterval(() => {
          if (!chatIsOpen && threadInput.value) {
            console.log('Background polling - checking unread count...');
            getUnreadCount();
          }
        }, 8000); // Check every 8 seconds when chat is closed
      })();
    </script>
    <!-- Chat widget end -->

</body>