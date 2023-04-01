<?php

namespace App\Services;

use App\Models\PhoneBook;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PhoneBookService
{
    public function createPhoneBook(Request $request)
    {
        $data = new PhoneBook();
        $user_id = Auth::user()->id;
        $data->setUserId($user_id);
        $data->setName($request->input('name'));
        $data->setTelNumber($request->input('phone_number'));
        $data->setRelationship($request->input('relationship'));
        $data->setCountry($request->input('country'));
        $data->setJob($request->input('job'));
        $data->setEmail($request->input('email'));
        $data->setImage('image');
        $data->save();

        if ($request->hasFile('image')) {
            $imageName = $data->getId().'.'.$request->file('image')->getClientOriginalExtension();
            Storage::disk('public')->put($imageName, file_get_contents($request->file('image')->getRealPath()));
            $data->setImage($imageName);
            $data->save();
        }

        return $data;
    }
}
