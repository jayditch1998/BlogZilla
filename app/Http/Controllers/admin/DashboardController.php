<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Likes;
use App\Models\Comment;
use App\Models\User;
use DB;

class DashboardController extends Controller
{
    public function index(){
        $posts = Post::whereNull('deleted_at')->with('likes')->with('comments')->get();
        $total_users = User::where('role', '3')->count();
        $total_authors = User::where('role', '2')->count();
        $total_posts = Post::whereNull('deleted_at')->count();
        return view('admin.index', compact('posts', 'total_users', 'total_authors','total_posts'));
    }
}
