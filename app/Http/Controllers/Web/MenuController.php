<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index()
    {
        $categories_products = Category::with('products')->whereHas('products', function($q){
            $q->where('visibility', 'catalog');
        })->where('parent_id', null)->get();

        //dd($categories_products_simple);

        return view('web.menu.index', compact('categories_products'));
    }

    public function productSimple($name, $id)
    {
        //dd($id);
        $product = Product::with('categories')->find($id);
        //dd($product);

        return view('web.menu.productSimple', compact('product'));

    }


    public function productBundle($name, $id)
    {}
}
