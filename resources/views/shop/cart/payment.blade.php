@extends('shop_layout')
@section('content')

<?php use Illuminate\Support\Facades\Session; ?>
@if(Session::has('error'))
    <div class="alert alert-danger">
        {{ Session::get('error') }}
    </div>
@endif
<form method="POST" action="{{URL::to('/submit-payment')}}" id="payment-form">
    @csrf
<!--Page Banner Start-->
<div class="page-banner" style="background-image: url(public/ericshop/images/banner/banner-shop.png);">
    <div class="container">
        <div class="page-banner-content text-center">
            <h2 class="title">Thanh toán</h2>
            <ol class="breadcrumb justify-content-center">
                <li class="breadcrumb-item"><a href="{{URL::to('/home')}}">Trang chủ</a></li>
                <li class="breadcrumb-item active" aria-current="page">Thanh toán</li>
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
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#AddressModal">+ Thêm Địa Chỉ</button>
                </div>
                <ul class="shipping-list list-address">

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
                    <?php $Total = 0; $ship = 0; $total_bill = 0; ?>
                    @foreach($list_pd_cart as $key => $pd_cart)
                        <?php $Total += ($pd_cart->PriceNew * $pd_cart->QuantityBuy); ?>
                    <tr class="product-item">
                        <?php $image = json_decode($pd_cart->ImageName)[0]; ?>
                        <td class="image">
                            <a href="{{URL::to('/shop-single/'.$pd_cart->ProductSlug)}}"><img src="{{asset('public/storage/admin/images/product/'.$image)}}" alt=""></a>
                        </td>
                        <td class="product">
                            <a href="{{URL::to('/shop-single/'.$pd_cart->ProductSlug)}}">{{$pd_cart->ProductName}}</a>
                            <span>Mã sản phẩm: {{$pd_cart->idProduct}}</span>
                            <span>{{$pd_cart->AttributeProduct}}</span>
                            <span class="text-primary">Còn Lại: {{$pd_cart->Quantity}}</span>
                            <?php $replace = [" ",":"]; ?>
                            <input type="hidden" class="Quantity" id="<?php echo 'Quantity-'.$pd_cart->idProduct.'-'.str_replace($replace,"",$pd_cart->AttributeProduct);?>" value="{{$pd_cart->Quantity}}">
                        </td>
                        <td class="price">{{number_format($pd_cart->PriceNew,0,',','.')}}đ</td>
                        <td class="quantity">{{$pd_cart->QuantityBuy}}</td>
                        <td class="total">{{number_format($pd_cart->Total,0,',','.')}}đ</td>
                        <input type="hidden" name="idProAttr" value="{{$pd_cart->idProAttr}}">
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="row">
            <div class="col-lg-6">
                <div class="cart-coupon">
                    <div class="cart-title">
                        <h4 class="title">Mã giảm giá</h4>
                        <p>Nhập mã giảm giá của bạn nếu có.</p>
                    </div>
                    <div class="cart-form mt-25 d-flex">
                        <div class="single-form flex-fill mr-30">
                            <input type="text" id="VoucherCode" placeholder="Nhập mã giảm giá (chỉ áp dụng 1 lần)">
                        </div>
                        <div class="cart-form-btn d-flex">
                            <button type="button" style="width:97px;" class="btn btn-primary pl-2 pr-2 check-voucher">Áp dụng</button>
                        </div>
                    </div>
                    <div class="text-primary alert-voucher"></div>
                </div>
            </div>
            <div class="col-lg-6 container__address-content">
                <div class="container__address-content-hd">
                    <i class="container__address-content-hd-icon fa fa-money"></i>
                    <div>Phương thức thanh toán</div>
                </div>
                <ul class="shipping-list checkout-payment">
                    <li class="cus-radio">
                        <input type="radio" name="checkout" value="cash" id="cash" checked>
                        <label for="cash">
                            <span>Thanh toán khi nhận hàng</span>
                        </label>
                    </li>
                    <li class="cus-radio payment-radio">
                        <input type="radio" name="checkout" value="casso_vietqr" id="casso_vietqr" >
                        <label for="casso_vietqr">
                            <span>Chuyển khoản qua VietQR</span>
                        </label>
                    </li>
                </ul>                   
            </div>
            <div class="col-lg-12">
                <div class="cart-totals shop-single-content">
                    <div class="cart-title">
                        <h4 class="title">Tổng giỏ hàng</h4>
                    </div>
                    <div class="cart-total-table mt-25">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td>Tổng tiền hàng</td>
                                    <td class="text-right">{{ number_format(floatval($Total), 0, ',', '.') }}đ
