@extends('user.layouts.app')
@section('title', $viewData['title'])
@section('content')
        @include('user.layouts.notice')
        @include('user.layouts.home.slider')
        @include('user.layouts.home.shippingArea')
        @include('user.layouts.home.featuredProduct')
        @include('user.layouts.home.productArea')
        @include('user.layouts.home.NewProduct')
        @include('user.layouts.home.blogArea')
        @include('user.layouts.popupLogin')
        @include('user.layouts.popupChat');
@endsection