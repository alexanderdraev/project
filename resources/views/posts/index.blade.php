@extends('layouts.main')

@section('content')

	@include('messages')

	@foreach($posts as $p)
<div class="row">
  <div class="col-md-8">
    <div class="row">
      <div class="col-md-8">
        <h4><strong><a href="#">{{$p->title}}</a></strong></h4>
      </div>
    </div>
    <div class="row">
      <div class="col-md-4">
        <a href="{{route('posts.index', $p->id)}}" class="thumbnail">
            <img src="{{ URL::to('/' . $p->imagePath) ? URL::to('/' . $p->imagePath) : url('images/defaultImage.png')}}" class="img-fluid" alt="image not found"/>
        </a>
      </div>
      <div class="col-md-6">      
        <p>
         {{$p->content}}
        </p>
      </div>
    </div>
    <div class="row">
      <div class="col-md-8">
        <p></p>
        <p>
          <i class="glyphicon glyphicon-user"></i> by <a href="{{route('users.index', $p->user->id)}}">{{$p->user->name}}</a> 
          | <i class="glyphicon glyphicon-calendar"></i> {{$p->updated_at}}
          | <i class="glyphicon glyphicon-comment"></i> <a href="{{route('posts.index', $p->id)}}">Comments</a>
          | <i class="glyphicon glyphicon-tag"></i> Category : <a href="#"><span class="label label-info">{{$p->category->category_name}}</span></a> 
        </p>
		
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

    @if(Auth::check()&&$id>0)
      <form method="POST" action="{{route('comments.store',$p->id)}}" enctype="multipart/form-data">
        {{csrf_field()}}
        <textarea name="content">{{old('content')}}</textarea><br/>
        <input type="submit" value="Create Comment" />
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
          <input type="submit" value="Edit Comment" />
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

      </div>
    </div>
  </div>
</div>
<hr>
	@endforeach
@endsection