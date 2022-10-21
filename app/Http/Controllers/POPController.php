<?php

namespace App\Http\Controllers;

use App\Models\Pop;
use Illuminate\Http\Request;

class POPController extends Controller
{
    public function index()
    {
        return response()->json([
            'status' => 'success',
            'message' => 'Load data Balasan successfully',
            'data' => POP::get()], 200);
    }

    public function store(Request $request)
    {
        $message = 'Data Role berhasil dimasukan';
        $status = "success";

        $id_pop = $request->input('id_pop');
        $pop = $request->input('pop');

        try {
            POP::create([
                'id_pop' => $id_pop,
                'pop' => $pop,
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
        $message = "Data POP ditemukan";
        $status = "success";
        $pop = POP::find($id);
        if (!$pop) {
            $status = "error";
            $message = "Data POP tidak ditemukan";
            return response()->json([
                'status'=>$status,
                'mesage' =>$message
            ],404);
        }else{
            return response()->json([
                'status' => $status,
                'message' => $message,
                'data' =>$pop
            ],200);
        }
    }

    public function update(Request $request, $id)
    {
        $message = 'Data POP berhasil diupdate';
        $status = "success";

        try {
            POP::find($id)->update([
                'id_pop' => $request->id_pop,
                'pop' => $request->pop,
            ]);
        } catch (\Throwable $th) {
            $status = "error";
            $message = $th->getMessage();
            return response()->json([
                'status'=>$status,
                'mesage' =>$message
            ],404);
        }
        return response()->json([
            'status' => $status,
            'message' => $message,
        ], 200);
    }

    public function destroy($id)
    {
        $message = 'Data POP berhasil dihapus';
        $status = "success";
        try {
            POP::find($id)->delete();
        } catch (\Throwable $th) {
            $status = "error";
            $message = $th->getMessage();
            return response()->json([
                'status'=>$status,
                'mesage' =>$message
            ],404);
        }

        return response()->json([
            'status' => $status,
            'message' => $message,
        ], 200);
    }
}
