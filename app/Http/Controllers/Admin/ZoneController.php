<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController as BaseController;
use App\Models\Zone;

class ZoneController extends BaseController
{
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

    	return redirect()->route('admins.zone.index')->with('success','Registro satisfactorio');
    }

    function edit($id){
    	$zone = Zone::findOrFail($id);

    	return view('admin.zone.update')->with(compact('zone'));
    }

    function update(Request $request){
    	$data = $request->all();
    	$zone = Zone::findOrFail($data['id']);

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

    	return redirect()->route('admins.zone.index')->with('success','Actualización satisfactoria');
    }

    function delete($id){
    	$zone = Zone::findOrFail($id);
    	$zone->delete();

    	return redirect()->route('admins.zone.index')->with('success','Eliminación satisfactoria');
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