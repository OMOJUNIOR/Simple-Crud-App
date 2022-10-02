@extends('layouts.master')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
@section('content')
<div class="mt-14 sm:mt-0">
  <div class="md:grid md:grid-cols-4 md:gap-6 pt-8 pl-8">
    <div class="md:col-span-1">
      <div class="px-8 sm:px-0">
        <h3 class="text-lg font-medium leading-6 text-gray-900">Contach Information</h3>
        <p class="mt-1 text-sm text-gray-800"> Update your contact informations</p>
        <p class="mt-1 text-sm text-gray-800">If you experience any problem while <br> updating your contact informations, <br> Kindly leave a message.</p>
      </div>
    </div>
    <div class="mt-6 md:col-span-2 md:mt-0">
      <form action="{{route('phone.update',$phone->getId())}}" method="POST" enctype="multipart/form-data">
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
    <div class="alert alert-success text-green-700 dark:bg-slate-50">
        {{ session()->get('success') }}
    </div>
@endif
        <div class="overflow-hidden shadow sm:rounded-md">
          <div class="bg-white px-4 py-5 sm:p-6">
            <div class="grid grid-cols-6 gap-6">
              <div class="col-span-6 sm:col-span-3">
                <label for="first-name" class="block text-sm font-medium text-gray-700">Full Name</label>
                <input type="text" name="name" id="first-name" autocomplete="given-name"  value="{{$phone->getName()}}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
              </div>

              <div class="col-span-6 sm:col-span-3">
                <label for="last-name" class="block text-sm font-medium text-gray-700">Phone Number</label>
                <input type="text" name="phone_number" value="{{$phone->getTelNumber()}}" id="last-name" autocomplete="family-name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
              </div>

              <div class="col-span-6 sm:col-span-3">
                <label for="last-name" class="block text-sm font-medium text-gray-700">Relationship</label>
                <input type="text" name="relationship" id="last-name" autocomplete="family-name"  value="{{$phone->getRelationship()}}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
              </div>

              
              <div class="col-span-6 sm:col-span-3">
                <label for="last-name" class="block text-sm font-medium text-gray-700">Country</label>
                <input type="text" name="country" id="last-name" autocomplete="family-name" value="{{$phone->getCountry()}}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
              </div>

              <div class="col-span-6 sm:col-span-3">
                <label for="last-name" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="text" name="email" id="last-name" placeholder="example@email.com"  autocomplete="family-name" value="{{$phone->getEmail()}}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
              </div>

            <div class="col-span-6 sm:col-span-3">
                <label for="last-name" class="block text-sm font-medium text-gray-700">Career</label>
                <input type="text" name="job" id="last-name"  placeholder="Software Engineer" autocomplete="family-name" value="{{$phone->getJob()}}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
              </div>

              <div class="col-span-6 sm:col-span-3">
                <label for="last-name" class="block text-sm font-medium text-gray-700">Photo</label>
                <input type="file" name="image" id="last-name" autocomplete="family-name" value="{{$phone->getImage()}}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
              </div>
          </div>
          <div class="bg-gray-50 px-4 py-3 text-right sm:px-6">
            <button type="submit" class="inline-flex justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Save</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
