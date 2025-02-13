@extends('layouts.app')

@section('content')


<section class="container-sm">
    <div class="m-5 py-2 bg-light">
        <h1 class=" text-center fs-1 mt-2 text-dark">خوش امدید</h1>
    </div>
    <h1 class="text-white">جستجوی اقامتگاه</h1>
    <form action="{{ route('search') }}" method="GET">
        <input type="text" name="city" placeholder="شهر">
        <input type="date" name="start_date">
        <input type="date" name="end_date">
        <input type="number" name="number_of_guests" placeholder="تعداد نفرات">
        <button type="submit">جستجو</button>
    </form>
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

@endsection
