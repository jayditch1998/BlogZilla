<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Http\Models\User;

class UserController extends Controller
{
	public function register(Request $request){
	$firstName = $request->firstName;
	$lastName = $request->lastName;
	$middleName = $request->lastName; 
	$email = $request->email; 
	$mobile = $request->mobile; 
	$status = $request->status; 
	$password = Hash::make($request->password));

	$register = User::create([
		'firstName' => $firstName,
		'lastName' => $lastName,
		'middleName' => $middleName,
		'email' => $email,
		'mobile' => $mobile,
		'status' => $status,
		'password' => $password
	]);

	}
}
