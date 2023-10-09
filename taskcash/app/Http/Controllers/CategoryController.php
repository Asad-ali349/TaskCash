<?php

namespace App\Http\Controllers;

use App\Activity;
use App\Category;
use App\Http\Requests\CategoryAdd;
use App\Http\Requests\CategoryAddToHotel;
use App\Http\Requests\CategoryRequest;
use App\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
   
    public function index()
    {
        $cats = Category::where('status', 1)->get();
        return view('categories.index', compact('cats'));
    }

  
    public function create()
    {
        return view('categories.create');
    }

    public function store(CategoryRequest $request)
    {
        $category = Category::create($request->all());
        return back()->with('success', 'Added Successfully');
    }

 
    public function show(Category $category)
    {
        return response()->json($category);
    }

  
    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }
  
    public function update(CategoryRequest $request, Category $category)
    {
        $category->update($request->all());
        return redirect()->route('categories.index')->with('success', 'Successfully Updated!');
    }

    public function destroy(Category $category)
    {
        $category->status = 0;
        $category->save();
        return redirect()->route('categories.index')->with('success', 'Successfully Deleted!');
    }
}
