@extends('admin.layouts.app')

@section('title', 'Create Service')
@section('page-title', 'Create Service')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.services.index') }}">Services</a></li>
    <li class="breadcrumb-item active">Create</li>
@endsection

@section('content')
<form action="{{ route('admin.services.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @include('admin.services.form')
</form>
@endsection
