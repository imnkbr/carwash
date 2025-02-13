@extends('layouts.app')

@section('content')
<div class="container">
    <h1>ایجاد اقامتگاه جدید</h1>
    <form action="{{ route('host.residences.store') }}" method="POST" class="m-auto w-full max-w-lg">
        @csrf
        @method('POST')
        <div class="form-group">
            <label for="title" class="text-white">نام اقامتگاه</label>
            <input type="text" name="title" class="form-control" required>
            @error('title')
                <span class="text-danger">{{ $message }}</span>
            @enderror

        </div>
        <div class="form-group">
            <label for="city" class="text-white">شهر</label>
            <input type="text" name="city" class="form-control" required>
            @error('city')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group">
            <label for="start_date" class="text-white">تاریخ شروع</label>
            <input type="date" name="start_date" class="form-control" required>
            @error('start_date')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group">
            <label for="end_date" class="text-white">تاریخ پایان</label>
            <input type="date" name="end_date" class="form-control" required>
            @error('end_date')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group">
            <label for="capacity" class="text-white">ظرفیت</label>
            <input type="number" name="capacity" class="form-control" min="1" required>
            @error('capacity')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group">
            <label for="price" class="text-white">قیمت</label>
            <input type="number" name="price" class="form-control" min="0" required>
            @error('price')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group">
            <label for="is_available" class="text-white">وضعیت دسترسی</label>
            <select name="is_available" class="form-control" required>
                <option value="1">فعال</option>
                <option value="0">غیرفعال</option>
            </select>
            @error('is_availabe')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group">
            <label for="type" class="text-white">نوع رزرو</label>
            <select name="type" class="form-control" required>
                <option value="instant">رزرو آنی</option>
                <option value="inquiry">نیاز به استعلام</option>
                <option value="reserved">نیاز به استعلام</option>
            </select>
            @error('type')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">ذخیره</button>
    </form>
</div>
@endsection

