<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Likes;
use App\Models\Comment;
use DB;
use Illuminate\Support\Facades\Validator;

class ViewerController extends Controller
{
    public function login(){
        // $password = Hash::make('123456');
        // return $password;
        return view('login');
    }

    public function data(){
        $posts = Post::whereNull('deleted_at')->with('likes')->with('comments')->get();
         
        return response()->json(
            array
            (
            'blogs' => $posts
            )
        );
        // dd($likes);
        
    }

    public function index () {
        $posts = Post::whereNull('deleted_at')->with('likes')->with('comments')->get();
        return view('blogs', compact('posts'));
    }

    public function like(Request $request, $id){
        $user_id = auth()->user()->id;
        $post = Post::where('id', $id)->first();
        $check = Likes::where('user_id',$user_id)->where('post_id', $id)->first();
        // $checkLike= Likes::where('user_id',$user_id)->where('post_id', $id)->
        if(!$check){
        $like = Likes::create([
            'user_id' => $user_id,
            'post_id' => $id,
            'is_like' => '1',
            'author_id'=>$post->author_id,
        ]);
        }else if($check->is_like == 1){
            $updateAuthor =[
                'is_like' => '0',
            ];
            DB::table('likes')->where('post_id',$id)->where('user_id', $user_id)->update($updateAuthor);
        }else{
            $updateAuthor =[
                'is_like' => '1',
            ];
            DB::table('likes')->where('post_id',$id)->where('user_id', $user_id)->update($updateAuthor);
            
        }
        return redirect()->back();
        // return response()->json([
        //     'status'=>200,
        //     'message'=>'',
        // ]);

    }
    public function unlike(Request $request, $id){
        $user_id = auth()->user()->id;

        $updateAuthor =[
            'is_like' => '0',
        ];
        DB::table('likes')->where('post_id',$id)->where('user_id', $user_id)->update($updateAuthor);
        return redirect()->back();
    }

    public function postComment(Request $request, $id){
        $user_id = auth()->user()->id;
        $user_name = auth()->user()->firstName.' '.auth()->user()->lastName;
        $post_id = $id;
        $post = Post::where('id', $post_id)->first();
        
        $comment = $request->comment;
        if(!$comment){
            return redirect()->back();
        }else{
        $comment = Comment::create([
            
            'post_id' => $post_id,
            'user_id' => $user_id,
            'user_name' => $user_name,
            'comment' => $comment,
            'author_id' => $post->author_id,
        ]);
        return redirect()->back();
        }
    }

    public function view($id){
        $post = Post::where('id', $id)->with('likes')->with('comments')->first();
        return view('view-post', compact('post'));
    }
}
