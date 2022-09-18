<?php

namespace App\Http\Controllers;

use App\Models\Balasan;
use Illuminate\Http\Request;

class BalasanController extends Controller
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
            'message' => 'Load data Balasan successfully',
            'data' => Balasan::all()], 200);
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
        $message = 'Balasan created successfully';
        $status = "success";

        $user_id = $request->input('user_id');
        $keluhan_id = $request->input('keluhan_id');
        $balasan = $request->input('balasan');
        $lampiran = $request->input('lampiran');

        try {
            Review::create([
                'user_id' => $user_id,
                'keluhan_id' => $keluhan_id,
                'balasan' => $balasan,
                'lampiran' => $lampiran,
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

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Balasan  $balasan
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $message = "Load data post successfully";
        $status = "success";
        $balasan = Balasan::find($id);

        if (!$balasan) {
            $status = "error";
            $message = "Data balasan not found";
        }

        return response()->json([
            'status' => $status,
            'message' => $message,
            'data' => $balasan::with('user')->where('id',$id)->get()], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Balasan  $balasan
     * @return \Illuminate\Http\Response
     */
    public function edit(Balasan $balasan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Balasan  $balasan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Balasan $balasan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Balasan  $balasan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Balasan $balasan)
    {
        //
    }
}
