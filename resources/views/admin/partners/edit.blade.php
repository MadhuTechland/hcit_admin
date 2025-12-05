@extends('admin.layouts.app')

@section('title', 'Edit Partner')
@section('page-title', 'Edit Partner')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.partners.index') }}">Partners</a></li>
    <li class="breadcrumb-item active">Edit</li>
@endsection

@section('content')
<form action="{{ route('admin.partners.update', $partner->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    @include('admin.partners.form', ['partner' => $partner])
</form>
@endsection
