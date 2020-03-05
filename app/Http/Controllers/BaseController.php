<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\View;

class BaseController extends Controller{
    public function __construct(){
    	$stores = \App\Models\Store::where('status','enabled')->orderBy('id','desc')->select(['id','name'])->get();

    	if(count($stores) > 0 && ! \Session::has('store')){
    		session(['store'=>$stores[0]]);
    	}

    	View::share('stores', $stores);
  	}
}