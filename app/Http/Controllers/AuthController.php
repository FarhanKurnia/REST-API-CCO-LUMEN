<?php

namespace App\Http\Controllers;

use App\Mail\ForgetPassword;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Mail\Verification;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\View;

use Tymon\JWTAuth\Facades\JWTAuth; //use this library




class AuthController extends Controller
{
    // Register account function
    public function register(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'pop_id' => 'required',
            'role_id' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed',
        ]);

        $email = $request->get('email');
        $valid_email = Str::endsWith($email, '@citra.net.id');
        if ($valid_email == true) {
            try {
                $user = new User;
                $user->name = $request->get('name');
                $user->pop_id = $request->get('pop_id');
                $user->role_id = $request->get('role_id');
                $user->email = $email;
                $user->online = false;
                $user->aktif = true;
                $user->token_verifikasi = Str::random(128);
                $user->password = app('hash')->make($request->get('password'));
                $user->save();
    
                $name = $user->name;
                $email = $user->email;
                $token = $user->token_verifikasi;
                $data = [
                    'title' => 'Email Verification',
                    'name' => $name,
                    // url backend
                    // 'url' => url('api/verification/?token='.$token),
                    // url frontend
                    'url' => 'http://localhost:3000/verification/?token='.$token,
                ];
                Mail::to($email)->send(new Verification($data));
                return response()->json([
                    // 'user' => $user,
                    'status' => 'Success',
                    'message' => 'Successfully created!'], 201);
    
            } catch (\Exception $e) {
                return response()->json([
                    'status' => 'Error',
                    'message' => 'Failed register account!'], 409);
            }
        }else{
            return response()->json([
                // 'user' => $user,
                'status' => 'Error',
                'message' => 'Unvalid Email!'], 409);
        }
   }

   // Forget password function
   public function forgetPassword(Request $request)
   {
        $otp = $request->get('otp');
        $password = $request->get('password');
        $user = User::where('otp',$otp)->count();
        if($user>0){
            try{
                User::where('otp',$otp)->update([
                    'password'=>app('hash')->make($password),
                    'otp' => null,
                ]);
                return response()->json([
                    'status' => 'Success',
                    'message' => 'Updated password successfully',
                    ], 200);
            } catch (\Throwable $th) {
                $status = "Error";
                $message = $th->getMessage();
                return response()->json([
                    'status' => $status,
                    'message' => $message], 404);
            }
        }else{
            return response()->json([
                'status' => 'Error',
                'message' => 'Failed change password',], 404);
        }
   }

   // Request OTP (One Time Password) for forget password
   public function requestOTP(Request $request)
   {
    $token_OTP = Str::random(12);
    $email = $request->get('email');
    $user = User::where('email',$email)->count();

    if($user>0){
        try{
            User::where('email',$email)->update(['otp'=>$token_OTP]);
            $data = [
                'title' => 'Email Forget Password',
                'otp' => $token_OTP,
            ];
            Mail::to($email)->send(new ForgetPassword($data));
            return response()->json([
                'status' => 'Success',
                'message' => 'OTP created successfully',
                // 'otp' => $token_OTP
            ], 200);
        } catch (\Throwable $th) {
            $status = "Error";
            $message = $th->getMessage();
            return response()->json([
                'status' => $status,
                'message' => $message], 404);
        }
    }else{
        return response()->json([
            'status' => 'Error',
            'message' => 'Invalid data',], 404);
    }
   }

   // Verification Account after register
   public function verification(Request $request)
   {
    $token_verifikasi = $request->get('token');
    $user = User::where('token_verifikasi',$token_verifikasi)->count();
    if($user>0){
        try{
            User::where('token_verifikasi',$token_verifikasi)->update(['verifikasi'=>true]);
            return response()->json([
                'status' => 'Success',
                'message' => 'Account verification has been successful'], 200);
        } catch (\Throwable $th) {
            $status = "Error";
            $message = $th->getMessage();
            return response()->json([
                'status' => $status,
                'message' => $message], 404);
        }
    }else{
        return response()->json([
            'status' => 'Error',
            'message' => 'Invalid data',], 404);
    }
   }

    // Login function with JWT
    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|string',
            'password' => 'required|string',
        ]);

        $credentials = $request->only(['email', 'password']);
        if (! $token = Auth::setTTL(480)->attempt($credentials)) {
            return response()->json(['status' => 'Unauthorized','message'=>'Invalid email or password'], 401);
        }
        $aktif = Auth::user()->aktif;
        $verifikasi = Auth::user()->verifikasi;
        $id_user = Auth::user()->id_user;
        if($verifikasi==true && $aktif==true){
            $user = User::find($id_user)->update([
                'online' => true,
            ]);
            return response()->json([
                'id_user' => Auth::user()->id_user,
                // 'username' => Auth::user()->name,
                // 'email' => Auth::user()->email,
                'role_id' => Auth::user()->role_id,
                // 'online' => $user,
                'pop_id' => Auth::user()->pop_id,
                'bearer_token' => $token,
                // 'expires_in' => Auth::factory()->getTTL()
            ], 200);
        }else{
            return response()->json([
                'status' => 'Error',
                'message' => 'Account has not been verified or not active, please verify or activate your account'
            ],404);
        }
    }

    // Logout function with JWT token
    public function logout()
    {
      $token = auth()->tokenById(Auth::user()->id_user);
      $jwt_id = JWTAuth::getPayload($token)->toArray();
      $id_user = $jwt_id['id_user'];
      try {
        $user = User::find($id_user)->update([
            'online' => false,
        ]);
        // auth()->logout(true);
        Auth::guard('jwtapi')->logout();
        return response()->json([
            'status' => 'Success',
            'message' => 'User logged out successfully'
        ],200);
      } catch (\Exception $e) {
        return response()->json([
            'status' => 'Error',
            'message' => 'Sorry, the user cannot be logged out'
        ],404);
      }
    }
}
