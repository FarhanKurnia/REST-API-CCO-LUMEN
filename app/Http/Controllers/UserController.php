<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
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

    /**
     * Update the specified User with JWT ID.
     * Update User by ID JWT
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $message = 'Data User updated successfully';
        $status = "success";
        // Take JWT ID as ID in Database
        $token = JWTAuth::getToken();
        $jwt_id = JWTAuth::getPayload($token)->toArray();
        $id = $jwt_id['id_user'];
        $this->validate($request, [
            'name' => 'required|string',
            'pop_id' => 'required',
            'role_id' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed',
        ]);

        $name = $request->input('name');
        $email = $request->input('email');
        $password = $request->input('password');
        $role_id = $request->input('role_id');
        $pop_id = $request->input('pop_id');

        try {
            User::find($id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password,
                'role_id' => $request->role_id,
                'pop_id' => $request->pop_id,
            ]);
        } catch (\Throwable $th) {
            $status = "error";
            $message = $th->getMessage();
        }

        return response()->json([
            'status' => $status,
            'message' => $message,
            'data' => User::where('id',$id)->get()], 200);
    }

    // Show data user by ID JWT
    public function show()
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

    // Testing function only to get ID JWT
    public function getJwt()
    {
        try {
            // attempt to verify the credentials and create a token for the user
            $token = JWTAuth::getToken();
            $id_jwt = JWTAuth::getPayload($token)->toArray();
            $id = $id_jwt['id_user'];
            return var_dump($id);
            // return $id;
        }catch (\Exception $e) {
            return response()->json(['message' => 'Failed!'], 409);
        } catch (\Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
            return response()->json(['token_expired'], 500);
        } catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
            return response()->json(['token_invalid'], 500);
        } catch (\Tymon\JWTAuth\Exceptions\JWTException $e) {
            return response()->json(['token_absent' => $e->getMessage()], 500);
        }
    }

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

    /**
     * Display the specified resource.
     * Disable because I use how by JWT
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function show($id)
    // {
    //     //
    //     $message = "Load data User successfully";
    //     $status = "success";
    //     $user = User::find($id);

    //     if (!$user) {
    //         $status = "error";
    //         $message = "Data User not found";
    //     }

    //     return response()->json([
    //         'status' => $status,
    //         'message' => $message,
    //         'data' => $user->where('id',$id)->get()], 200);
    // }




    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
