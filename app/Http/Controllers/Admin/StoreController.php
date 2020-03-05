<?php

namespace App\Http\Controllers\Admin;

use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\BaseController as BaseController;

class StoreController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stores = Store::all();

        return view('admin.store.index')->with(compact('stores'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.store.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = array(
            'name' => 'required|min:4',
            'code' => 'required|min:2|unique:stores,code',
            'service' => 'required',
            'address' => 'required|min:4',
            'phone' => 'required|min:6',
            'attention_schedule' => 'required|min:6',
            'latitude' => 'required',
            'longitude' => 'required',
            'order' => 'required',
            'status' => 'required',
        );
        $mensajes = array(
            'name.required' => 'Es necesario ingresar el nombre de la tienda',
            'name.min' => 'El nombre de la tienda debe tener por lo menos 4 caracteres',
            'code.required' => 'Es necesario ingresar un codigo a la tienda',
            'code.min' => 'El código de la tienda debe tener por lo menos 2 caracteres',
            'code.unique' => 'Ya existe una tienda con este código',
            'service.required' => 'Es necesario ingresar el tipo de servicio de la tienda',
            'address.required' => 'Es necesario ingresar la dirección de la tienda',
            'address.min' => 'La dirección de la tienda debe tener minimo 4 caracteres',
            'phone.required' => 'Es necesario ingresar el teléfono de la tienda',
            'phone.min' => 'El teléfono de la tienda debe tener minimo 6 caracteres',
            'attention_schedule.required' => 'Es necesario ingresar el horario de atención de la tienda',
            'attention_schedule.min' => 'El horario de la tienda debe tener minimo 6 caracteres',
            'latitude.required' => 'Es necesario ingresar la latitud de la tienda',
            'longitude.required' => 'Es necesario ingresar la longitud de la tienda',
            'order.required' => 'Es necesario ingresar el orden de la tienda',
            'status.required' => 'Es necesario ingresar el estado de la tienda'
        );
        $validator = Validator::make($request->all(), $rules, $mensajes);

        // TODO: Validar el rol de usuario
        $validator->after(function ($validator){
            /*if (Auth::user()->role_id > 1 ) {
                $validator->errors()->add('role', 'No tiene permisos para hacer esta acción');
            }*/
        });

        if (!$validator->fails()){
            $store = Store::create([
                'name' => $request->get('name'),
                'code' => $request->get('code'),
                'service' => $request->get('service'),
                'address' => $request->get('address'),
                'phone' => $request->get('phone'),
                'attention_schedule' => $request->get('attention_schedule'),
                'latitude' => $request->get('latitude'),
                'longitude' => $request->get('longitude'),
                'order' => $request->get('order'),
                'status' => $request->get('status')
            ]);
            if ( $request->file('image') )
            {
                $path = public_path().'/admin/assets/images/stores';
                $extension = $request->file('image')->getClientOriginalExtension();
                $filename = $store->id . '.' . $extension;
                $request->file('image')->move($path, $filename);
                $store->image = $filename;
            } else {
                $validator->after(function ($validator){
                    $validator->errors()->add('image', 'Es necesario ingresar una imagen');
                });
            }
            $store->save();
        }

        return response()->json($validator->messages(),200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $store = Store::findOrFail($id);

        return view('admin.store.edit')->with(compact('store'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $rules = array(
            'name' => 'required|min:4',
            'code' => 'required|min:2',
            'service' => 'required',
            'address' => 'required|min:4',
            'phone' => 'required|min:6',
            'attention_schedule' => 'required|min:6',
            'latitude' => 'required',
            'longitude' => 'required',
            'order' => 'required',
            'status' => 'required',
        );
        $mensajes = array(
            'name.required' => 'Es necesario ingresar el nombre de la tienda',
            'name.min' => 'El nombre de la tienda debe tener por lo menos 4 caracteres',
            'code.required' => 'Es necesario ingresar un codigo a la tienda',
            'code.min' => 'El código de la tienda debe tener por lo menos 2 caracteres',
            'service.required' => 'Es necesario ingresar el tipo de servicio de la tienda',
            'address.required' => 'Es necesario ingresar la dirección de la tienda',
            'address.min' => 'La dirección de la tienda debe tener minimo 4 caracteres',
            'phone.required' => 'Es necesario ingresar el teléfono de la tienda',
            'phone.min' => 'El teléfono de la tienda debe tener minimo 6 caracteres',
            'attention_schedule.required' => 'Es necesario ingresar el horario de atención de la tienda',
            'attention_schedule.min' => 'El horario de la tienda debe tener minimo 6 caracteres',
            'latitude.required' => 'Es necesario ingresar la latitud de la tienda',
            'longitude.required' => 'Es necesario ingresar la longitud de la tienda',
            'order.required' => 'Es necesario ingresar el orden de la tienda',
            'status.required' => 'Es necesario ingresar el estado de la tienda'
        );
        $validator = Validator::make($request->all(), $rules, $mensajes);

        // TODO: Validar el rol de usuario
        $validator->after(function ($validator){
            /*if (Auth::user()->role_id > 1 ) {
                $validator->errors()->add('role', 'No tiene permisos para hacer esta acción');
            }*/
        });

        if (!$validator->fails()){
            $store = Store::find($request->get('store_id'));
            $store->name = $request->get('name');
            $store->code = $request->get('code');
            $store->service = $request->get('service');
            $store->address = $request->get('address');
            $store->phone = $request->get('phone');
            $store->attention_schedule = $request->get('attention_schedule');
            $store->latitude = $request->get('latitude');
            $store->longitude = $request->get('longitude');
            $store->order = $request->get('order');
            $store->status = $request->get('status');

            if ( $request->file('image') )
            {
                $path = public_path().'/admin/assets/images/films';
                $extension = $request->file('image')->getClientOriginalExtension();
                $filename = $store->id . '.' . $extension;
                $request->file('image')->move($path, $filename);
                $store->image = $filename;
            }

            $store->save();
        }

        return response()->json($validator->messages(),200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        $rules = array(
            'store_id' => 'required|exists:stores,id',
        );
        $mensajes = array(
            'store_id.required' => 'Es necesario enviar el id de la tienda',
            'store_id.exists' => 'La tienda no exista en la base de datos',
        );
        $validator = Validator::make($request->all(), $rules, $mensajes);

        // TODO: Validar el rol de usuario
        $validator->after(function ($validator){
            /*if (Auth::user()->role_id > 1 ) {
                $validator->errors()->add('role', 'No tiene permisos para hacer esta acción');
            }*/
        });

        if (!$validator->fails()){
            $store = Store::find($request->get('store_id'));
            $store->delete();
        }

        return response()->json($validator->messages(),200);
    }
    
    public function locals()
    {
        $stores = Store::orderby('order')->get();
        return view('admin.store.locals')->with(compact('stores'));
    }

    public function addressLocals()
    {
        $stores = Store::get(['name', 'phone', 'address', 'latitude', 'longitude', 'attention_schedule']);
        $array = $stores->toArray();

        return json_encode($array);
    }

    public function change_session(Request $request){
        $data = $request->all();
        $store_id = $data['store'];
        $before = session('store');
        session(['store'=>$store_id]);
        $after = session('store');

        return ['before'=>$before,'after'=>$after];
    }
}