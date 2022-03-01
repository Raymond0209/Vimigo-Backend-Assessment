<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\UpdateRequest;
use App\Http\Resources\UsersResource;

class ApiController extends Controller
{
    public function register(RegisterRequest $request)
    {
        $user = User::create([
            'name' => $request-> input('name'),
            'email' => $request-> input('email'),
            'password' => bcrypt($request->input('password'))
        ]);
  
        $token = $user->createToken('LaravelAuth')->accessToken;
  
        return response()->json(['token' => $token], 200);
    }
  
    public function login(LoginRequest $request)
    {
        $data = [
            'email' => $request->input('email'),
            'password' => $request->input('password')
        ];
  
        if (auth()->attempt($data)) {
            $token = auth()->user()->createToken('LaravelAuth')->accessToken;
            return response()->json(['token' => $token], 200);
        } else {
            return response()->json(['error' => 'Wrong Login Information'], 401);
        }
    }

    public function users(User $user)
    {

        $userList = $user::paginate(5);

        return UsersResource::collection($userList);

    }
    
    public function userInfo(User $user) 
    {
        return new UsersResource($user);
    }



    public function addUser(RegisterRequest $request)
    {
        $user = User::create([
            'name' => $request-> input('name'),
            'email' => $request-> input('email'),
            'password' => bcrypt($request->input('password'))
        ]);
    
        return new UsersResource($user);
        
    }

    public function updateUser(UpdateRequest $request, User $user)
    {
        $user->update($request->all());
    
        return new UsersResource($user);
    }

    public function deleteUser(User $user)
    {
        $user->delete();
    
        return response()->json("Deleted User Successfully");
    }



}
