@extends('admin.layouts.app')

@section('title', 'Edit Blog')
@section('page-title', 'Edit Blog')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.blogs.index') }}">Blogs</a></li>
    <li class="breadcrumb-item active">Edit</li>
@endsection

@section('content')
<form action="{{ route('admin.blogs.update', $blog->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    @include('admin.blogs.form', ['blog' => $blog, 'categories' => $categories, 'tags' => $tags])
</form>
@endsection
