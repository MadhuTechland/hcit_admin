@extends('admin.layouts.app')

@section('title', 'Edit Case Study')
@section('page-title', 'Edit Case Study')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.case-studies.index') }}">Case Studies</a></li>
    <li class="breadcrumb-item active">Edit</li>
@endsection

@section('content')
<form action="{{ route('admin.case-studies.update', $caseStudy->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    @include('admin.case-studies.form', ['caseStudy' => $caseStudy])
</form>
@endsection
