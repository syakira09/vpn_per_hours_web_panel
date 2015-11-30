@extends('dashboard')


@section('content')

    @if( ! $servers->count() )
        <p>Set random servers</p>
        {!! Form::open(['url' => 'randomserver']) !!}
        <div class="row">
            <div class="input-field col s6">
                {!! Form::label('number_of_servers','Number of servers you want to create') !!}
            </div>
        </div>
        <div class="row">
            <div class="input-field col s6">
                {!! Form::select('number_of_servers', [10, 20, 30, 40, 50], null, ['class' => 'validate'] ) !!}
            </div>
        </div>
        <button class="btn waves-effect waves-light" type="submit" name="submit">Create
            <i class="material-icons right"></i>
        </button>
        {!! Form::close() !!}
    @else
        <div class="card blue-grey darken-1">
            <div class="card-content white-text">
                <span class="card-title" >Current random servers</span>
                <p>Created Servers: {{$number}}/{{$requested}}</p>
                <p>Used Servers: {{$used}}/{{$number}}</p>
                <p>Status: {{$status}}</p>
            </div>
            @if($number == $requested)
                <div class="card-action" id="buttons">
                    @if($status == 'Powered off' && $used==0)
                        <a href="{{ URL::to('enablerandomserver')}}" class="waves-effect waves-light btn-large green">Enable Server</a>
                    @elseif($status == 'Powered off' && $used>0)
                        <a href="{{ URL::to('enablerandomserver')}}" class="waves-effect waves-light btn-large green">Power On</a>
                        <a href="{{ URL::to('nextrandomserver')}}" class="waves-effect waves-light btn-large blue">Change server</a>
                    @endif
                    @if($status == 'Running')
                            <a href="{{ URL::to('disablerandomserver')}}" class="waves-effect waves-light btn-large red">Poweroff Server</a>
                            <a href="{{ URL::to('nextrandomserver')}}" class="waves-effect waves-light btn-large blue">Change server</a>
                    @endif
                </div>
            @endif
        </div>
    @endif

@stop