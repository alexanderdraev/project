@extends('layouts.main')

@section('content')
    @include('messages')
    @if($id>0)
 <div class="jumbotron">
                  <div class="row">
                      <div class="col-md-4">
                           <img src="{{ URL::to('/' . $user->image_path) ? URL::to('/' . $user->image_path) : url('images/defaultImage.png')}}" class="img-fluid" alt="image not found"/>
                      </div>
                      <div class="col-md-8">
                          <div class="container" style="border-bottom:1px solid black">
                            <h2>{{$user->name}}</h2>
                          </div>
                            <hr>
                          <ul class="container details">
                            <li><p><span class="" style="width:50px;"></span>Email: {{$user->email}}</p></li>
                            <li><p><span class="glyphicon glyphicon-map-marker one" style="width:50px;">Created on: {{$user->created_at}}</span></p></li>
                            <li><p><span class="glyphicon glyphicon-new-window one" style="width:50px;"></span><a href="#">www.example.com</p></a>
                          </ul>
                      </div>
                  </div>
    </div>
@else
    @foreach($user as $u)
        @if(Auth::check() && Auth::id()!=$u->id)
                <div class="jumbotron">
                  <div class="row mt-5">
                      <div class="col-md-4">
                           <img src="{{ URL::to('/' . $u->image_path) ? URL::to('/' . $u->image_path) : url('images/defaultImage.png')}}" class="img-fluid" alt="image not found"/>
                      </div>
                      <div class="col-md-8">
                          <div class="container" style="border-bottom:1px solid black">
                            <h2>{{$u->name}}</h2>
                          </div>
                            <hr>
                          <ul class="container details">
                            <li><p><span class="" style="width:50px;"></span>Email: {{$u->email}}</p></li>
                            <li><p><span class="glyphicon glyphicon-map-marker one" style="width:50px;">Created on: {{$u->created_at}}</span></p></li>
                            <li><p><span class="glyphicon glyphicon-new-window one" style="width:50px;"></span><a href="#">www.example.com</p></a>
                          </ul>
                      </div>
                  </div>
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
        
        @else
        @endif
    @endforeach
    @endif

@endsection