<?php

namespace App\Http\Controllers;

use App\Models\VpnServer;
use App\Models\Zones;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests;
use Illuminate\Http\Request;
use Zjango\Laracurl\Facades\Laracurl;

class ServersController extends Controller
{
    public function __construct()
    {

        $this->middleware('auth');
        $this->middleware('verify');
    }

    public function index()
    {
        return redirect('dashboard');
    }

    public function store(Requests\ServerRequest $request)
    {
        $request['user_id'] = Auth::user()->id;
        $request['token'] = str_random(60);
        $token = $request['token'];
        dd($request->all());
        VpnServer::create($request->all());
        sleep(2);
        //$test= \Illuminate\Http\Request::create('http://paula.es.una.ninja:8888/createserver?token='.$request['token']);
        //$test->all();
        $test = Laracurl::get('http://paula.es.una.ninja:8888/createserver?token='.$token);
        $response = Laracurl::get($test);
        return redirect('dashboard');
    }

    public function show(Request $request, $token)
    {

        $zones = Zones::lists('zonename');
        $server = VpnServer::where([ 'token' => $token])->first();
        if($server->count()) {
            return response()->json(['name' => $server->name, 'state' => $server->status, 'time' => $server->time, 'zone' => $zones[$server->zone]]);
        }
    }

    public function powerOff(Request $request)
    {

        $server = VpnServer::where([ 'token' => $request['token']])->first();
        if($server->count()) {
            VpnServer::where([ 'token' => $request['token']])->update(['status' => 'Powering off']);
            $test = Laracurl::get('http://paula.es.una.ninja:8888/poweroff?token='.$request['token']);
            $response = Laracurl::get($test);
            return response()->json(['status' => 1]);
        }
        else {
            return response()->json(['status' => 0]);
        }
    }

    public function powerOn(Request $request)
    {

        $server = VpnServer::where([ 'token' => $request['token']])->first();
        if($server->count()) {
            VpnServer::where([ 'token' => $request['token']])->update(['status' => 'Powering on']);
            $test = Laracurl::get('http://paula.es.una.ninja:8888/poweron?token='.$request['token']);
            $response = Laracurl::get($test);
            return response()->json(['status' => 1]);
        }
        else {
            return response()->json(['status' => 0]);
        }
    }

    public function destroy($token)
    {
        $test = Laracurl::get('http://paula.es.una.ninja:8888/destroy?token='.$token);
        $response = Laracurl::get($test);
        sleep(5);
        Auth::user()->servers()->where([ 'token' => $token])->delete();
    }

}
