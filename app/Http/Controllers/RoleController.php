<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    // Index function to get All Role except Admin (for registration user/ no admin)
    public function indexPublic()
    {
        return response()->json([
            'status' => 'Success',
            'message' => 'Load data role successfully',
            'data' => Role::where('role','!=',"ADMIN")->get()], 200);
    }

    // Index function to get All Role without exception
    public function index()
    {
        $data = Role::get();
        return response()->json([
            'status' => 'Success',
            'message' => 'Load data role successfully',
            'data' => $data], 200);
    }

    // Store Role function
    public function store(Request $request)
    {
        $id_role = $request->input('id_role');
        $role = $request->input('role');
        try {
            Role::create([
                'id_role' => $id_role,
                'role' => $role,
            ]);
            $message = 'Role added successfully';
            $status = 'Success';
            $http_code = 200;
        } catch (\Throwable $th) {
            $status = 'Error';
            $message = $th->getMessage();
            $http_code = 404;
        }

        return response([
            'status' => $status,
            'message' => $message,
        ], $http_code);
    }

    // Show Role function
    public function show($id)
    {
        $role = Role::find($id);
        if (!$role) {
            $status = 'Error';
            $message = 'Data Role not found';
            $http_code = 404;
            return response()->json([
                'status'=>$status,
                'mesage' =>$message
            ],$http_code);
        }else{
            $message = 'Data Role has found';
            $status = 'Success';
            $http_code = 200;
            return response()->json([
                'status' => $status,
                'message' => $message,
                'data' =>$role
            ],$http_code);
        }
    }

    // Update Role function
    public function update(Request $request, $id)
    {
        try {
            Role::find($id)->update([
                'id_role' => $request->id_role,
                'role' => $request->role,
            ]);
            $message = 'Data Role updated successfully';
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

    // Delete Role function
    public function destroy($id)
    {
        try {
            Role::find($id)->delete();
            $message = 'Data Role deleted successfully';
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
