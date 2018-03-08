@extends('layout')

@section('content')
	@include('messages')
	@foreach($posts as $p)
		<div>
			{{$p->title}}
		</div>
		<div>
			{{$p->updated_at}}
		</div>
		<div>
			{{$p->category->category_name}}
		</div>
		<div>
			{{$p->user->name}}
		</div>
		@if(Auth::check() && Auth::id()==$p->user_id)
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
		<div>
			{{$p->content}}
		</div>
		@if(Auth::check()&&$id>0)
			<form method="POST" action="{{route('comments.store',$p->id)}}" enctype="multipart/form-data">
				{{csrf_field()}}
				<textarea name="content">{{old('content')}}</textarea><br/>
				<input type="submit" value="Save" />
			</form>
		@endif
		@if($id>0)
			@foreach($comments->all() as $c)
				<div>
					{{$c->content}}
				</div>
				<div>
					{{$c->updated_at}}
				</div>
				<div>
					{{$c->user->name}}
				</div>
				@if(Auth::check() && Auth::id()==$c->user_id)
					<form method="POST" action="{{route('comments.update',[$p->id,$c->id])}}" enctype="multipart/form-data">
					{{csrf_field()}}
						{{method_field('PUT')}}
						<textarea name="content">{{old('content',$c->content)}}</textarea><br/>
					<input type="submit" value="Save" />
					</form>
					<form method="POST" action="{{route('comments.destroy', [$p->id,$c->id])}}">
						{{csrf_field()}}
						{{method_field('DELETE')}}
						<button
								type="submit"
								onclick="return confirm('Are you sure you want to delete this item?');"
								class="btn btn-danger"
						>X</button>
					</form>
				@endif
			@endforeach
		@endif
	@endforeach
@endsection
