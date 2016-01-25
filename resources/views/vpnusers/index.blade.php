@extends('dashboard')


@section('content')


    @if(! $users->count())
        <div class="row">
            <div class="col s12 m6">
                <div class="card blue-grey darken-1">
                    <div class="card-content white-text">
                        <span class="card-title">No VPN users</span>
                        <p>You don't have any vpn users yet. Before creating a vpn server you must create one user.</p>
                    </div>
                </div>
            </div>
        </div>
    @else

        <div class="row">
            <div class="col s12">
                <h4>Users</h4>
            </div>
            <div class="col s12 m6">
                <ul class="collection">
                @foreach ($users as $user)
                    <li class="collection-item dismissable"><div>{{ $user->name }}<a  class="secondary-content"><i class="material-icons" onclick="showModalDeleteUser('{{ $user->name }}')">delete</i></a></div></li>
                @endforeach
                </ul>
            </div>
        </div>
    @endif
    @if($users->count() < 10)
    <p>Create a vpn user</p>
    {!! Form::open(['url' => 'vpnusers']) !!}
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
    @else
        <p>You can only create 10 users</p>
    @endif
    @if($error)
        <script>Materialize.toast('{{ $error }}', 4000)</script>
    @endif
    @if( $users->count())
        <div class="row">
            <div class="col s12">
                <h4>Groups</h4>
            </div>
            @if( $groups->count())
            <div class="col s12 m6">
                <ul class="collection">
                    @foreach ($groups as $group)
                        <li class="collection-item dismissable"><div>{{ $group->name }}<a  class="secondary-content"><i class="material-icons" onclick="showModalAddUsersToGroup({{ $group->id}})">perm_identity</i><i class="material-icons" onclick="showModalDeleteGroup('{{ $group->name }}')">delete</i></a></div></li>

                    @endforeach
                </ul>
            </div>
            @endif
        </div>
        <p>Create a vpn group</p>
        {!! Form::open(['url' => 'vpngroups']) !!}
        <div class="row">
            <div class="input-field col s6">
                {!! Form::label('name','group name') !!}
                {!! Form::text('name',null,['class'=>'validate']) !!}
            </div>
        </div>
        <button class="btn waves-effect waves-light" type="submit" name="submit">Create group
            <i class="material-icons right"></i>
        </button>
        {!! Form::close() !!}
    @endif

    <div id="modaldeleteuser" class="modal">
        <div class="modal-content">
            <h4>Really delete user</h4>
            <p id="modaldeleteusertext"></p>
        </div>
        <div class="modal-footer" id="modaldeleteuserfooter">
        </div>
    </div>

    <div id="modaldeletegroup" class="modal">
        <div class="modal-content">
            <h4>Really delete group</h4>
            <p id="modaldeletegrouptext"></p>
        </div>
        <div class="modal-footer" id="modaldeletegroupfooter">
        </div>
    </div>

    <div id="modaladduserstoGroup" class="modal">
        <div class="modal-content">
            <h4>Add user to group</h4>
            <ul id="availableusers">
            </ul>
        </div>
        <div class="modal-footer" id="modaladdusergroupfooter">
        </div>
    </div>

    <script>

        function showModalDeleteUser(name) {
            $('#modaldeleteusertext').text('Do you really want to delete user '+ name + '?');
            $('#modaldeleteuserfooter').html('<a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat">No</a>');
            $('#modaldeleteuserfooter').append('<a onclick=deleteVPNUser("'+name+'") class=" waves-effect waves-green btn-flat">Yes</a>');
            $('#modaldeleteuser').openModal();
        }

        function showModalDeleteGroup(name) {
            $('#modaldeletegrouptext').text('Do you really want to delete group '+ name + '?');
            $('#modaldeletegroupfooter').html('<a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat">No</a>');
            $('#modaldeletegroupfooter').append('<a onclick=deleteVPNGroup("'+name+'") class=" waves-effect waves-green btn-flat">Yes</a>');
            $('#modaldeletegroup').openModal();
        }

        function deleteVPNUser(name) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'DELETE',
                url: '/vpnusers/'+name,
                success: function(){
                    window.location.href = "{{ URL::to('vpnusers')}}";
                }
            });
        }

        function deleteVPNGroup(name) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'DELETE',
                url: '/vpngroups/'+name,
                success: function(){
                    window.location.href = "{{ URL::to('vpnusers')}}";
                }
            });
        }

        function showModalAddUsersToGroup(id) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'POST',
                url: '/vpngroups/getusers',
                data: { id: id } ,
                success: function(avalaibleUsers){
                    $('#availableusers').html("");
                    for (i = 0; i < avalaibleUsers.length; i++) {
                        $('#availableusers').append('<li class="collection-item dismissable"><div>'+avalaibleUsers[i]['name']+'<a  class="secondary-content"><i class="material-icons">perm_identity</i></a></div></li>');
                    }
                    $('#modaladduserstoGroup').openModal();
                }
            });

        }

    </script>

    @include('errors.list')

@stop