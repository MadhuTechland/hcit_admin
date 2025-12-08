@extends('admin.layouts.app')

@section('title', 'Create Role')
@section('page-title', 'Create Role')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.roles.index') }}">Roles</a></li>
    <li class="breadcrumb-item active">Create</li>
@endsection

@section('content')
<form action="{{ route('admin.roles.store') }}" method="POST">
    @csrf
    @include('admin.roles.form', ['role' => null, 'rolePermissions' => []])
</form>
@endsection
