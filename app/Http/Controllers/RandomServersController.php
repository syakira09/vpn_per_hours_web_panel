<?php

namespace App\Http\Controllers;

use App\Models\RandomServer;
use App\Models\VpnServer;
use App\Models\Zones;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests;
use Illuminate\Http\Request;
use Zjango\Laracurl\Facades\Laracurl;

class RandomServersController extends Controller
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
        $servers = VpnServer::where(['user_id' => Auth::user()->id , 'random' => 1])->get();
        $numberOfServers = RandomServer::where(['user_id' => Auth::user()->id])->first();
        $number = $numberOfServers->number;
        $requested = $numberOfServers->requested;
        $used = $numberOfServers->used;
        if($used == $requested)
        {
            $server_info = RandomServer::where(['user_id' => Auth::user()->id ])->first();
            $server_info->number = 0;
            $server_info->used = 0;
            $server_info->requested = 0;
            $server_info->save();
            $status = "No servers ready";
            return view('randomservers.index')->with(compact('servers','number','requested','used','status'));
        }
        if($number==$requested)
        {
            $fisrt = $servers = VpnServer::where(['user_id' => Auth::user()->id , 'random' => 1])->first();
            $status = $fisrt->status;
        }
        else{
            $status = "No servers ready";
        }

        return view('randomservers.index')->with(compact('servers','number','requested','used','status'));
    }

    public function store(Request $request)
    {
        $number_of_servers = (intval($request['number_of_servers'])+1)*10;
        $zones = Zones::lists('zonename');
        $token = '';
        RandomServer::where(['user_id' => Auth::user()->id])->update(['requested' => $number_of_servers , 'number' => 0]);
        $tokens = array();
        foreach(range(0, $number_of_servers - 1) as $server)
        {
            $request['user_id'] = Auth::user()->id;
            $request['token'] = str_random(60);
            $token = $request['token'] ;
            array_push($tokens,$token);
            $request['random'] = 1;
            $request['zone'] = rand(0,$zones->count()-1);
            VpnServer::create($request->all());
        }
        foreach($tokens as $token)
        {
            $test = Laracurl::get('http://paula.es.una.ninja:8888/createrandomserver?token='.$token);
            $response = Laracurl::get($test);
        }

        return redirect('randomserver');
    }

    public function enable()
    {
        $server = VpnServer::where(['user_id' => Auth::user()->id , 'random' => 1])->first();
        $test = Laracurl::get('http://paula.es.una.ninja:8888/enablerandomserver?token='.$server->token);
        $response = Laracurl::get($test);
        $fisrt = $servers = VpnServer::where(['user_id' => Auth::user()->id , 'random' => 1])->first();
        $status = $fisrt->status;
        while ($status != 'Running')
        {
            sleep(1);
            $fisrt = $servers = VpnServer::where(['user_id' => Auth::user()->id , 'random' => 1])->first();
            $status = $fisrt->status;
        }
        return redirect('randomserver');
    }

    public function disable()
    {
        $server = VpnServer::where(['user_id' => Auth::user()->id , 'random' => 1])->first();
        $test = Laracurl::get('http://paula.es.una.ninja:8888/poweroff?token='.$server->token);
        $response = Laracurl::get($test);
        $fisrt = VpnServer::where(['user_id' => Auth::user()->id , 'random' => 1])->first();
        $status = $fisrt->status;
        while ($status != 'Powered off')
        {
            sleep(1);
            $fisrt = $servers = VpnServer::where(['user_id' => Auth::user()->id , 'random' => 1])->first();
            $status = $fisrt->status;
        }
        return redirect('randomserver');
    }

    public function nextserver()
    {
        $server = VpnServer::where(['user_id' => Auth::user()->id , 'random' => 1])->first();
        $test = Laracurl::get('http://paula.es.una.ninja:8888/destroy?token='.$server->token);
        $response = Laracurl::get($test);
        VpnServer::where(['user_id' => Auth::user()->id , 'random' => 1])->first()->delete();
        $first = VpnServer::where(['user_id' => Auth::user()->id , 'random' => 1])->first();
        if ($first) {
            $test = Laracurl::get('http://paula.es.una.ninja:8888/enablerandomserver?token=' . $first->token);
            $response = Laracurl::get($test);
            $status = $first->status;
            while ($status != 'Running') {
                sleep(1);
                $fisrt = $servers = VpnServer::where(['user_id' => Auth::user()->id, 'random' => 1])->first();
                $status = $fisrt->status;
            }

        }
        $randomServersInfo = RandomServer::where(['user_id' => Auth::user()->id])->first();
        $randomServersInfo->used += 1;
        $randomServersInfo->save();
        return redirect('randomserver');
    }

}