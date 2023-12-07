@extends('shop_layout')
@section('content')

<!--Page Banner Start-->
<div class="page-banner" style="background-image: url(public/ericshop/images/banner/banner1.png);">
    <div class="container">
        <div class="page-banner-content text-center">
            <h2 class="title">Giới thiệu</h2>
            <ol class="breadcrumb justify-content-center">
                <li class="breadcrumb-item"><a href="{{URL::to('/home')}}">Trang chủ</a></li>
                <li class="breadcrumb-item active" aria-current="page">Giới thiệu</li>
            </ol>
        </div>
    </div>
</div>
<!--Page Banner End-->

<div class="empty-cart-page section-padding-5">
    <div class="container">
        <div class="row flex-row-reverse">
            <div class="col-lg-6">
                <div class="img-about" >
                <img src="public/ericshop/images/about1.png" alt="About Us Image" class="img-fluid" >
                </div>
            </div>
            <div class="col-lg-6" style="text-align: justify;">
            <h3>Về chúng tôi</h3>
            <h4>Chào mừng bạn đến với <span style="color: brown;"><a href="{{URL::to('/home')}}">EricShop</a></span>!</h4>
                <p>Chúng tôi là một cộng đồng đam mê giày dép, không chỉ đơn thuần là một cửa hàng bán giày mà còn là ngôi nhà của những đam mê và phong cách. 
                   Tại đây, chúng tôi tin rằng mỗi đôi giày không chỉ là một vật dụng mà còn là một biểu tượng của cá tính và phong cách cá nhân.
                   Với nền tảng vững chắc của chất lượng và sự đa dạng, chúng tôi tự hào mang đến cho khách hàng một trải nghiệm mua sắm độc đáo. 
                   Bộ sưu tập của chúng tôi không chỉ bao gồm những xu hướng mới nhất mà còn tập trung vào việc thể hiện cá tính và phong cách riêng biệt của mỗi người.
                   Chúng tôi không ngừng nỗ lực để tìm kiếm những thương hiệu uy tín và những mẫu giày độc đáo từ khắp nơi trên thế giới. 
                   Từ những thiết kế tinh tế của các nhãn hiệu danh tiếng đến sự sáng tạo từ những nhà thiết kế độc lập, mỗi đôi giày tại cửa hàng của 
                   chúng tôi đều được chọn lựa cẩn thận với tiêu chí vừa vặn, thoải mái và sang trọng.Chúng tôi không chỉ muốn bán giày, mà còn muốn kết nối, 
                   lan tỏa niềm đam mê và phong cách qua từng sản phẩm. Chúng tôi tin rằng mỗi đôi giày là một câu chuyện, và chúng tôi muốn bạn trở thành 
                   người kể chuyện đầy tự hào về đôi giày của mình.</p>
            </div>
                <p style="text-align: justify;">Chất lượng không chỉ xuất phát từ sản phẩm, mà còn từ trải nghiệm mua sắm và sự hỗ trợ chăm sóc khách hàng mà chúng tôi mang lại. 
                    Đội ngũ của chúng tôi luôn sẵn sàng lắng nghe và hỗ trợ bạn trong mọi vấn đề liên quan đến sản phẩm và dịch vụ của chúng tôi.<br>
                    Chúng tôi hy vọng rằng, bằng cách chia sẻ niềm đam mê và tư vấn chân thành, chúng tôi có thể trở thành người bạn đồng hành tin 
                    cậy trong hành trình tìm kiếm phong cách và sự tự tin.</p>
            <div>
                <img src="public/ericshop/images/about2.png" alt="About Us Image" class="img-fluid" >
            </div>
            <div style="margin-top: 10px;">
                <img src="public/ericshop/images/about3.png" alt="About Us Image" class="img-fluid" >
            </div>
        </div>
    </div>
</div>

@endsection