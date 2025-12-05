@extends('admin.layouts.app')

@section('title', 'Create About Page')
@section('page-title', 'Create New About Page')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.about-pages.index') }}">About Pages</a></li>
    <li class="breadcrumb-item active">Create</li>
@endsection

@section('content')
<form action="{{ route('admin.about-pages.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @include('admin.about-pages.form', ['aboutPage' => null])
</form>
@endsection
