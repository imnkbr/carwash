@extends('layouts.app')

@section('content')
<form action="{{ route('login') }}" method="POST" class="w-full max-w-lg m-auto">
@csrf
    <div class="w-4/5 py-24">
        <div class="text-center">
            <h2 class="uppercase bold text-5xl">login</h2>
            <br>
            <br>
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-state">
                Email:
            </label>
            <input type="email" name="email" class="appearance-none block w-full bg-gray-100 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
            <br>
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-zip">
                Password:
            </label>
            <input class="appearance-none block w-full bg-gray-100 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" name="password" type="password">
        </div>
    </div>
    <button class = "appearance-none block w-4/5 bg-blue-400 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" type="submit">Click</button>
</form>
    @if($errors->any())
    <div class="w-4/8 m-auto text-center">
        @foreach ($errors->all() as $error)
            <li style="color: red; list-style-type: none;">
                {{$error}}
            </li>
        @endforeach
    </div>
    @endif
@endsection
