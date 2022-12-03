<?php

namespace App\Http\Controllers\Contact;

use App\Http\Controllers\Controller;
use App\Http\Requests\PhoneBookRequest;
use App\Services\PhoneBookService;

class PhoneBookController extends Controller
{
    public function store(PhoneBookRequest $request, PhoneBookService $phoneBookService)
    {
        try {
            $phoneBookService->createPhoneBook($request);

            return redirect()->route('phone.index')->with('success', 'Phone number added successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Phone number could not be created added');
        }
    }
}
