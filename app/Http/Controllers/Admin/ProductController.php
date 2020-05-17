<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController as BaseController;
use App\Models\Product;
use App\Models\Category;
use App\Models\CategoryProduct;
use App\Http\Controllers\Admin\CategoryController;

class ProductController extends BaseController
{
	const VALIDATION_CONSTRAINTS = [
		'type'=>'required',
		'code'=>'required|unique:products,code',
        'name'=>'required',
        'description'=>'required',
        'price'=>'required|min:0',
        'initial_stock'=>'required|min:0',
        'position'=>'integer',
        'status'=>'required'
    ];
    const VALIDATION_MESSAGES = [
    	'type.required'=>'El <b>TIPO</b> de producto es requerido',
    	'code.required'=>'El <b>CÓDIGO</b> de producto es requerido',
    	'code.unique'=>'El <b>CÓDIGO</b> de producto debe ser único',
        'name.required'=>'El <b>NOMBRE</b> de producto es requerido',
        'description.required'=>'La <b>DESCRIPCIÓN</b> de producto es requerida',
        'price.required'=>'El <b>PRECIO</b> de producto es requerido',
        'initial_stock.required'=>'El <b>STOCK</b> de producto es requerido',
        'position.integer'=>'La <b>POSICIÓN</b> ingresada debe ser numérica',
        'status.required'=>'El <b>ESTADO</b> de producto es requerido'
    ];

    public function index(){
    	$products = Product::all();

    	return view('admin.product.index')->with(compact('products'));
    }

    public function create(){
    	$categoryController = new CategoryController();
    	$htmlCategories = $categoryController->getCategoryData(true);

    	return view('admin.product.create')->with(compact('htmlCategories'));
    }

    public function store(Request $request){
    	$response = [
            'success'=>false,
            'errors'=>[],
            'message'=>'',
            'url'=>''
        ];

    	$data = $request->all();
    	$categories = json_decode($data['categories']);
    	$validator = \Validator::make($data,$this::VALIDATION_CONSTRAINTS,$this::VALIDATION_MESSAGES);

    	if($validator->fails()){
    		$response['errors'] = $validator->errors();

    		return response()->json($response);
    	}

    	$data['stock'] = $data['initial_stock'];
    	unset($data['image']);
    	unset($data['small_image']);
    	unset($data['categories']);

    	$product = Product::create($data);

		if($request->hasFile('image') || $request->hasFile('small_image')){
			if($request->hasFile('image')){
	    		$image     = $request->file('image');
	    		$extension = $image->getClientOriginalExtension();
	            $filename  = $product->id . '.' . $extension;
	    		$path      = public_path().'/admin/assets/images/product';
	    		$image->move($path,$filename);
	    		$product->image = $filename;
    		}

    		if($request->hasFile('small_image')){
	    		$image     = $request->file('small_image');
	    		$extension = $image->getClientOriginalExtension();
	            $filename  = $product->id . '_small.' . $extension;
	    		$path      = public_path().'/admin/assets/images/product';
	    		$image->move($path,$filename);
	    		$product->small_image = $filename;
    		}

    		$product->save();
    	}

    	if(count($categories)>0){
    		$product->categories()->sync($categories);
    	}

    	$response['success'] = true;
    	$response['message'] = 'Registro satisfactorio';
    	$response['url'] = route('admins.product.index');

    	return response()->json($response);
    }

    public function edit(){

    }

    public function delete(Request $request){
    	$id = $request->get('id');
 		$product = Product::findOrFail($id);
 		$product->categories()->detach();
 		$product->delete();

 		$response['success'] = true;
    	$response['message'] = 'Eliminación correcta';
    	$response['url'] = route('admins.product.index');

    	return response()->json($response);
    }

    public function filterableProducts(Request $request){
    	$ids = $request->get('ids');
    	$products = Product::where('status','enabled')->where('type','simple');

    	if($ids && count($ids)>0){
    		$products->whereNotIn('id',$ids);
    	}

    	$products = $products->orderBy('name')->get();
    	$elements = count($products);
    	$response['count'] = $elements;
    	$response['data']  = $products;

    	return response()->json($response);
    }
}