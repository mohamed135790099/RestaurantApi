<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryMenuResource;
use App\Http\Resources\MenuResource;
use App\Http\Resources\MenusResource;
use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menu =\App\Models\Menu::paginate(env('MENU_PER_PAGE'));
        return new MenusResource($menu);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $menu =new Menu();

        $request->validate([
            'restaurant_id'=>'required'
        ]);

        if(intval($request->get('restaurant_id'))!=0){
            $menu->restaurant_id= intval($request->get('restaurant_id'));
        }


        $menu->save();

        return new MenuResource($menu);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $menu =\App\Models\Menu::with(['category'])->where('id',$id)->get();
        return new MenuResource($menu);
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
        $menu = Menu::find($id);

        if($request->has('restaurant_id')){
            if(intval($request->get('restaurant_id'))!=0){
                $menu->restaurant_id= intval($request->get('restaurant_id'));
          }
        }
      

        $menu->save();
        
        return new MenuResource($menu);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $menu = Menu::find($id);
        $menu->delete();
        return new MenuResource($menu);
    }

    public function CategoryMenu(){
        $menu =\App\Models\Menu::find(12);
        $Categories=$menu->Category;
        return new CategoryMenuResource($Categories);
    }
}
