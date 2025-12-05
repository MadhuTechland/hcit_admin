@extends('admin.layouts.app')

@section('title', 'Create Case Study')
@section('page-title', 'Create New Case Study')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.case-studies.index') }}">Case Studies</a></li>
    <li class="breadcrumb-item active">Create</li>
@endsection

@section('content')
<form action="{{ route('admin.case-studies.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @include('admin.case-studies.form', ['caseStudy' => null])
</form>
@endsection
