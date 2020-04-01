<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController as BaseController;
use App\Models\Product;
use App\Models\Category;

class ProductController extends BaseController
{
    public function index(){
    	$products = Product::where('status','enabled')->get();

    	return view('admin.product.index')->with(compact('products'));
    }

    public function create(){
    	//$categories = Category::get()->groupBy('status')->dd();

    	return view('admin.product.create')->with(compact('categories'));
    }
}
