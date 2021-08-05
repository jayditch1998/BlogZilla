<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;
use DB;
use Illuminate\Support\Facades\Hash;
use Auth;
use Carbon\Carbon;
class AuthorController extends Controller
{
    public function login(){
        // $password = Hash::make('123456');
        // return $password;
        return view('author.login');
    }

    public function authorPostLogin(Request $request)
    {
        $email = $request->email;
        $password = $request->password;
        $user = User::where('email', $email)->first();
        if(!$user) return redirect()->back();
        if($user->role == '1') return redirect()->back();
        if (!Hash::check($password, $user->password)) return redirect()->back();

        Auth::login($user);
        if($user->role == '2'){
        return redirect()->route('author-dashboard');
        }elseif($user->role == '3'){
            return redirect()->route('home');
        }
        
    }

    public function authorLogout()
    {
        Auth::logout(); 
        return redirect()->route('author-login');
    }  
    
    public function register(){
        return view('author.register');
    }

    public function postRegister(Request $request){
        // $id = $request->id;
        $firstName = $request->firstName;
        $lastName = $request->lastName;
        $middleName = $request->middleName;
        $email = $request->email;
        $mobile = $request->mobile;
        $role = $request->role;
        
        $password = $request->password;
        $hash = Hash::make($password);

        $user = User::create([
            'firstName' => $firstName,
            'lastName' => $lastName,
            'middleName' => $middleName,
            'email' => $email,
            'mobile' => $mobile,
            'role' => $role, //author
            'password' => $hash,
        ]);
        Auth::login($user);
        if($role == 2){
            return redirect()->route('author-dashboard');
        }else{
        return redirect()->route('home');
        }
    }

    public function dashboard(){
       
        return view('author.dashboard');
    }

    public function posts(){
        $user_id = auth()->user()->id;
        // $publisher = auth()->user()->firstName.' '.auth()->user()->lastName;

        // dd($publisher);
        // dd($user_id);
        $posts = Post::where('author_id', $user_id)->with('likes')->get();
        // dd($posts);
        return view('author.posts', compact('posts'));
    }
    
    public function addPost(){
        return view('author.add-post');
    }

    public function postAddPost(Request $request){
        $title = $request->title;
        $body = $request->body;
        $author_id = auth()->user()->id;
        $publisher = auth()->user()->firstName.' '.auth()->user()->lastName;

        // dd($publisher);

        $createPost = Post::create([
            'author_id' => $author_id,
            'publisher' => $publisher,
            'title' => $title,
            'body' => $body,
        ]);
        return redirect()->route('author-posts');
    }

    public function editPost($id){
        $post = Post::where('id', $id)->first();
        return view('author.edit-post', compact('post'));
    }
    
    public function postUpdatePost(Request $request){
        $title = $request->title;
        $body = $request->body;

        $updatePost =[
            'title' => $title,
            'body' => $body
        ];
        DB::table('posts')->where('id',$request->id)->update($updatePost);

        return redirect()->route('author-posts');
    }

    public function deletePost($id){
        $post = Post::where('id', $id)->first();
        $post->delete();

        return redirect()->route('author-posts');
    }

}
