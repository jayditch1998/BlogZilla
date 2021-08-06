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

class UserController extends Controller
{
    public function login(){
        $password = Hash::make('123456');
        // return $password;
        return view('admin.login');
    }
    public function adminPostLogin(Request $request)
    {
        $email = $request->email;
        $password = $request->password;
        $user = User::where('email', $email)->first();
        if(!$user) return redirect()->back();
        if($user->role != '1') return redirect()->back();
        if (!Hash::check($password, $user->password)) return redirect()->back();

        Auth::login($user);
        return redirect()->route('admin-dashboard');
        
    }
    public function adminLogout()
    {
        Auth::logout(); 
        return redirect()->route('admin-login');
}

    public function authors(){
        $authors = User::where('role', '2')->get();
        return view('admin.authors', compact('authors'));
    }

    public function activateAuthor($id){
        $author = User::find($id);
        $author->status = 'active';
        $author->save();
        return redirect()->route('admin-authors');
    }
    public function deactivateAuthor($id){
        $author = User::find($id);
        $author->status = 'not active';
        $author->save();
        return redirect()->route('admin-authors');
    }
    public function addAuthor(){
        return view('admin.add-author');
    }

    public function postAddAuthor(Request $request){
        $firstName = $request->firstName;
        $lastName = $request->lastName;
        $middleName = $request->middleName;
        $email = $request->email;
        $mobile = $request->mobile;
        
        $password = $request->password;
        $hash = Hash::make($password);

        $addAuthor = User::create([
            'firstName' => $firstName,
            'lastName' => $lastName,
            'middleName' => $middleName,
            'email' => $email,
            'mobile' => $mobile,
            'role' => '2', //author
            'password' => $hash,
        ]);
        return redirect()->route('admin-authors');
    }

    public function editAuthor($id){
        $author = User::where('role', '2')->where('id', $id)->first();
        return view('admin.edit-author', compact('author'));
    }

    public function updateAuthor(Request $request){
        $id = $request->id;
        $firstName = $request->firstName;
        $lastName = $request->lastName;
        $middleName = $request->middleName;
        $email = $request->email;
        $mobile = $request->mobile;

        $updateAuthor =[
            'firstName' => $firstName,
            'lastName' => $lastName,
            'middleName' => $middleName,
            'email' => $email,
            'mobile' => $mobile
        ];
        DB::table('users')->where('id',$id)->update($updateAuthor);
        return redirect()->route('admin-authors');
    }

    public function deleteAuthor($id){
        $author = User::where('id', $id)->first();
        $author->delete();

        return redirect()->route('admin-authors');
    }

    public function users(){
        $users = User::where('role', '3')->get();

        return view('admin.users',compact('users'));
    }

    public function addUser(){
        return view('admin.add-user');
    }

    public function activateUser($id){
        $author = User::find($id);
        $author->status = 'active';
        $author->save();
        return redirect()->route('admin-users');
    }
    public function deactivateUser($id){
        $author = User::find($id);
        $author->status = 'not active';
        $author->save();
        return redirect()->route('admin-users');
    }


    public function postAddUser(Request $request){
        $firstName = $request->firstName;
        $lastName = $request->lastName;
        $middleName = $request->middleName;
        $email = $request->email;
        $mobile = $request->mobile;
        
        $password = $request->password;
        $hash = Hash::make($password);

        $addAuthor = User::create([
            'firstName' => $firstName,
            'lastName' => $lastName,
            'middleName' => $middleName,
            'email' => $email,
            'mobile' => $mobile,
            'role' => '3', //user
            'password' => $hash,
        ]);
        return redirect()->route('admin-users');
    }

    public function editUser($id){
        $user = User::where('role', '3')->where('id', $id)->first();
        return view('admin.edit-user', compact('user'));
    }

    public function updateUser(Request $request){
        $id = $request->id;
        $firstName = $request->firstName;
        $lastName = $request->lastName;
        $middleName = $request->middleName;
        $email = $request->email;
        $mobile = $request->mobile;

        $updateUser =[
            'firstName' => $firstName,
            'lastName' => $lastName,
            'middleName' => $middleName,
            'email' => $email,
            'mobile' => $mobile
        ];
        DB::table('users')->where('id',$id)->update($updateUser);
        return redirect()->route('admin-users');
    }

    public function deleteUser($id){
        $user = User::where('id', $id)->first();
        $user->delete();

        return redirect()->route('admin-users');
    }
}
