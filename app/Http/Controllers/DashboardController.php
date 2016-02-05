<?php

namespace App\Http\Controllers;

use App\Models\VpnServer;
use App\User;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function __construct()
    {

        $this->middleware('auth');
        $this->middleware('verify');
    }

    public function index()
    {
        if(! Auth::user()->vpnusers()->count())
        {
            return redirect('vpnusers');
        }
        $servers = VpnServer::where(['user_id' => Auth::user()->id , 'random' => 0])->get();
        $vpnGroups = Auth::user()->vpngroups()->get();
        $numberOfGroups = $vpnGroups->count();
        //return view('dashboard.index')->with(compact('servers'));
        return view('dashboard.index')->with(compact('servers','vpnGroups','numberOfGroups'));
    }

    public function showVpnUsers()
    {
        die("hola");
    }

}