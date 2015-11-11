<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function __construct()
    {

        $this->middleware('auth');
    }

    public function index()
    {
        if(! Auth::user()->vpnusers()->count())
        {
            return redirect('vpnusers');
        }

        return view('dashboard.index');
    }

    public function showVpnUsers()
    {
        die("hola");
    }

}