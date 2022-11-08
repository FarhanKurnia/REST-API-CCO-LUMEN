<?php

namespace App\Http\Controllers;

use App\Models\Balasan;
use Illuminate\Http\Request;

class BalasanController extends Controller
{
    public function index()
    {
        return response()->json([
            'status' => 'success',
            'message' => 'Load data Balasan successfully',
            'data' => Balasan::with('user','lampiranbalasan')->get()], 200);
    }

    public function store(Request $request)
    {
        $message = 'Balasan created successfully';
        $status = "success";

        $user_id = $request->input('user_id');
        $keluhan_id = $request->input('keluhan_id');
        $balasan = $request->input('balasan');

        try {
            Balasan::create([
                'user_id' => $user_id,
                'keluhan_id' => $keluhan_id,
                'balasan' => $balasan,
            ]);
        } catch (\Throwable $th) {
            $status = "error";
            $message = $th->getMessage();
        }

        return response([
            'status' => $status,
            'message' => $message,
        ], 200);
    }

    public function show($id)
    {
        $message = "Load data post successfully";
        $status = "success";
        $balasan = Balasan::find($id);
        if (!$balasan) {
            $status = "error";
            $message = "Data balasan not found";
            return response()->json([
                'status' => $status,
                'message' => $message
            ], 404);
        }else{
            $balasan->user;
            $balasan->user->role;
            $balasan->keluhan;
            $balasan->lampiranbalasan;
            return response()->json([
                'status' => $status,
                'message' => $message,
                'data' => $balasan], 200);
        }
    }
}
