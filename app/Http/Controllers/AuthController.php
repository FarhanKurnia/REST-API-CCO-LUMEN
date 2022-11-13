<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

use Illuminate\Http\Request;
use App\Models\User;

class AuthController extends Controller
{
    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    /**
     * Register Function
     *
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'pop_id' => 'required',
            'role_id' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed',
        ]);

        try {
            $user = new User;
            $user->name = $request->get('name');
            $user->pop_id = $request->get('pop_id');
            $user->role_id = $request->get('role_id');
            $user->email = $request->get('email');
            $user->token_verifikasi = Str::random(128);
            $user->password = app('hash')->make($request->get('password'));
            $user->save();

            return response()->json(['user' => $user, 'message' => 'Successfully created!'], 201);

        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed!'], 409);
        }

   }

   public function Verifikasi(Request $request)
   {
    $token_verifikasi = $request->get('token');
    $user = User::where('token_verifikasi',$token_verifikasi)->count();
    if($user>0){
        try{
            User::where('token_verifikasi',$token_verifikasi)->update(['verifikasi'=>true]);
            return response()->json([
                'status' => 'Verifikasi sukses',
                'message' => 'Akunmu sudah diverifikasi'], 200);
        } catch (\Throwable $th) {
            $status = "Gagal";
            $message = $th->getMessage();
            return response()->json([
                'status' => $status,
                'message' => $message], 404);
        }
    }else{
        return response()->json([
            'status' => 'Gagal',
            'message' => 'Akun tidak ditemukan',], 404);
    }
   }

    /**
     * Login Function
     *
     * @return \Illuminate\Http\Response
     */
    //set ttl aexpired
    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|string',
            'password' => 'required|string',
        ]);

        $credentials = $request->only(['email', 'password']);
        if (! $token = Auth::setTTL(480)->attempt($credentials)) {
            return response()->json(['status' => 'Unauthorized','message'=>'data email atau password tidak valid'], 401);
        }
        $verifikasi = Auth::user()->verifikasi;
        if($verifikasi==true){
            return response()->json([
                'id_user' => Auth::user()->id_user,
                'username' => Auth::user()->name,
                'email' => Auth::user()->email,
                'role_id' => Auth::user()->role_id,
                'pop_id' => Auth::user()->pop_id,
                'bearer_token' => $token,
                'expires_in' => Auth::factory()->getTTL()
            ], 200);
        }else{
            return response()->json([
                'status' => 'error',
                'message' => 'Harap lakukan verifikasi akun'
            ],404);
        }
    }

    /**
     * Logout Function
     *
     * @return \Illuminate\Http\Response
     */
    public function logout()
    {
      $token = auth()->tokenById(Auth::user()->id_user);
      try {
        auth()->logout(true);
        return response()->json([
            'status' => 'success',
            'message' => 'User logged out successfully'
        ]);
      } catch (\Exception $e) {
        return response()->json([
            'status' => 'failed',
            'message' => 'Sorry, the user cannot be logged out'
        ]);
      }
    }
}