</td>
                                </tr>
                                @if($Total < 1000000) @php $ship = '30000'; $total_bill = $Total + $ship; @endphp
                                @else @php $ship = 'Miễn phí'; $total_bill = $Total; @endphp @endif
                                <tr class="shipping">
                                    <td>Phí vận chuyển (Miễn phí vận chuyển cho đơn hàng trên 1.000.000đ)</td>
                                    <td class="text-right">
                                            @if($ship > 0) {{number_format(floatval($ship),0,',','.')}}đ
                                            @else {{$ship}} @endif
                                    </td>
                                </tr>

                                <tr>
                                    <td width="70%">Thành tiền</td>
                                    <td class="text-right totalBill">{{number_format(floatval($total_bill),0,',','.')}}đ</td>
                                </tr>

                                <input type="hidden" class="subtotal" value="{{$Total}}">
                                <input type="hidden" name="TotalBill" class="totalBillVal" value="{{$total_bill}}">    
                            </tbody>
                        </table>
                    </div>
                    <div class="dynamic-checkout-button disabled ">
                        <div class="checkout-checkbox">
                            <input type="checkbox" id="disabled">
                            <label for="disabled"><span></span> Tôi đồng ý với các điều khoản và điều kiện </label>
                        </div>    
                        <div class="cart-total-btn checkout-btn">
                            <button type="submit" name="redirect" class="btn btn-primary btn-block btnorder" style="max-width:100%;">Đặt hàng</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--Cart End-->
</form>

<!-- Modal VietQR -->
<div class="modal fade" id="VietQRModal" tabindex="-1" aria-labelledby="VietQRModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="VietQRModalLabel">Thanh toán qua VietQR</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <div id="qr-loading" class="d-none">
                    <div class="spinner-border text-primary" role="status">
                        <span class="sr-only">Đang tạo mã QR...</span>
                    </div>
                    <p class="mt-2">Đang tạo mã QR thanh toán...</p>
                </div>
                
                <div id="qr-content" class="d-none">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="qr-code-container">
                                <img id="qr-image" src="" alt="VietQR Code" class="img-fluid" style="max-width: 300px;">
                                <p class="text-muted mt-2">Quét mã QR để thanh toán</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="payment-info">
                                <h6>Thông tin chuyển khoản</h6>
                                <div class="bank-info p-3 border rounded">
                                    <p><strong>Số tài khoản:</strong> <span id="account-number"></span></p>
                                    <p><strong>Tên tài khoản:</strong> <span id="account-name"></span></p>
                                    <p><strong>Số tiền:</strong> <span id="payment-amount"></span></p>
                                    <p><strong>Nội dung:</strong> <span id="payment-description"></span></p>
                                </div>
                                
                                <div class="payment-status mt-3">
                                    <div id="payment-checking">
                                        <div class="spinner-border spinner-border-sm text-success" role="status"></div>
                                        <span class="ml-2">Đang kiểm tra thanh toán...</span>
                                    </div>
                                    <div id="payment-success" class="d-none text-success">
                                        <i class="fa fa-check-circle"></i>
                                        <span class="ml-2">Thanh toán thành công!</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div id="qr-error" class="d-none">
                    <div class="alert alert-danger">
                        <i class="fa fa-exclamation-triangle"></i>
                        <span id="error-message">Có lỗi xảy ra khi tạo mã QR</span>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" id="cancel-payment">Hủy thanh toán</button>
                <button type="button" class="btn btn-primary" id="check-payment-manual" data-order-id="">Kiểm tra lại</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal thêm địa chỉ -->
