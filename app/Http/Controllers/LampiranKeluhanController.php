<?php

namespace App\Http\Controllers;

use App\Models\Lampiran_Keluhan;
use Illuminate\Http\Request;

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
                'path.*' => 'mimes:doc,pdf,docx,zip,jpeg,jpg,png,mp4,mp3,wav|max:5000'
        ]);
        try {
            $keluhan_id = $request->input('keluhan_id');
            $paths = $request->file('path');
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
            $status = "error";
            $message = $th->getMessage();
            $http_code = 404;
        }
        return response()->json([
            'status' => $status,
            'message' => $message,
        ], $http_code);
    }
}
