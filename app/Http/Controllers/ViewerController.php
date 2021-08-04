<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Likes;
use DB;

class ViewerController extends Controller
{
    public function login(){
        // $password = Hash::make('123456');
        // return $password;
        return view('login');
    }

    public function index(){
        $posts = Post::whereNull('deleted_at')->with('likes')->get();
        $likes = Likes::where('is_like', '1')->get();
         
        
        // dd($likes);
        
        return view('blogs', compact('posts', 'likes'));
    }

    public function like(Request $request, $id){
        $user_id = auth()->user()->id;
        $check = Likes::where('user_id',$user_id)->where('post_id', $id)->first();
        if(!$check){
        $like = Likes::create([
            'user_id' => $user_id,
            'post_id' => $id,
            'is_like' => '1',
        ]);
        }else{
            $updateAuthor =[
                'is_like' => '1',
            ];
            DB::table('likes')->where('post_id',$id)->where('user_id', $user_id)->update($updateAuthor);
            
        }
        return redirect()->back();
    }
    public function unlike(Request $request, $id){
        $user_id = auth()->user()->id;

        $updateAuthor =[
            'is_like' => '0',
        ];
        DB::table('likes')->where('post_id',$id)->where('user_id', $user_id)->update($updateAuthor);
        return redirect()->back();
    }
}
