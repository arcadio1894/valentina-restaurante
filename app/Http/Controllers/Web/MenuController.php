<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Productoption;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index($slug = null)
    {
        $categories = Category::whereNull('parent_id')->where('status','enabled')->orderBy('position')->get();

        if($slug){
            $categories = Category::where('slug',$slug)->whereNull('parent_id')->where('status','enabled')->get();
        }

        return view('web.menu.index', compact('categories'));
    }

    public function productDetail($categorySlug, $productSlug)
    {
        $product = Product::where('slug',$productSlug)->first();
        //dd($product->options[0]->selections[0]->product);

        return view('web.menu.product-detail', compact('product'));

    }

}
