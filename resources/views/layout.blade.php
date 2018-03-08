<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <base href="http://localhost/project/public/">
</head>
<style>
.navbar-nav li{
	display: inline-table !important;
}
</style>
<body>
<nav class="navbar navbar-light bg-faded">
    <ul class="navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="{{url('/')}}">Home <span class="sr-only">(current)</span></a>
      </li>
      
     <li class="nav-item">
        <a class="nav-link" href="{{route('posts.index')}}">List Posts</a>
      </li>
      @auth

      @if(Auth::user()->isAdmin === 1)
      <li class="nav-item">
        <a class="nav-link" href="{{route('posts.create')}}">Create Post</a>
      </li>
      @endif
      
      <li class="nav-item">
        <a class="nav-link" href="{{route('logout')}}">Logout</a>
      </li>
      @endauth

      @guest
      <li class="nav-item">
      	<a class="nav-link" href="{{route('login')}}">
      		Login
      	</a>
      </li>

      <li class="nav-item">
      	<a class="nav-link" href="{{route('users.create')}}">
      		Register
      	</a>
      </li>
      @endguest
    </ul>
</nav>
<div class="container">

	@yield('content')
</div>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>