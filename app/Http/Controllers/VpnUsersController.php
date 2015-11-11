<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\Auth;

class VpnUsersController extends Controller
{
    public function __construct()
    {

        $this->middleware('auth');
    }

    public function index()
    {
        $users = Auth::user()->vpnusers()->get();
        return view('vpnusers.index')->with(compact('users'));
    }

}