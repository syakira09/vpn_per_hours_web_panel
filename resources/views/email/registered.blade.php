@extends('email')

@section('content')
    <h2>Congratulations you are now registered</h2>

    <div>
        You are now registered! Go to {{ URL::to('login') }} to start using our app.<br/>

    </div>

@stop