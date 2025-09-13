@extends('admin_layout')
@section('content_dash')

<div class="content-page">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="d-flex flex-wrap align-items-center justify-content-between mb-4">
                    <div>
                        <h4 class="mb-3">Danh Sách Đơn Đã Xác Nhận ( Tổng: {{$list_bill->count()}} đơn hàng )</h4>
                       
                    </div>
                </div>
            </div>

            <div class="col-lg-12">
                <div class="table-responsive rounded mb-3">
                    <table class="data-tables table mb-0 tbl-server-info">
                        <thead class="bg-white text-uppercase">
                            <tr class="ligth ligth-data">
                                <th>Mã ĐH</th>
                                <th>Tên Tài Khoản</th>
                                <th>SĐT</th>
                                <th>Thanh Toán</th>
                                <th>Ngày Đặt Hàng</th>
                                <th>NV Xác Nhận</th>
                                <th>Ngày Xác Nhận</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody class="ligth-body" id="load-bill">
                            @foreach($list_bill as $key => $bill)
                            <tr>
                                <td>{{$bill->idBill}}</td>
                                <td>{{$bill->username}}</td>
                                <td>{{$bill->CusPhone}}</td>
                                <td class="badge-column">
                                    @if($bill->Payment == 'vnpay') 
                                        <span class="badge badge-primary payment-badge">VNPay</span>
                                    @elseif($bill->Payment == 'casso_vietqr')
                                        <span class="badge badge-info payment-badge">VietQR</span>
                                    @elseif($bill->Payment == 'paid')
                                        <span class="badge badge-success payment-badge">Đã thanh toán</span>
                                    @else 
                                        <span class="badge badge-warning payment-badge">Khi nhận hàng</span>
                                    @endif
                                </td>
                                <td>{{$bill->created_at}}</td>
                                <td class="badge-column"><span class="badge badge-success status-badge">{{$bill->AdminName}}</span></td>
                                <td>{{$bill->TimeConfirm}}</td>

                                <td>
                                    <div class="d-flex align-items-center list-action">
                                        <a class="badge badge-success mr-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Xem chi tiết" 
                                            href="{{URL::to('/bill-info/'.$bill->idBill)}}"><i class="ri-eye-line mr-0"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Page end  -->

@endsection