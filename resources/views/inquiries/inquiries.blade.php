<!-- resources/views/host/inquiries.blade.php -->
@extends('layouts.app')

@section('content')
    <h1>درخواست‌های اقامتگاه‌های من</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th class="text-white">نام اقامتگاه</th>
                <th class="text-white">نام شهر</th>
                <th class="text-white">آی دی یوزر</th>
                <th class="text-white">وضعیت</th>
                <th class="text-white">عملیات</th>
            </tr>
        </thead>
        <tbody>
            @foreach($inquiries as $inquiry)
                <tr>
                    <td class="text-white">{{ $inquiry->residence->title }}</td>
                    <td class="text-white">{{ $inquiry->residence->city }}</td>
                    <td class="text-white">{{ $inquiry->user_id }}</td>
                    <td class="text-white">{{ $inquiry->status }}</td>
                    <td>
                        @if($inquiry->status === 'pending')
                            <form action="{{ route('inquiries.approve', $inquiry) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn btn-success">تأیید</button>
                            </form>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
