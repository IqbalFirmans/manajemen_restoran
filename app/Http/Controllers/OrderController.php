<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Customer;
use App\Models\OrderDetail;
use App\Models\PaymentMethod;
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
        $orders = Order::where('status', 'pending')
            ->latest()
            ->filter(request(['search']))
            ->paginate(5)
            ->withQueryString();

        return view('orders.index', compact('orders'));
    }

    public function history()
    {
        $orders = Order::where('status', 'accepted')
            ->orWhere('status', 'canceled')
            ->latest()
            ->filter(request(['search']))
            ->paginate(5)
            ->withQueryString();

        return view('orders.history', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $menus = Menu::all();
        $customers = Customer::all();
        $payments = PaymentMethod::where('status', 'active')->get();

        return view('orders.create', compact('menus', 'customers', 'payments'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOrderRequest $request)
    {
        // dd($request);
        if (!$request->customer_id) {
            return redirect()->route('orders.create')->with('error', 'Customer field required!');
        }

        if (!$request->payment_id) {
            return redirect()->route('orders.create')->with('error', 'Payment field required!');
        }


        $dataOrder = [
            'customer_id' => $request->customer_id,
            'status' => 'pending'
        ];

        Order::create($dataOrder);

        $order = Order::latest('id')->first();
        $order_id = $order->id;
        $total_bayar = 0;

        foreach ($request->dataMenuOrders as $dataMenuOrder) {
            $menu_id = $dataMenuOrder['menu_id'];
            $quantity = $dataMenuOrder['jumlah'];

            if ($quantity <= 0) {
                // Jika menu tidak ditemukan, batalkan proses
                $order->delete(); // Hapus order yang sudah dibuat
                return redirect()->route('orders.create')->with('error', 'Quantity field required!');
            }
            if ($quantity > 255) {
                $order->delete(); // Hapus order yang sudah dibuat
                return redirect()->route('orders.create')->with('error', 'Order quantity exceeds the limit!');
            }

            // Ambil harga menu dari database
            $menu = Menu::find($menu_id);
            $price = $menu->price;

            // Hitung total harga untuk item ini
            $total_item_price = $price * $quantity;

            // Tambahkan total harga item ke total bayar
            $total_bayar += $total_item_price;

            $data = [
                'order_id' => $order_id,
                'menu_id' => $menu_id,
                'quantity' => $quantity
            ];

            // dd($data);
            OrderDetail::create($data);
        }

        $payment_data = [
            'order_id' => $order_id,
            'method_id' => $request->payment_id,
            'total_bayar' => $total_bayar,
        ];

        Payment::create($payment_data);

        return redirect()->route('orders.index')->with('success', 'Order success!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        $orders = OrderDetail::where('order_id', $order->id)->get();
        $payment = Payment::where('order_id', $order->id)->first();

        return view('orders.show', compact('orders', 'payment'));
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

    public function accept(UpdateOrderRequest $request, Order $order)
    {
        $order->update([
            'status' => 'accepted'
        ]);

        return redirect()->route('orders.index')->with('success', 'Accepted Order Success!');
    }

    public function cancel(UpdateOrderRequest $request, Order $order)
    {
        $order->update([
            'status' => 'canceled'
        ]);

        return redirect()->route('orders.index')->with('success', 'Canceled Order Success!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        try {
            // dd($order->id);
            $order->delete();

            return redirect()->route('orders.history')->with('success', 'Delete Order History Success!');
        } catch (\Throwable $e) {
            return redirect()->route('orders.index')->with('error', 'Failed Delete : ' . $e->getMessage());
        }
    }
}
