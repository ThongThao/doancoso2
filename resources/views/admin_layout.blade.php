<?php
  header("Cache-Control: no-cache, must-revalidate");
  header("Pragma: no-cache"); 
  header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); 
  header("Cache-Control: max-age=2592000");
  use Illuminate\Support\Facades\Session;
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <title>Admin</title>
      
      <!-- Morris Chart CSS -->
      <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
      <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
      <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
      <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
      <!-- Favicon -->
      <link rel="shortcut icon" href="{{asset('public/admin/images/favicon.ico')}}" />
      <link rel="stylesheet" href="{{asset('public/admin/css/backend-plugin.min.css')}}">
      <link rel="stylesheet" href="{{asset('public/admin/css/backend.css?v=1.0.0')}}">
      
      <link rel="stylesheet" href="{{asset('public/admin/vendor/@fortawesome/fontawesome-free/css/all.min.css')}}">
      <link rel="stylesheet" href="{{asset('public/admin/vendor/line-awesome/dist/line-awesome/css/line-awesome.min.css')}}">
      <link rel="stylesheet" href="{{asset('public/admin/vendor/remixicon/fonts/remixicon.css')}}">
    </head>
  <body class="  ">
    <!-- loader Start -->
    <div id="loading">
          <div id="loading-center">
          </div>
    </div>
    <!-- loader END -->
    <!-- Wrapper Start -->
    <div class="wrapper">

      
      <div class="iq-sidebar  sidebar-default ">
          <div class="iq-sidebar-logo d-flex align-items-center justify-content-between">
              <a href="{{URL::to('/dashboard')}}" class="header-logo">
              <img src="{{asset('public/admin/images/logo.png')}}" class="img-fluid rounded-normal light-logo" alt="logo">
                  <h5 class="logo-title light-logo ml-2">Admin</h5>
              </a>
              <div class="iq-menu-bt-sidebar ml-0">
                  <i class="las la-bars wrapper-menu" style="cursor:pointer;"></i>
              </div>
          </div>
          <?php
            $position = Session::get('Position');
            
            if($position != 'Nhân Viên'){
          ?>
          <div class="data-scrollbar" data-scroll="1">
              <nav class="iq-sidebar-menu">
                  <ul id="iq-sidebar-toggle" class="iq-menu">
                      <li class="{{ Request::is('dashboard') ? 'active' : '' }}">
                          <a href="{{URL::to('/dashboard')}}" class="svg-icon">                        
                          <svg  class="svg-icon" id="p-dash1" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                  <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path><polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline><line x1="12" y1="22.08" x2="12" y2="12"></line>
                              </svg>
                              <span class="ml-4">Thống Kê Doanh Thu</span>
                          </a>
                      </li>
                      <li class=" ">
                          <a href="#purchase" class="collapsed" data-toggle="collapse" aria-expanded="false">
                          <svg class="svg-icon" id="p-dash5" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="1" y="4" width="22" height="16" rx="2" ry="2"></rect>
                                  <line x1="1" y1="10" x2="23" y2="10"></line>
                              </svg>
                              <span class="ml-4">Quản Lý Đơn Hàng</span>
                             
                          </a>
                          <ul id="purchase" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">
                                <li class="{{ Request::is('list-bill') ? 'active' : '' }}">
                                    <a href="{{URL::to('/list-bill')}}">
                                        <i class="las la-minus"></i><span>Danh Sách Đơn Hàng</span>
                                    </a>
                                </li>
                                <li class="{{ Request::is('waiting-bill') ? 'active' : '' }}">
                                    <a href="{{URL::to('/waiting-bill')}}">
                                        <i class="las la-minus"></i><span>Đơn Chờ Xác Nhận</span>
                                    </a>
                                </li>
                                <li class="{{ Request::is('shipping-bill') ? 'active' : '' }}">
                                    <a href="{{URL::to('/shipping-bill')}}">
                                        <i class="las la-minus"></i><span>Đơn Đang Giao</span>
                                    </a>
                                </li>
                                <li class="{{ Request::is('shipped-bill') ? 'active' : '' }}">
                                    <a href="{{URL::to('/shipped-bill')}}">
                                        <i class="las la-minus"></i><span>Đơn Đã Giao</span>
                                    </a>
                                </li>
                                <li class="{{ Request::is('cancelled-bill') ? 'active' : '' }}">
                                    <a href="{{URL::to('/cancelled-bill')}}">
                                        <i class="las la-minus"></i><span>Đơn Đã Hủy</span>
                                    </a>
                                </li>
                                <li class="{{ Request::is('confirmed-bill') ? 'active' : '' }}">
                                    <a href="{{URL::to('/confirmed-bill')}}">
                                        <i class="las la-minus"></i><span>Đơn Đã Xác Nhận</span>
                                    </a>
                                </li>
                          </ul>
                      </li>
                      <li class=" ">
                          <a href="#product" class="collapsed" data-toggle="collapse" aria-expanded="false">
                          <svg class="svg-icon" id="p-dash2" width="20" height="20"  xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="9" cy="21" r="1"></circle><circle cx="20" cy="21" r="1"></circle>
                                  <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
                              </svg>
                              <span class="ml-4">Quản Lý Sản Phẩm</span>
                              
                          </a>
                          <ul id="product" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">
                              <li class="{{ Request::is('manage-products') ? 'active' : '' }}">
                                  <a href="{{URL::to('/manage-products')}}">
                                      <i class="las la-minus"></i><span>Danh Sách Sản Phẩm</span>
                                  </a>
                              </li>
                              <li class="{{ Request::is('add-product') ? 'active' : '' }}">
                                  <a href="{{URL::to('/add-product')}}">
                                      <i class="las la-minus"></i><span>Thêm Sản Phẩm</span>
                                  </a>
                              </li>
                              <li class="{{ Request::is('manage-attr-value') ? 'active' : '' }}">
                                        <a href="{{URL::to('/manage-attr-value')}}">
                                            <i class="las la-minus"></i><span>Thêm Phân Loại</span>
                                        </a>
                             </li> 
                             <li class="{{ Request::is('manage-sale') ? 'active' : '' }}">
                                        <a href="{{URL::to('/manage-sale')}}">
                                            <i class="las la-minus"></i><span>Khuyến Mãi</span>
                                        </a>
                            </li>                           
                            <li class="{{ Request::is('manage-voucher') ? 'active' : '' }}">
                                        <a href="{{URL::to('/manage-voucher')}}">
                                            <i class="las la-minus"></i><span>Mã Giảm Giá</span>
                                        </a>
                            </li>
                                                      
                    
                          </ul>

                      </li>
                      <li class=" ">
                          <a href="#category" class="collapsed" data-toggle="collapse" aria-expanded="false">
                          <svg class="svg-icon" id="p-dash3" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="9" y="9" width="13" height="13" rx="2" ry="2"></rect>
                                  <path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"></path>
                              </svg>
                              <span class="ml-4">Quản Lý Danh Mục</span>
                             
                          </a>
                          <ul id="category" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">
                                  <li class="{{ Request::is('manage-category') ? 'active' : '' }}">
                                          <a href="{{URL::to('/manage-category')}}">
                                              <i class="las la-minus"></i><span>Danh Sách Danh Mục</span>
                                          </a>
                                  </li>
                                  <li class="{{ Request::is('add-category') ? 'active' : '' }}">
                                          <a href="{{URL::to('/add-category')}}">
                                              <i class="las la-minus"></i><span>Thêm Danh Mục</span>
                                          </a>
                                  </li>
                          </ul>
                      </li>
                      </li><li class=" ">
                          <a href="#brand" class="collapsed" data-toggle="collapse" aria-expanded="false">
                          <svg class="svg-icon" id="p-dash3" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="9" y="9" width="13" height="13" rx="2" ry="2"></rect>
                                  <path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"></path>
                              </svg>
                              <span class="ml-4">Quản Lý Thương Hiệu</span>
                             
                          </a>
                          <ul id="brand" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">
                                  <li class="{{ Request::is('manage-brand') ? 'active' : '' }}">
                                          <a href="{{URL::to('/manage-brand')}}">
                                              <i class="las la-minus"></i><span>Danh Sách Thương Hiệu</span>
                                          </a>
                                  </li>
                                  <li class="{{ Request::is('add-brand') ? 'active' : '' }}">
                                          <a href="{{URL::to('/add-brand')}}">
                                              <i class="las la-minus"></i><span>Thêm Thương Hiệu</span>
                                          </a>
                                  </li>
                          </ul>
                      </li>
                      <li class=" ">
                          <a href="#people" class="collapsed" data-toggle="collapse" aria-expanded="false">
                          <svg class="svg-icon" id="p-dash8" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                  <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                              </svg>
                              <span class="ml-4">Quản Lý Người Dùng</span>
                              
                          </a>
                          <ul id="people" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">
                                  <li class="{{ Request::is('manage-customers') ? 'active' : '' }}">
                                          <a href="{{URL::to('/manage-customers')}}">
                                              <i class="las la-minus"></i><span>Danh Sách Tài Khoản Khách Hàng</span>
                                          </a>
                                  </li>
                                  <li class="{{ Request::is('manage-staffs') ? 'active' : '' }}">
                                          <a href="{{URL::to('/manage-staffs')}}">
                                              <i class="las la-minus"></i><span>Danh Sách Nhân Viên</span>
                                          </a>
                                  </li>
                                  <li class="{{ Request::is('add-staffs') ? 'active' : '' }}">
                                          <a href="{{URL::to('/add-staffs')}}">
                                              <i class="las la-minus"></i><span>Thêm Nhân Viên</span>
                                          </a>
                                  </li>
                          </ul>
                      </li>
                      <li class=" ">
                          <a href="#myaccount" class="collapsed" data-toggle="collapse" aria-expanded="false">
                          <svg class="svg-icon" id="p-dash8" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                  <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                              </svg>
                              <span class="ml-4">Quản Lý Tài Khoản</span>
                              
                          </a>
                          <ul id="myaccount" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">
                                  <li class="{{ Request::is('my-adprofile') ? 'active' : '' }}">
                                          <a href="{{URL::to('/my-adprofile')}}">
                                              <i class="las la-minus"></i><span>Hồ Sơ Của Tôi</span>
                                          </a>
                                  </li>
                                  <li class="{{ Request::is('edit-adprofile') ? 'active' : '' }}">
                                          <a href="{{URL::to('/edit-adprofile')}}">
                                              <i class="las la-minus"></i><span>Sửa Hồ Sơ</span>
                                          </a>
                                  </li>
                                  <li class="{{ Request::is('change-adpassword') ? 'active' : '' }}">
                                          <a href="{{URL::to('/change-adpassword')}}">
                                              <i class="las la-minus"></i><span>Đổi Mật Khẩu</span>
                                          </a>
                                  </li>
                          </ul>
                      </li>
                      
                                  <li class=" ">
                          <a href="#otherpage" class="collapsed" data-toggle="collapse" aria-expanded="false">
                          <svg class="svg-icon" id="p-dash8" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                  <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                              </svg>
                              <span class="ml-4">Quản Lý Tin Tức</span>
                             
                          </a>
                          <ul id="otherpage" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">
                                <li class="{{ Request::is('manage-blog') ? 'active' : '' }}">
                                    <a href="{{URL::to('/manage-blog')}}">
                                        <i class="las la-minus"></i><span>Danh sách tin tức</span>
                                    </a>
                                </li>
                                <li class="{{ Request::is('add-blog') ? 'active' : '' }}">
                                    <a href="{{URL::to('/add-blog')}}">
                                        <i class="las la-minus"></i><span>Thêm tin tức</span>
                                    </a>
                                </li>

                          </ul>
                      </li>
                               
                  </ul>
              </nav>

              <div class="p-3"></div>
          </div>
          <?php
            }else{
          ?>
          <div class="data-scrollbar" data-scroll="1">
              <nav class="iq-sidebar-menu">
                  <ul id="iq-sidebar-toggle" class="iq-menu">
                      <li class=" ">
                          <a href="#purchase" class="collapsed" data-toggle="collapse" aria-expanded="false">
                          <svg class="svg-icon" id="p-dash5" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="1" y="4" width="22" height="16" rx="2" ry="2"></rect>
                                  <line x1="1" y1="10" x2="23" y2="10"></line>
                              </svg>
                              <span class="ml-4">Quản Lý Đơn Hàng</span>
                          </a>
                          <ul id="purchase" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">
                                <li class="{{ Request::is('list-bill') ? 'active' : '' }}">
                                    <a href="{{URL::to('/list-bill')}}">
                                        <i class="las la-minus"></i><span>Danh Sách Đơn Hàng</span>
                                    </a>
                                </li>
                                <li class="{{ Request::is('waiting-bill') ? 'active' : '' }}">
                                    <a href="{{URL::to('/waiting-bill')}}">
                                        <i class="las la-minus"></i><span>Đơn Chờ Xác Nhận</span>
                                    </a>
                                </li>
                                <li class="{{ Request::is('shipping-bill') ? 'active' : '' }}">
                                    <a href="{{URL::to('/shipping-bill')}}">
                                        <i class="las la-minus"></i><span>Đơn Đang Giao</span>
                                    </a>
                                </li>
                                <li class="{{ Request::is('shipped-bill') ? 'active' : '' }}">
                                    <a href="{{URL::to('/shipped-bill')}}">
                                        <i class="las la-minus"></i><span>Đơn Đã Giao</span>
                                    </a>
                                </li>
                                <li class="{{ Request::is('cancelled-bill') ? 'active' : '' }}">
                                    <a href="{{URL::to('/cancelled-bill')}}">
                                        <i class="las la-minus"></i><span>Đơn Đã Hủy</span>
                                    </a>
                                </li>
                                <li class="{{ Request::is('confirmed-bill') ? 'active' : '' }}">
                                    <a href="{{URL::to('/confirmed-bill')}}">
                                        <i class="las la-minus"></i><span>Đơn Đã Xác Nhận</span>
                                    </a>
                                </li>
                          </ul>
                      </li>
                      <li class=" ">
                          <a href="#myaccount" class="collapsed" data-toggle="collapse" aria-expanded="false">
                          <svg class="svg-icon" id="p-dash8" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                  <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                              </svg>
                              <span class="ml-4">Quản Lý Tài Khoản</span>
                              
                          </a>
                          <ul id="myaccount" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">
                                  <li class="{{ Request::is('my-adprofile') ? 'active' : '' }}">
                                          <a href="{{URL::to('/my-adprofile')}}">
                                              <i class="las la-minus"></i><span>Hồ Sơ Của Tôi</span>
                                          </a>
                                  </li>
                                  <li class="{{ Request::is('edit-adprofile') ? 'active' : '' }}">
                                          <a href="{{URL::to('/edit-adprofile')}}">
                                              <i class="las la-minus"></i><span>Sửa Hồ Sơ</span>
                                          </a>
                                  </li>
                                  <li class="{{ Request::is('change-adpassword') ? 'active' : '' }}">
                                          <a href="{{URL::to('/change-adpassword')}}">
                                              <i class="las la-minus"></i><span>Đổi Mật Khẩu</span>
                                          </a>
                                  </li>
                          </ul>
                      </li>
                      <li class=" ">
                          <a href="#otherpage" class="collapsed" data-toggle="collapse" aria-expanded="false">
                          <svg class="svg-icon" id="p-dash8" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                  <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                              </svg>
                              <span class="ml-4">Quản Lý Tin Tức</span>
                             
                          </a>
                          <ul id="otherpage" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">
                                <li class="{{ Request::is('manage-blog') ? 'active' : '' }}">
                                    <a href="{{URL::to('/manage-blog')}}">
                                        <i class="las la-minus"></i><span>Danh sách tin tức</span>
                                    </a>
                                </li>
                                <li class="{{ Request::is('add-blog') ? 'active' : '' }}"> 
                                    <a href="{{URL::to('/add-blog')}}">
                                        <i class="las la-minus"></i><span>Thêm tin tức</span>
                                    </a>
                                </li>
                          </ul>
                      </li>
                  </ul>
              </nav>
              <div class="p-3"></div>
          </div>
          <?php
            }
          ?>
          </div>      <div class="iq-top-navbar">
          <div class="iq-navbar-custom">
              <nav class="navbar navbar-expand-lg navbar-light p-0">
                  <div class="iq-navbar-logo d-flex align-items-center justify-content-between">
                      <i class="ri-menu-line wrapper-menu"></i>
                      <a href="{{URL::to('/dashboard')}}" class="header-logo">
                          <img src="{{asset('public/admin/images/logo.png')}}" class="img-fluid rounded-normal" alt="logo">
                          <h5 class="logo-title ml-3">Dashboard</h5>
      
                      </a>
                  </div>
                  <div class="iq-search-bar device-search">
                      <form action="#" class="searchbox">
                          <a class="search-link" href="#"><i class="ri-search-line"></i></a>
                          <input type="text" class="text search-input" placeholder="Search here...">
                      </form>
                  </div>
                  <div class="d-flex align-items-center">
                      <button class="navbar-toggler" type="button" data-toggle="collapse"
                          data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                          aria-label="Toggle navigation">
                          <i class="ri-menu-3-line"></i>
                      </button>
                      <div class="collapse navbar-collapse" id="navbarSupportedContent">
                          <ul class="navbar-nav ml-auto navbar-list align-items-center">
                              
                              <li class="nav-item nav-icon search-content">
                                  <a href="#" class="search-toggle rounded" id="dropdownSearch" data-toggle="dropdown"
                                      aria-haspopup="true" aria-expanded="false">
                                      <i class="ri-search-line"></i>
                                  </a>
                                  <div class="iq-search-bar iq-sub-dropdown dropdown-menu" aria-labelledby="dropdownSearch">
                                      <form action="#" class="searchbox p-2">
                                          <div class="form-group mb-0 position-relative">
                                              <input type="text" class="text search-input font-size-12"
                                                  placeholder="type here to search...">
                                              <a href="#" class="search-link"><i class="las la-search"></i></a>
                                          </div>
                                      </form>
                                  </div>
                              </li>
                              <li class="nav-item nav-icon">
                                  <a href="{{URL::to('/admin/chat')}}" class="search-toggle position-relative" title="Hộp thoại tư vấn" onclick="clearChatBadge()">
                                      <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                                          fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                          stroke-linejoin="round" class="feather feather-mail">
                                          <path
                                              d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z">
                                          </path>
                                          <polyline points="22,6 12,13 2,6"></polyline>
                                      </svg>
                                      <span id="chat-unread-badge" class="badge badge-danger position-absolute" style="top: 8px; right: -8px; min-width: 18px; height: 18px; font-size: 10px; display: none; line-height: 18px; border-radius: 50%; padding: 0; animation: pulse 2s infinite;">0</span>
                                  </a>
                              </li>
                              <li class="nav-item nav-icon dropdown">
                                  <a href="#" class="search-toggle dropdown-toggle" id="dropdownMenuButton"
                                      data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                      <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                                          fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                          stroke-linejoin="round" class="feather feather-bell">
                                          <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path>
                                          <path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
                                      </svg>
                                      <span class="bg-primary "></span>
                                  </a>
                              </li>
                
                              <li class="nav-item nav-icon dropdown caption-content">
                                  <a href="#" class="search-toggle dropdown-toggle" id="dropdownMenuButton4"
                                      data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                       
                                        <img src="{{asset('public/storage/admin/images/user/'.Session::get('Avatar'))}}" class="img-fluid rounded" alt="user">
                                       
                                  </a>
                                  <div class="iq-sub-dropdown dropdown-menu" aria-labelledby="dropdownMenuButton">
                                      <div class="card shadow-none m-0">
                                          <div class="card-body p-0 text-center">
                                              <div class="media-body profile-detail text-center">
                                                  <img src="{{asset('public/admin/images/page-img/profile-bg.jpg')}}" alt="profile-bg"
                                                      class="rounded-top img-fluid mb-4">
                                                 
                                                  <img src="{{asset('public/storage/admin/images/user/'.Session::get('Avatar'))}}" alt="profile-img"
                                                      class="rounded profile-img img-fluid avatar-70">
                                                  
                                              </div>
                                              <div class="p-3">
                                                  <h5 class="mb-1"><?php echo Session::get('AdminName'); ?></h5>
                                                  <p class="mb-0">(<?php echo Session::get('AdminUser'); ?>)</p>
                                                  <div class="d-flex align-items-center justify-content-center mt-3">
                                                        <a href="{{URL::to('/my-adprofile')}}" class="btn border mr-2">Profile</a>
                                                        <a href="{{URL::to('/admin-logout')}}" class="btn border">Đăng Xuất</a>
                                                  </div>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                              </li>
                          </ul>
                      </div>
                  </div>
              </nav>
          </div>
      </div>

      @yield('content_dash')

    </div>
    <!-- Wrapper End-->

