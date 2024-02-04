@extends('layouts.app')

@section('content')
@if(auth()->check())
    <div class="text-right mx-4 my-4 text-gray-500">
       <a href="{{ route('logout') }}" class="bg-red-500 rounded-lg px-3 py-3">Logout</a>
    </div>
@endif
<div class="m-auto w-4/5 py-24">
    <div class="text-center">
        <h1 class="text-5xl uppercase bold">Washing Time!</h1>
        <br>
        <h6 class="text-xl italic ">Welcome</h6>
    </div>
</div>

<div class="flex justify-evenly hover:text-sky-400">
    <a  href="/register">Register</a>
    <a href="/login">Login</a>
    @if(auth()->check())
    <a href="{{route('details' , auth()->user()->id)}}">History</a>
    <a href="{{route('reserve')}}">Reserve Time</a>
    @endif
</div>


@endsection
