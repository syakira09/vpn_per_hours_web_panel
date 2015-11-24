@extends('auth')


@section('content')


<?php $countries = \Webpatser\Countries\Countries::lists('name','country_code') ?>

        <div class="row">
            {!! Form::open(['url' => 'register','class'=>'col s12']) !!}
                <div class="row">
                    <div class="input-field col s6">
                        {!! Form::label('first_name Name','First Name') !!}
                        {!! Form::text('first_name',null,['class'=>'validate']) !!}
                    </div>
                    <div class="input-field col s6">
                        {!! Form::label('last_name','Last Name') !!}
                        {!! Form::text('last_name',null,['class'=>'validate']) !!}
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        {!! Form::label('country','Country') !!}
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">

                        {!! Form::select('country', $countries, null, ['class' => 'validate'] ) !!}
                    </div>
                </div>
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
                        {!! Form::label('password_confirmation','Repeat Password') !!}
                        {!! Form::password('password_confirmation', array('class' => 'validate')) !!}
                    </div>
                </div>
                <button class="btn waves-effect waves-light" type="submit" name="submit">Register
                    <i class="material-icons right"></i>
                </button>
            {!! Form::close() !!}
            @include('errors.list')
    </div>


@stop