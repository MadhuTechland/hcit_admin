@extends('admin.layouts.app')

@section('title', 'Create Partner')
@section('page-title', 'Create New Partner')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.partners.index') }}">Partners</a></li>
    <li class="breadcrumb-item active">Create</li>
@endsection

@section('content')
<form action="{{ route('admin.partners.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @include('admin.partners.form', ['partner' => null])
</form>
@endsection
