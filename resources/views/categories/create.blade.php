@extends('layouts.main')

@section('content')
    @include('messages')

   @if(session('error'))
        {{session('error')}}
    @endif

    <form method="POST" class="mt-5" enctype="multipart/form-data">
        @if($category->id>0)
            {{method_field('PUT')}}
        @endif
        {{csrf_field()}}
        <input type="text" name="category_name" placeholder="Category..." value="{{old('category_name',$category->category_name)}}"/>
        <input type="submit" class="btn btn-info"  value="Create New Category" />
    </form>
@endsection