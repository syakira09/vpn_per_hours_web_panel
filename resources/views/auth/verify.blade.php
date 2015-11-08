@extends('auth')


@section('content')

    <div class="row">
        <div class="col s12"><p><h5 class="center-align">One more step</h5></div>
        <div class="col s12 m4 l2"><p></p></div>
        <div class="col s12 m4 l8"><p>You are now registered, after starting we need to verify your e-mail address. We've just send you and email with te verification link. It will expire in 48 hours.</p></div>
        <div class="col s12 m4 l2"><p></p></div>
    </div>
    <div class="row">
        <div class="col s12 m4 l2"><p></p></div>
        <div class="col s12 m4 l8"><p><a href="#!" class="btn waves-effect waves-teal">Re-send e-amil verification.</a></p></div>
        <div class="col s12 m4 l2"><p></p></div>
    </div>
@stop