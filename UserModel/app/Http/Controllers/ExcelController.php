<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\UsersImport;

class ExcelController extends Controller
{
    public function import(Request $request) 
    {
        Excel::import(new UsersImport, $request->file('file'));
        return response()->json("Successfully Import Users ");
    }
}
