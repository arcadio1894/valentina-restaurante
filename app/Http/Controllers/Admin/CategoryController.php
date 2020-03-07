<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController as BaseController;
use App\Models\Category;

class CategoryController extends BaseController
{
    function index(){
    	$store = session('store');
    	$categories = Category::where('store_id',$store)->with('parent_category')->orderBy('position','desc')->get();

    	return view('admin.category.index')->with(compact('categories'));
    }

    function create(){
    	$parents = Category::where('status','enabled')->orderBy('position','desc')
    		->select(['id','name'])->get();

    	return view('admin.category.create')->with(compact('parents'));
    }

    function store(Request $request){
    	$data  = $request->all();
    	$store = session('store');
    	$data['store_id'] = $store;
    	unset($data['image']);

    	$category = Category::create($data);

    	if($request->hasFile('image')){
    		$image     = $request->file('image');
    		$extension = $image->getClientOriginalExtension();
            $filename  = $category->id . '.' . $extension;
    		$path      = public_path().'/admin/assets/images/category';
    		$image->move($path,$filename);
    		$category->image = $filename;
    		$category->save();
    	}

    	return redirect()->route('admins.category.index')->with('success','Registro satisfactorio');
    }

    function edit($id){
    	$category = Category::findOrFail($id);
    	$parents = Category::orderBy('position','desc')
    		->select(['id','name'])->get();

    	return view('admin.category.update')->with(compact('category','parents'));
    }

    function update(Request $request){
    	$data  = $request->all();
    	unset($data['image']);

    	$category = Category::findOrFail($data['id']);
    	$category->update($data);

    	if($request->hasFile('image')){
    		$image     = $request->file('image');
    		$extension = $image->getClientOriginalExtension();
            $filename  = $category->id . '.' . $extension;
    		$path      = public_path().'/admin/assets/images/category';
    		$image->move($path,$filename);
    		$category->image = $filename;
    		$category->save();
    	}

    	return redirect()->route('admins.category.index')->with('success','Actualización satisfactoria');
    }

    function delete($id){
    	$category = Category::findOrFail($id);
    	$category->delete();

    	return redirect()->route('admins.category.index')->with('success','Eliminación satisfactoria');
    }
}