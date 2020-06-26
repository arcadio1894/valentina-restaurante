<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController as BaseController;
use App\Models\Category;

class CategoryController extends BaseController
{
    const LEVELS = ['default','red','pink','orange','green'];
    const VALIDATION_CONSTRAINTS = [
        'name'=>'required',
        'description'=>'required',
        'image'=>'file',
        'position'=>'required|integer',
        'status'=>'required'
    ];
    const VALIDATION_MESSAGES = [
        'name.required'=>'El <b>NOMBRE</b> de la categoría es requerido',
        'description.required'=>'La <b>DESCRIPCIÓN</b> de la categoría es requerida',
        'position.required'=>'La <b>POSICIÓN</b> de la categoría es requerida',
        'position.integer'=>'La <b>POSICIÓN</b> ingresada debe ser numérica',
        'status.required'=>'El <b>ESTADO</b> de la categoría es requerido'
    ];

    function index(){
        $htmlCategories = $this->getCategoryData();

    	return view('admin.category.index')->with(compact('htmlCategories'));
    }

    function getCategoryData($selectable = false,$ids = []){
        $store = session('store');
        $elements = [];
        $htmlCategories = '';

        $categories = Category::where('store_id',$store)
        ->select('id','name','level','status')->whereNull('parent_id')
        ->orderBy('position')->get();

        foreach ($categories as $category) {
            $items = $this->buildCategoryTree($category);
            $category->categories = [];

            if(count($items)){
                $category->categories = $items;
            }

            array_push($elements,$category);
        }

        foreach ($elements as $category) {
            $htmlCategories .= $this->printCategoryTree($category,$selectable,$ids);
        }

        return $htmlCategories;
    }

    function buildCategoryTree($category){
        $store = session('store');
        $elements = [];
        $categories = Category::where('store_id',$store)->where('parent_id',$category->id)
        ->select('id','name','level','status')->orderBy('position')->get();

        if(count($categories)>0){
            foreach ($categories as $cat) {
                $items = $this->buildCategoryTree($cat);
                $cat->categories = [];

                if(count($items)){
                    $cat->categories = $items;
                }

                array_push($elements,$cat);
            }
        }
         
        return $elements;
    }

    function printCategoryTree($category,$selectable,$ids = []){
        $level = $this::LEVELS[0];
        $faTimes = 'fa-times';
        $selectedCategory = '';
        $selectedCategoryLabel = '';

        if(isset($this::LEVELS[$category->level])){
            $level = $this::LEVELS[$category->level];
        }

        $statusColor = 'blue';
        $statusIcon = 'cloud-upload';

        if($category->status === 'disabled'){
            $statusColor = 'orange';
            $statusIcon = 'cloud-download';
        }

        if(in_array($category->id, $ids)){
            $faTimes = 'fa-check';
            $selectedCategory = 'selected-category';
            $selectedCategoryLabel = 'selected-category-label';
        }

        if($selectable){
            $htmlCategories = 
                '<li class="tree-branch tree-open tree-branch-product" role="treeitem" aria-expanded="true" data-category="'.$category->id.'">'.
                    '<i class="icon-item ace-icon '.$faTimes.' '.$selectedCategory.' fa selectable-category"></i>'.
                    '<span class="tree-label '.$selectedCategoryLabel.'">'.$category->name.'</span>';
        }else{
            $htmlCategories = 
                '<li class="tree-branch tree-open" role="treeitem" aria-expanded="true">'.
                    '<i class="icon-caret ace-icon tree-minus"></i>&nbsp;'.
                    '<div class="tree-branch-header">'.
                        '<span class="tree-branch-name">'.
                            '<span class="tree-label">'.$category->name.'</span>&nbsp;'.
                            '<i class="'.$statusColor.' fa fa-'.$statusIcon.'"></i>'.
                            '<a href="'.route('admins.category.delete', $category->id).'" data-delete class="ml-5 btn-xs btn-danger pull-right hide"><i class="fa fa-trash"></i></a>'.
                            '<a href="'.route('admins.category.edit', $category->id).'"  data-update class="ml-5 btn-xs btn-info pull-right hide"><i class="fa fa-pencil"></i></a>'.
                            '<a href="'.route('admins.category.create', $category->id).'" data-create class="ml-5 btn-xs btn-success pull-right hide"><i class="fa fa-plus"></i></a>'.
                        '</span>'.
                    '</div>';
        }


        if(count($category->categories)>0){
            $htmlCategories .= '<ul class="tree-branch-children" role="group">';

            foreach ($category->categories as $cat) {
                $htmlCategories .= $this->printCategoryTree($cat,$selectable,$ids);
            }

            $htmlCategories .= '</ul>';
        }else{
            $htmlCategories .= '</li>';
        }

        return $htmlCategories;
    }

    function create($id=null){
        $level = 1;
        $parent_id = null;

        if($id){
            $category = Category::findOrFail($id);

            if($category->id){
                $level = intval($category->level)+1;
                $parent_id = $id;
            }
        }

    	return view('admin.category.create')->with(compact('level','parent_id'));
    }

    function store(Request $request){
    	$data  = $request->all();
    	$store = session('store');
    	$data['store_id'] = $store;
        $response = [
            'success'=>false,
            'errors'=>[],
            'message'=>'',
            'url'=>''
        ];

        $validate = \Validator::make(
            $data,$this::VALIDATION_CONSTRAINTS,$this::VALIDATION_MESSAGES
        );

        if($validate->fails()){
            $response['errors'] = $validate->errors();

            return response()->json($response);
        }

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

        $response['success'] = true;
        $response['message'] = 'Registro satisfactorio';
        $response['url'] = route('admins.category.index');

    	return response()->json($response);
    }

    function edit($id){
    	$category = Category::findOrFail($id);

    	return view('admin.category.update')->with(compact('category'));
    }

    function update(Request $request){
    	$data  = $request->all();
    	unset($data['image']);

        $response = [
            'success'=>false,
            'errors'=>[],
            'message'=>'',
            'url'=>''
        ];

        $validate = \Validator::make(
            $data,$this::VALIDATION_CONSTRAINTS,$this::VALIDATION_MESSAGES
        );

        if($validate->fails()){
            $response['errors'] = $validate->errors();

            return response()->json($response);
        }

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

        $response['success'] = true;
        $response['message'] = 'Actualización satisfactoria';
        $response['url'] = route('admins.category.index');

        return response()->json($response);
    }

    function delete($id){
    	$category = Category::findOrFail($id);
    	$category->delete();

    	return redirect()->route('admins.category.index')->with('success','Eliminación satisfactoria');
    }
}