<form id="form-insert-address">
    @csrf
    <div class="modal fade" id="AddressModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Thêm Địa Chỉ</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="CustomerName" class="col-form-label">Họ và tên:</label>
                        <input type="text" class="form-control" name="CustomerName" id="CustomerName">
                        <span class="text-danger"></span>
                    </div>
                    <div class="form-group">
                        <label for="PhoneNumber" class="col-form-label">Số điện thoại:</label>
                        <input type="text" class="form-control" name="PhoneNumber" id="PhoneNumber">
                        <span class="text-danger"></span>
                    </div>
                    <div class="form-group">
                        <label for="Address" class="col-form-label">Địa chỉ:</label>
                        <textarea class="form-control" name="Address" id="Address"></textarea>
                        <span class="text-danger"></span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                    <input type="submit" id="btn-insert-address" class="btn btn-primary" value="Thêm"> 
                </div>
            </div>
        </div>
    </div>
</form>

<!-- Modal sửa địa chỉ -->
<form id="form-edit-address">
    @csrf
    <div class="modal fade" id="EditAddressModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Sửa Địa Chỉ</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="CustomerName" class="col-form-label">Họ và tên:</label>
                        <input type="text" class="form-control" name="CustomerName" id="CustomerName" value="aa">
                        <span class="text-danger"></span>
                    </div>
                    <div class="form-group">
                        <label for="PhoneNumber" class="col-form-label">Số điện thoại:</label>
                        <input type="text" class="form-control" name="PhoneNumber" id="PhoneNumber">
                        <span class="text-danger"></span>
                    </div>
                    <div class="form-group">
                        <label for="Address" class="col-form-label">Địa chỉ:</label>
                        <textarea class="form-control" name="Address" id="Address"></textarea>
                        <span class="text-danger"></span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                    <input type="submit" id="btn-insert-address" class="btn btn-primary" value="Sửa"> 
                </div>
            </div>
        </div>
    </div>
</form>

<script src="{{asset('public/ericshop/js/jquery.validate.min.js')}}"></script>

