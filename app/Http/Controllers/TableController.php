<?php

namespace App\Http\Controllers;

use App\Models\Table;
use App\Http\Requests\StoreTableRequest;
use App\Http\Requests\UpdateTableRequest;

class TableController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tables = Table::filter(request(['search']))->paginate(10);

        return view('tables.index', compact('tables'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view('tables.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTableRequest $request)
    {
        try {
            Table::create($request->validated());

            return redirect()->route('tables.index')->with('success', 'Create Table success!');
        } catch (\Throwable $e) {

            return redirect()->route('tables.index')->with('error', 'Failed create table.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Table $table)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Table $table)
    {
        return view('tables.edit', compact('table'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTableRequest $request, Table $table)
    {

        try {
            $table->update($request->validated());

            return redirect()->route('tables.index')->with('success', 'Update Table success!');

        } catch (\Throwable $e) {

            return redirect()->route('tables.index')->with('error', 'Failed update table.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Table $table)
    {
        try {
            $table->delete();

            return redirect()->route('tables.index')->with('success', 'Delete Table success!');

        } catch (\Throwable $e) {

            return redirect()->route('tables.index')->with('error', 'Failed delete table.');
        }
    }
}
