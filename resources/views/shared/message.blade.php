@if($errors->any())
    <div class="alert alert-danger mt-3">
        <h4>Error</h4>
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@elseif(Session::has('success'))
    <div class="alert alert-success mt-3">
        <h4>Success</h4>
        <p>{{ Session::get('success') }}</p>
    </div>
@endif