<!-- Backend Bundle JavaScript -->
<script src="{{asset('public/admin/js/backend-bundle.min.js')}}"></script>

<!-- Table Treeview JavaScript -->
<script src="{{asset('public/admin/js/table-treeview.js')}}"></script>

<!-- Chart Custom JavaScript -->
<script src="{{asset('public/admin/js/customizer.js')}}"></script>

<!-- Chart Custom JavaScript -->
<script async src="{{asset('public/admin/js/chart-custom.js')}}"></script>

<!-- app JavaScript -->
<script src="{{asset('public/admin/js/app.js')}}"></script>

<script src="{{asset('public/admin/js/ckeditor/ckeditor.js')}}"></script>

<link rel="stylesheet" type="text/css" href="{{asset('public/admin/datetimepicker-master/jquery.datetimepicker.css')}}">
<script src="{{asset('public/admin/datetimepicker-master/jquery.js')}}"></script>
<script src="{{asset('public/admin/datetimepicker-master/build/jquery.datetimepicker.full.min.js')}}"></script>
<script src="{{asset('public/admin/js/moment.js')}}"></script>
<script src="{{asset('public/admin/js/form-validate.js')}}"></script>

<script type="text/javascript">
    function ChangeToSlug()
        {
            var slug;
         //fffffff
            //Lấy text từ thẻ input title 
            slug = $('.slug').val();
            slug = slug.toLowerCase();
            //Đổi ký tự có dấu thành không dấu
                slug = slug.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a');
                slug = slug.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e');
                slug = slug.replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i');
                slug = slug.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o');
                slug = slug.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u');
                slug = slug.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y');
                slug = slug.replace(/đ/gi, 'd');
                //Xóa các ký tự đặt biệt
                slug = slug.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi, '');
                //Đổi khoảng trắng thành ký tự gạch ngang
                slug = slug.replace(/ /gi, "-");
                //Đổi nhiều ký tự gạch ngang liên tiếp thành 1 ký tự gạch ngang
                //Phòng trường hợp người nhập vào quá nhiều ký tự trắng
                slug = slug.replace(/\-\-\-\-\-/gi, '-');
                slug = slug.replace(/\-\-\-\-/gi, '-');
                slug = slug.replace(/\-\-\-/gi, '-');
                slug = slug.replace(/\-\-/gi, '-');
                //Xóa các ký tự gạch ngang ở đầu và cuối
                slug = '@' + slug + '@';
                slug = slug.replace(/\@\-|\-\@|\@/gi, '');
                //In slug ra textbox có id “slug”
            $('#convert_slug').val(slug);
        }

