@extends('layout')


@section('content')
	@foreach($posts as $p)
	<div>
	{{$p->title}}
	</div>
	<div>
		<img src="{{$p->imagePath ? $p->imagePath : url('images/defaultImage.png')}}" alt="image not found"/>
	</div>
	@endforeach

	<div>
	{{$posts->render()}}
	</div>
@endsection