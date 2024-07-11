<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Support\Str;
use App\Http\Requests\StoreMenuRequest;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\UpdateMenuRequest;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $menus = Menu::all();
        return view('menus.index', compact('menus'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('menus.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMenuRequest $request)
    {
        try {
            $image = $request->file('image')->store('menu-image', 'public');
            $data = [
                'name' => $request->name,
                'price' => $request->price,
                'description' => $request->description,
                'image' => $image,

            ];

            Menu::create($data);

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

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Menu $menu)
    {
        return view('menus.edit', compact('menu'));
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
                    Storage::disk('public')->delete($menu->image);
                }

                $validateData['image'] = $request->file('image')->store('menu-image', 'public');
            }

            $validateData['excerpt'] = Str::limit(strip_tags($request->description), 100);

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
