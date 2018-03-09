    @extends('layouts.main')

    @section('content')
    @include('messages')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
        @if($post->id>0)
            <h1>Edit Post</h1>
            @else
            <h1>Create Post</h1>
            @endif

             <form method="POST" enctype="multipart/form-data">
  
                    {{csrf_field()}}
            @if($post->id>0)
                {{method_field('PUT')}}
            @endif
            
                <div class="form-group">
                    <label for="title">Title <span class="require">*</span></label>
                    <input type="text" class="form-control" value="{{old('title',$post->title)}}" name="title" />
                </div>
                
                <div class="form-group">
                    <label for="content">Description</label>
                    <textarea rows="5" class="form-control" name="content" >{{old('content',$post->content)}}</textarea>
                </div>

                 <div class="form-group">
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
                </div>

                @if($post->imagePath)

                <div class="col-md-3">
                    <img src="{{URL::to('/' . $post->imagePath)}}" class="img-fluid">
                </div>

                @endif

                <div class="form-group">
                    <input type="file" name="photo" /><br/>
                </div>
         
                <div class="form-group">
                    <p><span class="require">*</span> - required fields</p>
                </div>
                
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">
                        Create
                    </button>
                    <button class="btn btn-default">
                        Cancel
                    </button>
                </div>
                
            </form>
        </div>
        
    </div>
    @endsection