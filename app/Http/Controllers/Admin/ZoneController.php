<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController as BaseController;
use App\Models\Zone;

class ZoneController extends BaseController
{
    const VALIDATION_CONSTRAINTS = [
        'name'=>'required',
        'code'=>'required|unique:zones,code',
        'status'=>'required',
        'polygon'=>'required'
    ];
    const VALIDATION_MESSAGES = [
        'name.required'=>'El <b>NOMBRE</b> de la zona es requerido',
        'code.required'=>'El <b>CÓDIGO</b> de la zona es requerido',
        'code.unique'=>'El <b>CÓDIGO</b> de la zona debe ser único',
        'status.required'=>'El <b>ESTADO</b> de la zona es requerido',
        'polygon.required'=>'Debe trazar la <b>ZONA REPARTO</b>'
    ];

    function index(){
        $store = session('store');
    	$zones = Zone::all();

        if($store){
            $zones = Zone::where('store_id', $store)->get();
        }

    	return view('admin.zone.index')->with(compact('zones'));
    }

    function create(){
    	return view('admin.zone.create');
    }

    function store(Request $request){
    	$data = $request->all();
        $response = [
            'success'=>false,
            'errors'=>[],
            'message'=>'',
            'url'=>''
        ];
        $validator = \Validator::make(
            $data,$this::VALIDATION_CONSTRAINTS,$this::VALIDATION_MESSAGES
        );

        if($validator->fails()){
            $response['errors'] = $validator->errors();

            return response()->json($response);
        }

        $store   = session('store');
    	$polygon = $data['polygon'];
    	$center  = $data['center'];

    	$polygon = str_replace('(', '[', $polygon);
    	$polygon = str_replace(')', ']', $polygon);
    	$polygon = '['.$polygon.']';
		$center  = str_replace('(', '[', $center);
    	$center  = str_replace(')', ']', $center);

    	$data['polygon'] = $polygon;
    	$data['center']  = $center;
        $data['store_id']  = $store;
    	
    	$zone = Zone::create($data);
        $response['success'] = true;
        $response['message'] = 'Registro satisfactorio';
        $response['url'] = route('admins.zone.index');

        return response()->json($response);
    }

    function edit($id){
    	$zone = Zone::findOrFail($id);

    	return view('admin.zone.update')->with(compact('zone'));
    }

    function update(Request $request){
    	$data = $request->all();
    	$zone = Zone::findOrFail($data['id']);
        $rules = $this::VALIDATION_CONSTRAINTS;
        $response = [
            'success'=>false,
            'errors'=>[],
            'message'=>'',
            'url'=>''
        ];

        $rules['code'] = 'required|unique:zones,code,'.$data['id'].',id';
        $validator = \Validator::make(
            $data,$rules,$this::VALIDATION_MESSAGES
        );

        if($validator->fails()){
            $response['errors'] = $validator->errors();

            return response()->json($response);
        }

    	$polygon = $data['polygon'];
    	$center  = $data['center'];

        if($zone->polygon !== $polygon){
        	$polygon = str_replace('(', '[', $polygon);
        	$polygon = str_replace(')', ']', $polygon);
        	$polygon = '['.$polygon.']';
    		$center  = str_replace('(', '[', $center);
        	$center  = str_replace(')', ']', $center);
        }

    	$data['polygon'] = $polygon;
    	$data['center']  = $center;
    	
    	$zone->update($data);

        $response['success'] = true;
        $response['message'] = 'Actualización satisfactoria';
        $response['url'] = route('admins.zone.index');

        return response()->json($response);
    }

    function delete(Request $request){
        $id = $request->get('id');
    	$zone = Zone::findOrFail($id);
    	$zone->delete();

        $response['success'] = true;
        $response['message'] = 'Eliminación correcta';
        $response['url'] = route('admins.zone.index');

    	return response()->json($response);
    }

    function maps(){
        $store = session('store');
        $polygons = Zone::select('polygon','name')->where('store_id',$store)->where('status','enabled')->get()->toArray();

        if($polygons){
            $polygons = json_encode($polygons);
        }else{
            return redirect()->route('admins.zone.index');
        }

        return view('admin.zone.maps')->with(compact('polygons'));
    }
}