<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id)->Auth::user()->id;

        if ($user->exists()) {
            $user->update($request->all());

            return redirect()->route('phone.index')->with('success', 'User updated successfully');
        }

        return redirect()->route('phone.index', $user)->with('error', 'User not found');
    }
}
