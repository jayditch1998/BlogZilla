<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
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
        if($user->role != '2') return redirect()->back();
        if (!Hash::check($password, $user->password)) return redirect()->back();

        Auth::login($user);
        return redirect()->route('author-dashboard');
        
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
        
        $password = $request->password;
        $hash = Hash::make($password);

        $user = User::create([
            'firstName' => $firstName,
            'lastName' => $lastName,
            'middleName' => $middleName,
            'email' => $email,
            'mobile' => $mobile,
            'role' => '2', //author
            'password' => $hash,
        ]);
        Auth::login($user);
        return redirect()->route('author-dashboard');
    }

    public function dashboard(){
       
        return view('author.dashboard');
    }

    public function posts(){
        $user_id = auth()->user()->id;
        // $publisher = auth()->user()->firstName.' '.auth()->user()->lastName;

        // dd($publisher);
        // dd($user_id);
        $posts = Post::where('author_id', $user_id)->get();
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
}
