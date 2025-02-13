@extends('layouts.app')

@section('content')
<div class="container">
    <h1>ورود</h1>
    <form action="{{ route('login') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="email" class="text-white">ایمیل</label>
            <input type="email" name="email" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="password" class="text-white">رمز عبور</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">ورود</button>
    </form>
</div>
@endsection
