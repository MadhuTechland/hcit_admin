@extends('admin.layouts.app')

@section('title', 'Create Section')
@section('page-title', 'Create Section for ' . $service->title)

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.services.index') }}">Services</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.services.sections.index', $service) }}">Sections</a></li>
    <li class="breadcrumb-item active">Create</li>
@endsection

@section('content')
<form action="{{ route('admin.services.sections.store', $service) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @include('admin.service-sections.form')
</form>
@endsection
