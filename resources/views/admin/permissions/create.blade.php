@extends('admin.layouts.app')

@section('title', 'Create Permission')
@section('page-title', 'Create Permission')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.permissions.index') }}">Permissions</a></li>
    <li class="breadcrumb-item active">Create</li>
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-6">
        <form action="{{ route('admin.permissions.store') }}" method="POST">
            @csrf
            @include('admin.permissions.form', ['permission' => null])
        </form>
    </div>
</div>
@endsection
