<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ConfOrderResource;
use App\Http\Resources\ConfrimOrdersResource;
use App\Models\ConfrimOrder;
use Illuminate\Http\Request;

class ConfrimOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $confrimOrders=\App\Models\ConfrimOrder::paginate(env('CATEGORY_PER_PAGE'));
        return new ConfrimOrdersResource($confrimOrders);
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
        'user_name'=>'required',
        'phone'=>'required',
        'location'=>'required',
        //'order_id'=>'required',
       ]);

       $confrimOrders=new ConfrimOrder();

       $confrimOrders->user_name=$request->get('user_name');
       $confrimOrders->phone=$request->get('phone');
       $confrimOrders->location=$request->get('location');
       $confrimOrders->user_id=$request->user()->id;
       $confrimOrders->order_id=$id;

       $confrimOrders->save();
      
       return new ConfOrderResource($confrimOrders);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $confrimOrders=\App\Models\ConfrimOrder::find($id);
        return new ConfOrderResource($confrimOrders);
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
        $confrimOrders=ConfrimOrder::find($id);
        if($request->has('user_name')){
            $confrimOrders->user_name=$request->get('user_name');
        }
        if($request->has('phone')){
            $confrimOrders->phone=$request->get('phone');
        }
        if($request->has('location')){
            $confrimOrders->location=$request->get('location');
        }
  
        
        $confrimOrders->save();
       
        return new ConfOrderResource($confrimOrders);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $confrimOrders=\App\Models\ConfrimOrder::find($id);
        $confrimOrders->delete;
        return new ConfOrderResource($confrimOrders);
    }
}
