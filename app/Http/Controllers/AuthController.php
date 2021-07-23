<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Facades\JWTAuth;

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
        $credentials = $request->only('phone', 'pin');

        try {
            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'invalid_credentials'], 400);
            }
        } catch (JWTException $e) {
            return response()->json(['error' => 'could_not_create_token'], 500);
        }

        $user = JWTAuth::user();
        $status = 1;
        return response()->json(compact('status', 'user', 'token'));

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
            'password' => 'required|string|min:6',
            'pin' => 'required|max:255|unique:users',
            'phone' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 400);
        }

        $user = User::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'phone' => $request->get('phone'),
            'image' => $request->get('image'),
            'isLogin' => true,
            'isVerified' => false,
            'role' => 0,
            'password' => Hash::make($request->get('password')),
            'pin' => Hash::make($request->get('pin')),
            'token' => ''
        ]);

        $token = JWTAuth::fromUser($user);

        $updateToken = User::find($user->id)->first();
        $updateToken->update(['token' =>$token]);
        

        $status = 1;

        return response()->json(['status'=> $status, 'data'=>$user]);

    }

    public function getAllUsers()
    {
        $succes = 1;
        $failed = 0;
        $user = JWTAuth::parseToken()->authenticate();
        try {
            if (!$user || $user->role) {
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




    public function logout(Request $request, $id)
    {

        $token = $request->header('Authorization');
        $user = User::find($id)->first();
        $user->update(['isLogin' => false]);
        // $loginStatus = false;
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
  
    public function edit($id)
    {
        //
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
       
    }

    public function refresh(Request $request)
    {
        $credentials = $request->only('pin');
        $token = JWTAuth::attempt($credentials);
        $this->createNewToken($token);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    protected function createNewToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'user' => auth()->user()
        ]);
    }

    public function destroy($id)
    {
        //
    }
}
