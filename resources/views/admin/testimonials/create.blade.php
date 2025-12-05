@extends('admin.layouts.app')

@section('title', 'Create Testimonial')
@section('page-title', 'Create New Testimonial')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.testimonials.index') }}">Testimonials</a></li>
    <li class="breadcrumb-item active">Create</li>
@endsection

@section('content')
<form action="{{ route('admin.testimonials.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @include('admin.testimonials.form', ['testimonial' => null])
</form>
@endsection
