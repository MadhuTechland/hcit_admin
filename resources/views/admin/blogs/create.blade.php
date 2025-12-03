@extends('admin.layouts.app')

@section('title', 'Create Blog')
@section('page-title', 'Create New Blog')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.blogs.index') }}">Blogs</a></li>
    <li class="breadcrumb-item active">Create</li>
@endsection

@section('content')
<form action="{{ route('admin.blogs.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @include('admin.blogs.form', ['blog' => null, 'categories' => $categories, 'tags' => $tags])
</form>
@endsection
