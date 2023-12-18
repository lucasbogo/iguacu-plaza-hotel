<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Customer;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::get();
        return view('admin.order.orders', compact('orders'));
    }

    public function invoice($id)
    {
        $order = Order::where('id', $id)->first();
        $order_detail = OrderDetail::where('order_id', $id)->get();
        $customer_data = Customer::where('id', $order->customer_id)->first();
        return view('admin.order.invoice', compact('order', 'order_detail', 'customer_data'));
    }

    public function delete($id)
    {
        $obj = Order::where('id', $id)->delete();
        $obj = OrderDetail::where('order_id', $id)->delete();

        return redirect()->back()->with('success', 'Reserva Excluída com sucesso!');
    }
}
