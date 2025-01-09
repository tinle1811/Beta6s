@extends('user.layouts.app')
@section('title', $viewData['title'])
@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-primary text-white text-center">
                    <h3>Đăng ký</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('register') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="TenDN" class="form-label">Tên đăng nhập</label>
                            <input type="text" id="TenDN" name="TenDN" class="form-control" value="{{ old('TenDN', $viewData['oldData']['TenDN'] ?? '') }}" placeholder="Nhập tên đăng nhập" required>
                        </div>
                        <div class="mb-3">
                            <label for="Email" class="form-label">Email</label>
                            <input type="email" id="Email" name="Email" class="form-control" value="{{ old('Email', $viewData['oldData']['Email'] ?? '') }}" placeholder="Nhập email" required>
                            @if(isset($viewData['error']))
                                <div class="text-danger">{{ $viewData['error'] }}</div>
                            @endif
                        </div>
                        <div class="mb-3">
                            <label for="Password" class="form-label">Mật khẩu</label>
                            <input type="password" id="Password" name="Password" class="form-control"
                                placeholder="Nhập mật khẩu" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Đăng ký</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection