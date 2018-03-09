@extends('layouts.main')

@section('content')
    @include('messages')
    @foreach($categories as $c)
        <div>
            {{$c->category_name}}
        </div>

            <a href="{{route('categories.edit', $c->id)}}" class="btn btn-info">Edit</a>
            <form method="POST" action="{{route('categories.destroy', $c->id)}}">
                {{csrf_field()}}
                {{method_field('DELETE')}}
                <button
                        type="submit"
                        onclick="return confirm('Are you sure you want to delete this item?');"
                        class="btn btn-danger"
                >X</button>
            </form>

    @endforeach

@endsection