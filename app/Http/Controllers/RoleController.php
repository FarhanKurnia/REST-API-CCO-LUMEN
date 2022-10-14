<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index()
    {
        return response()->json([
            'status' => 'success',
            'message' => 'Load data Balasan successfully',
            'data' => Role::get()], 200);
    }
}
