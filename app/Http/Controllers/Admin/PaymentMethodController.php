<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController as BaseController;
use App\Models\PaymentMethod;
use Illuminate\Support\Facades\DB;
use Log;

class PaymentMethodController extends BaseController
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
    	$paymentmethods = PaymentMethod::all();

    	return view('admin.paymentmethod.index')->with(compact('paymentmethods'));
    }

    public function create(){
    	return view('admin.paymentmethod.create');
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

        if(isset($data['paymentmethod_id'])){
            $paymentmethod = PaymentMethod::findOrFail($data['paymentmethod_id']);
        }else{
            $paymentmethod = new PaymentMethod();
        }

    	unset($data['image']);

        $paymentmethod->store_id = $data['store_id'];
        $paymentmethod->name     = $data['name'];
        $paymentmethod->position = $data['position'];
        $paymentmethod->status   = $data['status'];
        $paymentmethod->save();

        if($request->hasFile('image')){
            $image     = $request->file('image');
            $extension = $image->getClientOriginalExtension();
            $filename  = $paymentmethod->id . '.' . $extension;
            $path      = public_path().'/admin/assets/images/paymentmethod';
            $image->move($path,$filename);
            $paymentmethod->image = $filename;
            $paymentmethod->save();
        }

        $response['success'] = true;
        $response['message'] = 'Registro satisfactorio';
        $response['url'] = route('admins.paymentmethod.index');

    	return response()->json($response);
    }

    public function edit($id){
        $paymentmethod = PaymentMethod::find($id);

        return view('admin.paymentmethod.create')->with(compact('paymentmethod'));
    }

    public function delete(Request $request){
    	$id = $request->get('id');
 		$paymentmethod = PaymentMethod::findOrFail($id);
 		$paymentmethod->delete();

 		$response['success'] = true;
    	$response['message'] = 'Eliminación correcta';
    	$response['url'] = route('admins.paymentmethod.index');

    	return response()->json($response);
    }
}