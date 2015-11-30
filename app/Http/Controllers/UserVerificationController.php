<?php

namespace App\Http\Controllers;

use App\Models\RandomServer;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;

class UserVerificationController extends Controller
{

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    public function __construct()
    {

        //$this->middleware('auth');
    }

    public function verify($confirmationcode = Null)
    {
        if ($confirmationcode) {
            $user = User::where('confirmation_code', $confirmationcode)->first();
            if ($user) {
                if ($user->activated) {
                    die("You already activated you account");
                } else {
                    $data = User::where('confirmation_code', $confirmationcode)->first();
                    User::where('confirmation_code', $confirmationcode)->update(['activated' => 1, 'confirmation_code' => Null]);
                    Mail::send('email.registered', [], function ($message) use ($data) {
                        $message->from('admin@windmaker.net');
                        $message->subject("Verification succeded");
                        $message->to($data['email']);
                    });
                    RandomServer::create(['user_id' => Auth::user()->id , 'number' => 0,'requested' => 0, 'used' => 0]);
                    return view('auth.registered');
                }
            } else {
                dd("No user");
            }
            dd($user);
            dd($confirmationcode);
        } else {
            if (Auth::user()) {
                if (Auth::user()->activated) {
                    return Redirect::to('dashboard');
                } else {
                    return view('auth.verify');
                }
            } else {
                return Redirect::to('login');
            }
        }

    }

}