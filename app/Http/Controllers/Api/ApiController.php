<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Validator;
use Auth;
use Mail;
use Log;

class ApiController extends Controller
{
    public function login(Request $request)
    {
        $rules = [
            'email' => 'required|email',
            'password' => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $userData = [
                'id' => $user->id,
                'first_name' => $user->first_name,
                'last_name' => $user->last_name,
            ];
            $token = $user->createToken($userData)->accessToken;
            return response()->json([
                'id' => $user->id,
                //'roleid' => $user->roles_id,
                'first_name' => $user->first_name,
                'last_name' => $user->last_name,
                'token' => $token
            ], 200);
        } else {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
    }

    public function register(Request $request){
        $rules = [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|string|max:20|unique:users,phone',
            'password' => 'required|string|min:8',
            'address' => 'required|string|max:255',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }
        $user = User::create([
            'id' => $request->id,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => bcrypt($request->password),
            'address' => $request->address,
            'roles_id' => 7,
        ]);

        $token = $user->createToken($user)->accessToken;
        return response()->json([
            'id' => $user->id,
            'roles_id' => $user->roles_id,
            'first_name' => $user->first_name,
            'last_name' => $user->last_name,
            'phone' => $user->phone,
            'email' => $user->email,
            'token' => $token
        ], 200);
    }
    //owner regester

    public function profiledetails($id){
        $details = User::with('filesData')->select('id','first_name','last_name','email','phone','zipcode','gst','address','phone_verified','email_verified')->where(['status'=>1,'id'=>$id])->first();
        if(!empty($details)){
            return response()->json([
                'status'=>true,
                'data' => $details,
            ]);
        } else {
            return response()->json([
                'status'=>true,
                'data' => $details,
            ]);
        }
        //echo "<pre>"; print_r($details);
    }

}
