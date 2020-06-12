<x-admin-master>
    @section('content')
        <h1>create</h1>
<form action="{{route('post.store')}}" enctype="multipart/form-data" method="post">
        @csrf
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="title" class="form-control" id="title" 
            aria-describedby="" placeholder="Enter Title">
        </div>
        <div class="form-group">
            <label for="title">File</label>
            <input type="file" name="post_image" 
            class="form-control-file" id="post_image">
        </div>
        <div class="form-group">
            <label for=""></label>
            <textarea cols="30" rows="10" name="body" 
            class="form-control" id="body"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    @endsection
</x-admin-master>