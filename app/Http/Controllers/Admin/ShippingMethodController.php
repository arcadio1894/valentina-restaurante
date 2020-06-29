<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController as BaseController;
use App\Models\ShippingMethod;
use Illuminate\Support\Facades\DB;
use Log;

class ShippingMethodController extends BaseController
{
	const VALIDATION_CONSTRAINTS = [
        'name'=>'required',
        'position'=>'required|integer',
        'status'=>'required'
    ];
    const VALIDATION_MESSAGES = [
        'name.required'=>'El <strong>NOMBRE</strong> es requerido',
        'position.required'=>'La <strong>POSICIÓN</strong> es requerida',
        'position.integer'=>'La <strong>POSICIÓN</strong> ingresada debe ser numérica',
        'status.required'=>'El <strong>ESTADO</strong> es requerido'
    ];

    public function index(){
    	$shippingmethods = ShippingMethod::all();

    	return view('admin.shippingmethod.index')->with(compact('shippingmethods'));
    }

    public function create(){
    	return view('admin.shippingmethod.create');
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
        $store = session('store');
        $data['store_id'] = $store;

    	$validator = \Validator::make($data,$rules,$this::VALIDATION_MESSAGES);

        if(!empty($validator->errors()->getMessages())){
    	    $response['errors'] = $validator->errors()->getMessages();

            return response()->json($response);
        }

        if(isset($data['shippingmethod_id'])){
            $shippingmethod = ShippingMethod::findOrFail($data['shippingmethod_id']);
        }else{
            $shippingmethod = new ShippingMethod();
        }

    	unset($data['image']);

        $shippingmethod->store_id = $data['store_id'];
        $shippingmethod->name     = $data['name'];
        $shippingmethod->position = $data['position'];
        $shippingmethod->status   = $data['status'];
        $shippingmethod->save();

        if($request->hasFile('image')){
            $image     = $request->file('image');
            $extension = $image->getClientOriginalExtension();
            $filename  = $shippingmethod->id . '.' . $extension;
            $path      = public_path().'/admin/assets/images/shippingmethod';
            $image->move($path,$filename);
            $shippingmethod->image = $filename;
            $shippingmethod->save();
        }

        $response['success'] = true;
        $response['message'] = 'Registro satisfactorio';
        $response['url'] = route('admins.shippingmethod.index');

    	return response()->json($response);
    }

    public function edit($id){
        $shippingmethod = ShippingMethod::find($id);

        return view('admin.shippingmethod.create')->with(compact('shippingmethod'));
    }

    public function delete(Request $request){
    	$id = $request->get('id');
 		$shippingmethod = ShippingMethod::findOrFail($id);
 		$shippingmethod->delete();

 		$response['success'] = true;
    	$response['message'] = 'Eliminación correcta';
    	$response['url'] = route('admins.shippingmethod.index');

    	return response()->json($response);
    }
}