<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function __construct(){

        $this->middleware('auth');
    }

    public function index(){

    }

    public function getCreateVPN(){

    }

}