<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    public function posts(){
        $posts = Post::get();
        return view('admin.posts', compact('posts'));
    }

    public function addPost(){
        return view('admin.add-post');
    }

    public function postAddPost(Request $request){
        $title = $request->title;
        $body = $request->body;

        $createPost = Post::create([
            'title' => $title,
            'body' => $body,
        ]);
        return view('admin.posts');
    }

    // public function delete($id){
    //     return response()->json(Post::destroy($id));
    // }
    // public function put(Request $request,$id){
    //     $post = Post::where('id', $id)->first();
    //     $post->title = $request->title;
    //     $post->body =$request->body;
    //     $post->save();
    //     return response()->json($post);
    // }
    // public function post(Request $request){
    //     $post = new Post();
    //     $post->title = $request->title;
    //     $post->body =$request->body;
    //     $post->save();
    //     return response()->json($post);
    // }
}
