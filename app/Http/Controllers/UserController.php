<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Str;


use App\Models\User;
use Tymon\JWTAuth\Facades\JWTAuth; //use this library

class UserController extends Controller
{
    // Index function for get all user
    public function index(Request $request)
    {
        $keyword = $request->get('keyword');
        if($keyword == null){
            $user = User::paginate(10);
        }else if(!empty($keyword)){
            $user = User::where([
                ['name','iLike',"%{$keyword}%"]
            ])->orwhere([
                ['email',$keyword]
            ])->paginate(10);
        }else{
            return response()->json([
                'status'=> "Error",
                'message' => 'Invalid Request',
            ],404);
        }

        if($user->isNotEmpty()){
            return response()->json([
                'status' => 'Success',
                'message' => 'Load data User successfully',
                'data' => $user], 200);
        }else{
            return response()->json([
                'status'=>'Error',
                'message' => 'Load data User not found',
            ],404);
        }   
    }

    // Search User 
    public function search(Request $request)
	{
        $keyword = $request->get('keyword');
        $data = User::where([
                ['name','iLike',"%{$keyword}%"],
                ['aktif',true]
            ])->orwhere([
                ['email',$keyword],
                ['aktif',true]
            ])->paginate(10);

        if($data->isEmpty()){
            return response()->json([
                'status' => 'error',
                'message' => 'Data User not found',
            ], 404);
        }else{
            return response()->json([
                'status' => 'success',
                'message' => 'Data User has found',
                'data' => $data
            ], 200);
        }
    }  

    // Update user by admin
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'pop_id' => 'required',
            'role_id' => 'required',
            'email' => 'required|email',
        ]);
        $email = $request->get('email');
        $valid_email = Str::endsWith($email, '@citra.net.id');
        if ($valid_email == true) {
            try {
                $user = User::find($id)->update([
                    'name' => $request->name,
                    'email' => $request->email,
                    'role_id' => $request->role_id,
                    'pop_id' => $request->pop_id,
                ]);
                $message = 'Data User updated successfully';
                $status = 'Success';
                $http_code = 200;
                return response()->json([
                    'status' => $status,
                    'message' => $message,], $http_code);
            } catch (\Throwable $th) {
                $status = 'Error';
                $message = $th->getMessage();
                $http_code = 404;
                return response()->json([
                    'status' => $status,
                    'message' => $message], $http_code);
            }
        }else{
            return response()->json([
                'status' => 'Error',
                'message' => 'Unvalid Email!'], 409);
        }
    }

    // Update Avatar function
    public function updateAvatar(Request $request)
    {
        $this->validate($request, [
                'avatar' => 'file',
        ]);
        try {
            $user = Auth::user();
            $avatarName = time().'_'.$user->name.'_avatar'.'.'.request()->avatar->getClientOriginalExtension();
            $request->avatar->move('avatar',$avatarName);
            $user->avatar = url('avatar'.'/'.$avatarName);
            $user->save();
            $message = 'Profile picture updated successfully';
            $status = 'Success';
            return response()->json([
                'status' => $status,
                'message' => $message,
                'data' => $user,
            ], 200);
        } catch (\Throwable $th) {
            $status = 'Error';
            $message = $th->getMessage();
            return response()->json([
                'status' => $status,
                'message' => $message], 404);
        }
    }

    // Change password function
    public function changePassword(Request $request)
    {
        // Take JWT ID as ID in Database
        $token = JWTAuth::getToken();
        $jwt_id = JWTAuth::getPayload($token)->toArray();
        $id_user = $jwt_id['id_user'];
        $password = $request->input('password');
        try {
            User::where('id_user',$id_user)->update([
                'password'=>app('hash')->make($password),
            ]);
            Auth::guard('jwtapi')->logout();
            $message = 'Password updated successfully. Please re-login';
            $status = 'Success';
        } catch (\Throwable $th) {
            $status = 'Error';
            $message = $th->getMessage();
            return response()->json([
                'status' => $status,
                'message' => $message], 404);
        }

        return response()->json([
            'status' => $status,
            'message' => $message,], 200);
    }

    // Get profile user by ID JWT
    public function profile()
    {
        // Take JWT ID as ID in Database
        $token = JWTAuth::getToken();
        // dd($token);
        $id_jwt = JWTAuth::getPayload($token)->toArray();
        $id_user = $id_jwt['id_user'];

        $user = User::find($id_user);
        if (!$user) {
            $status = 'Error';
            $message = 'Profile user not found';
            return response()->json([
                'status' => $status,
                'message' => $message],404);
        }else{
            $user->role;
            $user->pop;
            $message = 'Load profile user successfully';
            $status = 'Success';
            return response()->json([
                'status' => $status,
                'message' => $message,
                'data' => $user], 200);
        }
    }

    // Show data user
    public function show($id)
    {
        $user = User::find($id);
        if (!$user) {
            $status = 'Error';
            $message = 'Data User not found';
            return response()->json([
                'status' => $status,
                'message' => $message],404);
        }else{
            $user->role;
            $user->pop;
            $message = 'Get data user';
            $status = 'Success';
            return response()->json([
                'status' => $status,
                'message' => $message,
                'data' => $user], 200);
        }
    }

    // Soft-Delete (deactivate) user
    public function deactivate($id)
    {
        try {
            $user = User::find($id)->update([
                'aktif' => false,
            ]);
            $message = 'Data User Unactivated successfully';
            $status = 'Success';
            $http_code = 200;
        } catch (\Throwable $th) {
            $status = 'Error';
            $message = $th->getMessage();
            $http_code = 404;
        }

        return response()->json([
            'status' => $status,
            'message' => $message,
        ], $http_code);
    }

    // Activate user
    public function activate($id)
    {
        try {
            $user = User::find($id)->update([
                'aktif' => true,
            ]);
            $message = 'Data User Activated successfully';
            $status = 'Success';
            $http_code = 200;
        } catch (\Throwable $th) {
            $status = 'Error';
            $message = $th->getMessage();
            $http_code = 404;
        }

        return response()->json([
            'status' => $status,
            'message' => $message,
        ], $http_code);
    }
}
