<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\OrderResource;
use App\Http\Resources\OrdersResource;
use App\Models\Order;
use App\Models\Restaurant;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders =\App\Models\Order::paginate(env('ORDERS_PER_PAGE'));
        return new OrdersResource($orders);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$id)
    {
        $request->validate([
            'price'=>'required',
            'quantity'=>'required',
            'meal_id'=>'required',
        ]);
        $order=new Order();
        $order->price=$request->get('price');
        $order->quantity=$request->get('quantity');

        if(intval($request->get('meal_id'))!=0){
          $order->meal_id= intval($request->get('meal_id'));
        }

         $order->restaurant_id=intval($id);
       
       
          $order->save();

          return new OrderResource($order);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order =\App\Models\Order::find($id);
        return new OrderResource($order);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $order =Order::find($id);

        if(intval($request->has('price'))){
            $order->price=intval($request->get('price'));
        }
        if(intval($request->has('quantity'))){
            $order->quantity= intval($request->get('quantity'));
        }
        if(intval($request->get('meal_id'))!=0){
            $order->meal_id= intval($request->get('meal_id'));
          }

         if(intval($request->get('restaurant_id'))!=0){
            $order->restaurant_id= intval($request->get('restaurant_id'));
          }         
    
           $order->save();
  
         return new OrderResource($order);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $order =\App\Models\Order::find($id);
        $order->delete();
        return new OrderResource($order);
    }
}
