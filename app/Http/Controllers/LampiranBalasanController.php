<?php

namespace App\Http\Controllers;

use App\Models\Lampiran_Balasan;
use Illuminate\Http\Request;

class LampiranBalasanController extends Controller
{
    // Index function for get all lampiran balasan
    public function index()
    {
        return response()->json([
            'status' => 'Success',
            'message' => 'Load data Lampiran successfully',
            'data' => Lampiran_Balasan::get()], 200);
    }

    // Store lampiran balasan function
    public function store(Request $request)
    {
        $this->validate($request, [
                'path.*' => 'mimes:doc,excel,pdf,docx,zip,jpeg,jpg,png,mp4,wav,mp3|max:5000'
        ]);
        try {
            $balasan_id = $request->input('balasan_id');
            $paths = $request->file('path');
            foreach($paths as $path){
                $new_name = date("Ymd").rand(100,999).'_attachment_balasan'.'.'.$path->getClientOriginalExtension();
                $path->move('lampiran',$new_name);
                $lampiranbalasan= new Lampiran_Balasan();
                $lampiranbalasan->path = url('lampiran'.'/'.$new_name);
                $lampiranbalasan->balasan_id = $balasan_id;
                $lampiranbalasan->save();
            }
            $message = 'Attachment balasan added successfully';
            $status = 'Success';
            $http_code = 200;
        }catch (\Throwable $th) {
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
