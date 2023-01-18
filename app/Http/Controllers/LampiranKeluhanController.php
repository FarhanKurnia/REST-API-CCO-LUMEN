<?php

namespace App\Http\Controllers;

use App\Models\Lampiran_Keluhan;
use Illuminate\Http\Request;
use App\Models\Keluhan;

class LampiranKeluhanController extends Controller
{
    // Index function for get all lampiran keluhan
    public function index()
    {
        return response()->json([
            'status' => 'Success',
            'message' => 'Load data Lampiran successfully',
            'data' => Lampiran_Keluhan::get()], 200);
    }

    // Store lampiran keluhan function
    public function store(Request $request)
    {
        $this->validate($request, [
                'path' => 'required',
                'path.*' => 'mimes:doc,pdf,docx,zip,jpeg,jpg,png,mp4,mp3,wav|max:5000',
                'keluhan_id' => 'required',
        ]);
        $keluhan_id = $request->input('keluhan_id');
        $paths = $request->file('path');
        $keluhan = Keluhan::where('id_keluhan',$keluhan_id)->count();
        if($keluhan > 0){
            try {
                foreach($paths as $path){
                    $new_name = date("Ymd").rand(100,999).'_attachment_keluhan'.'.'.$path->getClientOriginalExtension();
                    $path->move('lampiran',$new_name);
                    $lampirankeluhan= new Lampiran_Keluhan();
                    $lampirankeluhan->path = url('lampiran'.'/'.$new_name);
                    $lampirankeluhan->keluhan_id = $keluhan_id;
                    $lampirankeluhan->save();
                }
                $message = 'Attachment keluhan added successfully';
                $status = 'Success';
                $http_code = 200;
            }catch (\Throwable $th) {
                $status = 'Error';
                $message = $th->getMessage();
                $http_code = 404;
            }
        }else{
        $status = 'Error';
        $message = 'Data Keluhan not found';
        $http_code = 404;
    }
        return response()->json([
            'status' => $status,
            'message' => $message,
        ], $http_code);
    }
}
