@extends('admin.layouts.app')

@section('title', 'Edit Contact Info')
@section('page-title', 'Edit Contact Info')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.contact-info.index') }}">Contact Info</a></li>
    <li class="breadcrumb-item active">Edit</li>
@endsection

@section('content')
<form action="{{ route('admin.contact-info.update', $contactInfo->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    @include('admin.contact-info.form', ['contactInfo' => $contactInfo])
</form>
@endsection
