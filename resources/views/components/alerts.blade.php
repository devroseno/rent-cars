@if($errors->any())
    <div class="alert alert-danger">
        <p>Erro!</p>
        <ul>
            @foreach($errors->all() as $error)
                <li>{{$error}}</li>
            @endforeach
        </ul>
    </div>
@endif

@if(Session::has('success'))
    <div class="alert alert-success">
        <p>{{ Session::get('success') }}</p>
    </div>
@endif
