<?php

namespace App\Http\Controllers;

use App\Models\PhoneBook;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SearchController extends Controller
{
    public function searchPhone(Request $request)
    {
        $search = $request->get('search');
        $contacts = PhoneBook::where('name', 'like', '%'.$search.'%')->where('user_id', Auth::user()->id)->paginate(3);

        if ($search === null) {
            return redirect()->route('phone.index')->with('error', 'Please enter a name to search');
        }
        if ($contacts->isEmpty()) {
            return redirect()->route('phone.index')->with('error', 'No contact found with given name');
        }

        return view('phone.index', compact('contacts'));
    }
}
