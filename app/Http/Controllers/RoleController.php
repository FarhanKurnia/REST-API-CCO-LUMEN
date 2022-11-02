<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function indexPublic()
    {
        return response()->json([
            'status' => 'success',
            'message' => 'Load data Balasan successfully',
            'data' => Role::where('role','!=',"ADMIN")->get()], 200);
    }

    public function index()
    {
        $data = Role::get();
        return response()->json([
            'status' => 'success',
            'message' => 'Load data Balasan successfully',
            'data' => $data], 200);
    }

    public function store(Request $request)
    {
        $message = 'Data Role berhasil dimasukan';
        $status = "success";

        $id_role = $request->input('id_role');
        $role = $request->input('role');

        try {
            Role::create([
                'id_role' => $id_role,
                'role' => $role,
            ]);
        } catch (\Throwable $th) {
            $status = "error";
            $message = $th->getMessage();
            return response()->json([
                'status'=>$status,
                'mesage' =>$message
            ],404);
        }

        return response([
            'status' => $status,
            'message' => $message,
        ], 200);
    }

    public function show($id)
    {
        $message = "Data Role ditemukan";
        $status = "success";
        $role = Role::find($id);
        if (!$role) {
            $status = "error";
            $message = "Data Role tidak ditemukan";
            return response()->json([
                'status'=>$status,
                'mesage' =>$message
            ],404);
        }else{
            return response()->json([
                'status' => $status,
                'message' => $message,
                'data' =>$role
            ],200);
        }
    }

    public function update(Request $request, $id)
    {
        $message = 'Data Role berhasil diupdate';
        $status = "success";

        try {
            Role::find($id)->update([
                'id_role' => $request->id_role,
                'role' => $request->role,
            ]);
        } catch (\Throwable $th) {
            $status = "error";
            $message = $th->getMessage();
        }

        return response()->json([
            'status' => $status,
            'message' => $message,
        ], 200);
    }

    public function destroy($id)
    {
        $message = 'Data Role berhasil dihapus';
        $status = "success";
        try {
            Role::find($id)->delete();
        } catch (\Throwable $th) {
            $status = "error";
            $message = $th->getMessage();
        }

        return response()->json([
            'status' => $status,
            'message' => $message,
        ], 200);
    }
}
