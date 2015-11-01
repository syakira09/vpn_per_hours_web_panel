@if($errors->any())
<ul>
    @foreach($errors->all() as $error)
        <script>Materialize.toast('{{ $error }}', 4000)</script>
    @endforeach
</ul>
@endif