// Global variables for auto-update
let lastUnreadCount = 0;
let chatBadgeUpdateInterval = null;

// Global Chat Unread Count Update with change detection
function updateChatUnreadBadge() {
    fetch('{{ url('admin/api/chat/unread-count') }}')
        .then(r => r.json())
        .then(data => {
            const badge = document.getElementById('chat-unread-badge');
            if (badge) {
                const count = data.unread_count || 0;
                
                // Detect changes and show notification
                if (count > lastUnreadCount && lastUnreadCount > 0) {
                    showNewChatNotification(count - lastUnreadCount);
                }
                lastUnreadCount = count;
                
                if (count > 0) {
                    badge.textContent = count > 99 ? '99+' : count;
                    badge.style.display = 'inline-block';
                    
                    // Add flash effect for new messages
                    badge.style.animation = 'none';
                    badge.offsetHeight; // Trigger reflow
                    badge.style.animation = 'pulse 2s infinite, flash 0.5s ease-in-out';
                } else {
                    badge.style.display = 'none';
                    badge.style.animation = 'pulse 2s infinite';
                }
            }
        })
        .catch(error => {
            console.error('Error updating chat badge:', error);
        });
}

// Show notification for new chat messages
function showNewChatNotification(newCount) {
    // Browser notification
    if (Notification.permission === 'granted') {
        new Notification(`${newCount} tin nhắn mới`, {
            body: 'Bạn có tin nhắn mới từ khách hàng',
            icon: '{{ asset("admin/images/chat-icon.png") }}',
            tag: 'new-chat-messages'
        });
    }
    
    // Toast notification
    showChatToast(`Có ${newCount} tin nhắn mới`, 'Bạn có tin nhắn mới từ khách hàng');
}

