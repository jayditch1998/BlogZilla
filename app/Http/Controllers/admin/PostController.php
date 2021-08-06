<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Likes;
use App\Models\Comment;
use DB;

class PostController extends Controller
{
    public function posts(){
        $posts = Post::get();
        return view('admin.posts', compact('posts'));
    }

    public function viewPost($id){
        $post = Post::where('id', $id)->first();
        return view('admin.view-post', compact('post'));
    }

    public function addPost(){
        return view('admin.add-post');
    }

    public function postAddPost(Request $request){
        $title = $request->title;
        $body = $request->body;
        $user_name = auth()->user()->firstName. ' ' . auth()->user()->lastName;;
        $user_id = auth()->user()->id;
        $imgName = time().'.'.$request->img->extension();
        $request->img->move(public_path('images'), $imgName);

        // $images = array();
        // if($request->hasFile('img')){
        //     foreach($request->file('img')){

        //     }
        //  }   

        $createPost = Post::create([
            'author_id'=> $user_id,
            'author' => 'Admin',
            'title' => $title,
            'body' => $body,
            'img' => 'images/'.$imgName,
        ]);
        return redirect()->route('admin-posts');
    }

    public function editPost($id){
        $post = Post::where('id', $id)->first();
        return view('admin.edit-post', compact('post'));
    }

    public function postUpdatePost(Request $request){
        $title = $request->title;
        $body = $request->body;
        $user_id = auth()->user()->id;

        

        if(!$request->img){
        $updatePost =[
            
            'title' => $title,
            'body' => $body
        ];
        DB::table('posts')->where('id',$request->id)->update($updatePost);
        }else{
        $imgName = time().'.'.$request->img->extension();
        $request->img->move(public_path('images'), $imgName);
        $updatePost =[
            'img' => 'images/'.$imgName,
            'title' => $title,
            'body' => $body
        ];
        DB::table('posts')->where('id',$request->id)->update($updatePost);
        }

        return redirect()->route('admin-posts');
    }

    public function postComment(Request $request, $id){
        $user_id = auth()->user()->id;
        $user_name = auth()->user()->firstName.' '.auth()->user()->lastName;
        $post_id = $id;
        $post = Post::where('id', $id)->first();
        $comment = $request->comment;
        if(!$comment){
            return redirect()->back();
        }else{
        $comment = Comment::create([
            'author_id' => $post->author_id,
            'post_id' => $post_id,
            'user_id' => $user_id,
            'user_name' => $user_name,
            'comment' => $comment
        ]);
        return redirect()->back();
        }
    }

    public function like(Request $request, $id){
        $user_id = auth()->user()->id;
        $post = Post::where('id', $id)->first();
        $check = Likes::where('user_id',$user_id)->where('post_id', $id)->first();
        if(!$check){
        $like = Likes::create([
            'user_id' => $user_id,
            'post_id' => $id,
            'is_like' => '1',
            'author_id'=>$post->author_id,
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

    public function deletePost($id){
        $post = Post::where('id', $id)->first();
        $post->delete();

        return redirect()->route('admin-posts');
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
