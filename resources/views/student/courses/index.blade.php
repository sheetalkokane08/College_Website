@extends('layouts.student')

@section('content')
<div class="row mb-4">
    <div class="col-12">
        <h1>Available Courses</h1>
    </div>
</div>

<!-- Search & Filter -->
<div class="row mb-4">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <form method="GET" class="row g-3">
                    <div class="col-md-6">
                        <input type="text" name="search" class="form-control" placeholder="Search courses..." 
                               value="{{ request('search') }}">
                    </div>
                    <div class="col-md-4">
                        <select name="department" class="form-select">
                            <option value="">All Departments</option>
                            @foreach($departments as $department)
                                <option value="{{ $department->id }}" {{ request('department') == $department->id ? 'selected' : '' }}>
                                    {{ $department->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary w-100">Search</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Courses List -->
<div class="row">
    @forelse($courses as $course)
        <div class="col-md-6 col-lg-4 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title">{{ $course->name }}</h5>
                    <p class="text-muted">
                        <span class="badge bg-info">{{ $course->code }}</span>
                    </p>
                    
                    <p class="card-text small">
                        <strong>Faculty:</strong> {{ $course->faculty->name }}<br>
                        <strong>Department:</strong> {{ $course->department->name }}<br>
                        <strong>Credits:</strong> {{ $course->credits }}<br>
                        <strong>Students:</strong> {{ $course->students()->count() }}
                    </p>

                    @if(auth()->user()->courses()->where('course_id', $course->id)->exists())
                        <span class="badge bg-success">Enrolled</span>
                    @else
                        <form action="{{ route('student.enroll', $course) }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-primary">Enroll Now</button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    @empty
        <div class="col-12">
            <div class="alert alert-info text-center py-5">
                <i class="fas fa-inbox fs-2 mb-3"></i>
                <p>No courses available</p>
            </div>
        </div>
    @endforelse
</div>

<!-- Pagination -->
@if($courses->hasPages())
    <div class="row mt-4">
        <div class="col-12 d-flex justify-content-center">
            {{ $courses->links('pagination::bootstrap-4') }}
        </div>
    </div>
@endif
@endsection
