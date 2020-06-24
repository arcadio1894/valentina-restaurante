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

            $product->categories()->sync($categories);

            foreach ($options as $option) {
                $newOption = Productoption::create([
                    'parent_id' => $product->id,
                    'title' => $option->title,
                    'is_required' => $option->is_required,
                    'position' => $option->position,
                    'type' => $option->type
                ]);

                foreach ($option->selections as $selection) {
                    Productselection::create([
                        'option_id' => $newOption->id,
                        'position' => $selection->position,
                        'is_default' => $selection->is_default,
                        'price' => $selection->price,
                        'qty' => $selection->qty,
                        'parent_product_id' => $product->id,
                        'product_id' => $selection->product_id
                    ]);
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