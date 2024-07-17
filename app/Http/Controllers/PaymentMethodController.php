<?php

namespace App\Http\Controllers;

use App\Models\PaymentMethod;
use App\Http\Requests\StorePaymentMethodRequest;
use App\Http\Requests\UpdatePaymentMethodRequest;
use Illuminate\Support\Str;

class PaymentMethodController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $payment_methods = PaymentMethod::filter(request(['search']))->paginate(10);

        return view('payment_methods.index', compact('payment_methods'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('payment_methods.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePaymentMethodRequest $request)
    {
        PaymentMethod::create($request->all());
        return redirect(route('payment_methods.index'))->with('success', 'Data metode pembayaran berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(PaymentMethod $paymentMethod)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PaymentMethod $paymentMethod)
    {
        return view('payment_methods.edit', compact('paymentMethod'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePaymentMethodRequest $request, PaymentMethod $paymentMethod)
    {
        $paymentMethod->update($request->all());
        return redirect(route('payment_methods.index'))->with('success', 'Data metode pembayaran berhasil diedit.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {

        $paymentMethod = PaymentMethod::with('payment')->findOrFail($id);

        if ($paymentMethod->payment()->exists()) {
            return redirect()->route('payment_methods.index')->with('error', 'Cannot delete Payment Method with associated Payment.');
        }

        $paymentMethod->delete();
        return redirect(route('payment_methods.index'))->with('success', 'Data metode pembayaran berhasil dihapus.');
    }
}
