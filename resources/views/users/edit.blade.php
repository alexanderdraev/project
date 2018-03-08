@extends('layout')

@section('content')
    @include('messages')

    <form method="POST" action ="{{route('users.update',$user->id)}}" enctype="multipart/form-data">
        {{csrf_field()}}
        @if($user->id>0)
            {{method_field('PUT')}}
        @endif
        <input type="text" name="name" placeholder="Name" value="{{old('name',$user->name)}}"/><br/>
        <input type="email" name="email" placeholder="Email" value="{{old('email',$user->email)}}"/><br/>
    @if($user->image_path)
            <div class="col-md-3">
                <img src="{{URL::to('/' . $user->image_path)}}" class="img-fluid">
            </div>
        @endif
        <input type="file" name="photo" /><br/>
        <input type="submit" value="Save" />
    </form>
@endsection