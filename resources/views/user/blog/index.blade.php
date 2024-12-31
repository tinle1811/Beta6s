@extends('user.layouts.app')
@section('title', $viewData['title'])
@section('content')
    @include('user.layouts.breadcrumbs')
    @include('user.layouts.blog.blogArea')
    @include('user.layouts.blog.blogPagination')
    @include('user.layouts.popupChat')
@endsection