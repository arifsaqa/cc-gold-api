<?php

namespace App\Http\Controllers;

use App\Models\Saldo;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Namshi\JOSE\JWS;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Facades\JWTAuth;

/**
 *register
 *  createUser -> update token to db && isLogin true
 *login(phone and pin)
 **if isLogin?False -> run Auth -> get token push to db && update isLogin True to db;
 **if isLogin?True -> get token
 ****isTokenValid?true -> invalidate token ->run auth -> run Auth -> get token update user token to db
 ****isTokenValid?false-> ->run auth -> run Auth -> get token update user token to db, update isLoginFalse

 *logout -> **just invalidate the token and update isLogin:false and redirect whatever happen

 *if
 *
 *refreshTokentoDb
 *relogin(withpin)without token
 *relogin(withpin)with token
 *private
 *   isTokenValid?
 */
class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $credentials = $request->only('phone', 'password');
        $requestedDeviceId = $request->get('deviceId');
        try {
            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'invalid_credentials'], 400);
            }
        } catch (JWTException $e) {
            return response()->json(['error' => 'could_not_create_token'], 500);
        }

        $user = JWTAuth::user();
        $dbDeviceId = $user->deviceId;
        $isDeviceMatch= false;
        if($requestedDeviceId == $dbDeviceId){
            $isDeviceMatch = true;
        }
        $status = 1;
        return response()->json(compact('status', 'user', 'token', 'isDeviceMatch'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|max:255',
            'phone' => 'required|string|max:255',
            'deviceId' =>'required'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 400);
        }

        $user = User::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'phone' => $request->get('phone'),
            'image' => $request->get('image'),
            'isVerified' => $request->get('isVerified')?1:0,
            'role' => 0,
            'password' => Hash::make($request->get('password')),
            'deviceId' => $request->get('deviceId'),
        ]);

        $token = JWTAuth::fromUser($user);
        $status = 1;

        return response()->json(['status'=> $status, 'user'=>$user, 'token'=>$token]);
    }

    public function isTokenValid(){
        try {
            if (JWTAuth::parseToken()->authenticate()) {
                return response()->json(['message' => 'The token still good', 'status' => 1], 200);
            }
        } catch (TokenExpiredException $e) {

            $message = 'token_expired';
            return response()->json(['message' => $message,'status'=> 0]);
        } catch (TokenInvalidException $e) {
            $message = 'token_invalid';
            return response()->json(['message' => $message,'status'=> 0]);
        } catch (JWTException $e) {
            $message = 'token_absent';
            return response()->json(['message' => $message,'status'=> 0]);
        }
        ;
    }

    public function getUserById($id){

        $user = User::find($id);
        // $status = 1;
        return response()->json($user);
    }

    public function reloginWithPin(Request $request){
        $credentials = $request->only('phone', 'password');
        $requestedDeviceId = $request->get('deviceId');
        try {
            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'invalid_credentials', 'status'=>0], 400);
            }
        } catch (JWTException $e) {
            return response()->json(['error' => 'could_not_create_token'], 500);
        }
        $status = 1;
        return response()->json(compact('status', 'token'));
    }

    public function verifiedByOTP(){
        $user = JWTAuth::parseToken()->authenticate();
        try {
            if (!$user || $user->isVerified == 1) {
                return response()->json(['message' => 'You are verified', 'status' => 0], 404);
            }
        } catch (TokenExpiredException $e) {

            return response()->json(['token_expired'], $e->getCode());
        } catch (TokenInvalidException $e) {

            return response()->json(['token_invalid'], $e->getCode());
        } catch (JWTException $e) {
            return response()->json(['token_absent'], $e->getCode());
        }

        $updateIsVerified = User::find($user->id);
        // $updateUserVerification = $request->get('isVerified');
        $updateIsVerified->update(['isVerified' => 1]);

        return response()->json(['status' => 1, 'message' => 'berhasil'], 200);
    }

    public function getAllUsers()
    {
        $succes = 1;
        $failed = 0;
        $user = JWTAuth::parseToken()->authenticate();
        try {
            if (!$user || $user->role==0) {
                return response()->json(['message' => 'Your not allowed to get the data', 'status' => $failed], 404);
            }
        } catch (TokenExpiredException $e) {

            return response()->json(['token_expired'], $e->getCode());
        } catch (TokenInvalidException $e) {

            return response()->json(['token_invalid'], $e->getCode());
        } catch (JWTException $e) {
            return response()->json(['token_absent'], $e->getCode());
        }
        $users = User::where('role', 0)->get();
        $data = ['users' => $users];

        return response($data, 200)->json(['status'=> $succes, 'data'=>$data]);
    }




    public function logout(Request $request)
    {

        $token = $request->header('Authorization');
        try {
            JWTAuth::parseToken()->invalidate($token);
            return response()->json(['message'=>'you are logged out', ], 200);
        } catch (TokenExpiredException $e) {
            return response()->json(['token_expired'], $e->getCode());
        } catch (TokenInvalidException $e) {
            return response()->json(['token_invalid'], $e->getCode());
        } catch (JWTException $e) {
            return response()->json(['token_absent'], $e->getCode());
        }
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function updateIsVerified(Request $request ,$id)
    {
        $user = JWTAuth::parseToken()->authenticate();
        try {
            if (!$user || $user->role == 0) {
                return response()->json(['message' => 'Your not allowed to update user', 'status' => 0], 404);
            }
        } catch (TokenExpiredException $e) {

            return response()->json(['token_expired'], $e->getCode());
        } catch (TokenInvalidException $e) {

            return response()->json(['token_invalid'], $e->getCode());
        } catch (JWTException $e) {
            return response()->json(['token_absent'], $e->getCode());
        }

        $updateIsVerified = User::find($id);
        $updateUserVerification = $request->get('isVerified');
        $updateIsVerified->update(['isVerified' => $updateUserVerification]);

        return response()->json(['status' => 1, 'data' => 'berhasil']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function upload(Request $request)
    {

        if ($files = $request->file('image')) {
            $destinationPath = 'public/images/profile/'; // upload path
            $imageName = date('YmdHis') . "." . $files->getClientOriginalExtension();
            // $ikan['image'] = "$imageName";
            $files->move($destinationPath, $imageName);

            $forDB = $destinationPath . $imageName;
        }
        return response()->json([
            "status" => 1,
            "message" => "sukses",
            "location" => $forDB
        ], 201);
    }

    public function destroy($id)
    {
        $isAdmin = JWTAuth::parseToken()->authenticate();
        if ($isAdmin->role == 0) {
            return response()->json([
                "status" => 0,
                "message" => "You are not an admin",
            ], 400);
        }

        $user = User::find($id);
        if ($user == null) {
            return response()->json([
                "status" => 0,
                "message" => "gagal",
            ], 400);
        }
        $user->delete();

        return response()->json([
            "status" => 1,
            "message" => "sukses",
        ], 201);

    }
}
