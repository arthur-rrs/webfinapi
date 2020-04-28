<?php

namespace App\Http\Controllers;

use App\Model\Category;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $result = DB::table('categories')->orderBy('name')->get();
        return response()->json($result);
    }
}
