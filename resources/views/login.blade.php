@extends('layouts.app')

@section('content')

<form action="/login" method="POST" class="w-full max-w-lg m-auto">
@csrf
    <div class="w-4/5 py-24">
        <div class="text-center">
            <h2 class="uppercase bold">Enter Your Private Code To See Details:</h2>
            <br>
           <input class="appearance-none block w-full bg-gray-500 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" type="text" name="code">
        </div>
    </div>
    <button class = "appearance-none block w-4/5 bg-blue-400 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" type="submit">Click</button>
</form>
@endsection
