<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\MealResource;
use App\Http\Resources\MealsOrderResource;
use App\Http\Resources\MealsResource;
use App\Models\Meal;
use Illuminate\Http\Request;

class MealController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $meal =\App\Models\Meal::paginate(env('MEALS_PER_PAGE'));
        return new MealsResource($meal);
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
        'title'=>'required',
        'price'=>'required',
        'description'=>'required',
        'rate'=>'required',
        'review'=>'required',
        'image_url'=>'required',
        'category_id'=>'required'

        ]);
       $meal =New Meal();
       $meal->title=$request->get('title');
       $meal->price=$request->get('price');
       $meal->description=$request->get('description');   
       $meal->rate=$request->get('rate');
       $meal->review=$request->get('review');
       
       if($request->hasfile('image_url'))  
       {  
           $file=$request->file('image_url');  
           $extension=$file->getClientOriginalExtension();  
           $filename=time().'.'.$extension;  
           $file->move('public/upload/images/meals/',$filename);  
           $path=url(path:'/').'/public/upload/images/meals/'.$filename;
           $meal->image_url= $path;  
       }  
       else  
       {  
           return $request;  
           $meal->image_url='';  
       }  

       if(intval($request->get('category_id'))!=0){
        $meal->category_id=intval($request->get('category_id'));
       }
       
       $meal->save();

       return new MealResource($meal);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $meal =\App\Models\Meal::find($id);
        return new MealResource($meal);
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
        $meal = Meal::find($id);
        if($request->has('title')){
            $meal->title=$request->get('title');
        }
        if($request->has('price')){
            $meal->price=$request->get('price');
        }

        if($request->has('description')){
            $meal->description=$request->get('description');   
        }
        if($request->has('rate')){
            $meal->rate=$request->get('rate');
        }

        if($request->has('review')){
            $meal->review=$request->get('review');
        }
        if($request->has('image_url')){
            if($request->hasfile('image_url'))  
            {  
                $file=$request->file('image_url');  
                $extension=$file->getClientOriginalExtension();  
                $filename=time().'.'.$extension;  
                $file->move('public/upload/images/meals/',$filename);  
                $path=url(path:'/').'/public/upload/images/meals/'.$filename;
                $meal->image_url= $path;  
            }  
            else  
            {  
                return $request;  
                $meal->image_url='';  
            }  
        } 
        if(intval($request->get('category_id'))!=0){
         $meal->category_id=intval($request->get('category_id'));
        }
        $meal->save();
        
        return new MealResource($meal);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $meal =\App\Models\Meal::find($id);
        $meal->delete();
        return new MealResource($meal);
    }

    public function mealsOrder($id){
        $meal =\App\Models\Meal::find($id);
        $mealOrder=$meal->Order;
        return new MealsOrderResource($mealOrder);
    }
}
