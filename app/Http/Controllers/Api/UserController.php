<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\bookingResource;
use App\Http\Resources\confrimOrderResource;
use App\Http\Resources\TokenResource;
use App\Http\Resources\UserResource;
use App\Http\Resources\UsersResource;
use App\Http\Resources\UsesResource;
use App\Models\User;
use Hamcrest\Core\HasToString;
use Illuminate\Http\Request;
use Illuminate\Support\Env;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Mockery\Matcher\HasKey;
use Symfony\Contracts\Service\Attribute\Required;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users =\App\Models\User::paginate();
        return new UsersResource($users);
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
            'name'=>'required',

            'email'=>'required',

            'password'=>'required',

            'phone'=>'required',

            'profile_picture'=>'nullable'

            
            ]);
        
        $user=new User();

        $user->name=$request->get('name');
        $user->email=$request->get('email');
        $user->password=Hash::make($request->get('password'));
        $user->phone=$request->get('phone');

        if($request->hasfile('profile_picture'))  
        {  
            $file=$request->file('profile_picture');  
            $extension=$file->getClientOriginalExtension();  
            $filename=time().'.'.$extension;  
            $file->move('public/upload/images/users/',$filename);  
            $path=url(path:'/').'/public/upload/images/users/'.$filename;
            $user->profile_picture= $path;  
        }  
      
  

      
      
        $user->save();
        return new UserResource($user);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    /**
     * @user resource find one user by id
     */
    public function show($id)
    {
        $user =\App\Models\User::find($id);
        return new UserResource($user);
        //
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
       $user =User::find($id);

       if($request->has('name')){
        $user->name=$request->get('name');
       }

       if($request->has('profile_picture')){

        $file=$request->file('profile_picture');  
        $extension=$file->getClientOriginalExtension();  
        $filename=time().'.'.$extension;  
        $file->move('public/upload/images/users/',$filename);  
        $path=url(path:'/').'/public/upload/images/users/'.$filename;
        $user->profile_picture= $path;  

       }

       if($request->has('phone')){
        $user->phone=$request->get('phone');
       }



       $user->save();

       return new UserResource($user);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user =\App\Models\User::find($id);
        $user->delete();
        
        return new UserResource($user);
    }

    public function clientOrder($id)
    {
        $user =\App\Models\User::find($id);
        $order=$user->confrimOrder;

        
        return new confrimOrderResource($order);
    }

    public function userBooking($id)
    {
        $user =\App\Models\User::find($id);
        $Booking=$user->Booking;

        return new bookingResource($Booking);
    }


    public function getToken(Request $request){
        $request->validate(
            [
                'email'=>'required',
                'password'=>'required',
            ]);

            $credentials=$request->only('email','password');
            if(Auth::attempt($credentials)){
                $user=User::where('email',$request->get('email'))->first();
                return new TokenResource(['token'=>$user->api_token]);

            }

            return 'not found';


    }
}
