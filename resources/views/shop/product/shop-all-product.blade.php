@extends('shop_layout')
@section('content')


<!--Page Banner Start-->
<div class="page-banner" style="background-image: url(public/ericshop/images/banner/banner-shop.png);">
    <div class="container">
        <div class="page-banner-content text-center">
            <h2 class="title">Cửa Hàng</h2>
            <ol class="breadcrumb justify-content-center">
                <li class="breadcrumb-item"><a href="{{URL::to('/home')}}">Trang chủ</a></li>
                <li class="breadcrumb-item active" aria-current="page">Cửa Hàng</li>
            </ol>
        </div>
    </div>
</div>
<!--Page Banner End-->

<?php use App\Http\Controllers\ProductController; ?>

<!--Shop Start-->
<div class="shop-page section-padding-6">
    <div class="container">
        <div class="row flex-row-reverse">
            <div class="col-lg-9">

                <div class="shop-top-bar d-sm-flex align-items-center justify-content-between mt-3">
                       
                    <div class="top-bar-page-amount">
                        <p>Có: {{$count_pd}} sản phẩm</p>
                    </div>
                </div>
                <!--Shop Top Bar End-->


                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="grid" role="tabpanel">
                        <div class="row">
                            @foreach($list_pd as $key => $pd)
                            <div class="col-lg-4 col-sm-6">
                                <div class="single-product">
                                    <div class="product-image">
                                        <?php $image = json_decode($pd->ImageName)[0]; ?>
                                        <a href="{{URL::to('/shop-single/'.$pd->ProductSlug)}}">
                                            <img src="{{asset('public/storage/admin/images/product/'.$image)}}" alt="">
                                        </a>

                                        <div class="action-links">
                                            <ul>
                                                <li><a class="add-to-wishlist" data-id="{{$pd->idProduct}}"
                                                        data-tooltip="tooltip" data-placement="left"
                                                        title="Thêm vào danh sách yêu thích"><i
                                                            class="icon-heart"></i></a></li>
                                                <li><a class="quick-view-pd" data-id="{{$pd->idProduct}}"
                                                        data-tooltip="tooltip" data-placement="left"
                                                        title="Xem nhanh"><i class="icon-eye"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="product-content text-center">
                                        <h4 class="product-name"><a
                                                href="{{URL::to('/shop-single/'.$pd->ProductSlug)}}">{{$pd->ProductName}}</a>
                                        </h4>
                                        <div class="price-box">
                                            <span class="current-price">{{number_format($pd->Price,0,',','.')}}đ</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="tab-pane fade" id="list" role="tabpanel">
                        @foreach($list_pd as $key => $pd)
                        <div class="single-product product-list">
                            <div class="product-image">
                                <?php $image = json_decode($pd->ImageName)[0]; ?>
                                <a href="{{URL::to('/shop-single/'.$pd->ProductSlug)}}">
                                    <img src="{{asset('public/storage/admin/images/product/'.$image)}}" alt="">
                                </a>

                                <div class="action-links">
                                    <ul>
                                        <li><a class="quick-view-pd" data-id="{{$pd->idProduct}}" data-tooltip="tooltip"
                                                data-placement="left" title="Xem nhanh"><i class="icon-eye"></i></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="product-content">
                                <h4 class="product-name"><a
                                        href="{{URL::to('/shop-single/'.$pd->ProductSlug)}}">{{$pd->ProductName}}</a>
                                </h4>
                                <div class="price-box">
                                    <span class="current-price">{{number_format($pd->Price,0,',','.')}}đ</span>
                                </div>
                                <p>{!!$pd->ShortDes!!}</p>

                                <ul class="action-links">
                                    <li><a class="add-to-wishlist" data-id="{{$pd->idProduct}}" data-tooltip="tooltip"
                                            data-placement="left" title="Thêm vào danh sách yêu thích"><i
                                                class="icon-heart"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>


                <!--Pagination Start-->
                <div class="page-pagination">
                    {{$list_pd->appends(request()->input())->links()}}
                </div>
                <!--Pagination End-->


            </div>
            <div class="col-lg-3">
                <div class="shop-sidebar">

                    <h4><i class="fa fa-filter"></i> BỘ LỌC TÌM KIẾM</h4>

                    <!--Sidebar Categories Start-->
                    <div class="sidebar-categories">
                        <h3 class="widget-title">Theo danh mục</h3>

                        <ul class="categories-list">
                            @foreach($list_category as $key => $category)
                            <li class="d-flex align-items-center">
                                <input <?php if(isset($_GET['category'])){ $idCategory=$_GET['category'];
                                    $category_arr=explode(",",$idCategory); if(in_array($category->idCategory,
                                $category_arr)) echo 'checked';
                                else echo '';
                                }
                                ?>
                                class="filter-product" type="checkbox" id="cat-{{$category->idCategory}}"
                                data-filter="category" value="{{$category->idCategory}}" name="category-filter"
                                style="width:15px;height:15px;">
                                <label class="mb-0 ml-2" for="cat-{{$category->idCategory}}"
                                    style="font-size:15px;cursor:pointer;"><span
                                        style="position:relative; top:2px;">{{$category->CategoryName}}</span></label>
                                <span
                                    style="margin-left:auto">({{App\Models\Product::where('idCategory',$category->idCategory)->where('StatusPro','1')->count()}})</span>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    <!--Sidebar Categories End-->

                    <!--Sidebar Categories Start-->
                    <div class="sidebar-categories">
                        <h3 class="widget-title">Theo thương hiệu</h3>

                        <ul class="categories-list">
                            @foreach($list_brand as $key => $brand)
                            <li class="d-flex align-items-center">
                                <input <?php if(isset($_GET['brand'])){ $idBrand=$_GET['brand'];
                                    $brand_arr=explode(",",$idBrand); if(in_array($brand->idBrand, $brand_arr)) echo
                                'checked';
                                else echo '';
                                }
                                ?>
                                class="filter-product" type="checkbox" id="brand-{{$brand->idBrand}}"
                                data-filter="brand" value="{{$brand->idBrand}}" name="brand-filter"
                                style="width:15px;height:15px;">
                                <label class="mb-0 ml-2" for="brand-{{$brand->idBrand}}"
                                    style="font-size:15px;cursor:pointer;"><span
                                        style="position:relative; top:2px;">{{$brand->BrandName}}</span></label>
                                <span
                                    style="margin-left:auto">({{App\Models\Product::where('idBrand',$brand->idBrand)->where('StatusPro','1')->count()}})</span>
                            </li>
                            @endforeach
                        </ul>
                    </div>

                    <div class="sidebar-categories">
                        <h3 class="widget-title">Theo giá</h3>
                        <div class="d-flex justify-content-between">
                            <input class="input-filter-price min" type="number" min="0" maxlength="13"
                                placeholder="đ TỪ" onkeypress="return /[0-9]/i.test(event.key)" <?php
                                if(isset($_GET['priceMin'])){ echo "value=" .$_GET['priceMin']; } ?>
                            >
                            <span style="line-height: 240%;"> - </span>
                            <input class="input-filter-price max" type="number" min="0" maxlength="13"
                                placeholder="đ ĐẾN" onkeypress="return /[0-9]/i.test(event.key)" <?php
                                if(isset($_GET['priceMax'])){ echo "value=" .$_GET['priceMax']; } ?>
                            >
                        </div>
                        <div class="alert-filter-price text-primary mt-2 d-none">Vui lòng điền khoảng giá phù hợp</div>
                        <button type="button" class="btn-filter-price btn btn-primary">Áp dụng</button>
                    </div>

                    <!--Sidebar Product Start-->
                    <div class="sidebar-product">
                        <h3 class="widget-title">Top sản phẩm bán chạy</h3>
                        <ul class="product-list">
                            @foreach($top_bestsellers_pd as $key => $top_pd)
                            <li>
                                <div class="single-mini-product">
                                    <div class="product-image">
                                        <?php $image = json_decode($top_pd->ImageName)[0];?>
                                        <a href="{{URL::to('/shop-single/'.$top_pd->ProductSlug)}}">
                                            <img src="{{asset('public/storage/admin/images/product/'.$image)}}" alt="">
                                        </a>
                                    </div>
                                    <div class="product-content">
                                        <h4 class="title"><a class="two-line"
                                                href="{{URL::to('/shop-single/'.$top_pd->ProductSlug)}}">{{$top_pd->ProductName}}</a>
                                        </h4>
                                        <span class="text-primary h6">Đã bán: {{$top_pd->Sold}}</span>
                                        <div class="price-box">
                                            <span
                                                class="current-price">{{number_format($top_pd->Price,0,',','.')}}đ</span>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>

                    <!--Sidebar Product End-->





                </div>
            </div>
        </div>
    </div>
</div>
<!--Shop End-->

@endsection