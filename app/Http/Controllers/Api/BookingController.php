<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\BookingResources;
use App\Http\Resources\BookingsResource;
use App\Models\Booking;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bookings =\App\Models\Booking::paginate(env('BOOKING_PER_PAGE'));
         return new BookingsResource($bookings);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$id)
    {
       $request->validate(
        [
            'type_booking'=>'required',
            'restaurant_id'=>'required',
        ]);

        $booking=new Booking();
        $booking->type_booking=$request->get('type_booking');

        if(intval($request->get('restaurant_id'))!=0){
            $booking->restaurant_id= intval($id);
          }
        $booking->user_id=$request->user()->id;

        $booking->save();

        return new BookingResources($booking);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $booking =\App\Models\Booking::find($id);
        return new BookingResources($booking);

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
        $booking =Booking::find($id);


        if($request->has('num_guest')){
            $booking->num_guest=$request->get('num_guest');
        }
        if($request->has('type_booking')){
            $booking->type_booking=$request->get('type_booking');
        }

        if($request->has('restaurant_id')){
            if(intval($request->get('restaurant_id'))!=0){
                $booking->restaurant_id= intval($request->get('restaurant_id'));
              }
         }

        $booking->save();

        return new BookingResources($booking);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $booking =\App\Models\Booking::find($id);
        $booking->delete();

        return new BookingResources($booking);
    }
}
