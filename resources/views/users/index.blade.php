@extends('layout')

@section('content')
    @include('messages')
    @if($id>0)
        <div>
            {{$user->name}}
        </div>
        <div>
            {{$user->email}}
        </div>
        <div>
            {{$user->created_at}}
        </div>
        <div class="col-4">
            <img src="{{ URL::to('/' . $user->image_path) ? URL::to('/' . $user->image_path) : url('images/defaultImage.png')}}" class="img-fluid" alt="image not found"/>
        </div>
    @else
    @foreach($user as $u)
        @if(Auth::check() && Auth::id()!=$u->id)
            <div>
            {{$u->name}}
        </div>
        <div>
            {{$u->email}}
        </div>
        <div>
            {{$u->created_at}}
        </div>
        @if(Auth::check() && Auth::user()->isAdmin)
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
        @else
        @endif
    @endforeach
    @endif

@endsection