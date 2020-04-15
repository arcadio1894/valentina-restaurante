<?php

namespace App\Http\Controllers\Web;


use App\Customer;
use App\Models\Location;
use App\Models\Zone;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;

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
    //protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(){
        $this->middleware('guest:customer');
    }

    public function showRegisterForm(){
        $polygons = Zone::select('polygon','name')->where('status','enabled')->get()->toArray();

        if($polygons){
            $polygons = json_encode($polygons);
        }
        return view('web.auth.register')->with(compact('polygons'));
    }


    protected function validator(Request $request)
    {
        return Validator::make($request, [
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

    protected function create(Request $request)
    {
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
            'type_doc' => $request->get('type_doc'),
            'document' => $request->get('document'),
            'address' => $request->get('address'),
            'latitude' => $request->get('latitude'),
            'longitude' => $request->get('longitude'),
            'type_place' => $request->get('type_place'),
            'reference' => $request->get('reference')
        ]);

        try{
            if(Auth::guard('customer')->attempt(
                ['email'=> $request->email,'password'=>$request->password],
                0
            )){
                return redirect()->intended(route('web.home'));
            }
        }catch (\Exception $e){
            dd( $e->getMessage() );
        }


        return redirect()->back()->withInpput($request);

    }
}
