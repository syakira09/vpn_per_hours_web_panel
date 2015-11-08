@extends('email')

@section('content')
    <h2>Please, verify Your Email Address</h2>

    <div>
        Thanks for register. Go to {{ URL::to('verify/' . $confirmation_code) }}.<br/>

    </div>

@stop