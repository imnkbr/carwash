@extends('layouts.app')

@section('content')

@if(auth()->check())
    <div class="text-right mx-4 my-4 text-gray-500">
       <a href="{{ route('logout') }}" class="bg-red-500 rounded-lg px-3 py-3">Logout</a>
    </div>
@endif


<div class="m-auto w-4/5 py-24">
    <div class="text-center">
        <h1 class="text-5xl uppercase bold">welcome admin</h1>
        <br>
        <h6 class="text-m italic ">Users and Reserved Times Details Right blow</h6>
    </div>
</div>

<div class="flex justify-evenly hover:text-sky-400">
    <a  href="/users">Users</a>
    <a href="/reservedtimes">Reserved Times</a>
    <a href="/washtypes">WashTypes</a>
</div>











@endsection
