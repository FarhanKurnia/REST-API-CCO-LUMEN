<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;



use App\Models\User;
use Tymon\JWTAuth\Facades\JWTAuth; //use this library

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json([
            'status' => 'success',
            'message' => 'Load data User successfully',
            'data' => User::all()
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $message = 'Data User updated successfully';
        $status = "success";
        $this->validate($request, [
            'name' => 'required|string',
            'pop_id' => 'required',
            'role_id' => 'required',
            'email' => 'required|email',
        ]);

        try {
            $user = User::find($id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'role_id' => $request->role_id,
                'pop_id' => $request->pop_id,
            ]);
        } catch (\Throwable $th) {
            $status = "error";
            $message = $th->getMessage();
            return response()->json([
                'status' => $status,
                'message' => $message], 404);
        }
        return response()->json([
            'status' => $status,
            'message' => $message,
            'data' => $user], 200);
    }

    public function updateAvatar(Request $request) {
        $message = 'Profile picture updated successfully';
        $status = "success";
        $this->validate($request, [
                'avatar' => 'file',
        ]);
        try {
            $user = Auth::user();
            $avatarName = time().'_'.$user->name.'_avatar'.'.'.request()->avatar->getClientOriginalExtension();
            $request->avatar->move('avatar',$avatarName);
            $user->avatar = url('avatar'.'/'.$avatarName);
            $user->save();
        } catch (\Throwable $th) {
            $status = "error";
            $message = $th->getMessage();
            return response()->json([
                'status' => $status,
                'message' => $message], 404);
        }
        return response()->json([
            'status' => $status,
            'message' => $message,
            'data' => $user,
        ], 200);
    }

    public function updateProfile(Request $request)
    {
        $message = 'Data User updated successfully';
        $status = "success";
        // Take JWT ID as ID in Database
        $token = JWTAuth::getToken();
        $jwt_id = JWTAuth::getPayload($token)->toArray();
        $id = $jwt_id['id_user'];

        try {
            User::find($id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
        } catch (\Throwable $th) {
            $status = "error";
            $message = $th->getMessage();
            return response()->json([
                'status' => $status,
                'message' => $message], 404);
        }

        $credentials = $request->only(['email', 'password']);
        if (! $token = Auth::setTTL(7200)->attempt($credentials)) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
        return response()->json([
            'status' => $status,
            'message' => $message,
            'bearer_token' => $token,
            'data' => User::where('id_user',$id)->get()], 200);
    }

    // Show data user by ID JWT
    public function profile()
    {
        // Take JWT ID as ID in Database
        $token = JWTAuth::getToken();
        $id_jwt = JWTAuth::getPayload($token)->toArray();
        $id_user = $id_jwt['id_user'];
        $message = "Load data User successfully";
        $status = "success";
        $user = User::find($id_user);
        if (!$user) {
            $status = "error";
            $message = "Data User not found";
            return response()->json([
                'status' => $status,
                'message' => $message],404);
        }else{
            $user->role;
            $user->pop;
            return response()->json([
                'status' => $status,
                'message' => $message,
                'data' => $user], 200);
        }
    }

    // Show data user by ID JWT
    public function show($id){
        $message = "Data BTS ditemukan";
        $status = "success";
        $user = User::find($id);
        if (!$user) {
            $status = "error";
            $message = "Data User not found";
            return response()->json([
                'status' => $status,
                'message' => $message],404);
        }else{
            $user->role;
            $user->pop;
            return response()->json([
                'status' => $status,
                'message' => $message,
                'data' => $user], 200);
        }
    }

    public function destroy($id)
    {
        $message = 'Data User berhasil dihapus';
        $status = "success";
        try {
            User::find($id)->delete();
        } catch (\Throwable $th) {
            $status = "error";
            $message = $th->getMessage();
            return response()->json([
                'status' => $status,
                'message' => $message], 404);
        }

        return response()->json([
            'status' => $status,
            'message' => $message,
        ], 200);
    }

    // Testing function only to get ID JWT
    // public function getJwt()
    // {
    //     try {
    //         // attempt to verify the credentials and create a token for the user
    //         $token = JWTAuth::getToken();
    //         $id_jwt = JWTAuth::getPayload($token)->toArray();
    //         $id = $id_jwt['id_user'];
    //         return var_dump($id);
    //         // return $id;
    //     }catch (\Exception $e) {
    //         return response()->json(['message' => 'Failed!'], 409);
    //     } catch (\Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
    //         return response()->json(['token_expired'], 500);
    //     } catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
    //         return response()->json(['token_invalid'], 500);
    //     } catch (\Tymon\JWTAuth\Exceptions\JWTException $e) {
    //         return response()->json(['token_absent' => $e->getMessage()], 500);
    //     }
    // }

    // Testing function only to get Payload JWT
    // public function getJWT()
    // {
    //     try {
    //         // attempt to verify the credentials and create a token for the user
    //         $token = JWTAuth::getToken();
    //         $apy = JWTAuth::getPayload($token)->toArray();
    //         return response()->json(['id' => $apy['id'], 'name' => $apy['name'], 'role_id' => $apy['role_id']
    //         ],200);
    //     }catch (\Exception $e) {
    //         return response()->json(['message' => 'Failed!'], 409);
    //     } catch (\Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
    //         return response()->json(['token_expired'], 500);
    //     } catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
    //         return response()->json(['token_invalid'], 500);
    //     } catch (\Tymon\JWTAuth\Exceptions\JWTException $e) {
    //         return response()->json(['token_absent' => $e->getMessage()], 500);
    //     }
    // }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }



}
