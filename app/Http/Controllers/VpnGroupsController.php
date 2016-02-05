<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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

    public function GetVpnUsers(Request $request)
    {
        $usersOfGroup = Auth::user()->vpngroups()->where('id',$request->id)->first()->users()->get()->toArray();
        if($usersOfGroup == []){
            return response()->json(Auth::user()->vpnusers()->get()->toArray());
        }
        else{
            $users = Auth::user()->vpnusers()->get()->toArray();
            $availableUsers = array();
            //dd($users);
            //dd($usersOfGroup);

            foreach($users as $user)
            {
                //dd($user['id']);
                //dd($usersOfGroup);
                $insertado = 0;
                foreach($usersOfGroup as $existingUser){
                    if ( $existingUser['id'] == $user['id']){
                        $insertado = 1;
                        break;
                    }
                }
                if ( $insertado == 0 )
                {
                    array_push($availableUsers, $user);
                }
            }
            return response()->json($availableUsers);
        }

    }

    public function addVpnuserToGroup(Request $request)
    {
        $group = Auth::user()->vpngroups()->where('id', $request->group_id)->first();
        $usersOfGroup = $group->users()->get(['id'])->toArray();
        $userIDs = array();
        foreach($usersOfGroup as $user){
            array_push($userIDs, $user['id']);
        }
        if (in_array($request->user_id, $userIDs)) {
            return 0;//The user is already in the group
        } else {
            $group->users()->attach($request->user_id,array('user_id' => Auth::user()->id));
            return 1;
        }
    }

    public function deleteVpnuserFromGroup(Request $request)
    {
        $group = Auth::user()->vpngroups()->find($request->group_id);
        $group->users()->detach($request->user_id);
        return 1;
    }

}