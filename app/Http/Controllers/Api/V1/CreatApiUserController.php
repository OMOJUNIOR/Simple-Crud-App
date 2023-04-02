<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CreatApiUserController extends Controller
{
    public function createUserController(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'tel_number' => 'required',
            'password' => 'required',
        ]);

        $user = new User();
        $user->name = $request->name; 
        $user->email = $request->email;
        $user->tel_number = $request->tel_number;
        $user->password = bcrypt($request->password);

        if ($user->save()) {
            return response()->json(['message' => 'User created successfully'], 201);
        }

        return response()->json(['message' => 'User not created'], 401);
    }

    public function createUserToken(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();
        if ($user) {
            if (Hash::check($request->password, $user->password)) {
                $token = $user->createToken('token', ['create', 'update', 'delete'])->plainTextToken;

                return response()->json(['token' => $token], 200);
            }

            return response()->json(['message' => 'Password is incorrect'], 401);
        }

        return response()->json(['message' => 'User not found'], 401);
    }
}
