<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\Auth;
use App\Models\VpnUser;
use App\Http\Requests;
use Symfony\Component\HttpFoundation\Request;

class VpnUsersController extends Controller
{
    public function __construct()
    {

        $this->middleware('auth');
    }

    public function index()
    {
        $error = ""; //Chapuza
        $users = Auth::user()->vpnusers()->where(['user_id' => Auth::user()->id])->get();
        return view('vpnusers.index')->with(compact('users','error'));
    }

    public function store(Requests\VpnUserRequest $request)
    {
        $error = "";
        $users = Auth::user()->vpnusers()->get();
        foreach($users as $user)
        {
            if($request->name == $user->name)
            {
                $error = "You've already added a user with this name.";
                return view('vpnusers.index')->with(compact('users','error'));
            }
        }
        $request['user_id'] = Auth::user()->id;
        VpnUser::create($request->all());
        $users = Auth::user()->vpnusers()->get();
        return view('vpnusers.index')->with(compact('users','error'));

    }

    public function destroy(Request $request)
    {
        die("WOS");
    }

}