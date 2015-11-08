@extends('auth')


@section('content')
    <div class="row">
        {!! Form::open(['url' => 'login','class'=>'col s12']) !!}
            {!! csrf_field() !!}

            <div class="row">
                <div class="input-field col s12">
                    {!! Form::label('email','e-mail Address') !!}
                    {!! Form::email('email',null, ['class' => 'validate']) !!}
                </div>
            </div>

            <div class="row">
                <div class="input-field col s12">
                    {!! Form::label('password','Password') !!}
                    {!! Form::password('password', array('class' => 'validate')) !!}
                </div>
            </div>

            <div class="row">
                <div class="input-field col s12">
                    {!! Form::checkbox('name', 'value') !!}
                    {!! Form::label('remember','Remember me') !!}
                </div>
            </div>

        <button class="btn waves-effect waves-light" type="submit" name="submit">Login
            <i class="material-icons right"></i>
        </button>
        {!! Form::close() !!}
        @include('errors.list')
    </div>
@stop