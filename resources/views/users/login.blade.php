@extends('layouts.main')

@section('content')

@include('messages')

  <div class="row row mt-5 justify-content-md-center">
  <div>
  	
  </div>
    <form class="form-signin content-center w-50 p-3" method="POST">
      <div class="form-label-group">
        <input type="text" name="email" id="inputEmail" class="form-control" value="{{old('email')}}" placeholder="Email address" required autofocus>
      </div>

      <div class="form-label-group mt-3 mb-3">
        <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required>
      </div>
      <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
      {{csrf_field()}}
    </form>
    </div>
@endsection