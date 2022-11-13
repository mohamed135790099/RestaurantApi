<?php

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
/*
  @user 
  related all Users
*/
Route::get('users','App\Http\Controllers\Api\UserController@index');
// return one user
Route::get('users/{id}','App\Http\Controllers\Api\UserController@show');
//return  user confrim order 
Route::get('confrimOrder/user/{id}','App\Http\Controllers\Api\UserController@clientOrder');
// returant user operation booking
Route::get('booking/user/{id}','App\Http\Controllers\Api\UserController@userBooking');

//post
// create new user
Route::post('register','App\Http\Controllers\Api\UserController@store');
//generate token for new user
Route::post('token','App\Http\Controllers\Api\UserController@getToken');
// this protected by token if you want update profile user
Route::middleware('auth:api')->group(function(){

 /**
   * @user
   * operation update && delete
   */
//edite user details
Route::post('update-user/{id}','App\Http\Controllers\Api\UserController@update');
//delete user
Route::delete('destory-user/{id}','App\Http\Controllers\Api\UserController@destroy');

/*
  end user
 */
/**
 * @restaurant
 * operation post && update && delete
 */
//add new restaurant
Route::post('new-restaurant','App\Http\Controllers\Api\RestaurantController@store');
//update restaurant by id
Route::post('update-restaurant/{id}','App\Http\Controllers\Api\RestaurantController@update');
// delete restaurant by id
Route::delete('destroy-restaurant/{id}','App\Http\Controllers\Api\RestaurantController@destroy');
/*
  end restaurant
 */

 /**
  * @booking
  * operation post && update && delete
  */

  //add new booking restaurant 
  Route::post('new-booking/restaurant/{id}','App\Http\Controllers\Api\BookingController@store');
  // update restaurant by id
  Route::post('update-booking/{id}','App\Http\Controllers\Api\BookingController@update');
  // delete booking by id
  Route::delete('destroy-booking/{id}','App\Http\Controllers\Api\BookingController@destroy');

  /*
   end booking
   */

   /**
    * @confrim Order
    * operation post&&update&&delete
    */
     // new confrim order
    Route::post('new-confrimOrder/post/{id}','App\Http\Controllers\Api\ConfrimOrderController@store');
     // update confrim order
    Route::post('update-confrimOrder/{id}','App\Http\Controllers\Api\ConfrimOrderController@update');
    //delete confrim order by id
    Route::delete('destroy-confrimOrder/{id}','App\Http\Controllers\Api\ConfrimOrderController@destroy');
                                                                          
    /*
     end confrim
     */

     /** 
      *@order
      *operation post && update && delete
      */
      // add new order
      Route::post('new-order/restaurant/{id}','App\Http\Controllers\Api\OrderController@store');
      // update oder by id
      Route::post('update-order/{id}','App\Http\Controllers\Api\OrderController@update');
      // delete oder by id
      Route::delete('destroy-order/{id}','App\Http\Controllers\Api\OrderController@destroy');

      /*
       end order
       */

       /**
        * @meal
        * operation post && update && delete
        */
        // add new meal
        Route::post('new-meal/{id}','App\Http\Controllers\Api\MealController@store');
        // update meal by id
        Route::post('update-meal/{id}','App\Http\Controllers\Api\MealController@update');
        // remove meal by id
        Route::delete('destroy-meal/{id}','App\Http\Controllers\Api\MealController@destroy');

        /*
        end meal
         */

         /**
          * @category
          * operation post && update && delete
          */
          //add new category
          Route::post('new-category','App\Http\Controllers\Api\CategoryController@store');
          //update category by id
          Route::post('update-category/{id}','App\Http\Controllers\Api\CategoryController@update');
          //delete category by id
          Route::delete('destroy-category/{id}','App\Http\Controllers\Api\CategoryController@destroy');
          /*
          end category
           */


           /**
            * @menu
            * operation post && update && delete
            */

            // add new menu
            Route::post('new-menu','App\Http\Controllers\Api\MenuController@store');
            // update menu by id
            Route::post('update-menu/{id}','App\Http\Controllers\Api\MenuController@update');
            // delete menu by id
            Route::delete('destroy-menu/{id}','App\Http\Controllers\Api\MenuController@destroy');








            /*
            end menu
             */




});

/*
 end user
*/

/**
 * @restaurant
 * start restaurant operation
 */

  
  Route::get('reataurants','App\Http\Controllers\Api\RestaurantController@index');
  // return one retaurant 
  Route::get('reataurants/{id}','App\Http\Controllers\Api\RestaurantController@show');
 // return all order that related to restaurant
  Route::get('reataurant/order/{id}','App\Http\Controllers\Api\RestaurantController@RestaurantOrder');
 //return menu that related to restaurant
  Route::get('reataurant/menu/{id}','App\Http\Controllers\Api\RestaurantController@RestaurantMenu');
  //return all booking related to restaurant
  Route::get('reataurant/booking/{id}','App\Http\Controllers\Api\RestaurantController@RestaurantBooking');

 /*
  end restaurant
 */

 /**
  * @menu
  * start operation menu
  */
  //return all menus
  Route::get('menus','App\Http\Controllers\Api\MenuController@index');
  //return one menu
  Route::get('menu/{id}','App\Http\Controllers\Api\MenuController@show');
  //return categories that related to menu
  Route::get('menu/categories/{id}','App\Http\Controllers\Api\MenuController@CategoryMenu');

  /*
  end menu
   */


   /**
    * @category
    * start operation category
    */
    //return all category
    Route::get('categories','App\Http\Controllers\Api\CategoryController@index');
    // return one category
    Route::get('category/{id}','App\Http\Controllers\Api\CategoryController@show');
    // return all category meals
    Route::get('category/meals/{id}','App\Http\Controllers\Api\CategoryController@categoryMeals');

    /*
    end category
    */

    /**
     * @ meal
     * start operation meal
     */
    // return all meals
    Route::get('meals','App\Http\Controllers\Api\MealController@index');
    //return one meals
    Route::get('meal/{id}','App\Http\Controllers\Api\MealController@show');
    // return all orders meal
    Route::get('meal/orders/{id}','App\Http\Controllers\Api\MealController@mealsOrder');

     /*
     end meal
      */

      /**
       * @order
       * start operation order
       */
      //return all orders
      Route::get('orders','App\Http\Controllers\Api\OrderController@index');
      //return one order
      Route::get('order/{id}','App\Http\Controllers\Api\OrderController@show');

       /*
       end order
        */

        /**
         * @confrim order
         * start operation confrim order
         */
        //return all confrim orders
        Route::get('confrimOrders','App\Http\Controllers\Api\ConfrimOrderController@index');
        //rturn one confrim order
        Route::get('confrimOrder/{id}','App\Http\Controllers\Api\ConfrimOrderController@show');

         /*
         end confrim order
    
          */

          /**
           * @booking
           * start operation booking
           */
          //return all bookings
          Route::get('bookings','App\Http\Controllers\Api\BookingController@index');
          //return one booking
          Route::get('booking/{id}','App\Http\Controllers\Api\BookingController@show');

           /*
           end booking
           */





Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
