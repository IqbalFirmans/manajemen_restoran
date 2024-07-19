<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Support\Str;
use App\Http\Requests\StoreMenuRequest;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\UpdateMenuRequest;
use App\Models\Category;
use Intervention\Image\Facades\Image;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $menus = Menu::with('category')->latest()->paginate(5);

        $menus = Menu::latest()->filter(request(['search']))->paginate(5)->withQueryString();

        return view('menus.index', compact('menus'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();

        return view('menus.create', compact('categories'));
    }

    public function store(StoreMenuRequest $request)
    {
        try {
            $validateData = $request->validated();

            $validateData['image'] = $request->file('image')->store('menu-image', 'public');

            Menu::create($validateData);

            return redirect()->route('menus.index')->with('success', 'Create Menu Success!');
        } catch (\Throwable $e) {

            return redirect()->route('menus.index')->with('error', 'Failed create Menu. ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Menu $menu)
    {
        //
    }

    public function showDeleted()
    {
        $deletedMenu = Menu::onlyTrashed()->latest()->filter(request(['search']))->paginate(5)->withQueryString();

        return view('menus.deleted', compact('deletedMenu'));
    }

    public function restore($id)
    {
        $menu = Menu::withTrashed()->find($id);

        if ($menu) {
            $menu->restore();

            return redirect()->route('menus.index')->with('success', 'Restore Menu Success!');
        }
        return redirect()->route('menus.index')->with('erorr', 'Deleted Menu Not found!');

    }

    public function forceDelete($id)
    {
        $menu = Menu::withTrashed()->find($id);

        if ($menu->details()->count() > 0) {
            return redirect()->route('menus.deleted')->with('error', 'Cannot delete Menu with associated Details.');
        }

        if ($menu) {
            $menu->forceDelete();

            return redirect()->route('menus.deleted')->with('success', 'Permanently Deleted Menu Success!');
        }

        return redirect()->route('menus.deleted')->with('erorr', 'Deleted Menu Not found!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Menu $menu)
    {

        $categories = Category::all();

        return view('menus.edit', compact('menu', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMenuRequest $request, Menu $menu)
    {
        $validateData = $request->validated();


        try {
            if ($request->hasFile('image')) {

                if ($request->oldImage) {
                    Storage::disk('public')->delete($request->oldImage);
                }

                $validateData['image'] = $request->file('image')->store('menu-image', 'public');
            }

            $menu->update($validateData);

            return redirect()->route('menus.index')->with('success', 'Update Menu Success!');
        } catch (\Throwable $e) {

            return redirect()->route('menus.index')->with('error', 'Failed Update Menu. ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Menu $menu)
    {
        try {
            if ($menu->image) {
                Storage::disk('public')->delete($menu->image);
            }

            $menu->delete();

            return redirect()->route('menus.index')->with('success', 'Delete Menu Success!');
        } catch (\Throwable $e) {

            return redirect()->route('menus.index')->with('error', 'Failed Delete Menu. ' . $e->getMessage());
        }
    }
}
