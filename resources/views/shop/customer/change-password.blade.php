@extends('shop_layout')
@section('content')

<?php use Illuminate\Support\Facades\Session; ?>

<!--Page Banner Start-->
<div class="page-banner" style="background-image: url(public/ericshop/images/oso.png);">
    <div class="container">
        <div class="page-banner-content text-center">
            <h2 class="title">Đổi mật khẩu</h2>
            <ol class="breadcrumb justify-content-center">
                <li class="breadcrumb-item"><a href="{{URL::to('/home')}}">Trang chủ</a></li>
                <li class="breadcrumb-item active" aria-current="page">Đổi mật khẩu</li>
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
                            <a href="{{URL::to('/account')}}"><i class="fa fa-user"></i> Hồ Sơ</a>
                        </li>
                        <li>
                            <a class="active"><i class="fa fa-key"></i> Đổi Mật Khẩu</a>
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
                    <div class="tab-pane fade show active" id="pills-password">
                        <div class="my-account-address account-wrapper">
                            <div class="row">
                                <div class="col-md-12" style="border-bottom: solid 1px #efefef;">
                                    <h4 class="account-title" style="margin-bottom: 0;">Đổi Mật Khẩu</h4>
                                    <h5 style="color: #666;">Quản lý thông tin hồ sơ để bảo mật tài khoản</h5>
                                </div>
                                <form method="POST" action="{{URL::to('/submit-change-password')}}" id="form-changepassword">
                                    @csrf
                                    <div class="text-primary mt-2 alert-password"></div>
                                    <div class="col-md-12">
                                        <div class="account-address mt-30">
                                            <div class="form-group mb-30">
                                            <label for="cpass" class="profile__info-body-left-item-title d-inline-block" style="width: 20%; margin-right:9%;">Mật Khẩu Cũ:</label>

                                                <input name="password" id="cpass" type="password" style="width: 70%">
                                                <span class="text-danger"></span>
                                            </div>
                                            <div class="form-group mb-30">
                                            <label for="npass" class="profile__info-body-left-item-title d-inline-block" style="width: 20%; margin-right:9%;">Mật Khẩu Mới:</label>
                                             
                                                <input name="newpassword" id="npass" type="password" style="width: 70%">
                                                <span class="text-danger"></span>
                                            </div>
                                            <div class="form-group mb-30">
                                            <label for="vpass" class="profile__info-body-left-item-title d-inline-block" style="width: 20%; margin-right:9%;">Nhập Lại Mật Khẩu:</label>
                                                
                                                <input name="renewpassword" id="vpass" type="password" style="width: 70%">
                                                <span class="text-danger"></span>
                                            </div>
                                            <input class="btn btn-primary" type="submit" style="float: right;" value="Lưu">
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
<!--My Account End-->

<script>
    $(document).ready(function(){  
        Validator({
            form: "#form-changepassword",
            errorSelector: ".text-danger",
            parentSelector: ".form-group",
            rules:[
            Validator.isRequired("#cpass"),
            Validator.isRequired("#npass"),
            Validator.isRequired("#vpass"),  
            Validator.isPassword("#npass"),
            Validator.isRePassword("#vpass",function(){
                return  document.querySelector("#form-changepassword #npass").value;
            })
            ]
        });
    });
</script>
@endsection