@extends('layout')

@section('content')
    @include('messages')

    <form method="POST" enctype="multipart/form-data">
        {{csrf_field()}}
        @if($post->id>0)
            {{method_field('PUT')}}
        @endif
        <input type="text" name="title" placeholder="Post title" value="{{old('title',$post->title)}}"/><br/>
        <textarea name="content">{{old('content',$post->content)}}</textarea><br/>
        <select name="category">
            <option value="">Select a category</option>
            @foreach($categories->all() as $category)
                @if($post->category_id>0 && $post->category_id === $category->id)
                <option selected value="{{$category->category_name}}">{{$category->category_name}}</option>
                @else
                <option value="{{$category->category_name}}">{{$category->category_name}}</option>
                @endif
            @endforeach

        </select><br/>
        @if($post->imagePath)
            <div class="col-md-3">
                <img src="{{URL::to('/' . $post->imagePath)}}" class="img-fluid">
            </div>
        @endif
        <input type="file" name="photo" /><br/>
        <input type="submit" value="Save" />
    </form>
@endsection