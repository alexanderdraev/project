@extends('layout')

@section('content')
    @include('messages')

   @if(session('error'))
        {{session('error')}}
    @endif

    <form method="POST" enctype="multipart/form-data">
        @if($category->id>0)
            {{method_field('PUT')}}
        @endif
        {{csrf_field()}}
        <input type="text" name="category_name" placeholder="Category..." value="{{old('category_name',$category->category_name)}}"/><br/>
        <input type="submit" value="Save" />
    </form>
@endsection