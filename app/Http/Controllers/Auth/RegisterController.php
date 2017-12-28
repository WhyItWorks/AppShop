<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;


use Illuminate\Http\Request as Req;

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
      $messages = [
       
    ];



        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'username' => 'required|unique:users',
            'phone' => 'required',
            'address' => 'required'
        ],
        [
           'name.required' => 'Es necesario ingresar un nombre de usuario',
           'name.max' => 'El nombre puede contener un máximo de 255 caracteres',
           'email.required' => 'Es necesario ingresar un correo electrónico',
           'email.unique' => 'El email ingresado ya está siendo utilizado',
           'email.max' => 'El email puede contener un máximo de 255 caracteres',
           'username.unique' => 'El nombre de usuario ingresado ya está siendo utilizado',
           'phone.required' => 'Es necesario ingresar un número telefónico',
           'address.required' => 'Es necesario ingresar una dirección'
        ]
    );
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'username' => $data['username'],
            'phone' => $data['phone'],
            'address' => $data['address'],
            'password' => bcrypt($data['password']),
        ]);
    }

    public function showRegistrationForm(Req $request)
    {
        $name = $request->input('name');
        $email = $request->input('email');
        
        return view('auth.register')->with(compact('name','email'));
    }
    
}

