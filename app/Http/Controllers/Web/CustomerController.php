<?php

namespace App\Http\Controllers\Web;

use App\Customer;
use App\Models\Location;
use App\Models\Zone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class CustomerController extends Controller
{

    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function locationCreate()
    {
        //dd($user);
        $customer = Auth::guard('customer')->user();
        $polygons = Zone::select('polygon','name')->where('status','enabled')->get()->toArray();

        /*if($polygons){
            $polygons = $polygons;
        }*/
        //dd($location);
        return view('web.account.locationCreate', compact('polygons', 'customer'));
    }

    public function locationStore( Request $request )
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

        if (!$validator->fails()){
            $customer = Auth::guard('customer')->user();
            $location = Location::create([
                'customer_id' => $customer->id,
                'name' => $request->get('name'),
                'lastname' => $request->get('lastname'),
                'phone' => $request->get('phone'),
                'email' => $request->get('email'),
                'type_doc' => $request->get('type_doc'),
                'document' => $request->get('document'),
                'address' => $request->get('address'),
                'latitude' => $request->get('latitude'),
                'longitude' => $request->get('longitude'),
                'type_place' => $request->get('type_place'),
                'reference' => $request->get('reference')
            ]);

        } else {
            return redirect()->route('web.account.locationCreate')
                ->withErrors($validator);
        }

        return redirect()->route('web.account.location')
            ->with('success', 'Cambios guardados correctamente.');
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

        $location = Location::findorfail($request->get('location_id'));
        if (!$validator->fails()){

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
        } else {
            return redirect()->route('web.account.location.edit', $location->id)
                ->withErrors($validator);
        }

        return redirect()->route('web.account.location.edit', $location->id)
            ->with('success', 'Cambios guardados correctamente.');

    }

    public function locationEdit($id)
    {
        $location = Location::findorfail($id);
        $polygons = Zone::select('polygon','name')->where('status','enabled')->get()->toArray();

        if($polygons){
            $polygons = json_encode($polygons);
        }
        //dd($location);
        return view('web.account.locationEdit', compact('location', 'polygons'));
    }

    public function locationDelete(Request $request)
    {
        $location = Location::find($request->get('location_id'));
        $location->delete();
        return redirect()->route('web.account.location')
            ->with('success', 'Dirección eliminada correctamente.');
    }

    public function account()
    {
        $user = Auth::guard('customer')->user();
        //dd($user);
        return view('web.account.user', compact('user'));
    }

    public function orders()
    {
        $user = Auth::guard('customer')->user();
        //dd($user);
        return view('web.account.orders', compact('user'));
    }

    public function location()
    {
        $user = Auth::guard('customer')->user();
        $locations = Location::where('customer_id', $user->id)->get();
        //dd($user);
        return view('web.account.location', compact('user', 'locations'));
    }

    public function update( Request $request )
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
        } else {
            return redirect()->route('web.account.user')
                ->withErrors($validator);
        }

        return redirect()->route('web.account.user')
            ->with('success', 'Cambios guardados correctamente.');
    }
}
