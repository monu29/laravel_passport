<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Validator;

class UserController extends Controller
{
    public function register(Request $request){

    	$res=[];
		$validator = Validator::make($request->all(), [ 
		    'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6',
		]);

        if ($validator->fails()) { 
            return response()->json(['error'=>$validator->errors()]);
        }
        try{
            $User = $request->all();
            $User['password'] = bcrypt($request->password);
            $User = User::create($User);
            $res['status'] = 200;
            $res['message'] = "User register successfully!";
            $res['token'] = $User->createToken('LaravelAuthApp')->accessToken;
            return response()->json(['response' =>$res]);
        } catch (Exception $e) {
            $res['status'] = 400;
            $res['message'] = "Something went wrong..";
            return response()->json(['error' => $res]);
        }
    }
    public function login(Request $request)
    {
    	$res=[];
        $data = [
            'email' => $request->email,
            'password' => $request->password
        ];
        if(auth()->attempt($data)) {
        	$res['status'] = 200;
            $res['message'] = "Login successfully!";
            $res['token'] = auth()->user()->createToken('LaravelAuthApp')->accessToken;
        }else {
        	$res['status'] = 400;
            $res['message'] = "Unauthorised! User";
        }
        return response()->json(['response' => $res]);
    } 
}
