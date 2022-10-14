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
}
