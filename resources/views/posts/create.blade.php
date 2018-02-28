@extends('layout')

@section('content')
	@if($errors->any())
		<ul>
		@foreach($errors->all() as $e)
			<li>{{$e}}</li>
		@endforeach
		</ul>
	@endif

	@if(session('error'))
		{{session('error')}}
	@endif

	<form method="POST" enctype="multipart/form-data">
		{{csrf_field()}}
		<input type="text" name="title" placeholder="Title" value="{{old('title')}}"/><br/>
		<textarea name="content">{{old('text')}}</textarea><br/>
		<select name="category"> {{--a dropdown with all categories for the user to choose, not finished, null check not done yet--}}
			<option value="">Select a category</option>
		@foreach($categories->all() as $c)
			<option value="{{$c->category_name}}">{{$c->category_name}}</option>
			@endforeach
		</select><br/>
		<input type="file" name="photo" /><br/>
		<input type="submit" value="Save" />
	</form>
@endsection	