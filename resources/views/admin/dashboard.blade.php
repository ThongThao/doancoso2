@extends('admin_layout')
@section('content_dash')

<?php use Illuminate\Support\Facades\Session; ?>

<div class="content-page">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-4">
                <div class="card card-transparent card-block card-stretch card-height border-none">
                    <div class="card-body p-0 mt-lg-2 mt-0">
                        <h3 class="mb-3">Hi <?php echo Session::get('AdminName'); ?>, Good Morning</h3>
                        <p class="mb-0 mr-4">
                            Trang tổng quan của bạn cung cấp cho bạn các quan điểm về hiệu suất chính hoặc quy trình kinh doanh.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="row">
                    <div class="col-lg-6 col-md-4">
                        <div class="card card-block card-stretch card-height">
                            <div class="card-body">
                                <div class="d-flex align-items-center mb-4 card-total-sale">
                                    <div class="icon iq-icon-box-2 bg-info-light">
                                        <img src="public/admin/images/product/1.png" class="img-fluid" alt="image">
                                    </div>
                                    <div>
                                        <p class="mb-2">Tổng Doanh Thu</p>
                                        <h4>{{number_format($total_revenue,0,',','.')}}đ</h4>
                                    </div>
                                </div>                                
                                <div class="iq-progress-bar mt-2">
                                    <span class="bg-info iq-progress progress-1" data-percent="85">
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-lg-6 col-md-4">
                        <div class="card card-block card-stretch card-height">
                            <div class="card-body">
                                <div class="d-flex align-items-center mb-4 card-total-sale">
                                    <div class="icon iq-icon-box-2 bg-success-light">
                                        <img src="public/admin/images/product/3.png" class="img-fluid" alt="image">
                                    </div>
                                    <div>
                                        <p class="mb-2">Tổng Sản Phầm Bán Ra</p>
                                        <h4>{{number_format($total_sell,0,',','.')}} sản phẩm</h4>
                                    </div>
                                </div>
                                <div class="iq-progress-bar mt-2">
                                    <span class="bg-success iq-progress progress-1" data-percent="75">
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</div>
<!-- Page end  -->

<!-- Tạo datetimepicker form -->
<script>
    $(document).ready(function(){  
        APP_URL = '{{url('/')}}' ;
        jQuery.datetimepicker.setLocale('vi');
        jQuery(function(){
            jQuery('#DateFrom').datetimepicker({
                // format: 'DD-MM-YYYY HH:mm',
                format:'Y-m-d',
                // timepicker: false,
                onShow:function( ct ){
                    this.setOptions({
                        maxDate:jQuery('#DateTo').val()?jQuery('#DateTo').val():false
                    })
                }
            });
            jQuery('#DateTo').datetimepicker({
                // format: 'DD-MM-YYYY HH:mm',
                format:'Y-m-d',
                // timepicker: false,
                onShow:function( ct ){
                    this.setOptions({
                        minDate:jQuery('#DateFrom').val()?jQuery('#DateFrom').val():false
                    })
                }
            });
        });

        chart_7days();

        var chart = new Morris.Bar({
            element: 'chart-sale',
            barColors: ['orange','#32BDEA','#FF9DBE'],
            gridTextColor: ['orange','#32BDEA','#FF9DBE'],
            pointFillColors: ['#fff'],
            pointStrokeColors: ['black'],
            fillOpacity: 1,
            hideHover: 'auto',
            parseTime: false, 
            xkey: 'Date',
            ykeys: ['TotalSold','Sale','QtyBill'],
            behaveLikeLine: true,
            labels: ['Số lượng bán','Doanh thu','Đơn hàng'],
        });

        function chart_7days(){
            var _token = $('input[name="_token"]').val();

            $.ajax({
                url: APP_URL + '/chart-7days',
                method: 'POST',
                dataType: 'JSON',
                data: {_token:_token},
                success:function(data){
                    chart.setData(data);
                }
            });
        }

        $('.statistic-btn').on("click", function(){
            var DateFrom = $('#DateFrom').val();
            var DateTo = $('#DateTo').val();
            var _token = $('input[name="_token"]').val();

            $.ajax({
                url: APP_URL + '/statistic-by-date',
                method: 'POST',
                dataType: 'JSON',
                data: {DateFrom:DateFrom,DateTo:DateTo,_token:_token},
                success:function(data){
                    chart.setData(data);
                }
            });
        });

        $('#chart-by-days').on("change", function(){
            var Days = $(this).val();
            var _token = $('input[name="_token"]').val();

            $.ajax({
                url: APP_URL + '/statistic-by-date-order',
                method: 'POST',
                dataType: 'JSON',
                data: {Days:Days,_token:_token},
                success:function(data){
                    chart.setData(data);
                }
            });
        });

        $('.select-topPro').on("click", function(){
            var Days = $(this).html();
            var _token = $('input[name="_token"]').val();
            var sort_by = '';
            
            $('.topPro-default').html(Days);
            if(Days == 'Trong Tuần') sort_by = 'week';
            else if(Days == 'Trong Tháng') sort_by = 'month';
            else if(Days == 'Trong Năm') sort_by = 'year';

            $.ajax({
                url: APP_URL + '/topPro-sort-by-date',
                method: 'POST',
                data: {sort_by:sort_by,_token:_token},
                success:function(data){
                    $('.list-topPro').html(data);
                }
            });
        });
    });
</script>

@endsection