// Show toast notification
function showChatToast(title, message) {
    const toast = document.createElement('div');
    toast.style.cssText = `
        position: fixed;
        top: 20px;
        right: 20px;
        background: #28a745;
        color: white;
        padding: 15px 20px;
        border-radius: 8px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        z-index: 9999;
        font-size: 14px;
        max-width: 300px;
        animation: slideInRight 0.3s ease;
    `;
    
    toast.innerHTML = `
        <div style="font-weight: 600; margin-bottom: 5px;">${title}</div>
        <div style="font-size: 12px; opacity: 0.9;">${message}</div>
    `;
    
    document.body.appendChild(toast);
    
    // Auto remove after 3 seconds
    setTimeout(() => {
        if (toast.parentNode) {
            toast.style.animation = 'slideOutRight 0.3s ease';
            setTimeout(() => toast.remove(), 300);
        }
    }, 3000);
}

// Clear badge when clicking chat icon
function clearChatBadge() {
    const badge = document.getElementById('chat-unread-badge');
    if (badge) {
        badge.style.display = 'none';
    }
}

// Expose to global scope so chat page can access it
window.updateChatUnreadBadge = updateChatUnreadBadge;
window.clearChatBadge = clearChatBadge;

// Add CSS for animations
const style = document.createElement('style');
style.textContent = `
@keyframes pulse {
    0% {
        box-shadow: 0 0 0 0 rgba(220, 53, 69, 0.7);
    }
    70% {
        box-shadow: 0 0 0 10px rgba(220, 53, 69, 0);
    }
    100% {
        box-shadow: 0 0 0 0 rgba(220, 53, 69, 0);
    }
}

@keyframes flash {
    0%, 100% { opacity: 1; transform: scale(1); }
    50% { opacity: 0.7; transform: scale(1.1); }
}

@keyframes slideInRight {
    from { transform: translateX(100%); opacity: 0; }
    to { transform: translateX(0); opacity: 1; }
}

@keyframes slideOutRight {
    from { transform: translateX(0); opacity: 1; }
    to { transform: translateX(100%); opacity: 0; }
}

#chat-unread-badge {
    animation: pulse 2s infinite;
    transition: all 0.3s ease;
}
`;
document.head.appendChild(style);

// Start auto-update with faster frequency (every 5 seconds)
function startChatAutoUpdate() {
    // Clear existing interval if any
    if (chatBadgeUpdateInterval) {
        clearInterval(chatBadgeUpdateInterval);
    }
    
    // Update badge every 5 seconds for faster response
    chatBadgeUpdateInterval = setInterval(updateChatUnreadBadge, 5000);
    
    console.log('Chat auto-update started (5 second intervals)');
}

// Stop auto-update (useful for chat page to prevent conflicts)
function stopChatAutoUpdate() {
    if (chatBadgeUpdateInterval) {
        clearInterval(chatBadgeUpdateInterval);
        chatBadgeUpdateInterval = null;
        console.log('Chat auto-update stopped');
    }
}

// Expose functions globally
window.startChatAutoUpdate = startChatAutoUpdate;
window.stopChatAutoUpdate = stopChatAutoUpdate;

// Start auto-update
startChatAutoUpdate();

// Initial load
document.addEventListener('DOMContentLoaded', function() {
    updateChatUnreadBadge();
});
</script>

</body>
</html>
