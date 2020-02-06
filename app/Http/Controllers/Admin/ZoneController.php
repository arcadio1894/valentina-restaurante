<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Zone;

class ZoneController extends Controller
{
    function index(){
    	$zones = Zone::all();

    	return view('admin.zone.index')->with(compact('zones'));
    }

    function create(){
    	return view('admin.zone.create');
    }

    function store(Request $request){
    	$data = $request->all();
    	$polygon = $data['polygon'];
    	$center  = $data['center'];

    	$polygon = str_replace('(', '[', $polygon);
    	$polygon = str_replace(')', ']', $polygon);
    	$polygon = '['.$polygon.']';
		$center  = str_replace('(', '[', $center);
    	$center  = str_replace(')', ']', $center);

    	$data['polygon'] = $polygon;
    	$data['center']  = $center;
    	
    	$zone = Zone::create($data);

    	return redirect()->route('admins.zone.index')->with('success','Registro satisfactorio');
    }

    function update($id){
    	$zone = Zone::findOrFail($id);

    	return view('admin.zone.update')->with(compact('zone'));
    }

    function edit(Request $request){
    	$data = $request->all();
    	$polygon = $data['polygon'];
    	$center  = $data['center'];

    	$polygon = str_replace('(', '[', $polygon);
    	$polygon = str_replace(')', ']', $polygon);
    	$polygon = '['.$polygon.']';
		$center  = str_replace('(', '[', $center);
    	$center  = str_replace(')', ']', $center);

    	$data['polygon'] = $polygon;
    	$data['center']  = $center;
    	
    	$zone = Zone::findOrFail($data['id']);
    	$zone->update($data);

    	return redirect()->route('admins.zone.index')->with('success','Actualización satisfactoria');
    }

    function delete($id){
    	$zone = Zone::findOrFail($id);
    	$zone->delete();

    	return redirect()->route('admins.zone.index')->with('success','Eliminación satisfactoria');
    }

}
