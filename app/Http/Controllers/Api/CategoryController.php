<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Http\Resources\CategoriesResource;
use App\Http\Resources\CategoryMealsResource;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category =\App\Models\Category::paginate(env('CATEGORY_PER_PAGE'));
        return new CategoriesResource($category);
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
        'menu_id'=>'required',
        'image_url'=>'required'
        ]);

        $category= new Category();

        $category->title=$request->get('title');
        $category->menu_id=$request->get('menu_id');

        if($request->hasfile('image_url'))  
        {  
            $file=$request->file('image_url');  
            $extension=$file->getClientOriginalExtension();  
            $filename=time().'.'.$extension;  
            $file->move('public/upload/images/category/',$filename);  
            $path=url(path:'/').'/public/upload/images/category/'.$filename;
            $category->image_url= $path;  
        }  
        else  
        {  
            return $request;  
            $category->image_url='';  
        } 
        
        $category->save();

        return new CategoryResource($category);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category =\App\Models\Category::find($id);
        return new CategoryResource($category);
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
        $category= Category::find($id);

        if($request->has('title')){
            $category->title=$request->get('title');
        }
        if($request->has('menu_id')){
            $category->menu_id=$request->get('menu_id');
        }
        if($request->has('image_url')){
            if($request->hasfile('image_url'))  
            {  
                $file=$request->file('image_url');  
                $extension=$file->getClientOriginalExtension();  
                $filename=time().'.'.$extension;  
                $file->move('public/upload/images/category/',$filename);  
                $path=url(path:'/').'/public/upload/images/category/'.$filename;
                $category->image_url= $path;  
            }  
            else  
            {  
                return $request;  
                $category->image_url='';  
            } 
    
        }
       
        $category->save();

        return new CategoryResource($category);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category =\App\Models\Category::find($id); 
        $category->delete();
        return new CategoryResource($category);

    }

    public function categoryMeals($id){
        $category =\App\Models\Category::find($id);
        $meals=$category->Meal;

        return new CategoryMealsResource($meals);

    }
}
