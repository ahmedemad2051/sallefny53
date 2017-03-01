<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Category;
use App\Product;

class ApiController extends Controller
{
    public function index()
    {
        $categories=Category::with('products')->get()->toArray();
        return Response::json($categories);
    }
}
