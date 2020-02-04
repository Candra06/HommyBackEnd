<?php

namespace App\Http\Controllers;

use App\Order;
use App\DetailOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class OrdersController extends Controller
{

    public $successStatus = 200;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $orders = DB::table('orders')
            ->join('users', 'orders.id_user', '=', 'users.id_user')
            ->join('detail_orders', 'orders.id_order', '=', 'detail_orders.id_order')
            ->select('orders.id', 'orders.id_order', 'users.name', 'orders.service', 'orders.address', 'detail_orders.title', 'detail_orders.description', 'detail_orders.date', 'detail_orders.status')
            ->where('detail_orders.status', '=', 1)
            ->get();

        return view('order.index', compact('orders'));

        //with Eloquent
        // $orders = Order::all();
        // return view('order.index', compact('orders'));
        
        // return $orders;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        // echo $order->id; 

        $details = DB::table('orders')
            ->join('users', 'orders.id_user', '=', 'users.id_user')
            ->join('detail_orders', 'orders.id_order', '=', 'detail_orders.id_order')
            ->select('orders.id', 'orders.id_order', 'users.name', 'orders.service', 'orders.address', 'detail_orders.title', 'detail_orders.description', 'detail_orders.date', 'detail_orders.status')
            ->where('orders.id', '=', $order->id)
            ->get();

        // $details = DB::table('users')
        //     ->join('orders', 'users.id_user', '=', 'orders.id_user')
        //     ->join('detail_orders', 'orders.id_order', '=', 'detail_orders.id_order')
        //     ->select('users.id', 'orders.id_order', 'users.name', 'orders.service', 'orders.address', 'detail_orders.title', 'detail_orders.description', 'detail_orders.date', 'detail_orders.status')
        //     ->where('users.id', '=', $order->id)
        //     ->get();

        return view('order.show', ['orders' => $details]);
        // return $details;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }

    public function add_order(Request $request)
    {
        $id_order = Str::random(8);

        $request->validate([
            'service' => 'required',
            'address' => 'required',
            'id_user' => 'required',
            'date' => 'required',
        ]);

        Order::create([
            'id_order' => $id_order,
            'id_user' => $request->id_user,
            'service' => $request->service,
            'address' => $request->address,
        ]);

        DetailOrder::create([
            'id_order' => $id_order,
            'title' => "Order Baru",
            'description' => "Order Baru",
            'date' => $request->date,
            'status' => 1,
        ]);

        return response()->json(['message' => 'Berhasil Melakukan Order!'], $this->successStatus);
    }

    public function detail_order(Request $request)
    {
        $details = DB::table('orders')
            ->join('detail_orders', 'orders.id_order', '=', 'detail_orders.id_order')
            ->select('orders.id_order', 'orders.id_user', 'orders.service', 'orders.address',
                     'detail_orders.title', 'detail_orders.description', 'detail_orders.date', 'detail_orders.status')
            ->where('orders.id_order', '=', $request->id_order)
            ->get();
    
            return response()->json(['data' => $details], $this->successStatus);
    }
    
}