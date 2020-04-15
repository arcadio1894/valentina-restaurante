<?php

namespace App\Http\Controllers\Auth;


use App\Customer;
use App\Models\Location;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!_@$%^&*-]).{6,}$/|confirmed',
            'type_doc' => 'required|in:dni,passport',
            'document' => 'required|string|digits_between:8,12',
            'birthday' => 'required|date',
            'genre' => 'required|in:male,female',
            'phone' => 'required|regex:/[0-9]{9}/',
            'address' => 'required|string|max:255',
            'latitude' => 'required|string',
            'longitude' => 'required|string',
            'type_place' => 'required|in:home,business,department,hotel,condominium',
            'reference' => 'string',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $customer = Customer::create([
            'name' => $data['name'],
            'lastname' => $data['lastname'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'type_doc' => $data['type_doc'],
            'document' => $data['document'],
            'birthday' => $data['birthday'],
            'genre' => $data['genre'],
            'phone' => $data['phone'],
        ]);

        // TODO: Insert of address
        
        $location = Location::create([
            'customer_id' => $customer->id,
            'type_doc' => $data['type_doc'],
            'document' => $data['document'],
            'address' => $data['address'],
            'latitude' => $data['latitude'],
            'longitude' => $data['longitude'],
            'type_place' => $data['type_place'],
            'reference' => $data['reference'],
        ]);

        try{
            if(Auth::guard('customer')->attempt(
                ['email'=> $data['email'],'password'=>bcrypt($data['password'])],
                0
            )){
                return redirect()->intended(route('web.home'));
            }
        }catch (\Exception $e){
            dd( $e->getMessage() );
        }


        return redirect()->back()->withInpput($data);

    }
}
