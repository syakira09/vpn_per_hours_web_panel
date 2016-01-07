<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\VpnUser;
use App\Http\Requests;

class VpnUsersController extends Controller
{
    public function __construct()
    {

        $this->middleware('auth');
        $this->middleware('verify');
    }

    public function index()
    {
        $error = ""; //Chapuza
        $users = Auth::user()->vpnusers()->where(['user_id' => Auth::user()->id])->get();
        $groups = Auth::user()->vpngroups()->where(['user_id' => Auth::user()->id])->get();
        return view('vpnusers.index')->with(compact('users','groups','error'));
    }

    public function store(Requests\VpnUserRequest $request)
    {
        $error = "";
        $users = Auth::user()->vpnusers()->get();
        if($users->count()<10) {
            foreach ($users as $user) {
                if ($request->name == $user->name) {
                    $error = "You've already added a user with this name.";
                    return view('vpnusers.index')->with(compact('users', 'error'));
                }
            }
            $request['user_id'] = Auth::user()->id;
            $request->usename = $request->vpnusername ;
            VpnUser::create($request->all());
            $users = Auth::user()->vpnusers()->get();
            $groups = Auth::user()->vpngroups()->get();
            return view('vpnusers.index')->with(compact('users','groups','error'));
        }
        else
        {
            $error = "You can only create 10 users";
            return view('vpnusers.index')->with(compact('users', 'error'));
        }
    }

    public function destroy($name)
    {
        Auth::user()->vpnusers()->where(['user_id' => Auth::user()->id])->where(['name' => $name])->delete();
    }

}