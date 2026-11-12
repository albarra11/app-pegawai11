@extends('master')

@section('title', 'Edit Department')

@section('content')
<div class="card shadow-sm">
    <div class="card-header bg-warning text-dark fw-bold">Edit Department</div>
    <div class="card-body">
        <form action="{{ route('departments.update', $department->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label class="form-label">Department Name</label>
                <input type="text" name="nama_departemen" class="form-control" value="{{ $department->nama_departemen }}" required>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('departments.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>
@endsection
