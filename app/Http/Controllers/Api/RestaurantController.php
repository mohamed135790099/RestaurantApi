<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\RestaurantBookingResource;
use App\Http\Resources\RestaurantMenuResource;
use App\Http\Resources\RestaurantOrderResource;
use App\Http\Resources\RestaurantResource;
use App\Http\Resources\RestaurantsResource;
use App\Models\Restaurant;
use Illuminate\Http\Request;

class RestaurantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $restaurant =\App\Models\Restaurant::paginate(env('RESTAURAT_PER_PAGE'));
        return new RestaurantsResource($restaurant);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'Longitude'=>'required',
            'Latitude'=>'required',
            'rate'=>'required',
            'name'=>'required',
            'title'=>'required',
            'phone'=>'required',
            'email'=>'required',
            'description'=>'required',
            'menu_id'=>'required'
        
        ]);

        $restaurant=new Restaurant();
        $restaurant->Longitude=$request->get('Longitude');
        $restaurant->Latitude=$request->get('Latitude');
        $restaurant->rate=$request->get('rate');
        $restaurant->name=$request->get('name');
        $restaurant->title=$request->get('title');
        $restaurant->phone=$request->get('phone');
        $restaurant->email=$request->get('email');
        $restaurant->description=$request->get('description');

        if(intval($request->get('menu_id'))!=0){
          $restaurant->menu_id= intval($request->get('menu_id'));
        }

       // $menu=Menu::where('id', $request->menu_id)->first();

      //  $restaurant->menu_id=$menu;a
      //  $restaurant->booking_id=$booking->id;
      //  $restaurant->order_id=$order->id;




        if($request->hasfile('image'))  
        {  
            $file=$request->file('image');  
            $extension=$file->getClientOriginalExtension();  
            $filename=time().'.'.$extension;  
            $file->move('public/upload/images/restaurant',$filename);  
            $path=url(path:'/').'/public/upload/images/restaurant/'.$filename;
            $restaurant->image= $path;  
        }  
        else  
        {  
            return $request;  
            $restaurant->image='';  
        }  

        $restaurant->save();

        return new RestaurantResource($restaurant);
  
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $restaurant =\App\Models\Restaurant::with(['menu','booking','order'])->where('id',$id)->get();
        return new RestaurantResource($restaurant);
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
        $restaurant= Restaurant::find($id);

        if($request->has('Longitude')){
            $restaurant->Longitude=$request->get('Longitude');
        }

        if($request->has('Latitude')){
            $restaurant->Latitude=$request->get('Latitude');
        }

        if($request->has('rate')){
            $restaurant->rate=$request->get('rate');
        }

        if($request->has('name')){
            $restaurant->name=$request->get('name');
        }

        if($request->has('title')){
            $restaurant->title=$request->get('title');
        }

        if($request->has('phone')){
            $restaurant->phone=$request->get('phone');
        }
        if($request->has('email')){
            $restaurant->email=$request->get('email');
        }

        if($request->has('description')){
            $restaurant->description=$request->get('description');
        }

        if($request->has('image')){
            $file=$request->file('image');  
            $extension=$file->getClientOriginalExtension();  
            $filename=time().'.'.$extension;  
            $file->move('public/upload/images/restaurant',$filename);  
            $path=url(path:'/').'/public/upload/images/restaurant/'.$filename;
            $restaurant->image= $path;    
        }
        if($request->has('menu_id')){
            if(intval($request->get('menu_id'))!=0){
                $restaurant->menu_id= intval($request->get('menu_id'));
              }
         }


        $restaurant->save();

        return new RestaurantResource($restaurant);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $restaurant =\App\Models\Restaurant::find($id);
        $restaurant->delete();

        return new RestaurantResource($restaurant);
    }

    public function RestaurantBooking($id){
        $restaurant =\App\Models\Restaurant::find($id);
        $booking=$restaurant->Booking;
        return new RestaurantBookingResource($booking);

    }

    
    public function RestaurantOrder($id){
        $restaurant =\App\Models\Restaurant::find($id);
        $order=$restaurant->Order;
        return new RestaurantOrderResource($order);

    }

    public function RestaurantMenu($id){
        $restaurant =\App\Models\Restaurant::find($id);
        $menuCategory=$restaurant->Menu;
        return new RestaurantMenuResource($menuCategory);

    }
}
