<?php

namespace App\Http\Controllers;

use App\Models\VpnServer;
use Illuminate\Http\Request;

class ServerHandlerController extends Controller
{

    public function bandwidth(Request $request){
        if (isset($request->token)) {
            $server = VpnServer::where(['token' => $request['token']])->first();
            if (isset($request->transfer) && $server ) {
                if ( $server->count() == 1 ) {
                    $transfer = intval($request->transfer);
                    VpnServer::where(['token' => $request['token']])->update(['transfer' => $transfer]);
                    return 1;
                }
            }
        }
        return 0;
    }

}