@extends('admin.layouts.app')

@section('title', 'Edit Leadership Member')
@section('page-title', 'Edit Leadership Member')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.leadership-members.index') }}">Leadership Members</a></li>
    <li class="breadcrumb-item active">Edit</li>
@endsection

@section('content')
<form action="{{ route('admin.leadership-members.update', $leadershipMember->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    @include('admin.leadership-members.form', ['leadershipMember' => $leadershipMember])
</form>
@endsection