<script>
    $(document).ready(function(){  
        APP_URL = '{{url('/')}}' ;
        fetch_address();

        // Ajax hiện danh sách địa chỉ nhận hàng
        function fetch_address(){
            var _token = $('input[name="_token"]').val();

            $.ajax({
                url: "{{url('/fetch-address')}}",
                method: 'POST',
                data:{_token:_token},
                xhrFields: {
                    withCredentials: true
                },
                success:function(data){
                    $('.list-address').html(data);

                    // Ajax xóa địa chỉ nhận hàng
                    $('.dlt-address').on('click',function(){
                        var idAddress = $(this).data("id");
                        var _token = $('input[name="_token"]').val();
          
                        $.ajax({
                            url: APP_URL + '/delete-address/'+idAddress,
                            method: 'DELETE',
                            data: {idAddress:idAddress,_token:_token},
                            xhrFields: {
                                withCredentials: true
                            },
                            success:function(data){
                                fetch_address();
                            }
                        });
                    });

                    // Ajax validate form && sửa địa chỉ nhận hàng
                    $('.edit-address').on('click',function(){
                        $('#form-edit-address #CustomerName').val($(this).data("name"));
                        $('#form-edit-address #PhoneNumber').val($(this).data("phone"));
                        $('#form-edit-address #Address').val($(this).data("address"));
                        var idAddress = $(this).data("id");

                        $("#form-edit-address").validate({
                            rules: {
                                Address: {
                                    required: true,
                                    minlength: 20
                                },
                                CustomerName: {
                                    required: true,
                                    minlength: 5
                                },
                                PhoneNumber: {
                                    required: true,
                                    minlength: 10,
                                    maxlength: 12
                                }
                            },

                            messages: {
                                Address: {
                                    required: "Vui lòng nhập trường này",
                                    minlength: "Nhập địa chỉ tối thiểu 20 ký tự"
                                },
                                CustomerName: {
                                    required: "Vui lòng nhập trường này",
                                    minlength: "Nhập họ và tên tối thiểu 5 ký tự"
                                },
                                PhoneNumber: {
                                    required: "Vui lòng nhập trường này",
                                    minlength: "Nhập số điện thoại tối thiểu 10 chữ số",
                                    maxlength: "Nhập số điện thoại tối đa 12 chữ số"
                                }
                            },

                            submitHandler: function(form) {
                                var CustomerName = $('#form-edit-address #CustomerName').val();
                                var PhoneNumber = $('#form-edit-address #PhoneNumber').val();
                                var Address = $('#form-edit-address #Address').val();
                                var _token = $('input[name="_token"]').val();
                                $.ajax({
                                    url: APP_URL + '/edit-address/'+idAddress,
                                    method: 'POST',
                                    data: {idAddress:idAddress,CustomerName:CustomerName,PhoneNumber:PhoneNumber,Address:Address,_token:_token},
                                    xhrFields: {
                                        withCredentials: true
                                    },
                                    success:function(data){
                                        $('#EditAddressModal').modal('hide');
                                        fetch_address();
                                    }
                                });
                            }
                        });
                    });
                }
            });
        }

        // Ajax validate form && insert địa chỉ nhận hàng
        $("#form-insert-address").validate({
            rules: {
                Address: {
                    required: true,
                    minlength: 20
                },
                CustomerName: {
                    required: true,
                    minlength: 5
                },
                PhoneNumber: {
                    required: true,
                    minlength: 10,
                    maxlength: 12
                }
            },

            messages: {
                Address: {
                    required: "Vui lòng nhập trường này",
                    minlength: "Nhập địa chỉ tối thiểu 20 ký tự"
                },
                CustomerName: {
                    required: "Vui lòng nhập trường này",
                    minlength: "Nhập họ và tên tối thiểu 5 ký tự"
                },
                PhoneNumber: {
                    required: "Vui lòng nhập trường này",
                    minlength: "Nhập số điện thoại tối thiểu 10 chữ số",
                    maxlength: "Nhập số điện thoại tối đa 12 chữ số"
                }
            },

            submitHandler: function(form) {
                var CustomerName = $('#CustomerName').val();
                var PhoneNumber = $('#PhoneNumber').val();
                var Address = $('#Address').val();
                var _token = $('input[name="_token"]').val();

                $.ajax({
                    url: "{{ url('/insert-address') }}",
                                        method: 'POST',
                    data: {CustomerName:CustomerName,PhoneNumber:PhoneNumber,Address:Address,_token:_token},
                    xhrFields: {
                        withCredentials: true
                    },
                    success:function(data){
                        $('#AddressModal').modal('hide');
                        fetch_address();
                    }
                });
            }
        });
    });
</script>

<script>
    $(document).ready(function(){  
        APP_URL = '{{url('/')}}' ;

        function format(n) {
            return n.toFixed(0).replace(/./g, function(c, i, a) {
                return i > 0 && c !== "." && (a.length - i) % 3 === 0 ? "." + c : c;
            });
        }
    });
</script>

