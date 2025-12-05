@extends('admin.layouts.app')

@section('title', 'Create Contact Info')
@section('page-title', 'Create New Contact Info')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.contact-info.index') }}">Contact Info</a></li>
    <li class="breadcrumb-item active">Create</li>
@endsection

@section('content')
<form action="{{ route('admin.contact-info.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @include('admin.contact-info.form', ['contactInfo' => null])
</form>
@endsection
