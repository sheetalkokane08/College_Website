@extends('layouts.admin')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <h1 class="mb-4">Admin Dashboard</h1>
        </div>
    </div>

    @include('partials.notices')

    <!-- Statistics Cards -->
    <div class="row">
        <div class="col-md-6 col-lg-3 mb-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <h6 class="card-title text-muted mb-0">Total Students</h6>
                            <h2 class="mb-0">{{ $stats['total_students'] }}</h2>
                        </div>
                        <div class="text-primary fs-2">
                            <i class="fas fa-user-graduate"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-3 mb-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <h6 class="card-title text-muted mb-0">Total Courses</h6>
                            <h2 class="mb-0">{{ $stats['total_courses'] }}</h2>
                        </div>
                        <div class="text-success fs-2">
                            <i class="fas fa-book"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-3 mb-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <h6 class="card-title text-muted mb-0">Total Faculty</h6>
                            <h2 class="mb-0">{{ $stats['total_faculty'] }}</h2>
                        </div>
                        <div class="text-info fs-2">
                            <i class="fas fa-chalkboard-user"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-3 mb-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <h6 class="card-title text-muted mb-0">Total Departments</h6>
                            <h2 class="mb-0">{{ $stats['total_departments'] }}</h2>
                        </div>
                        <div class="text-warning fs-2">
                            <i class="fas fa-building"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Enrollments -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-bottom">
                    <h5 class="mb-0">Recent Enrollments</h5>
                </div>
                <div class="table-responsive">
                    <table class="table mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Student</th>
                                <th>Course</th>
                                <th>Semester</th>
                                <th>Enrolled At</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recent_enrollments as $enrollment)
                                <tr>
                                    <td>
                                        <a href="{{ route('admin.students.show', $enrollment->student) }}" class="text-decoration-none">
                                            {{ $enrollment->student->name }}
                                        </a>
                                    </td>
                                    <td>{{ $enrollment->course->name }}</td>
                                    <td><span class="badge bg-primary">{{ $enrollment->semester ?? 'N/A' }}</span></td>
                                    <td>{{ $enrollment->enrolled_at->format('M d, Y') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center text-muted py-4">No enrollments yet</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
