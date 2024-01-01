@extends('shop_layout')
@section('content')
<?php use Illuminate\Support\Facades\Session; ?>

<!--Page Banner Start-->
<div class="page-banner" style="background-image: url(public/ericshop/images/oso.png);">
    <div class="container">
        <div class="page-banner-content text-center">
            <h2 class="title">Tài khoản của tôi</h2>
            <ol class="breadcrumb justify-content-center">
                <li class="breadcrumb-item"><a href="{{URL::to('/home')}}">Trang chủ</a></li>
                <li class="breadcrumb-item active" aria-current="page">Tài khoản của tôi</li>
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
                            <a class="active"><i class="fa fa-user"></i> Hồ Sơ</a>
                        </li>
                        <li>
                            <a href="{{URL::to('/change-password')}}"><i class="fa fa-key"></i> Đổi Mật Khẩu</a>
                        </li>
                        <li>
                            <a href="{{URL::to('/ordered')}}"><i class="fa fa-shopping-cart"></i> Đơn Đặt Hàng</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-xl-9 col-md-8">
                <div class="tab-content my-account-tab mt-30" id="pills-tabContent">
                <?php
                            $message = Session::get('message');
                            $error = Session::get('error');
                            if($message){
                                echo '<span class="text-success">'.$message.'</span>';
                                Session::put('message', null);
                            }else if($error){
                                echo '<span class="text-danger">'.$error.'</span>';
                                Session::put('error', null);
                            }
                        ?>  
                    <div class="tab-pane fade show active" id="pills-account">
                        <div class="tab-content my-account-tab" id="pills-tabContent">
                            <div class="tab-pane fade active show">
                                <div class="my-account-address account-wrapper">
                                    <div class="row">
                                        <div class="col-md-12" style="border-bottom: solid 1px #efefef;">
                                            <h4 class="account-title" style="margin-bottom: 0;">Hồ Sơ Của Tôi</h4>
                                            <h5 style="color: #666;">Quản lý thông tin hồ sơ để bảo mật tài khoản</h5>
                                        </div>
                                      
                                            <form method="POST" action="{{URL::to('/edit-profile')}}" id="form-edit-profile" style="display:flex; padding: 0;" enctype="multipart/form-data">
                                             @csrf
                                            <div class="col-md-8 mt-10">
                                                <div class="account-address">
                                                    <div class="profile__info-body-left-item">
                                                        <span class="profile__info-body-left-item-title">Tên Đăng Nhập</span>
                                                        <span class="profile__info-body-left-item-text ml-20">{{$customer->username}}</span>
                                                    </div>
                                                    <div class="form-group mb-30">
                                                        <span for="fname"  class="profile__info-body-left-item-title" style="margin: 0 28px 0 52px;">Họ Và Tên</span>
                                                        <input id="fname" name="CustomerName" class="ml-30" style="width:65%;" type="text" value="{{$customer->CustomerName}}">
                                                        <span class="text-danger"></span>
                                                    </div>
                                                    <div class="form-group mb-30">
                                                        <span  for="nmphone"  class="profile__info-body-left-item-title" style="margin-left: 52px;">Số Điện Thoại</span>
                                                        <input class="ml-30" style="width:65%;" name="PhoneNumber" id="nmphone" type="text" value="{{$customer->PhoneNumber}}">
                                                        <span class="text-danger"></span>
                                                    </div>
                                                    <button type="submit" class="btn btn-primary edit-profile" style="float: right;"><i class="fa fa-edit"></i> Sửa Hồ Sơ</button>
                                                </div>
                                            </div>
                                            <div class="col-md-4 mt-10 d-flex align-items-center justify-content-center" style="border-left: solid 1px #efefef; margin: 0 12px;">
                                                <div class="profile__info-body-right-avatar">
                                                    <div class="profile-img-edit">
                                                        <div class="crm-profile-img-edit">
        
                                                            <img class="crm-profile-pic rounded-circle avatar-100 replace-avt" src="public/admin/images/user/12.png"> 
                                                           
                                                        </div>                                          
                                                    </div>
                                                    <div class="text-danger alert-img mt-3 ml-3 mr-3"></div>
                                                   
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
        </div>
    </div>
</div>
<!--My Account End-->

<script>
    $(document).ready(function(){  
        Validator({
            form: "#form-profile-edit",
            errorSelector: ".text-danger",
            parentSelector: ".form-group",
            rules:[
            Validator.isRequired("#fname"),
            Validator.isRequired("#nmphone")
            ]
        });
    });
</script>

@endsection