@extends('layouts.app')

@section('content')
<form action="{{ route('update', ['id'=>$washtypes->id]) }}" method="POST" class="m-auto w-full max-w-lg">
@csrf
@method('PUT')
    <div class="text-center">
        <h1 class="text-5xl uppercase bold">Update WashTypes</h1>
    </div>
    <br><br>
    <div class="flex flex-wrap -mx-3 mb-6">
      <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
          Type Name:
        </label>
        <input class="appearance-none block w-full bg-gray-100 text-gray-700 border py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" name="washtype" type="text" value="{{$washtypes->washtype}}">
      </div>
    </div>
    <div class="flex flex-wrap -mx-3 mb-2">
        <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-state">
                Cost:
            </label>
            <input class="appearance-none block w-full bg-gray-100 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" name="cost" type="number" value="{{$washtypes->cost}}">
        </div>
        <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-zip">
                Duration:
            </label>
            <input class="appearance-none block w-full bg-gray-100 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" name="duration" type="number" value="{{$washtypes->duration}}">
        </div>
    </div>
    <button class = "appearance-none block w-full bg-blue-400 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" type="submit">Click If You Sure</button>
  </form>
@endsection
