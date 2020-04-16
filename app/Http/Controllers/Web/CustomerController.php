<?php

namespace App\Http\Controllers\Web;

use App\Customer;
use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        //
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
