<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Category;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = auth()->user()->categories()->paginate(6);
        return view('categories', compact('categories'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);
        $user = auth()->user();
        $user->categories()->save(new Category($request->all()));
        return redirect('/categories')->withFlashMessage('Category added successfully');
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);
        $category = Category::find($id);
        $category->update($request->all());
        return redirect('/categories')->withFlashMessage('Category updated successfully');
    }

    public function destroy($id)
    {
        Category::find($id)->delete();
        return redirect('/categories')->withFlashMessage('Category deleted successfully');
    }
}
