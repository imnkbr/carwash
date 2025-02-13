@extends('layouts.app')

@section('content')


<div class="container">
    <h1 class="text-white">داشبورد میزبان</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @auth
        <a href="{{ route('host.residences.create') }}" class="btn btn-primary">ایجاد اقامتگاه جدید</a>
        <a href="{{ route('inquiries') }}" class="btn btn-primary">تایید اقامتگاه</a>
    @endauth


    <h2 class="text-white">اقامتگاه‌های من</h2>
    @if ($reserves->isEmpty())
        <p class="text-white">هیچ اقامتگاهی ثبت نشده است.</p>
    @else
        <table class="table">
            <thead>
                <tr>
                    <th class="text-white">نام</th>
                    <th class="text-white">شهر</th>
                    <th class="text-white">تاریخ شروع</th>
                    <th class="text-white">تاریخ بایان</th>
                    <th class="text-white">ظرفیت</th>
                    <th class="text-white">قیمت</th>
                    <th class="text-white">توضیحات</th>
                    <th class="text-white">در دسترس بودن</th>

                </tr>
            </thead>
            <tbody>
                @foreach ($reserves as $reserve)
                    <tr>
                        <td class="text-white">{{ $reserve->title }}</td>
                        <td class="text-white">{{ $reserve->city }}</td>
                        <td class="text-white">{{ $reserve->start_date }}</td>
                        <td class="text-white">{{ $reserve->end_date }}</td>
                        <td class="text-white">{{ $reserve->capacity }}</td>
                        <td class="text-white">{{ $reserve->price }}</td>
                        <td class="text-white">{{ $reserve->description }}</td>
                        <td class="text-white" >{{ $reserve->is_available }}</td>
                        <td>
                            <form action="{{ route('residences.destroy', $reserve) }}" method="POST" onsubmit="return confirm('آیا مطمئن هستید؟');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">حذف</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>



@endsection
