<?php

namespace App\Http\Controllers;

use App\Models\PhoneBook;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PhoneBookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contacts = PhoneBook::orderBy('id', 'desc')->where('user_id', Auth::user()->id)->paginate(3);

        return view('phone.index', compact('contacts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('phone.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        PhoneBook::validate($request);

        $data = new PhoneBook();
        $user_id = Auth::user()->getUserId();
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

        return redirect()->route('phone.index')->with('success', 'Phone number added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $phone = PhoneBook::findOrFail($id);

        if (Auth::user()->getUserId() !== $phone->getUserId()) {
            return redirect()->route('phone.index')->with('error', 'You are not authorized to view this contact');
        }

        return view('phone.show')->with('phone', $phone);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $phone = PhoneBook::findOrFail($id);

        if($phone->getUserId() !== Auth::user()->getUserId()) {
         return redirect()->route('phone.index')->with('error', 'This contact does not belong to you');
        }

        return view('phone.edit')->with('phone', $phone);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        PhoneBook::validate($request);

        $contacts = PhoneBook::findOrFail($id);
        $user_id = auth()->user()->id;
        $contacts->setName($request->input('name'));
        $contacts->setTelNumber($request->input('phone_number'));
        $contacts->setRelationship($request->input('relationship'));
        $contacts->setEmail($request->input('email'));
        $contacts->setCountry($request->input('country'));
        $contacts->setJob($request->input('job'));
        $contacts->setImage('image');

        $contacts->save();

        if ($request->hasFile('image')) {
            $imageName = $contacts->getId().'.'.$request->file('image')->getClientOriginalExtension();
            Storage::disk('public')->put($imageName, file_get_contents($request->file('image')->getRealPath()));
            $contacts->setImage($imageName);
            $contacts->save();
        }

        return redirect()->route('phone.index')->with('success', 'Phone number updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $phone = PhoneBook::findOrFail($id);

        $phone->delete();

        return back()->with('success', 'Phone number deleted successfully');
    }
}
