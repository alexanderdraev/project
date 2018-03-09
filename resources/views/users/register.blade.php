@extends('layouts.main')

@section('content')

@include('messages')

<div class="row mt-5 justify-content-md-center">
	<form method="POST" class="form-signin content-center w-50 p-3">

		<div class="form-label-group">
			<input 
			type="text" name="email" 
			placeholder="Email..."
			value="{{old('email')}}" 
			class="form-control" 
		/>	
		</div>
		
		<div class="form-label-group mt-3">
			<input 
				type="text" name="name" 
				placeholder="Name..."
				value="{{old('name')}}"
				class="form-control"
			/>
		</div>
	<!-- -->
		<div class="form-label-group mt-3">
			<input 
			type="password" name="password"
			placeholder="Enter password..."
			class="form-control" 
			/>
		</div>

		<div class="form-label-group mt-3 mb-3">
			<input 
			type="password" name="passwordConfirmed"
			placeholder="Enter password again..."
			class="form-control" 
			/>
		</div>
		
		<input 
			type="submit"
			class="btn btn-lg btn-primary btn-block"
			value="Submit"

		/>
	{{csrf_field()}}
	</form>
</div>

@endsection

