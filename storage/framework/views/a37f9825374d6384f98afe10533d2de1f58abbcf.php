
<?php $__env->startSection('content'); ?>

<!--Page Banner Start-->
<div class="page-banner" style="background-image: url(public/kidolshop/images/spbn.png);">
    <div class="container">
        <div class="page-banner-content text-center">
            <h2 class="title">Danh Sách Yêu Thích</h2>
            <ol class="breadcrumb justify-content-center">
                <li class="breadcrumb-item"><a href="<?php echo e(URL::to('/home')); ?>">Trang chủ</a></li>
                <li class="breadcrumb-item active" aria-current="page">Danh Sách Yêu Thích</li>
            </ol>
        </div>
    </div>
</div>
<!--Page Banner End-->

<!--Cart Start-->
<div class="cart-page section-padding-5">
    <div class="container">
        <div class="col-xl-12 col-md-12">
            <div class="tab-content my-account-tab mt-30" id="pills-tabContent">
                <div class="tab-pane fade active show">
                    <div class="my-account-order account-wrapper">
                        <table id="example" class="table table-striped table-bordered wishlist-table" style="width:100%;">
                            <thead>
                                <tr>
                                    <th class="no text-center">STT</th>
                                    <th class="name" style="width:10%;">Hình Ảnh</th>
                                    <th class="date">Sản Phẩm</th>
                                    <th class="date">Giá</th>
                                    <th class="action text-center" style="width:10%;">Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>             
                                <?php $__currentLoopData = $wishlist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $wish): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>                     
                                <tr>
                                    <td class="text-center"><?php echo e($key+1); ?></td>
                                    <?php $image = json_decode($wish->ImageName)[0]; ?>
                                    <td>
                                        <a href="<?php echo e(URL::to('/shop-single/'.$wish->ProductSlug)); ?>"><img src="<?php echo e(asset('public/storage/kidoldash/images/product/'.$image)); ?>" alt=""></a>
                                    </td>
                                    <td>
                                        <div><a href="<?php echo e(URL::to('/shop-single/'.$wish->ProductSlug)); ?>"><?php echo e($wish->ProductName); ?></a></div>
                                        <div>Mã sản phẩm: <?php echo e($wish->idProduct); ?></div>
                                        <div class="text-primary">Còn Lại: <?php echo e($wish->QuantityTotal); ?></div>
                                    </td>

                                    <td><?php echo e($wish->Price); ?></td>            

                                    <td class="text-center">
                                        <a class="view-hover h3 d-block delete-wish" data-id="<?php echo e($wish->idWish); ?>" data-toggle="tooltip" data-placement="top" title="" data-original-title="Xóa"><i class="fa fa-trash"></i></a>
                                    </td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--Cart End-->

<script>
    $(document).ready(function()
    {
        APP_URL = '<?php echo e(url('/')); ?>' ;
        $('body').tooltip({selector: '[data-toggle="tooltip"]'});
        $('#example').DataTable();

        $('.delete-wish').on('click',function(){
            var _token = $('input[name="_token"]').val();
            var idWish = $(this).data("id");

            $.ajax({
                url: APP_URL + '/delete-wish/'+idWish,
                method: 'DELETE',
                data: {_token:_token},
                success:function(data){
                    location.reload();
                }
            });
        });
    });  
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('shop_layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\shoopp\kidolshop\resources\views/shop/customer/wishlist.blade.php ENDPATH**/ ?>