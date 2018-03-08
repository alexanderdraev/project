@extends('layout')

@section('content')
    @include('messages')

    <form method="POST" enctype="multipart/form-data">
        {{csrf_field()}}
        @if($comment->id>0)
            {{method_field('PUT')}}
        @endif
        <textarea name="content">{{old('content',$comment->content)}}</textarea><br/>
        <input type="submit" value="Save" />
    </form>
@endsection