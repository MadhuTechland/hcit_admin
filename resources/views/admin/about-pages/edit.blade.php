@extends('admin.layouts.app')

@section('title', 'Edit About Page')
@section('page-title', 'Edit About Page')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.about-pages.index') }}">About Pages</a></li>
    <li class="breadcrumb-item active">Edit</li>
@endsection

@section('content')
<form action="{{ route('admin.about-pages.update', $aboutPage->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    @include('admin.about-pages.form', ['aboutPage' => $aboutPage])
</form>
@endsection
