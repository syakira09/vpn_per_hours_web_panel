<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Controller;
use App\User;
use Illuminate\Support\Facades\Mail;
use Validator;
use Input;

class RegistrationController extends Controller
{
    public function store()
    {
        $rules = [
            'first_name' => 'required',
            'last_name' => 'required',
            'country' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:6'
        ];

        $input = Input::only(
            'first_name',
            'last_name',
            'country',
            'email',
            'password',
            'password_confirmation'
        );

        $validator = Validator::make($input, $rules);

        if($validator->fails())
        {
            return Redirect::back()->withInput()->withErrors($validator);
        }


    }
}
