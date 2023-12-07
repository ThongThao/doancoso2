<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\Brand;
use Illuminate\Http\Request;

class AboutUsController extends Controller
{
    public function about()
    {
        $list_category = Category::get();
        $list_brand = Brand::get();

        return view('shop.about.about_us')->with(compact('list_category','list_brand'));
    }
}
