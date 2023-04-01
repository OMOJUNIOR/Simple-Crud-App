<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\PhoneBookRequest;
use App\Http\Resources\PhoneBookResource;
use App\Models\PhoneBook;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PhoneBookApiController extends Controller
{
    public function store(PhoneBookRequest $request)
    {
        if (Auth::check()) {
            // validate the request parameters and return the validated data
            $request = $request->validated();
            $phoneBook = new PhoneBook();
            $phoneBook->user_id = Auth::user()->id;
            $phoneBook->name = $request['name'];
            $phoneBook->phone_number = $request['phone_number'];
            $phoneBook->relationship = $request['relationship'];
            $phoneBook->country = $request['country'];
            $phoneBook->email = $request['email'];
            $phoneBook->job = $request['job'] ?? 'Not specified';
            $phoneBook->image = $request->image ?? 'Not uploaded';
            $phoneBook->save();

            return response()->json(['message' => 'Contact added successfully', 'data' => $phoneBook], 201);
        }

        return response()->json(['message' => 'You are not authorized to create this data'], 401);
    }

    public function update(Request $request)
    {
        if (Auth::check()) {
            $phoneBook = PhoneBook::where('user_id', Auth::user()->id)->where('id', $request->id)->first();
            PhoneBook::validate($request);
            if ($phoneBook) {
                $phoneBook->name = $request->name ?? $phoneBook->name;
                $phoneBook->phone_number = $request->phone_number ?? $phoneBook->phone_number;
                $phoneBook->relationship = $request->relationship ?? $phoneBook->relationship;
                $phoneBook->country = $request->country ?? $phoneBook->country;
                $phoneBook->email = $request->email ?? $phoneBook->email;
                $phoneBook->job = $request->job ?? $phoneBook->job;
                $phoneBook->image = $request->image ? $request->image->store('images', 'public') : $phoneBook->image;
                $phoneBook->save();

                return response()->json(['message' => 'Contact updated successfully', 'contact' => $phoneBook], 200);
            }

            return response()->json(['message' => 'Contact not found'], 404);
        }

        return response()->json(['message' => 'You are not authorized to modify this data'], 401);
    }

    public function destroy(Request $request)
    {
        if (Auth::check()) {
            $phoneBook = PhoneBook::where('user_id', Auth::user()->id)->where('id', $request->id)->first();
            if ($phoneBook) {
                $phoneBook->delete();

                return response()->json(['message' => 'Contact deleted successfully'], 200);
            }

            return response()->json(['message' => 'Contact not found'], 404);
        }

        return response()->json(['message' => 'You are not authorized to delete this data'], 401);
    }

    public function show(Request $request)
    {
        if (Auth::check()) {
            $phoneBook = PhoneBook::where('user_id', Auth::user()->id)->where('id', $request->id)->first();
            if ($phoneBook) {
                return new PhoneBookResource($phoneBook);
            }

            return response()->json(['message' => 'Contact not found'], 404);
        }

        return response()->json(['message' => 'You are not authorized to view this data'], 401);
    }

    public function index()
    {
        if (Auth::check()) {
            $phoneBooks = PhoneBook::where('user_id', Auth::user()->id)->paginate(10);
            if ($phoneBooks->count() > 0) {
                return response()->json($phoneBooks, 200);
            } else {
                return response()->json(['message' => 'No contacts found'], 404);
            }
        }

        return response()->json(['message' => 'You are not authorized to view this data'], 401);
    }
}
