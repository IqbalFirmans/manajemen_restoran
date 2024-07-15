<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Support\Carbon;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::all();
        return view('orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('orders.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOrderRequest $request)
    {

        // $now_time = Carbon::now()->format('Y-m-d H:i:s');
        $dataOrder = [
            'customer_id' => $request->customer_id,
            // 'order_time' => $now_time,
            'status' => 'pending',
            'payment_id' => $request->payment_id
        ];

        Order::create($dataOrder);

        $order = Order::latest('id')->first();
        $order_id = $order->id;

        foreach ($request->dataMenuOrders as $dataMenuOrder) {
            $data = [
                'order_id' => $order_id,
                'menu_id' => $dataMenuOrder['menu_id'],
                'quantity' => $dataMenuOrder['jumlah']
            ];

            // dd($data);
            OrderDetail::create($data);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOrderRequest $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }
}
