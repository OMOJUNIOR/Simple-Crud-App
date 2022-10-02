@extends('layouts.master')
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
@section('content')
<div class="mt-14 sm:mt-0">
  <div class="pt-8 pl-8 md:grid md:grid-cols-4 md:gap-6">
    <div class="md:col-span-1">
      <div class="px-8 sm:px-0">
        <h3 class="text-lg font-medium leading-6 text-gray-900">Profile Details</h3>
        <p class="mt-1 text-sm text-gray-800"> Update your profile informations</p>
        <p class="mt-1 text-sm text-gray-800">If you experience any problem while <br> updating your contact profile, <br> Kindly leave a message.</p>
      </div>
    </div>
    <div class="mt-6 md:col-span-2 md:mt-0">
      <form action="{{route('user.update',$user->getUserId())}}" method="POST">
        @csrf
        @method('PUT')
        @if ($errors->any())
    <div class="alert alert-danger color-red-700">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if(session()->has('success'))
    <div class="text-green-700 alert alert-success dark:bg-slate-50">
        {{ session()->get('success') }}
    </div>
@endif
        <div class="overflow-hidden shadow sm:rounded-md">
          <div class="px-4 py-5 bg-white sm:p-6">
            <div class="grid grid-cols-6 gap-6">
              <div class="col-span-6 sm:col-span-3">
                <label for="first-name" class="block text-sm font-medium text-gray-700">Full Name</label>
                <input type="text" name="name" id="first-name" autocomplete="given-name" value="{{$user->getName()}}" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
              </div>

              <div class="col-span-6 sm:col-span-3">
                <label for="last-name" class="block text-sm font-medium text-gray-700">Phone Number</label>
                <input type="number" name="tel_number"  id="last-name" value="{{$user->getTelNumber()}}" autocomplete="family-name" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
              </div>

              <div class="col-span-6 sm:col-span-3">
                <label for="last-name" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="text" name="email" id="last-name" placeholder="example@email.com" value="{{$user->getEmail()}}"  autocomplete="family-name"  class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
              </div>

            <div class="col-span-6 sm:col-span-3">
                <label for="last-name" class="block text-sm font-medium text-gray-700">Update Password</label>
                <input type="password" name="password" id="last-name" autocomplete="family-name"  class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
              </div>

           
            <div class="col-span-6 sm:col-span-3">
                <label for="last-name" class="block text-sm font-medium text-gray-700">Re-enter Password</label>
                <input type="password" name="password_confirmation" id="last-name"   autocomplete="family-name"  class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
              <span>
              @if(session()->has('error'))
                <div class="pb-2 font-semibold text-red-600 text-start alert alert-success ">
                    {{ session()->get('error') }}
                </div> 
            @endif
              
              </span>
              </div>   
          </div>
          <div class="px-4 py-3 text-right bg-gray-50 sm:px-6">
            <button type="submit" class="inline-flex justify-center px-4 py-2 text-sm font-medium text-white bg-indigo-600 border border-transparent rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Save</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
