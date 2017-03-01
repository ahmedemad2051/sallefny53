<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Requests\productRequest;
use App\Product;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = auth()->user()->categories()->get();
        return view('home', compact('categories'));
    }

    public function add(productRequest $request)
    {
        if ($request->ajax()) {
            Product::create($request->all());
            $categories = auth()->user()->categories()->get();
            $data = view('__products', compact('categories'))->render();
            return response()->json($data);
        }
    }

    public function getProduct(Request $request)
    {
        if ($request->ajax()) {

            $product_id = $request['product_id'];
            $product = Product::find($product_id);
            $categories = [];
            foreach (auth()->user()->categories as $category) {
                $categories[$category->id] = $category->name;
            }
            $data = view('__editProduct', compact('product', 'categories', 'product_id'))->render();
            return response()->json($data);
        }

    }

    public function update(productRequest $request, $id)
    {
        $product = Product::findOrFail($id);
        $product->update($request->all());

        return redirect('/home')->withFlashMessage('product updated successfully');
    }

    public function delete(Request $request)
    {
        Product::findOrFail($request->id)->delete();
        $categories = auth()->user()->categories()->get();
        $data = view('__products', compact('categories'))->render();
        return response()->json($data);
    }
}
