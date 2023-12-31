<?php

namespace App\Http\Controllers;

use App\Models\AddressCustomer;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Cart;

use App\Models\Bill;
use App\Models\BillHistory;
use App\Models\BillInfo;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    function array_zip_merge() {
        $output = array();
        for ($args = func_get_args(); count($args); $args = array_filter($args)) {
          foreach ($args as &$arg) {
            $output[] = array_shift($arg);
          }
        }
        return $output;
    }  

    // Kiểm tra đăng nhập
    public function checkLogin(){
        $idCustomer = Session::get('idCustomer');
        if($idCustomer == false) return Redirect::to('login')->send();
    }
    
    // Kiểm tra giỏ hàng
    public function checkCart(){
        $check_cart = Cart::where('idCustomer',Session::get('idCustomer'))->count();
        if($check_cart <= 0) Redirect::to('empty-cart')->send();
    }

    // Chuyển đến trang giỏ hàng
    public function show_cart(){
        $this->checkLogin();
        $list_category = Category::get();
        $list_brand = Brand::get();
    
        $list_pd_cart = Cart::join('product','product.idProduct','=','cart.idProduct')
            ->join('productimage','productimage.idProduct','cart.idProduct')
            ->join('product_attribute','product_attribute.idProAttr','=','cart.idProAttr')
            ->where('idCustomer',Session::get('idCustomer'))->get();
    
        foreach($list_pd_cart as $key => $pd_cart){
            $idBrand = $pd_cart->idBrand;
            $idCategory = $pd_cart->idCategory;
    
            $list_recommend_pds = Product::whereRaw("MATCH (ProductName) AGAINST (?)", Product::fullTextWildcards($pd_cart->ProductName))
         ->where('StatusPro','1')
                ->select('idProduct');
            $list_recommend_pds->where(function ($list_recommend_pds) use ($idBrand, $idCategory){
                $list_recommend_pds->orWhere('idBrand',$idBrand)->orWhere('idCategory',$idCategory);
            });
            $list_recommend_pd = $list_recommend_pds->get();
    
            foreach($list_recommend_pd as $recommend_pd){
                $recommend_pds_array[$key][] = $recommend_pd->idProduct;
            }   
    
            $recommend_pds_arrays[] = $recommend_pds_array[$key];
        }
    

        for ($args = $recommend_pds_arrays; count($args); $args = array_filter($args)) {
            foreach ($args as &$arg) {
              $output[] = array_shift($arg);
            }
        }
    
        $recommend_pds = json_encode($output);
    
        return view("shop.cart.cart")->with(compact('list_category','list_brand','list_pd_cart','recommend_pds'));
    }
    

    // Gợi ý sản phẩm trang giỏ hàng
    public static function get_product($idProduct){
        return Product::join('productimage','productimage.idProduct','=','product.idProduct')
            ->where('product.idProduct',$idProduct)->select('ImageName','product.*')->first();
    }

    // Chuyển đến trang thanh toán
    public function payment(){
        $this->checkLogin();
        $this->checkCart();
        $list_category = Category::get();
        $list_brand = Brand::get();

        $list_pd_cart = Cart::join('product','product.idProduct','=','cart.idProduct')
            ->join('productimage','productimage.idProduct','cart.idProduct')
            ->join('product_attribute','product_attribute.idProAttr','=','cart.idProAttr')
            ->where('idCustomer',Session::get('idCustomer'))->get();

        return view("shop.cart.payment")->with(compact('list_category','list_brand','list_pd_cart'));
    }

    // Chuyển đến trang giỏ hàng trống
    public function empty_cart(){
        $list_category = Category::get();
        $list_brand = Brand::get();
        return view("shop.cart.empty-cart")->with(compact('list_category','list_brand'));
    }

    // Chuyển đến trang đặt hàng thành công
    public function success_order(Request $request){
        $list_category = Category::get();
        $list_brand = Brand::get();
        if($request->vnp_TransactionStatus && $request->vnp_TransactionStatus == '00'){
            // $test = dd($request->toArray());
            $Bill = new Bill();
            $BillHistory = new BillHistory();
            $OrderInfo = explode("_",$request->vnp_OrderInfo);

            $get_address = AddressCustomer::find($OrderInfo[0]);
            $Bill->idCustomer = $OrderInfo[2];
            $Bill->TotalBill = $request->vnp_Amount/100;
            $Bill->Address = $get_address->Address;
            $Bill->PhoneNumber = $get_address->PhoneNumber;
            $Bill->CustomerName = $get_address->CustomerName;
            $Bill->Status = 1;
            $Bill->Payment = 'vnpay';
    
            $Bill->save();
            $get_Bill = Bill::where('created_at', now())->where('idCustomer',$OrderInfo[2])->first();
            $get_cart = Cart::where('idCustomer',$OrderInfo[2])->get();
    
            foreach($get_cart as $key => $cart)
            {
                $data_billinfo = array(
                    'idBill' => $get_Bill->idBill,
                    'idProduct' => $cart->idProduct,
                    'AttributeProduct' => $cart->AttributeProduct,
                    'Price' => $cart->PriceNew,
                    'QuantityBuy' => $cart->QuantityBuy,
                    'idProAttr' => $cart->idProAttr,
                    'created_at' => now(),
                    'updated_at' => now()
                );
                BillInfo::insert($data_billinfo);
                DB::update(DB::RAW('update product set QuantityTotal = QuantityTotal - '.$cart->QuantityBuy.' where idProduct = '.$cart->idProduct.''));
                DB::update(DB::RAW('update product_attribute set Quantity = Quantity - '.$cart->QuantityBuy.' where idProAttr = '.$cart->idProAttr.''));
            }
            Cart::where('idCustomer',$OrderInfo[2])->delete();
            $BillHistory->idBill = $get_Bill->idBill;
            $BillHistory->AdminName = 'System';
            $BillHistory->Status = 1;
            $BillHistory->save();
            return view("shop.cart.success-order")->with(compact('list_category','list_brand'));
        }
        else if($request->vnp_TransactionStatus && $request->vnp_TransactionStatus != '00') 
            return Redirect::to('cart');
        else return view("shop.cart.success-order")->with(compact('list_category','list_brand'));
    }

    // Hiện giỏ hàng ở header
    public static function get_cart_header(){
        $sum_cart = Cart::where('idCustomer',Session::get('idCustomer'))->sum('QuantityBuy');

        $get_cart_header = Cart::join('product','product.idProduct','=','cart.idProduct')
            ->join('productimage','productimage.idProduct','cart.idProduct')
            ->where('cart.idCustomer',Session::get('idCustomer'))->get();
        return ['sum_cart' => $sum_cart, 'get_cart_header' => $get_cart_header];
    }

    // Mua ngay
    public function buy_now(Request $request){
        $this->checkLogin();

        $data = $request->all();
        $cart = new Cart();

        $cart->idProduct = $data['idProduct'];
        $cart->QuantityBuy = $data['qty_buy'];
        $cart->PriceNew = $data['PriceNew'];
        $cart->Total = $data['PriceNew']*$data['qty_buy'];
        $cart->idCustomer = Session::get('idCustomer');
        $cart->AttributeProduct = $data['AttributeProduct'];
        $cart->idProAttr = $data['idProAttr'];
        $qty_of_attr = $data['qty_of_attr'];

        $find_pd = Cart::where('idProduct',$data['idProduct'])->where('idCustomer',Session::get('idCustomer'))
            ->where('AttributeProduct',$data['AttributeProduct'])->first();

        if($find_pd){
            $QuantityBuy = $data['qty_buy'] + $find_pd->QuantityBuy;
            if($QuantityBuy > $qty_of_attr){
                return redirect()->back()->with('error', 'Vượt quá số lượng sản phẩm hiện có!');
            }else{
                $Total = $QuantityBuy * $data['PriceNew'];

                Cart::where('idProduct',$data['idProduct'])->where('idCustomer',Session::get('idCustomer'))
                    ->where('AttributeProduct',$data['AttributeProduct'])->update(['QuantityBuy' => $QuantityBuy, 'Total' => $Total]);
                
                return Redirect::to('cart')->send();
            }
        }else{
            $cart->save();
            return Redirect::to('cart')->send();
        }
    }

    // Thêm vào giỏ hàng
    public function add_to_cart(Request $request){
        $this->checkLogin();

        $data = $request->all();
        $cart = new Cart();

        $cart->idProduct = $data['idProduct'];
        $cart->QuantityBuy = $data['QuantityBuy'];
        $cart->PriceNew = $data['PriceNew'];
        $cart->Total = $data['PriceNew']*$data['QuantityBuy'];
        $cart->idCustomer = Session::get('idCustomer');
        $cart->AttributeProduct = $data['AttributeProduct'];
        $cart->idProAttr = $data['idProAttr'];
        $qty_of_attr = $data['qty_of_attr'];

        $output = '<div class="modal fade modal-AddToCart" id="successAddToCart" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true"><div class="modal-dialog modal-dialog-centered" role="document"><div class="modal-content"><div class="modal-header"><h5 class="modal-title" id="exampleModalCenterTitle">Thông báo</h5></div><button type="button" class="btn-close" data-dismiss="modal" aria-label="Close" aria-hidden="true"></span></button><div class="modal-body text-center p-3 h4"><div class="mb-3"><i class="fa fa-check-circle text-primary" style="font-size:50px;"></i></div>Đã thêm sản phẩm vào giỏ hàng</div><div class="modal-footer justify-content-center"><button type="button" class="btn btn-secondary" data-dismiss="modal">Tiếp tục mua sắm</button><a href="../cart" type="button" class="btn btn-primary">Đi đến giỏ hàng</a></div></div></div></div>';

        $find_pd = Cart::where('idProduct',$data['idProduct'])->where('idCustomer',Session::get('idCustomer'))
            ->where('AttributeProduct',$data['AttributeProduct'])->first();

        if($find_pd){
            $QuantityBuy = $data['QuantityBuy'] + $find_pd->QuantityBuy;
            if($QuantityBuy > $qty_of_attr){
                $output = '<div id="errorAddToCart" class="modal fade bd-example-modal-sm modal-AddToCart" tabindex="-1" role="dialog"  aria-hidden="true"><div class="modal-dialog modal-dialog-centered modal-sm"><div class="modal-content"><div class="modal-header"><h5 class="modal-title">Thông báo</h5></div><button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"></span></button><div class="modal-body"><p>Vượt quá số lượng sản phẩm hiện có!</p></div><div class="modal-footer justify-content-center"><button type="button" class="btn btn-secondary" data-dismiss="modal">OK</button></div></div></div></div>';
                echo $output;
            }else{
                $Total = $QuantityBuy * $data['PriceNew'];

                Cart::where('idProduct',$data['idProduct'])->where('idCustomer',Session::get('idCustomer'))
                    ->where('AttributeProduct',$data['AttributeProduct'])->update(['QuantityBuy' => $QuantityBuy, 'Total' => $Total]);

                echo $output;
            }
        }else{
            $cart->save();
            echo $output;
        }
    }

    // Xóa 1 sản phẩm trong giỏ hàng

    public function delete_pd_cart($idCart){
        Cart::find($idCart)->delete();
        if (Cart::count() > 0) {
            return redirect()->back();
        } else {
            return Redirect::to('empty-cart')->send();
        }
    }

    // Xóa giỏ hàng
    public function delete_cart(){
        Cart::truncate();
        return Redirect::to('empty-cart')->send();
    }

    // Cập nhật số lượng mua trong giỏ hàng
    public function update_qty_cart(Request $request){
        $this->checkCart();

        $data = $request->all();

        if($data['QuantityBuy'] > $data['Quantity']){
            Cart::where('idCart',$data['idCart'])
            ->update(array('QuantityBuy' => $data['Quantity'], 'Total' => $data['PriceNew']*$data['Quantity']));
        }else{
            Cart::where('idCart',$data['idCart'])
            ->update(array('QuantityBuy' => $data['QuantityBuy'], 'Total' => $data['PriceNew']*$data['QuantityBuy']));
        }
    }


    
    // Đặt hàng
    public function submit_payment(Request $request){
        $data = $request->all();
        $Bill = new Bill();

         if($data['checkout'] == 'cash'){
            $get_address = AddressCustomer::find($data['address_rdo']);
            $Bill->idCustomer = Session::get('idCustomer');
            $Bill->TotalBill = $data['TotalBill'];
            $Bill->Address = $get_address->Address;
            $Bill->PhoneNumber = $get_address->PhoneNumber;
            $Bill->CustomerName = $get_address->CustomerName;
            $Bill->Payment = 'cash';
    
            $Bill->save();
            $get_Bill = Bill::where('created_at', now())->where('idCustomer',Session::get('idCustomer'))->first();
            $get_cart = Cart::where('idCustomer',Session::get('idCustomer'))->get();
    
            foreach($get_cart as $key => $cart)
            {
                $data_billinfo = array(
                    'idBill' => $get_Bill->idBill,
                    'idProduct' => $cart->idProduct,
                    'AttributeProduct' => $cart->AttributeProduct,
                    'Price' => $cart->PriceNew,
                    'QuantityBuy' => $cart->QuantityBuy,
                    'idProAttr' => $cart->idProAttr,
                    'created_at' => now(),
                    'updated_at' => now()
                );
                BillInfo::insert($data_billinfo);
                DB::update(DB::RAW('update product set QuantityTotal = QuantityTotal - '.$cart->QuantityBuy.' where idProduct = '.$cart->idProduct.''));
                DB::update(DB::RAW('update product_attribute set Quantity = Quantity - '.$cart->QuantityBuy.' where idProAttr = '.$cart->idProAttr.''));
            }
    
           Cart::where('idCustomer',Session::get('idCustomer'))->delete();
            return Redirect::to('success-order')->send();
        }
    }
}
