@extends('layouts.app')

@section('content')

<div class="m-auto w-4/5 py-24">
    <div class="text-center text-red-500">
        <h1 class="text-center uppercase bold">Dear Customer Save Your Private code:</h1>
        <br>
        <p class="text-center text-green-500 bold"><strong>{{$carwash->code}}</strong></p>
        <a class="border-b-2 pb-2 border-dotted italic text-blue-400" href="login">Click here to login</a>
    </div>

</div>
@endsection

