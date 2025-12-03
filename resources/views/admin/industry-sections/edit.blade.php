@extends('admin.layouts.app')

@section('title', 'Edit Industry Section')
@section('page-title', 'Edit Section')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.industries.index') }}">Industries</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.industries.sections.index', $industry) }}">{{ $industry->title }} Sections</a></li>
    <li class="breadcrumb-item active">Edit Section</li>
@endsection

@section('content')
<form action="{{ route('admin.industries.sections.update', [$industry, $section]) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    @include('admin.industry-sections.form')
</form>
@endsection
