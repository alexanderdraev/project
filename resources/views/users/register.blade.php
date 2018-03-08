@extends('layout')

@section('content')

@include('messages')

<form method="POST" enctype="multipart/form-data">
	<input 
		type="text" name="email" 
		placeholder="Email..."
		value="{{old('email')}}"
	/></br>
	
	<input 
		type="text" name="name" 
		placeholder="Name..."
		value="{{old('name')}}"
	/></br>
	<input type="file" name="photo" /><br/>
	<input
	type="password" name="password"
	placeholder="Enter password..." 
	/></br>

	<input 
	type="password" name="passwordConfirmed"
	placeholder="Enter password again..." 
	/></br>

	<input 
		type="submit" class="btn btn-info" 
		value="Submit"
	/>
{{csrf_field()}}
</form>
@endsection

