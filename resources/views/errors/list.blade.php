
@if($errors->any())
    <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
    <script type="text/javascript" src="{{ URL::to('')}}/js/bin/materialize.js"></script>
<ul>
    @foreach($errors->all() as $error)
        <script>Materialize.toast('{{ $error }}', 4000)</script>
    @endforeach
</ul>
@endif