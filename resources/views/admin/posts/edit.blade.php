<x-admin-master>
    @section('content')
        <h1>Edit a Post</h1>
<form action="{{route('post.update', $post->id)}}" enctype="multipart/form-data" method="post">
        @csrf
        @method('PATCH')
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="title" class="form-control" id="title" 
            aria-describedby="" placeholder="Enter Title"
        value="{{$post->title}}">
        </div>
        <div class="form-group">
            <div><img height="100px" src="{{$post->post_image}}" alt=""></div>
            <label for="title">File</label>
            <input type="file" name="post_image" 
            class="form-control-file" id="post_image">
        </div>
        <div class="form-group">
            <label for=""></label>
            <textarea cols="30" rows="10" name="body" 
            class="form-control" id="body"
            value="{{$post->body}}"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    @endsection
</x-admin-master>