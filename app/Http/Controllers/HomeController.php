<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Blog;
use App\Models\Viewer;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    // Chuyển đến trang chủ
    public function index(){
        $list_category = Category::get();
        $list_brand = Brand::get();
        $list_blog = Blog::where('Status','1')->get();

        $sub30days = Carbon::now()->subDays(30)->toDateString();
        if(Session::get('idCustomer') == '') $idCustomer = session()->getId();
        else $idCustomer = Session::get('idCustomer');

        $list_new_pd = Product::join('productimage','productimage.idProduct','=','product.idProduct')
            ->whereBetween('product.created_at',[$sub30days,now()])->where('StatusPro','1')->get();

        $list_featured_pd = Product::join('productimage','productimage.idProduct','=','product.idProduct')
            ->whereBetween('product.created_at',[$sub30days,now()])->where('StatusPro','1')->orderBy('Sold','DESC')->get();

        $list_bestsellers_pd = Product::join('productimage','productimage.idProduct','=','product.idProduct')
        ->where('StatusPro','1')->orderBy('Sold','DESC')->get();     

        $recommend_pds = $list_new_pd;

        return view('shop.home')->with(compact('list_category','list_brand','list_new_pd','list_featured_pd','list_bestsellers_pd','list_blog','recommend_pds'));
    }
}
