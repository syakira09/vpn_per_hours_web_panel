@extends('dashboard')


@section('content')

   <p>Create your first vpn</p>
   {!! Form::open(['url' => 'vpnservers']) !!}
   <div class="row">
      <div class="input-field col s6">
         {!! Form::label('name','username') !!}
         {!! Form::text('name',null,['class'=>'validate']) !!}
      </div>
   </div>
   <div class="row">
      <div class="input-field col s6">
         {!! Form::label('password','Password') !!}
         {!! Form::password('password', array('class' => 'validate')) !!}
      </div>
   </div>
   <button class="btn waves-effect waves-light" type="submit" name="submit">Create user
      <i class="material-icons right"></i>
   </button>
   {!! Form::close() !!}

@stop