<?php

namespace App\Http\Controllers;

use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LocationController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $locations = Location::all();

        return view('user.location.index')->with(compact('locations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.location.create');
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
            'customer_id' => 'required|exists:customers, id',
            'type_doc' => 'required|in:dni,passport',
            'document' => 'required|string|digits_between:8,12',
            'address' => 'required|min:4',
            'latitude' => 'required',
            'longitude' => 'required',
            'type_place' => 'required|in:home,business,department,hotel,condominium',
            'reference' => 'string',
        );
        $mensajes = array(
            'customer_id.required' => 'Es necesario tener el id del cliente',
            'customer_id.exists' => 'El id del cliente debe existir en la tabla customers',
            'type_doc.required' => 'Es necesario ingresar el tipo de documento',
            'type_doc.in' => 'El tipo de documento debe ser dni o pasaporte',
            'document.required' => 'Es necesario ingresar el documento del cliente',
            'document.string' => 'El documento debe ser una cadena de caracteres',
            'document.digits_between' => 'La cantidad de caracteres debe ser 8 o 12',
            'address.min' => 'La dirección del cliente debe tener minimo 4 caracteres',
            'address.required' => 'Es necesario ingresar la direccion del cliente',
            'latitude.required' => 'Es necesario ingresar la latitud de la tienda',
            'longitude.required' => 'Es necesario ingresar la longitud de la tienda',
            'type_place.required' => 'Es necesario ingresar el tipo de lugar',
            'type_place.in' => 'El tipo de lugar debe ser casa, empresa, departamento, hotel o condominio',
            'reference.string' => 'La referencia debe ser una cadena de caracteres'
        );
        $validator = Validator::make($request->all(), $rules, $mensajes);

        // TODO: Validar el rol de usuario
        $validator->after(function ($validator){
            /*if (Auth::user()->role_id > 1 ) {
                $validator->errors()->add('role', 'No tiene permisos para hacer esta acción');
            }*/
        });

        if (!$validator->fails()){
            $location = Location::create([
                'customer_id' => $request->get('customer_id'),
                'type_doc' => $request->get('type_doc'),
                'document' => $request->get('document'),
                'address' => $request->get('address'),
                'latitude' => $request->get('latitude'),
                'longitude' => $request->get('longitude'),
                'type_place' => $request->get('type_place'),
                'reference' => $request->get('reference'),
            ]);
            
        }

        return response()->json($validator->messages(),200);
    }

    public function show(Location $location)
    {
        //
    }

    public function edit(Location $location)
    {
        //
    }

    public function update(Request $request, Location $location)
    {
        //
    }

    public function destroy(Location $location)
    {
        //
    }
}
