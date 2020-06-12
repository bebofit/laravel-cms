<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Post;

class AdminsController extends Controller
{
    //
    public function index(){
        return view('admin.index');
    }

    public function createPost(){
        return view('admin.posts.create');
    }

    public function storePost(){
        $inputs = new Post;
        request()->validate([
            'title'=> 'required|min:8|max:255',
            'post_image'=>'mimes:jpeg,png,jpg',
            'body'=>'required'
        ]);
        $inputs->title = request()->title;
        $inputs->body = request()->body;
        if(request('post_image')){
            $inputs->post_image = request()->post_image->store('images');
        }
       auth()->user()->posts()->save($inputs);
        Session::flash('create-message', 'Post was created');
        return redirect()->route('post.index');
    }

    public function getPosts(){
        $posts = Post::paginate(5);
        // $posts = auth()->user()->posts()->paginate(2);
        return view('admin.posts.index',compact('posts'));
    }

    public function deletePost(Post $post){
        $this->authorize('delete', $post);
        $post->delete();
        Session::flash('message', 'Post was deleted');
        return back();
    }
    public function getPost(Post $post){
    $this->authorize('view', $post);
    return view('admin.posts.edit',compact('post'));
    }

    public function editPost(Post $post){
        $this->authorize('update', $post);
        request()->validate([
            'title'=> 'required|min:8|max:255',
            'post_image'=>'mimes:jpeg,png,jpg',
            'body'=>'required'
        ]);
        $post->title = request()->title;
        $post->body = request()->body;
        if(request('post_image')){
            $post->post_image = request()->post_image->store('images');
        }
        $post->save();
        Session::flash('edit-message', 'Post was updated');
        return redirect()->route('post.index');

    }
}
