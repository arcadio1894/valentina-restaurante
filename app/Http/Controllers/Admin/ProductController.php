<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController as BaseController;
use App\Models\Product;
use App\Models\Productoption;
use App\Models\Productselection;
use App\Models\Category;
use App\Models\CategoryProduct;
use App\Http\Controllers\Admin\CategoryController;
use Illuminate\Support\Facades\DB;
use Log;

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
        'visibility'=>'required',
        'status'=>'required'
    ];
    const VALIDATION_MESSAGES = [
    	'type.required'=>'El <strong>TIPO</strong> de producto es requerido',
    	'code.required'=>'El <strong>CÓDIGO</strong> de producto es requerido',
    	'code.unique'=>'El <strong>CÓDIGO</strong> de producto debe ser único',
        'name.required'=>'El <strong>NOMBRE</strong> de producto es requerido',
        'description.required'=>'La <strong>DESCRIPCIÓN</strong> de producto es requerida',
        'price.required'=>'El <strong>PRECIO</strong> de producto es requerido',
        'initial_stock.required'=>'El <strong>STOCK</strong> de producto es requerido',
        'position.integer'=>'La <strong>POSICIÓN</strong> ingresada debe ser numérica',
        'visibility.required'=>'La <strong>VISIBILIDAD</strong> del producto es requerida',
        'status.required'=>'El <strong>ESTADO</strong> de producto es requerido'
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
        $rules =$this::VALIDATION_CONSTRAINTS;
    	$data = $request->all();
    	$categories = json_decode($data['categories']);
        $options = json_decode($data['options']);
        $rules['code'] = 'required|unique:products,code,,,deleted_at,NULL';
        $store = session('store');
        $data['store_id'] = $store;

        if(isset($data['product_id'])){
            $productToUpdate = Product::findOrFail($data['product_id']);
            $rules['code'] = 'required|unique:products,code,'.$data['product_id'].',id,deleted_at,NULL';
            $data['type'] = $productToUpdate->type;
            $data['visibility'] = $productToUpdate->visibility;
        }else{
            if($data['type'] === 'bundle'){
                $data['visibility'] = 'catalog';
            }
        }

    	$validator = \Validator::make($data,$rules,$this::VALIDATION_MESSAGES);

        if(empty($categories)){
            $validator->errors()->add('categories','Debe asociar el producto a una <strong>CATEGORÍA</strong>');
        }

        if(empty($options) && $data['type'] === 'bundle'){
            $validator->errors()->add('options','Debe asociar el producto a sus <strong>OPCIONES</strong>');
        }

        if(!empty($validator->errors()->getMessages())){
    	   $response['errors'] = $validator->errors()->getMessages();

            return response()->json($response);
        }

    	$data['stock'] = $data['initial_stock'];
    	unset($data['image']);
    	unset($data['small_image']);
    	unset($data['categories']);

        DB::beginTransaction();

        try{
            if(isset($data['product_id'])){
                $product = $productToUpdate;
            }else{
                $product = new Product();
            }

            $product->store_id      = $data['store_id'];
            $product->code          = $data['code'];
            $product->name          = $data['name'];
            $product->description   = $data['description'];
            $product->type          = $data['type'];
            $product->price         = $data['price'];
            $product->initial_stock = $data['initial_stock'];
            $product->stock         = $data['stock'];
            $product->position      = $data['position'];
            $product->visibility    = $data['visibility'];
            $product->status        = $data['status'];
            $product->save();

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

            $product->categories()->sync($categories);

            if(isset($data['product_id'])){
                $optionIds = $product->optionIds();
                $optionsToUpdate = array();
                $selectionsToDelete = array();
            }

            foreach ($options as $option) {
                $selectionsToUpdate = array();
                $selectionIds = array();

                if($option->id){
                    array_push($optionsToUpdate, $option->id);
                    $newOption = Productoption::findOrFail($option->id);
                    $selectionIds = $newOption->selectionIds();
                }else{
                    $newOption = new Productoption();
                }

                $newOption->parent_id   = $product->id;
                $newOption->title       = $option->title;
                $newOption->is_required = $option->is_required;
                $newOption->position    = $option->position;
                $newOption->type        = $option->type;
                $newOption->save();

                foreach ($option->selections as $selection) {
                    if($selection->id){
                        array_push($selectionsToUpdate, $selection->id);
                        $newSelection = Productselection::findOrFail($selection->id);
                    }else{
                        $newSelection = new Productselection();
                    }
                   
                    $newSelection->option_id  = $newOption->id;
                    $newSelection->position   = $selection->position;
                    $newSelection->is_default = $selection->is_default;
                    $newSelection->price      = $selection->price;
                    $newSelection->qty        = $selection->qty;
                    $newSelection->parent_product_id = $product->id;
                    $newSelection->product_id = $selection->product_id;
                    $newSelection->save();
                }

                if(!empty($selectionIds)){
                    array_push($selectionsToDelete, array_diff($selectionIds, $selectionsToUpdate));
                }
            }

            if(isset($data['product_id'])){
                $optionsToDelete = array_diff($optionIds, $optionsToUpdate);

                foreach ($optionsToDelete as $optionId) {
                    Productoption::findOrFail($optionId)->delete();
                }

                foreach ($selectionsToDelete as $selectionArray) {
                    foreach ($selectionArray as $selectionId) {
                        Productselection::findOrFail($selectionId)->delete();
                    }
                }
            }

            $response['success'] = true;
            $response['message'] = 'Registro satisfactorio';
            $response['url'] = route('admins.product.index');
            DB::commit();
        }catch(\Exception $e){
            Log::debug($e);
            $response['errors'] = ['general'=>[$e->getMessage()]];
            DB::rollback();
        }

    	return response()->json($response);
    }

    public function edit($id){
        $product = Product::find($id);
        $categoryController = new CategoryController();
        $htmlCategories = $categoryController->getCategoryData(true,$product->getCategoryIds());

        return view('admin.product.update')->with(compact('htmlCategories','product'));
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
        $id = $request->get('id');
        $name = $request->get('name');
        $code = $request->get('code');
        $minPrice = $request->get('min_price');
        $maxprice = $request->get('max_price');

    	$products = Product::where('status','enabled')->where('type','simple')->where('visibility','bundle');

        if($id){
            $products->where('id',$id);
        }

        if($name){
            $products->where('name','like',"%$name%");
        }

        if($code){
            $products->where('code','like',"%$code%");
        }

        if($minPrice){
            $products->where('price','>=',$minPrice);
        }

        if($maxprice){
            $products->where('price','<=',$maxprice);
        }

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