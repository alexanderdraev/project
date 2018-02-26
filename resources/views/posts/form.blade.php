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
		<textarea name="text">{{old('text')}}</textarea><br/>
		<input type="file" name="photo" /><br/>
		<input type="submit" value="Save" />
	</form>
@endsection	