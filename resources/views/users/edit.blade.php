@extends('layouts.main')

@section('content')
    @include('messages')

<h2 class="text-center font-weight-bold">Edit Profile</h2>
<div class="row justify-content-md-center">
    <form method="POST" action ="{{route('users.update',$user->id)}}" enctype="multipart/form-data">
        {{csrf_field()}}
        @if($user->id>0)
            {{method_field('PUT')}}
        @endif
        <div class="form-label-group">
            <input 
            type="text" name="email" 
            placeholder="Email..."
            value="{{old('email',$user->email)}}"
            class="form-control" 
        />  
        </div>

        <div class="form-label-group mt-3">
            <input 
                type="text" name="name" 
                placeholder="Name..."
                value="{{old('name',$user->name)}}"
                class="form-control"
            />
        </div>
        
        <div class="form-label-group mt-3">
            <input 
            type="password" name="password"
            placeholder="Enter new password..."
            class="form-control" 
            />
        </div>

        <div class="form-label-group mt-3 mb-3">
            <input 
            type="password" name="passwordConfirmed"
            placeholder="Enter new password again..."
            class="form-control" 
            />
        </div>

    @if($user->image_path)
            <div class="col-md-3">
                <img src="{{URL::to('/' . $user->image_path)}}" class="img-fluid">
            </div>
        @endif
        <input class="mb-3" type="file" name="photo" /><br/>
        <input class="btn btn-lg btn-primary btn-block" type="submit" value="Save" />
    </form>
@endsection