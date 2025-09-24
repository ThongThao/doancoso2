@extends('admin_layout')
@section('content_dash')
<div class="content-page">

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="d-flex flex-wrap align-items-center justify-content-between mb-4">
                <div>
                    <h4 class="mb-3">Quản Lý Đánh Giá</h4>
                    <p class="mb-0">Danh sách tất cả đánh giá từ khách hàng</p>
                </div>
                <div>
                    <a href="{{URL::to('/pending-reviews')}}" class="btn btn-warning">
                        <i class="las la-clock"></i> Đánh giá chờ duyệt
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="table-responsive rounded mb-3">
                <?php
                $message = Session::get('message');
                $error = Session::get('error');
                if($message) {
                    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                        <span class="text-success">'.$message.'</span>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>';
                    Session::put('message', null);
                }
                if($error) {
                    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <span class="text-danger">'.$error.'</span>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>';
                    Session::put('error', null);
                }
                ?>

                <table class="data-table table mb-0 tbl-server-info">
                    <thead class="bg-white text-uppercase">
                        <tr class="ligth ligth-data">
                            <th>ID</th>
                            <th>Sản phẩm</th>
                            <th>Khách hàng</th>
                            <th>Đánh giá</th>
                            <th>Nội dung</th>
                            <th>Trạng thái</th>
                            <th>Ngày tạo</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody class="ligth-body">
                        @foreach($reviews as $review)
                        <tr>
                            <td>{{ $review->id }}</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div>
                                        <h6 class="mb-0">{{ $review->product->ProductName ?? 'N/A' }}</h6>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div>
                                    <h6 class="mb-0">{{ $review->customer->CustomerName ?? $review->customer->username ?? $review->customer_name }}</h6>
                                    @if($review->is_verified_purchase)
                                        <small class="text-success"><i class="las la-check-circle"></i> Đã mua hàng</small>
                                    @endif
                                </div>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <span class="badge badge-warning" style="font-size: 0.9rem;">
                                        {{ $review->rating }}/5 ⭐
                                    </span>
                                </div>
                            </td>
                            <td>
                                <div style="max-width: 200px;">
                                    @if($review->title)
                                        <h6 class="mb-1">{{ Str::limit($review->title, 30) }}</h6>
                                    @endif
                                    <p class="mb-0 text-muted small">{{ Str::limit($review->review_text, 50) }}</p>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex flex-column">
                                    @if($review->is_approved)
                                        <span class="badge badge-success status-badge">Đã duyệt</span>
                                    @else
                                        <span class="badge badge-warning status-badge">Chờ duyệt</span>
                                    @endif
                                    
                                    @if($review->is_featured)
                                        <span class="badge badge-info status-badge mt-1">Nổi bật</span>
                                    @endif
                                </div>
                            </td>
                            <td>{{ $review->created_at->format('d/m/Y H:i') }}</td>
                            <td>
                                <div class="d-flex align-items-center list-action">
                                    <a class="badge badge-info mr-2" href="{{URL::to('/view-review/'.$review->id)}}" title="Xem chi tiết">
                                        <i class="las la-eye"></i>
                                    </a>
                                    
                                    @if(!$review->is_approved)
                                        <form method="POST" action="{{URL::to('/approve-review/'.$review->id)}}" class="d-inline">
                                            @csrf
                                            <button type="submit" class="badge badge-success mr-2 border-0" title="Duyệt">
                                                <i class="las la-check"></i>
                                            </button>
                                        </form>
                                    @else
                                        <form method="POST" action="{{URL::to('/reject-review/'.$review->id)}}" class="d-inline">
                                            @csrf
                                            <button type="submit" class="badge badge-warning mr-2 border-0" title="Hủy duyệt">
                                                <i class="las la-times"></i>
                                            </button>
                                        </form>
                                    @endif
                                    
                                    <form method="POST" action="{{URL::to('/toggle-featured-review/'.$review->id)}}" class="d-inline">
                                        @csrf
                                        <button type="submit" class="badge {{ $review->is_featured ? 'badge-secondary' : 'badge-info' }} mr-2 border-0" 
                                                title="{{ $review->is_featured ? 'Bỏ nổi bật' : 'Đánh dấu nổi bật' }}">
                                            <i class="las la-star"></i>
                                        </button>
                                    </form>
                                    
                                    <form method="POST" action="{{URL::to('/delete-review/'.$review->id)}}" class="d-inline" 
                                          onsubmit="return confirm('Bạn có chắc chắn muốn xóa đánh giá này?')">
                                        @csrf
                                        <button type="submit" class="badge badge-danger border-0" title="Xóa">
                                            <i class="las la-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Pagination -->
    <div class="row">
        <div class="col-lg-12">
            <div class="d-flex justify-content-center">
                {{ $reviews->links() }}
            </div>
        </div>
    </div>
</div>
</div>
@endsection
