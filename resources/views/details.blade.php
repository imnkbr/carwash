@extends('layouts.app')

@section('content')
<div>
    <div class="px-4 sm:px-0">
      <h3 class="text-base font-semibold leading-7 text-gray-900">Reservation Information</h3>
      <p class="mt-1 max-w-2xl text-sm leading-6 text-gray-500">Personal details.</p>
    </div>
    <div class="mt-6 border-t border-gray-100">
      <dl class="divide-y divide-gray-100">
        <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
          <dt class="text-sm font-medium leading-6 text-gray-900">Full name:</dt>
          <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{$carwash->name}}</dd>
        </div>
        <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
          <dt class="text-sm font-medium leading-6 text-gray-900">Phone Number:</dt>
          <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{$carwash->phonenumber}}</dd>
        </div>
        <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
          <dt class="text-sm font-medium leading-6 text-gray-900">Wash Type:</dt>
          <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{$carwash->washtype}}</dd>
        </div>
        <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
          <dt class="text-sm font-medium leading-6 text-gray-900">Start Time:</dt>
          <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{$carwash->start_time}}</dd>
        </div>
        <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
          <dt class="text-sm font-medium leading-6 text-gray-900">End Time:</dt>
          <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{$carwash->end_time}}</dd>
        </div>
      </dl>
      <div class="text-center">
        <a class="border-b-2 borfer-dotted italic text-green-500" href="/login/{{$carwash->code}}/edit">
            Edit Reservation &rarr;
        </a>
        <form method="POST" action="{{ route('posts.destroy', $carwash->id) }}" onsubmit = "return confirm('Are you sure?')" >
            @csrf
            @method('DELETE')
            <button type="submit" class="border-b-2 borfer-dotted italic text-red-500">
                Delete Reservation &rarr;
            </button>
        </form>
      </div>

    </div>
  </div>
@endsection
