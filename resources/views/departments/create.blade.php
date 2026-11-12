@extends('master')

@section('title', 'Add Department')

@section('content')
<div class="card shadow-sm">
    <div class="card-header bg-primary text-white fw-bold">Add New Department</div>
    <div class="card-body">
        <form action="{{ route('departments.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label">Department Name</label>
                <input type="text" name="nama_departemen" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-success">Save</button>
            <a href="{{ route('departments.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>
@endsection
