<?php

namespace App\Http\Controllers;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(){
    	return view('admin.posts');
    }

    public function postAddPost(Request $request){
    	$addPost = Post::create([
    		'title' => $request->title,
    		'type' => $request->type,
    		'description' => $request->description
    	]);
    	return view('admin.posts');
    }
}
