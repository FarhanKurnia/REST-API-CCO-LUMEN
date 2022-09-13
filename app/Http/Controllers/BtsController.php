<?php

namespace App\Http\Controllers;
// namespace App\Http\Middleware;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\Models\Destinasi;
use Illuminate\Support\Facades\Auth;
use App\Models\Bts;
use Illuminate\Http\Request;

class BtsController extends Controller
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
            'message' => 'Load data post successfully',
            'data' => Bts::all()
        ], 200);
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
     * @param  \App\Models\Bts  $bts
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
         //
         $message = "Load data post successfully";
         $status = "success";
         $bts = Bts::find($id);

         if (!$bts) {
             $status = "error";
             $message = "Data post not found";
         }

         return response()->json([
             'status' => $status,
             'message' => $message,
             'data' => $bts->where('id',$id)->get()], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Bts  $bts
     * @return \Illuminate\Http\Response
     */
    public function edit(Bts $bts)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Bts  $bts
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Bts $bts)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Bts  $bts
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bts $bts)
    {
        //
    }
}
