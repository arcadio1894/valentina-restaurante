<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController as BaseController;
use App\Models\Product;
use App\Models\Category;
use App\Http\Controllers\Admin\CategoryController;

class ProductController extends BaseController
{
    public function index(){
    	$products = Product::where('status','enabled')->get();

    	return view('admin.product.index')->with(compact('products'));
    }

    public function create(){
    	$categoryController = new CategoryController();
    	$htmlCategories = $categoryController->getCategoryData(true);

    	return view('admin.product.create')->with(compact('htmlCategories'));
    }
}
