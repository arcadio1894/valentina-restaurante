<?php

namespace App\Http\Controllers\Admin;

use App\Customer;
use App\Models\Location;
use App\Models\Zone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\BaseController as BaseController;

class CustomerController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = Customer::all();

        return view('admin.customer.index')->with(compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $polygons = Zone::select('polygon','name')->where('status','enabled')->get()->toArray();

        if($polygons){
            $polygons = json_encode($polygons);
        }
        return view('admin.customer.create')->with(compact('polygons'));
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
            'name' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!_@$%^&*-]).{6,}$/|confirmed',
            'type_doc' => 'required|in:dni,passport',
            'document' => 'required|string|digits_between:8,12',
            'birthday' => 'required|date',
            'genre' => 'required|in:male,female',
            'phone' => 'required|numeric|digits:9',
            'address' => 'required|string|max:255',
            'latitude' => 'required|string',
            'longitude' => 'required|string',
            'type_place' => 'required|in:home,business,department,hotel,condominium',
            'reference' => 'string',
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
            $customer = Customer::create([
                'name' => $request->get('name'),
                'lastname' => $request->get('lastname'),
                'email' => $request->get('email'),
                'password' => bcrypt($request->get('password')),
                'type_doc' => $request->get('type_doc'),
                'document' => $request->get('document'),
                'birthday' => $request->get('birthday'),
                'genre' => $request->get('genre'),
                'phone' => $request->get('phone')
            ]);

            // TODO: Insert of address

            $location = Location::create([
                'customer_id' => $customer->id,
                'name' => $customer->name,
                'lastname' => $customer->lastname,
                'phone' => $customer->phone,
                'email' => $customer->email,
                'type_doc' => $request->get('type_doc'),
                'document' => $request->get('document'),
                'address' => $request->get('address'),
                'latitude' => $request->get('latitude'),
                'longitude' => $request->get('longitude'),
                'type_place' => $request->get('type_place'),
                'reference' => $request->get('reference')
            ]);
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
        $customer = Customer::findOrFail($id);

        $locations = Location::where('customer_id', $customer->id)->get();

        $polygons = Zone::select('polygon','name')->where('status','enabled')->get()->toArray();

        if($polygons){
            $polygons = json_encode($polygons);
        }

        return view('admin.customer.edit')->with(compact('customer', 'locations', 'polygons'));
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
            'name' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'birthday' => 'required|date',
            'phone' => 'required|numeric|digits:9',
            'document' => 'required|string|digits_between:8,12',
            'genre' => 'required|in:male,female',
            'type_doc' => 'required|in:dni,passport',
        );
        $mensajes = array(
            'name.required' => 'Es necesario ingresar el nombre del usuario',
            'name.string' => 'El nombre del usuario debe contener sólo caracteres',
            'name.max' => 'El nombre del usuario debe contener máx. 255 caracteres',
            'lastname.required' => 'Es necesario ingresar el apellido del usuario',
            'lastname.string' => 'El apellido del usuario debe contener sólo caracteres',
            'lastname.max' => 'El apellido del usuario debe contener máx. 255 caracteres',
            'birthday.required' => 'Es necesario ingresar la fecha de nacimiento del usuario',
            'birthday.date' => 'Es necesario que la fecha sea una fecha',
            'phone.required' => 'Es necesario ingresar el teléfono de la tienda',
            'phone.numeric' => 'El teléfono del usuario debe tener sólo números',
            'phone.size' => 'El teléfono debe tener 9 digitos',
            'document.required' => 'Es necesario ingresar el documento del usuario',
            'document.string' => 'El apellido del usuario debe contener sólo caracteres',
            'document.digits_between' => 'La cantidad de números puede ser entre 8 y 12',
            'genre.required' => 'Es necesario ingresar el género del usuario',
            'genre.in' => 'El género puede ser masculino o femenino',
            'type_doc.required' => 'Es necesario ingresar el tipo de documento',
            'type_doc.in' => 'El tipo de documento solo puede ser DNI o pasaporte'
        );
        $validator = Validator::make($request->all(), $rules, $mensajes);

        if (!$validator->fails()){
            $customer = Customer::find($request->get('id'));
            $customer->name = $request->get('name');
            $customer->lastname = $request->get('lastname');
            $customer->type_doc = $request->get('type_doc');
            $customer->document = $request->get('document');
            $customer->birthday = $request->get('birthday');
            $customer->genre = $request->get('genre');
            $customer->phone = $request->get('phone');

            $customer->save();
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

    public function locationUpdate(Request $request)
    {
        $rules = array(
            'name' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'phone' => 'required|numeric|digits:9',
            'email' => 'required|string|email|max:255',
            'type_doc' => 'required|in:dni,passport',
            'document' => 'required|string|digits_between:8,12',
            'address' => 'required|string|max:255',
            'latitude' => 'required|string',
            'longitude' => 'required|string',
            'type_place' => 'required|in:home,business,department,hotel,condominium',
            'reference' => 'string',
        );
        $mensajes = array(
            'name.required' => 'Es necesario ingresar el nombre del usuario',
            'name.string' => 'El nombre del usuario debe contener sólo caracteres',
            'name.max' => 'El nombre del usuario debe contener máx. 255 caracteres',
            'lastname.required' => 'Es necesario ingresar el apellido del usuario',
            'lastname.string' => 'El apellido del usuario debe contener sólo caracteres',
            'lastname.max' => 'El apellido del usuario debe contener máx. 255 caracteres',
            'phone.required' => 'Es necesario ingresar el teléfono de la tienda',
            'phone.numeric' => 'El teléfono del usuario debe tener sólo números',
            'phone.digits' => 'El teléfono debe tener 9 digitos',
            'email.required' => 'Es necesario ingresar el email del usuario',
            'email.string' => 'El email del usuario debe tener sólo caracteres',
            'email.email' => 'El email del usuario debe tener el formato de email valido',
            'email.max' => 'El email del usuario debe tener máx. 255 caracteres',
            'type_doc.required' => 'Es necesario ingresar el tipo de documento',
            'type_doc.in' => 'El tipo de documento solo puede ser DNI o pasaporte',
            'document.required' => 'Es necesario ingresar el documento del usuario',
            'document.string' => 'El documento debe contener sólo caracteres',
            'document.digits_between' => 'El documento debe contener entre 8 y 12 digitos',
            'address.required' => 'Es necesario ingresar la dirección',
            'address.string' => 'La dirección debe contener caracteres',
            'address.max' => 'La dirección debe contener máx. 255 caracteres',
            'latitude.required' => 'Es necesario ingresar la latitud de la dirección.',
            'latitude.string' => 'La latitud de la dirección esta incorrecta',
            'longitude.required' => 'Es necesario ingresar la longitud de la dirección.',
            'longitude.string' => 'La longitud de la dirección esta incorrecta',
            'type_place.required' => 'Es necesario ingresar el tipo de lugar',
            'type_place.in' => 'El tipo de documento solo puede ser CASA, DEPARTAMENTO, NEGOCIO, HOTEL o CONDOMINIO',
            'reference.string' => 'La referencia de la dirección debe ser un texto'
        );
        $validator = Validator::make($request->all(), $rules, $mensajes);

        $location = Location::findorfail($request->get('loc_id'));
        if (!$validator->fails()){

            $location->customer_id = $request->get('customer_id');
            $location->name = $request->get('name');
            $location->lastname = $request->get('lastname');
            $location->phone = $request->get('phone');
            $location->email = $request->get('email');
            $location->type_doc = $request->get('type_doc');
            $location->document = $request->get('document');
            $location->address = $request->get('address');
            $location->latitude = $request->get('latitude');
            $location->longitude = $request->get('longitude');
            $location->type_place = $request->get('type_place');
            $location->reference = $request->get('reference');

            $location->save();
        }

        return response()->json($validator->messages(),200);

    }
}