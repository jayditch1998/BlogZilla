<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    public function get(){
        return Post::get();
    }
    public function delete($id){
        return response()->json(Post::destroy($id));
    }
    public function put(Request $request,$id){
        $post = Post::where('id', $id)->first();
        $post->title = $request->title;
        $post->body =$request->body;
        $post->save();
        return response()->json($post);
    }
    public function post(Request $request){
        $post = new Post();
        $post->title = $request->title;
        $post->body =$request->body;
        $post->save();
        return response()->json($post);
    }
}
