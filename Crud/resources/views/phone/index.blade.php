@extends('layouts.master')
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
@section('content')

<div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-gray-900 shadow-sm sm:rounded-lg">
                <div class="p-6 text-white bg-gray-900 border-b border-gray-200">
                    Welcome to your Phone list!
                </div>
            </div>
        </div>
    </div>


    <!-- success alert -->
    
    @if(session()->has('success'))
    
    <div class="pb-2 font-semibold text-center text-green-600 alert alert-success dark:bg-slate-50 ">
        {{ session()->get('success') }}
    </div>
    @endif
 <!-- search from -->
 <div class="w-full max-w-4xl mx-auto overflow-hidden bg-white divide-y divide-gray-300 rounded-lg whitespace-nowrap">
 <div class="relative mt-1">
            <div class="absolute inset-y-0 left-0 flex items-center pb-2 pl-2 ointer-events-none">
                <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path></svg>
            </div>

    <form method="post" action="{{route('phone.searchPhone')}}" class="my-2 form-inline my-lg-0">
        @csrf
        <input class="justify-center pl-8 border border-gray-300 rounded-lg form-control mr-sm-2 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" type="search"  name="search" placeholder="Search" aria-label="Search">
        <button class="text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700" type="submit">Search</button>
    </form>
    </div>

<div class="">
        <div class='w-full overflow-x-auto'>
            <table class='w-full max-w-4xl mx-auto overflow-hidden bg-white divide-y divide-gray-300 rounded-lg whitespace-nowrap'>
                <thead class="bg-gray-900">
                    <tr class="text-left text-white">
                        <th class="px-6 py-4 text-sm font-semibold uppercase"> Name </th>
                        <th class="px-6 py-4 text-sm font-semibold uppercase"> Phone Number </th>
                        <th class="px-6 py-4 text-sm font-semibold text-center uppercase"> Relationship</th>
                        <th class="px-6 py-4 text-sm font-semibold text-center uppercase"> Country </th>
                        <th class="px-6 py-4 text-sm font-semibold uppercase">Action </th>
                    </tr>
                  
                </thead>
                 @foreach($contacts as $contact) 
                <tbody class="divide-y divide-gray-200">
                    <tr>
                        <td class="px-6 py-4">
                            <div class="flex items-center space-x-3">
                                <div class="inline-flex w-10 h-10"> <img class='object-cover w-10 h-10 rounded-full' alt='User avatar' src='{{asset('/storage/'.$contact->getImage())}}' /> </div>
                                <div>
                                 <a  class= "hover:text-blue-600" href="{{route('phone.show',$contact->getId())}}"> {{$contact->getName()}}</a>
                                    <p class="text-sm font-semibold tracking-wide text-gray-500"> {{$contact->getEmail()}} </p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <p class=""> {{$contact->getTelNumber()}} </p>
                            <p class="text-sm font-semibold tracking-wide text-gray-500"> Job: {{$contact->getJob()}}</p>
                        </td>
                        <td class="px-6 py-4 text-center"> <span class="w-1/3 px-2 pb-1 text-sm font-semibold text-white bg-green-600 rounded-full"> {{$contact->getRelationship()}} </span> </td>
                        <td class="px-6 py-4 text-center"> {{$contact->getCountry()}} </td>
                        <td class="px-6 py-4 text-center"> <a href="{{route('phone.edit',$contact->getId())}}" class="text-purple-800 hover:underline">Edit</a><br> 
                        <form method="post" action="{{route('phone.destroy',$contact->getId())}}">
                       @csrf
                        @method('DELETE')
                        <button type="submit" class="px-2 space-y-2 font-semibold text-red-600 bg-white border border-red-400 rounded shadow dark:text-red-500 hover:bg-gray-100">Delete</button>   
                   </form>
                   </td> 
                    </tr>
                </tbody>
                @endforeach
                @if(session()->has('error'))
                <div class="pb-2 font-semibold text-center text-red-600 alert alert-success dark:bg-slate-50 ">
                    {{ session()->get('error') }}
                </div> 
            @endif
            </table>
        </div>
    </div>
    <p class= "flex bg-gray-900 flexbox"> {{$contacts->links()}} </p> 

@endsection
