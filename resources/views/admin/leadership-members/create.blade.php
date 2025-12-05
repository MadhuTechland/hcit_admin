@extends('admin.layouts.app')

@section('title', 'Create Leadership Member')
@section('page-title', 'Create New Leadership Member')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.leadership-members.index') }}">Leadership Members</a></li>
    <li class="breadcrumb-item active">Create</li>
@endsection

@section('content')
<form action="{{ route('admin.leadership-members.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @include('admin.leadership-members.form', ['leadershipMember' => null])
</form>
@endsection