<script>
$(document).ready(function(){
    let paymentCheckInterval;
    let currentOrderId = null;
    
    // Override form submission to handle Casso VietQR payment
    $('#payment-form').on('submit', function(e) {
        const selectedPayment = $('input[name="checkout"]:checked').val();
        
        if (selectedPayment === 'casso_vietqr') {
            e.preventDefault();
            handleCassoPayment();
        }
        // For cash payment, let the form submit normally
    });
    
    function handleCassoPayment() {
        // Validate address selection
        const selectedAddress = $('input[name="address_rdo"]:checked').val();
        if (!selectedAddress) {
            alert('Vui lòng chọn địa chỉ nhận hàng');
            return;
        }
        
        // Validate terms checkbox
        if (!$('#disabled').is(':checked')) {
            alert('Vui lòng đồng ý với điều khoản và điều kiện');
            return;
        }
        
        // Show loading modal
        $('#VietQRModal').modal('show');
        showQRLoading();
        
        // Prepare payment data
        const formData = {
            TotalBill: $('.totalBillVal').val(),
            address_rdo: selectedAddress,
            Voucher: $('#VoucherCode').val() || null,
            _token: $('input[name="_token"]').val()
        };
        
        // Create VietQR payment
        $.ajax({
            url: "{{ route('casso.create.vietqr') }}",
            method: 'POST',
            data: formData,
            success: function(response) {
                if (response.success) {
                    currentOrderId = response.order_id;
                    showQRContent(response);
                    startPaymentCheck(response.order_id);
                } else {
                    showQRError(response.message || 'Không thể tạo mã QR thanh toán');
                }
            },
            error: function(xhr) {
                let errorMessage = 'Lỗi hệ thống';
                if (xhr.responseJSON && xhr.responseJSON.message) {
                    errorMessage = xhr.responseJSON.message;
                }
                showQRError(errorMessage);
            }
        });
    }
    
    function showQRLoading() {
        $('#qr-loading').removeClass('d-none');
        $('#qr-content').addClass('d-none');
        $('#qr-error').addClass('d-none');
    }
    
    function showQRContent(data) {
        $('#qr-loading').addClass('d-none');
        $('#qr-content').removeClass('d-none');
        $('#qr-error').addClass('d-none');
        
        // Set QR image
        $('#qr-image').attr('src', data.qr_data_url);
        
        // Set bank info
        $('#account-number').text(data.bank_info.account_no);
        $('#account-name').text(data.bank_info.account_name);
        $('#payment-amount').text(formatCurrency(data.amount));
        $('#payment-description').text(data.description);
        
        // Set order ID for manual check
        $('#check-payment-manual').attr('data-order-id', data.order_id);
        
        // Show payment checking status
        $('#payment-checking').removeClass('d-none');
        $('#payment-success').addClass('d-none');
    }
    
    function showQRError(message) {
        $('#qr-loading').addClass('d-none');
        $('#qr-content').addClass('d-none');
        $('#qr-error').removeClass('d-none');
        $('#error-message').text(message);
    }
    
    function startPaymentCheck(orderId) {
        paymentCheckInterval = setInterval(function() {
            checkPaymentStatus(orderId);
        }, 3000); // Check every 3 seconds
    }
    
    function stopPaymentCheck() {
        if (paymentCheckInterval) {
            clearInterval(paymentCheckInterval);
            paymentCheckInterval = null;
        }
    }
    
    function checkPaymentStatus(orderId) {
        $.ajax({
            url: "{{ url('/casso/check-payment') }}/" + orderId,
            method: 'GET',
            success: function(response) {
                if (response.success && response.status === 'completed') {
                    stopPaymentCheck();
                    showPaymentSuccess();
                    
                    // Redirect to success page after 2 seconds
                    setTimeout(function() {
                        window.location.href = response.redirect_url || "{{ route('success.order') }}";
                    }, 2000);
                }
                // If pending, continue checking
            },
            error: function(xhr) {
                console.error('Payment check error:', xhr);
            }
        });
    }
    
    function showPaymentSuccess() {
        $('#payment-checking').addClass('d-none');
        $('#payment-success').removeClass('d-none');
    }
    
    // Manual payment check
    $('#check-payment-manual').on('click', function() {
        const orderId = $(this).attr('data-order-id');
        if (orderId) {
            checkPaymentStatus(orderId);
        }
    });
    
    // Cancel payment
    $('#cancel-payment').on('click', function() {
        if (currentOrderId) {
            $.ajax({
                url: "{{ url('/casso/cancel-payment') }}/" + currentOrderId,
                method: 'POST',
                data: {
                    _token: $('input[name="_token"]').val()
                },
                success: function(response) {
                    stopPaymentCheck();
                    $('#VietQRModal').modal('hide');
                    currentOrderId = null;
                }
            });
        } else {
            stopPaymentCheck();
            $('#VietQRModal').modal('hide');
        }
    });
    
    // Clean up when modal is closed
    $('#VietQRModal').on('hidden.bs.modal', function () {
        stopPaymentCheck();
        currentOrderId = null;
    });
    
    function formatCurrency(amount) {
        return new Intl.NumberFormat('vi-VN', {
            style: 'currency',
            currency: 'VND'
        }).format(amount);
    }
});
</script>

@endsection
