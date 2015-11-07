<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Support\Facades\Auth;

class UserVerificationController extends Controller
{

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    public function __construct(){

        //$this->middleware('auth');
    }

    public function verify($confirmationcode = Null)
    {
        if($confirmationcode)
        {
            $user = User::where('confirmation_code',$confirmationcode)->first();
            if($user){
                if($user->activated){
                    die("You already activated you account");
                }
                else{
                    $user->update(['activated',1]);
                    dd("Activado");
                }
                $user->update();
            }
            else{
                dd("No user");
            }
            dd($user);
            dd($confirmationcode);
        }
        else{
            if(Auth::user())
            {
                if(Auth::user()->activate)
                {
                    die("YA estás dentro");
                }
                else
                {
                    die("Verifica tu cuenta");
                }
            }
            else
            {
                die("No entras");
            }
        }

    }



}
