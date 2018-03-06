@extends('layout')

@section('content')
    @include('messages')
    @foreach($user as $u)
        <div>
            {{$u->name}}
        </div>
        <div>
            {{$u->created_at}}
        </div>
        @if(Auth::check() && Auth::user()->isAdmin)
            <a href="{{route('users.edit', $u->id)}}" class="btn btn-info">Edit</a>
            <form method="POST" action="{{route('users.destroy', $u->id)}}">
                {{csrf_field()}}
                {{method_field('DELETE')}}
                <button
                        type="submit"
                        onclick="return confirm('Are you sure you want to delete this item?');"
                        class="btn btn-danger"
                >X</button>
            </form>
        @endif
        <div class="col-4">
            <img src="{{ URL::to('/' . $u->image_path) ? URL::to('/' . $u->image_path) : url('images/defaultImage.png')}}" class="img-fluid" alt="image not found"/>
        </div>
    @endforeach

@endsection