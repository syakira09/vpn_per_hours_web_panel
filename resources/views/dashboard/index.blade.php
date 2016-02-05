@extends('dashboard')


@section('content')
   <?php $zones = App\Models\Zones::lists('zonename') ?>

   @if( ! $servers->count() )
       <div class="row">
           <div class="col s12 m6">
               <div class="card blue-grey darken-1">
                   <div class="card-content white-text">
                       <span class="card-title">No VPN servers</span>
                       <p>You don't have any vpn servers.</p>
                   </div>
               </div>
           </div>
       </div>
       @else
       <div class="row">
           <div class="col s12">
               <h4>Servers</h4>
           </div>
           <div class="row">
               <div class="col s12 m6">
                   @foreach($servers as $server)
                       <div class="card blue-grey darken-1">
                           <div class="card-content white-text" id="server-{{$server->token}}">
                               <span class="card-title" >Server in {{$zones[$server->zone]}}</span>
                               <p>Name: {{$server->name}}</p>
                               <p>Status: {{$server->status}}</p>
                           </div>
                           <div class="card-action" id="buttons-{{$server->token}}">
                               @if($server->status == 'Powered off')
                                   <a class="waves-effect waves-light btn-large green" onclick=powerOn("{{$server->token}}")>Power On</a><a class="waves-effect waves-light btn-large red" onclick=deleteServer("{{$server->token}}")>Delete</a>
                               @elseif($server->status == 'Running')
                                   <a class="waves-effect waves-light btn-large red darken-1" onclick=powerOff("{{$server->token}}")>Power Off</a><a class="waves-effect waves-light btn-large red" onclick=deleteServer("{{$server->token}}")>Delete</a>
                               @else
                                   <a class="btn-large disabled">Delete Server</a>
                               @endif
                           </div>
                       </div>
                   @endforeach
               </div>
           </div>
       </div>
   @endif
   <p>Create VPN server</p>
   {!! Form::open(['url' => 'servers']) !!}
   <div class="row">
      <div class="input-field col s6">
         {!! Form::label('zone','Zone') !!}
      </div>
   </div>
   <div class="row">
      <div class="input-field col s6">
         {!! Form::select('zone', $zones, null, ['class' => 'validate'] ) !!}
      </div>
   </div>
   <div class="row">
       <p>VPN groups</p>
       <div class="input-field col s6">
           {!! Form::checkbox('addvpngroups',null, false,['id' => 'addvpngroups']) !!}
           {!! Form::label('addvpngroups','Choose VPN groups',['onclick' => 'showGroups()']) !!}
       </div>
   </div>
   <div class="row" id="vpngroups">

   </div>
   <div class="row">
       <button class="btn waves-effect waves-light" type="submit" name="submit">Create zone
          <i class="material-icons right"></i>
       </button>
   </div>
   {!! Form::close() !!}
   @include('errors.list')
    <script>

        showgroups=0;

        function showGroups()
        {
            if (showgroups)
            {
                showgroups = 0;
                $( '#vpngroups').html('');
            }
            else{
                showgroups =1;
                $( '#vpngroups').html('');
                @foreach($vpnGroups as $group)
                    $( '#vpngroups').append('<input id="'+"{{$group->name}}"+'" name="'+"{{$group->name}}"+'" type="checkbox">');
                    $( '#vpngroups').append('<label for="'+"{{$group->name}}"+'">'+"{{$group->name}}"+'</label>');
                @endforeach

            }
        }

        function powerOff(token) {

            $.ajax({
                headers: {
                    'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'POST',
                url: '/poweroff',
                data: {token: token},
                context: document.body
            }).done(function() {
                $( '#buttons-'+token ).html('<a class="btn-large disabled">Delete Server</a>');
            });

        }

        function powerOn(token) {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'POST',
                url: '/poweron',
                data: {token: token},
                context: document.body
            }).done(function() {
                $( '#buttons-'+token ).html('<a class="btn-large disabled">Delete Server</a>');
            });

        }

        function deleteServer(token) {
            if (confirm('Really delete?')) {
                $( '#buttons-'+token ).html('');
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: 'DELETE',
                    url: '/servers/'+token,
                    success: function(){
                        window.location.href = "{{ URL::to('dashboard')}}";
                    }
                });
            }
        }

        function retrieveServerData(token) {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.getJSON('/servers/' + token, function (data) {
                firstdiv = '<span class="card-title" >Server in '+data['zone']+'</span><p>Name: '+data['name']+'</p><p>Status: '+data['state']+'</p>';
                $( '#server-'+token ).html(firstdiv);
                switch (data['state'])
                {
                    case 'Powering off':
                        $( '#buttons-'+token ).html('<a class="btn-large disabled">Delete Server</a>');
                        break;
                    case 'Powered off':
                        $( '#buttons-'+token ).html('<a class="waves-effect waves-light btn-large green" onclick="powerOn(\''+token+'\')">Power On</a><a class="waves-effect waves-light btn-large red" onclick=deleteServer(\''+token+'\')>Delete</a>');
                        break;
                    case 'Powering on':
                        $( '#buttons-'+token ).html('<a class="btn-large disabled">Delete Server</a>');
                        break;
                    case 'Running':
                        $( '#buttons-'+token ).html('<a class="waves-effect waves-light btn-large red darken-1" onclick="powerOff(\''+token+'\')">Power Off</a><a class="waves-effect waves-light btn-large red" onclick=deleteServer(\''+token+'\')>Delete</a>');
                        break;
                    default:
                        $( '#buttons-'+token ).html('<a class="btn-large disabled">Delete Server</a>');
                        break;
                }

            })

        }
        @foreach($servers as $server)
            setInterval("retrieveServerData('{{$server->token}}')",1000);
        @endforeach


    </script>
@stop