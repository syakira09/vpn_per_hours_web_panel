<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\VpnGroup;
use App\Http\Requests;

class VpnGroupsController extends Controller
{
    public function __construct()
    {

        $this->middleware('auth');
        $this->middleware('verify');
    }

    public function store(Requests\VpnGroupRequest $request)
    {
        $error = "";
        $users = Auth::user()->vpnusers()->get();
        $groups = Auth::user()->vpngroups()->get();
        if ($groups->count() < 10) {
            foreach ($groups as $group) {
                if ($request->name == $group->name) {
                    $error = "You've already added a group with this name.";
                    return view('vpnusers.index')->with(compact('users', 'groups', 'error'));
                }
            }
            $request['user_id'] = Auth::user()->id;
            VpnGroup::create($request->all());
            return redirect('vpnusers');
        } else {
            $error = "You can only create 10 groups";
            return view('vpnusers.index')->with(compact('users', 'groups', 'error'));
        }

    }

    public function destroy($name)
    {
        Auth::user()->vpngroups()->where(['user_id' => Auth::user()->id])->where(['name' => $name])->delete();
    }

}