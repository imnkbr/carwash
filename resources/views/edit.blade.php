@extends('layouts.app')

@section('content')

<form action="/login/{{$carwash->code}}" method="POST" class="m-auto w-full max-w-lg">
@csrf
@method('PUT')
    <div class="text-center">
        <h1 class="text-5xl uppercase bold">Update Your Profile</h1>
    </div>
    <br><br>
    <div class="flex flex-wrap -mx-3 mb-6">
      <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
          Full Name:
        </label>
        <input class="appearance-none block w-full bg-gray-100 text-gray-700 border py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" name="name" type="text" value="{{$carwash->name}}">
      </div>
    </div>
    <div class="flex flex-wrap -mx-3 mb-2">
      <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-state">
          Wash Type:
        </label>
        <div class="relative">
          <select class="block appearance-none w-full bg-gray-100 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" name="washtype" value="{{$carwash->washtype}}">
            <option>All </option>
            <option>inside </option>
            <option>Body </option>
          </select>
          <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
          </div>
        </div>
      </div>
      <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-zip">
          Set Your Wash Time:
        </label>
        <input class="appearance-none block w-full bg-gray-100 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" name="start_time" type="datetime-local" placeholder="90210">
      </div>
    </div>
    <button class = "appearance-none block w-full bg-blue-400 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" type="submit">Click If You Sure</button>
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
