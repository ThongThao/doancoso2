<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class CassoService
{
    private $apiKey;
    private $apiSecret;
    private $bankAccount;
    private $bankId;
    private $accountName;
    
    public function __construct()
    {
        $this->apiKey = env('CASSO_API_KEY');
        $this->apiSecret = env('CASSO_API_SECRET');
        $this->bankAccount = env('CASSO_BANK_ACCOUNT');
        $this->bankId = env('CASSO_BANK_ID', '970422'); // Default MBBank
        $this->accountName = env('CASSO_ACCOUNT_NAME');
    }

    /**
     * Tạo mã QR VietQR cho thanh toán
     */
    public function generateVietQR($amount, $description, $orderId = null)
    {
        try {
            $url = "https://api.vietqr.io/v2/generate";
            
            $payload = [
                "accountNo" => $this->bankAccount,
                "accountName" => $this->accountName,
                "acqId" => $this->bankId,
                "amount" => $amount,
                "addInfo" => $description . ($orderId ? " - DH{$orderId}" : ""),
                "format" => "text",
                "template" => "compact"
            ];

            $response = Http::timeout(30)->post($url, $payload);

            if ($response->successful()) {
                $data = $response->json();
                if ($data['code'] === '00') {
                    return [
                        'success' => true,
                        'qr_code' => $data['data']['qrCode'],
                        'qr_data_url' => $data['data']['qrDataURL'],
                        'bank_info' => [
                            'account_no' => $this->bankAccount,
                            'account_name' => $this->accountName,
                            'bank_id' => $this->bankId,
                            'amount' => $amount,
                            'description' => $description
                        ]
                    ];
                }
            }

            return [
                'success' => false,
                'message' => 'Không thể tạo mã QR'
            ];

        } catch (\Exception $e) {
            Log::error('VietQR Generation Error: ' . $e->getMessage());
            return [
                'success' => false,
                'message' => 'Lỗi hệ thống khi tạo mã QR'
            ];
        }
    }

    /**
     * Kiểm tra giao dịch từ Casso
     */
    public function checkTransaction($amount, $description, $fromDate = null, $toDate = null)
    {
        try {
            $headers = [
                'Authorization' => 'Apikey ' . $this->apiKey,
                'Content-Type' => 'application/json',
            ];

            $params = [
                'sort' => 'DESC',
                'pageSize' => 20,
                'page' => 1
            ];

            if ($fromDate) {
                // Chuyển đổi sang format yyyy-MM-dd mà Casso yêu cầu
                $params['fromDate'] = date('Y-m-d', strtotime($fromDate));
            }
            if ($toDate) {
                // Chuyển đổi sang format yyyy-MM-dd mà Casso yêu cầu
                $params['toDate'] = date('Y-m-d', strtotime($toDate));
            }

            $url = "https://oauth.casso.vn/v2/transactions?" . http_build_query($params);
            
            $response = Http::withHeaders($headers)->get($url);

            if ($response->successful()) {
                $data = $response->json();
                
                if (isset($data['data']['records'])) {
                    foreach ($data['data']['records'] as $transaction) {
                        // Kiểm tra số tiền
                        if ($transaction['amount'] == $amount) {
                            // Tìm order ID trong description của giao dịch
                            $transactionDesc = $transaction['description'];
                            
                            // Tìm pattern DH + timestamp + customer_id
                            if (preg_match('/DH\d+/', $transactionDesc, $matches)) {
                                $orderIdInTransaction = $matches[0];
                                
                                // So sánh với order ID đang tìm
                                if (strpos($description, $orderIdInTransaction) !== false) {
                                    return [
                                        'success' => true,
                                        'transaction' => $transaction,
                                        'found' => true
                                    ];
                                }
                            }
                            
                            // Backup: kiểm tra bằng cách tìm description chứa order info
                            if (strpos($transactionDesc, $description) !== false ||
                                strpos($description, $transactionDesc) !== false) {
                                return [
                                    'success' => true,
                                    'transaction' => $transaction,
                                    'found' => true
                                ];
                            }
                        }
                    }
                }

                return [
                    'success' => true,
                    'found' => false,
                    'message' => 'Không tìm thấy giao dịch phù hợp'
                ];
            }

            return [
                'success' => false,
                'message' => 'Không thể kết nối đến Casso API'
            ];

        } catch (\Exception $e) {
            Log::error('Casso Transaction Check Error: ' . $e->getMessage());
            return [
                'success' => false,
                'message' => 'Lỗi hệ thống khi kiểm tra giao dịch'
            ];
        }
    }

    /**
     * Lấy danh sách ngân hàng hỗ trợ VietQR
     */
    public function getBanks()
    {
        try {
            $response = Http::get('https://api.vietqr.io/v2/banks');
            
            if ($response->successful()) {
                $data = $response->json();
                if ($data['code'] === '00') {
                    return [
                        'success' => true,
                        'banks' => $data['data']
                    ];
                }
            }

            return [
                'success' => false,
                'message' => 'Không thể lấy danh sách ngân hàng'
            ];

        } catch (\Exception $e) {
            Log::error('Get Banks Error: ' . $e->getMessage());
            return [
                'success' => false,
                'message' => 'Lỗi hệ thống'
            ];
        }
    }

    /**
     * Tạo webhook URL để nhận thông báo từ Casso
     */
    public function setupWebhook($webhookUrl)
    {
        try {
            $headers = [
                'Authorization' => 'Apikey ' . $this->apiKey,
                'Content-Type' => 'application/json',
            ];

            $payload = [
                'webhook' => $webhookUrl,
                'secure_token' => hash_hmac('sha256', $webhookUrl, $this->apiSecret)
            ];

            $response = Http::withHeaders($headers)->post('https://oauth.casso.vn/v2/sync', $payload);

            if ($response->successful()) {
                return [
                    'success' => true,
                    'message' => 'Webhook đã được thiết lập thành công'
                ];
            }

            return [
                'success' => false,
                'message' => 'Không thể thiết lập webhook'
            ];

        } catch (\Exception $e) {
            Log::error('Webhook Setup Error: ' . $e->getMessage());
            return [
                'success' => false,
                'message' => 'Lỗi hệ thống khi thiết lập webhook'
            ];
        }
    }
}
