@extends('admin.layouts.app')

@section('title', 'Create Industry Section')
@section('page-title', 'Create New Section')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.industries.index') }}">Industries</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.industries.sections.index', $industry) }}">{{ $industry->title }} Sections</a></li>
    <li class="breadcrumb-item active">Create Section</li>
@endsection

@section('content')
<form action="{{ route('admin.industries.sections.store', $industry) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @include('admin.industry-sections.form')
</form>
@endsection
