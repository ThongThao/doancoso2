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
                              
                              <span class="ml-4">Thống Kê Doanh Thu</span>
                          </a>
                      </li>
                      <li class=" ">
                          <a href="#purchase" class="collapsed" data-toggle="collapse" aria-expanded="false">
                              
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
                    
                          </ul>
                      </li>
                      <li class=" ">
                          <a href="#category" class="collapsed" data-toggle="collapse" aria-expanded="false">
                              
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
                              <li class="nav-item nav-icon dropdown">
                                  <a href="#" class="search-toggle dropdown-toggle" id="dropdownMenuButton2"
                                      data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                      <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                                          fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                          stroke-linejoin="round" class="feather feather-mail">
                                          <path
                                              d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z">
                                          </path>
                                          <polyline points="22,6 12,13 2,6"></polyline>
                                      </svg>
                                      <span class="bg-primary"></span>
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
                                       
                                        <img src="{{asset('public/admin/images/user/12.png')}}" class="img-fluid rounded" alt="user">
                                       
                                  </a>
                                  <div class="iq-sub-dropdown dropdown-menu" aria-labelledby="dropdownMenuButton">
                                      <div class="card shadow-none m-0">
                                          <div class="card-body p-0 text-center">
                                              <div class="media-body profile-detail text-center">
                                                  <img src="{{asset('public/admin/images/page-img/profile-bg.jpg')}}" alt="profile-bg"
                                                      class="rounded-top img-fluid mb-4">
                                                 
                                                  <img src="{{asset('public/admin/images/user/12.png')}}" alt="profile-img"
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
</script>

</body>
</html>

