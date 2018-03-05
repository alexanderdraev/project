@extends('layout')

@section('content')
	@include('messages')
	@foreach($posts as $p)
		<div>
			{{$p->title}}
		</div>
		<div>
			{{$p->content}}
		</div>
		<div>
			{{$p->category_name}}
		</div>
		<div>
			{{$p->name}}
		</div>
		<div>
			{{$p->updated_at}}
		</div>
		@if(Auth::check() && Auth::user()->isAdmin)
			<a href="{{route('posts.edit', $p->id)}}" class="btn btn-info">Edit</a>
			<form method="POST" action="{{route('posts.destroy', $p->id)}}">
				{{csrf_field()}}
				{{method_field('DELETE')}}
				<button
						type="submit"
						onclick="return confirm('Are you sure you want to delete this item?');"
						class="btn btn-danger"
				>X</button>
			</form>
		@endif
		<div class="col-4">
			<img src="{{ URL::to('/' . $p->imagePath) ? URL::to('/' . $p->imagePath) : url('images/defaultImage.png')}}" class="img-fluid" alt="image not found"/>
		</div>
	@endforeach

@endsection