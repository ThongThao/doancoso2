@extends('admin_layout')
@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Hướng dẫn cấu hình Casso VietQR</h3>
                </div>
                <div class="card-body">
                    <div class="alert alert-info">
                        <h5><i class="icon fas fa-info"></i> Thông tin!</h5>
                        Để sử dụng thanh toán Casso VietQR, bạn cần thực hiện các bước sau:
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h4>Bước 1: Đăng ký tài khoản Casso</h4>
                                </div>
                                <div class="card-body">
                                    <ol>
                                        <li>Truy cập <a href="https://casso.vn" target="_blank">https://casso.vn</a></li>
                                        <li>Đăng ký tài khoản doanh nghiệp</li>
                                        <li>Xác thực tài khoản ngân hàng</li>
                                        <li>Lấy API Key và API Secret</li>
                                    </ol>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h4>Bước 2: Cấu hình .env</h4>
                                </div>
                                <div class="card-body">
                                    <p>Thêm các biến môi trường sau vào file <code>.env</code>:</p>
                                    <pre><code>CASSO_API_KEY=your_casso_api_key
CASSO_API_SECRET=your_casso_api_secret
CASSO_BANK_ACCOUNT=your_bank_account_number
CASSO_BANK_ID=970415
CASSO_ACCOUNT_NAME=your_account_name</code></pre>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4>Bước 3: Mã ngân hàng hỗ trợ</h4>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Ngân hàng</th>
                                                    <th>Mã ngân hàng</th>
                                                    <th>Tên viết tắt</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>Vietinbank</td>
                                                    <td>970415</td>
                                                    <td>ICB</td>
                                                </tr>
                                                <tr>
                                                    <td>Vietcombank</td>
                                                    <td>970436</td>
                                                    <td>VCB</td>
                                                </tr>
                                                <tr>
                                                    <td>BIDV</td>
                                                    <td>970418</td>
                                                    <td>BIDV</td>
                                                </tr>
                                                <tr>
                                                    <td>Techcombank</td>
                                                    <td>970407</td>
                                                    <td>TCB</td>
                                                </tr>
                                                <tr>
                                                    <td>ACB</td>
                                                    <td>970416</td>
                                                    <td>ACB</td>
                                                </tr>
                                                <tr>
                                                    <td>VPBank</td>
                                                    <td>970432</td>
                                                    <td>VPB</td>
                                                </tr>
                                                <tr>
                                                    <td>TPBank</td>
                                                    <td>970423</td>
                                                    <td>TPB</td>
                                                </tr>
                                                <tr>
                                                    <td>Sacombank</td>
                                                    <td>970403</td>
                                                    <td>STB</td>
                                                </tr>
                                                <tr>
                                                    <td>MBBank</td>
                                                    <td>970422</td>
                                                    <td>MBB</td>
                                                </tr>
                                                <tr>
                                                    <td>AgriBank</td>
                                                    <td>970405</td>
                                                    <td>AGB</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4>Bước 4: Webhook URL (Tùy chọn)</h4>
                                </div>
                                <div class="card-body">
                                    <p>Để nhận thông báo real-time từ Casso, hãy cấu hình webhook URL:</p>
                                    <div class="input-group">
                                        <input type="text" class="form-control" value="{{ url('/casso/webhook') }}" readonly>
                                        <div class="input-group-append">
                                            <button class="btn btn-outline-secondary" type="button" onclick="copyToClipboard(this)">Copy</button>
                                        </div>
                                    </div>
                                    <small class="text-muted">Thêm URL này vào cấu hình webhook trong tài khoản Casso của bạn</small>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="alert alert-success">
                                <h5><i class="icon fas fa-check"></i> Hoàn thành!</h5>
                                Sau khi cấu hình xong, khách hàng có thể sử dụng phương thức "Chuyển khoản qua VietQR" khi thanh toán.
                                Hệ thống sẽ tự động tạo mã QR và kiểm tra giao dịch.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function copyToClipboard(button) {
    const input = button.parentElement.previousElementSibling;
    input.select();
    input.setSelectionRange(0, 99999);
    document.execCommand("copy");
    
    const originalText = button.textContent;
    button.textContent = "Copied!";
    button.classList.remove("btn-outline-secondary");
    button.classList.add("btn-success");
    
    setTimeout(function() {
        button.textContent = originalText;
        button.classList.remove("btn-success");
        button.classList.add("btn-outline-secondary");
    }, 2000);
}
</script>

@endsection
