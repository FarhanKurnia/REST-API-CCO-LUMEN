<?php

namespace App\Http\Controllers;

use App\Models\Shift;
use Illuminate\Http\Request;

class ShiftController extends Controller
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
            'message' => 'Load data Shift successfully',
            'data' => Shift::get()], 200);
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
        $message = 'Data Shift berhasil dimasukan';
        $status = "success";

        $shift = $request->input('shift');
        $mulai = $request->input('mulai');
        $selesai = $request->input('selesai');


        try {
            Shift::create([
                'shift' => $shift,
                'mulai' => $mulai,
                'selesai' => $selesai,

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

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Shift  $shift
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $message = "Data Shift ditemukan";
        $status = "success";
        $shift = Shift::find($id);
        if (!$shift) {
            $status = "error";
            $message = "Data Shift tidak ditemukan";
            return response()->json([
                'status'=>$status,
                'mesage' =>$message
            ],404);
        }else{
            return response()->json([
                'status' => $status,
                'message' => $message,
                'data' =>$status
            ],200);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Shift  $shift
     * @return \Illuminate\Http\Response
     */
    public function edit(Shift $shift)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Shift  $shift
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $message = 'Data Shift berhasil diupdate';
        $status = "success";

        try {
            Shift::find($id)->update([
                'shift' => $request->shift,
                'mulai' => $request->mulai,
                'selesai' => $request->selesai,
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Shift  $shift
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $message = 'Data Shift berhasil dihapus';
        $status = "success";
        try {
            Shift::find($id)->delete();
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
