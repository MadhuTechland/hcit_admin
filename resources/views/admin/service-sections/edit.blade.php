@extends('admin.layouts.app')

@section('title', 'Edit Section')
@section('page-title', 'Edit Section for ' . $service->title)

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.services.index') }}">Services</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.services.sections.index', $service) }}">Sections</a></li>
    <li class="breadcrumb-item active">Edit</li>
@endsection

@section('content')
<form action="{{ route('admin.services.sections.update', [$service, $section]) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    @include('admin.service-sections.form')
</form>
@endsection
