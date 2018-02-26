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
	type="password" name="password"
	placeholder="Enter password..." 
	/>

	<input 
		type="submit" class="btn btn-info" 
		value="Submit"
	/>
{{csrf_field()}}
</form>
@endsection