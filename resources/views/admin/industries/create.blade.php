@extends('admin.layouts.app')

@section('title', 'Create Industry')
@section('page-title', 'Create New Industry')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.industries.index') }}">Industries</a></li>
    <li class="breadcrumb-item active">Create</li>
@endsection

@section('content')
<form action="{{ route('admin.industries.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @include('admin.industries.form', ['industry' => null])
</form>
@endsection
