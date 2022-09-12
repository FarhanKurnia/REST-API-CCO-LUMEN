<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;

class AuthController extends Controller
{
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
            $user->password = app('hash')->make($request->get('password'));
            $user->save();

            return response()->json(['user' => $user, 'message' => 'Successfully created!'], 201);

        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed!'], 409);
        }

   }

    /**
     * Login Function
     *
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|string',
            'password' => 'required|string',
        ]);
        $credentials = $request->only(['email', 'password']);
        if (! $token = Auth::setTTL(7200)->attempt($credentials)) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
        return response()->json([
            'userid' => Auth::user()->id,
            'username' => Auth::user()->name,
            'email' => Auth::user()->email,
            'bearer_token' => $token,
            'expires_in' => Auth::factory()->getTTL()
        ], 200);
    }

    /**
     * Logout Function
     *
     * @return \Illuminate\Http\Response
     */
    public function logout()
    {
      $token = auth()->tokenById(Auth::user()->userid);
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

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

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
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
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
