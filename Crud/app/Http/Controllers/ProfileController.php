<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);

        return view('user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        User::validate($request);
        $user = User::findOrFail($id);

        $user->setName($request->input('name'));
        $user->setEmail($request->input('email'));

        if ($request->input('password') != $request->input('password_confirmation')) {
            return redirect()->back()->with('error', 'Password does not match');
        }if ($request->input('password') !== null) {
            $user->setPassword($request->input('password'));
            $user->save();

            return redirect()->route('phone.index')->with('success', 'User updated successfully');
        }

        $user->save();

        return redirect()->route('phone.index')->with('success', 'User updated successfully but password not changed');
    }
}
