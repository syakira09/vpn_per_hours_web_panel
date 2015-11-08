<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Validator;
use Input;
use Illuminate\Html\HtmlFacade;


class MenuController extends Controller
{
    public function index()
    {
        return view('welcome');
    }
}