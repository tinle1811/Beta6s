@extends('user.layouts.app')
@section('title', $viewData['title'])
@section('content')
        @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
        @elseif(session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
        @include('user.layouts.home.slider')
        @include('user.layouts.home.shippingArea')
        @include('user.layouts.home.featuredProduct')
        @include('user.layouts.home.productArea')
        @include('user.layouts.home.NewProduct')
        @include('user.layouts.home.blogArea')

@endsection