<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Categories';

        $categories = Category::latest()->filter(request(['search']))->withCount('menus')->paginate(10);

        return view('categories.index', compact('categories', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Create Category';

        return view('categories.create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
        $validateData = $request->validated();


        try {
            Category::create($validateData);

            return redirect()->route('categories.index')->with('success', 'Create Category success!');
        } catch (\Throwable $e) {

            return redirect()->route('categories.index')->with('error', 'Failed create category.: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        $title = 'Edit Category';

        if (!$category) {
            return redirect()->route('categories.index')->with('error', 'Category not found.');
        }

        return view('categories.edit', compact('category', 'title'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, String $id)
    {
        $category = Category::findOrFail($id);

        $validateData = $request->validated();

        if (!$category) {
            return redirect()->route('categories.index')->with('error', 'Category not found.');
        }

        try {
            $category->update($validateData);

            return redirect()->route('categories.index')->with('success', 'Update Category success!');
        } catch (\Throwable $e) {

            return redirect()->route('categories.index')->with('error', 'Failed Update category.: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        if ($category->menus()->count() > 0) {
            return redirect()->route('categories.index')->with('error', 'Cannot delete Category with associated Menu.');
        }

        try {
            $category->delete();

            return redirect()->route('categories.index')->with('success', 'Delete Category success!');
        } catch (\Throwable $e) {

            return redirect()->route('categories.index')->with('error', 'Failed Delete category.: ' . $e->getMessage());
        }
    }
}
