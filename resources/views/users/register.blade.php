@extends('layout')

@section('content')

@include('messages')

<form method="POST">
	<input 
		type="text" name="email" 
		placeholder="Email..."
		value="{{old('email')}}"
	/>
	
	<input 
		type="text" name="name" 
		placeholder="Name..."
		value="{{old('name')}}"
	/>
<!-- -->
	<input 
	type="password" name="password"
	placeholder="Enter password..." 
	/>

	<input 
	type="password" name="passwordConfirmed"
	placeholder="Enter password again..." 
	/>

	<input 
		type="submit" class="btn btn-info" 
		value="Submit"
	/>
{{csrf_field()}}
</form>
@endsection

