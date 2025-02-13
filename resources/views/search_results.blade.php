@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-white">نتایج:</h1>
    @if ($residences->isEmpty())
        <p class="text-white">اقامتگاهی یافت نشد</p>
    @else
        <table class="table">
            <thead>
                <tr>
                    <th class="text-white">نام اقامتگاه:</th>
                    <th class="text-white">شهر:</th>
                    <th class="text-white">تاریخ شروع:</th>
                    <th class="text-white">تاریخ اتمام:</th>
                    <th class="text-white">جمعیت:</th>
                    <th class="text-white">نوع رزرو:</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($residences as $residence)
                    <tr>
                        <td class="text-white">{{ $residence->title }}</td>
                        <td class="text-white">{{ $residence->city }}</td>
                        <td class="text-white">{{ $residence->start_date }}</td>
                        <td class="text-white">{{ $residence->end_date }}</td>
                        <td class="text-white">{{ $residence->capacity }}</td>
                        <td class="text-white">{{ $residence->type }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        @auth
            @if($residence->type === 'instant')
                <form action="{{ route('reserve', $residence->id) }}" method="POST">
                    @csrf
                    <button type="submit">رزرو فوری</button>
                </form>
            @elseif($residence->type === 'inquiry')
                <form action="{{ route('inquiries.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="residence_id" value="{{ $residence->id }}">
                    <button type="submit" class="text">درخواست استعلام</button>
                </form>
            @else
                <p class="text-white">این اقامتگاه قبلاً رزرو شده است.</p>
            @endif
        @else
            <a href="{{ route('login') }}?redirect={{ url()->current() }}" class="btn btn-secondary text-white">برای رزرو وارد شوید</a>
        @endauth

    @endif
    <a href="{{ route('home') }}" class="btn btn-secondary text-white">بازگشت </a>
</div>
@endsection
