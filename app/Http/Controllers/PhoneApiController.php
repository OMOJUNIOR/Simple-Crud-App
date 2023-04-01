<?php

namespace App\Http\Controllers;

use App\Models\PhoneBook;

class PhoneApiController extends Controller
{
    public function getPhone()
    {
        $phone = PhoneBook::with('user')->where('user_id', '=', '2')->get();

        if ($phone->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'Phone not found',
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'data' => $phone,
        ], 200);
    }
}
