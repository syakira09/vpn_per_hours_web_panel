<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Illuminate\Support\Facades\Mail;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    protected $redirectPath = '/verify';
    protected $loginPath = '/login';

    public function __construct()
    {

        $this->middleware('guest', ['except' => 'getLogout']);
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
            'first_name' => 'required|max:255|min:2',
            'last_name' => 'required|max:255|min:2',
            'email' => 'required|email|max:255|unique:users',
            'country' => 'required',
            'password' => 'required|confirmed|min:8',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        $confirmation_code = str_random(60);
        $username = explode('@',$data['email'])[0];
        $counter=1;
        if( User::where(['username' => $username])->count() !=0 ){
            $username_candidate = $username.(string)$counter;
            while(User::where(['username' => $username_candidate])->count() !=0)
            {
                $counter = $counter +1;
                $username_candidate = $username.(string)$counter;
            }
            $username = $username_candidate;
        }

        /*Mail::send('email/verification', ['confirmation_code' => $confirmation_code, 'data' => $data], function($message)
        {
            $message->to($data['email'], 'John Smith')->subject('Welcome!');
        });*/
        Mail::send('email.verification', ['confirmation_code' => $confirmation_code],function ($message) use($data) {
            $message->from('admin@windmaker.net');
            $message->subject("Verify your email address");
            $message->to($data['email']);
        });

        return User::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'country' => $data['country'],
            'email' => $data['email'],
            'username' =>  $username,
            'password' => bcrypt($data['password']),
            'confirmation_code' => $confirmation_code,
        ]);


    }
}
