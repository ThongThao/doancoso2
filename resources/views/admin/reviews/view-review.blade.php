@extends('admin_layout')
@section('content_dash')
<div class="content-page">
    
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="d-flex flex-wrap align-items-center justify-content-between mb-4">
                <div>
                    <h4 class="mb-3">Chi Tiết Đánh Giá</h4>
                    <p class="mb-0">Xem thông tin chi tiết đánh giá từ khách hàng</p>
                </div>
                <div>
                    <a href="{{URL::to('/manage-reviews')}}" class="btn btn-secondary mr-2">
                        <i class="las la-arrow-left"></i> Quay lại
                    </a>
                    @if(!$review->is_approved)
                        <form method="POST" action="{{URL::to('/approve-review/'.$review->id)}}" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-success mr-2">
                                <i class="las la-check"></i> Duyệt đánh giá
                            </button>
                        </form>
                    @else
                        <form method="POST" action="{{URL::to('/reject-review/'.$review->id)}}" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-warning mr-2">
                                <i class="las la-times"></i> Hủy duyệt
                            </button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card">
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

                <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                        <h4 class="card-title">Nội dung đánh giá</h4>
                    </div>
                    <div>
                        @if($review->is_approved)
                            <span class="badge badge-success">Đã duyệt</span>
                        @else
                            <span class="badge badge-warning">Chờ duyệt</span>
                        @endif
                        
                        @if($review->is_featured)
                            <span class="badge badge-info ml-1">Nổi bật</span>
                        @endif
                    </div>
                </div>
                <div class="card-body">
                    <!-- Rating -->
                    <div class="mb-4">
                        <div class="d-flex align-items-center mb-2">
                            <h5 class="mb-0 mr-3">Đánh giá: </h5>
                            <div class="rating">
                                @for($i = 1; $i <= 5; $i++)
                                    @if($i <= $review->rating)
                                        <span class="text-warning">⭐</span>
                                    @else
                                        <span class="text-muted">☆</span>
                                    @endif
                                @endfor
                                <span class="ml-2 badge badge-warning">{{ $review->rating }}/5</span>
                            </div>
                        </div>
                    </div>

                    <!-- Title -->
                    @if($review->title)
                        <div class="mb-3">
                            <h5>{{ $review->title }}</h5>
                        </div>
                    @endif

                    <!-- Review Content -->
                    <div class="mb-4">
                        <p class="text-dark" style="line-height: 1.6;">{{ $review->review_text }}</p>
                    </div>

                    <!-- Images -->
                    @if($review->images && count($review->images) > 0)
                        <div class="mb-4">
                            <h6 class="mb-3">Hình ảnh đính kèm:</h6>
                            <div class="row">
                                @foreach($review->images as $image)
                                    <div class="col-md-3 col-6 mb-3">
                                        <img src="{{ asset('storage/reviews/' . $image) }}" 
                                             class="img-fluid rounded" 
                                             alt="Review Image"
                                             style="cursor: pointer; max-height: 150px; object-fit: cover;"
                                             onclick="showImageModal('{{ asset('storage/reviews/' . $image) }}')">
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- Helpful Count -->
                    @if($review->helpful_count > 0)
                        <div class="mb-3">
                            <span class="text-muted">
                                <i class="las la-thumbs-up"></i> {{ $review->helpful_count }} người thấy hữu ích
                            </span>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <!-- Product Info -->
            <div class="card mb-4">
                <div class="card-header">
                    <div class="header-title">
                        <h4 class="card-title">Thông tin sản phẩm</h4>
                    </div>
                </div>
                <div class="card-body">
                    <h6 class="mb-2">{{ $review->product->ProductName ?? 'N/A' }}</h6>
                    @if($review->product && $review->product->ProductSlug)
                        <a href="{{ URL::to('/shop-single/' . $review->product->ProductSlug) }}" target="_blank" class="btn btn-sm btn-outline-primary">
                            <i class="las la-external-link-alt"></i> Xem sản phẩm
                        </a>
                    @endif
                </div>
            </div>

            <!-- Customer Info -->
            <div class="card mb-4">
                <div class="card-header">
                    <div class="header-title">
                        <h4 class="card-title">Thông tin khách hàng</h4>
                    </div>
                </div>
                <div class="card-body">
                    <div class="mb-2">
                        <strong>Tên:</strong> {{ $review->customer->CustomerName ?? $review->customer->username ?? $review->customer_name }}
                    </div>
                    @if($review->customer && $review->customer->Email)
                        <div class="mb-2">
                            <strong>Email:</strong> {{ $review->customer->Email }}
                        </div>
                    @endif
                    <div class="mb-3">
                        <strong>Trạng thái:</strong>
                        @if($review->is_verified_purchase)
                            <span class="badge badge-success">Đã mua hàng</span>
                        @else
                            <span class="badge badge-secondary">Chưa mua hàng</span>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Review Info -->
            <div class="card">
                <div class="card-header">
                    <div class="header-title">
                        <h4 class="card-title">Thông tin đánh giá</h4>
                    </div>
                </div>
                <div class="card-body">
                    <div class="mb-2">
                        <strong>Ngày tạo:</strong> {{ $review->created_at->format('d/m/Y H:i:s') }}
                    </div>
                    @if($review->verified_at)
                        <div class="mb-2">
                            <strong>Ngày duyệt:</strong> {{ $review->verified_at->format('d/m/Y H:i:s') }}
                        </div>
                    @endif
                    <div class="mb-3">
                        <strong>ID đánh giá:</strong> #{{ $review->id }}
                    </div>

                    <!-- Actions -->
                    <div class="d-flex flex-column">
                        <form method="POST" action="{{URL::to('/toggle-featured-review/'.$review->id)}}" class="mb-2">
                            @csrf
                            <button type="submit" class="btn btn-sm {{ $review->is_featured ? 'btn-secondary' : 'btn-info' }} w-100">
                                <i class="las la-star"></i> {{ $review->is_featured ? 'Bỏ nổi bật' : 'Đánh dấu nổi bật' }}
                            </button>
                        </form>
                        
                        <form method="POST" action="{{URL::to('/delete-review/'.$review->id)}}" 
                              onsubmit="return confirm('Bạn có chắc chắn muốn xóa đánh giá này?')">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-danger w-100">
                                <i class="las la-trash"></i> Xóa đánh giá
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Image Modal -->
<div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-labelledby="imageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="imageModalLabel">Xem ảnh đánh giá</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                <img id="modalImage" src="" class="img-fluid" alt="Review Image">
            </div>
        </div>
    </div>
</div>
</div>
<script>
function showImageModal(imageSrc) {
    document.getElementById('modalImage').src = imageSrc;
    $('#imageModal').modal('show');
}
</script>

@endsection
