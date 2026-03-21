@extends('layouts.faculty')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12 d-flex align-items-center justify-content-between">
            <h1 class="mb-4">Faculty Dashboard</h1>
            <div>
                <a href="{{ route('faculty.notices.index') }}" class="btn btn-outline-primary me-2">Manage Notices</a>
                <a href="{{ route('faculty.notices.create') }}" class="btn btn-primary">New Notice</a>
            </div>
        </div>
    </div>

    @include('partials.notices')

    @if($facultyRecord)
        <!-- Statistics Cards -->
        <div class="row">
            <div class="col-md-6 col-lg-3 mb-4">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1">
                                <h6 class="card-title text-muted mb-0">Total Courses</h6>
                                <h2 class="mb-0">{{ $stats['total_courses'] }}</h2>
                            </div>
                            <div class="text-primary fs-2">
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
                                <h6 class="card-title text-muted mb-0">Total Students</h6>
                                <h2 class="mb-0">{{ $stats['total_students'] }}</h2>
                            </div>
                            <div class="text-success fs-2">
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
                                <h6 class="card-title text-muted mb-0">Department</h6>
                                <p class="mb-0">{{ $facultyRecord->department->name ?? 'N/A' }}</p>
                            </div>
                            <div class="text-info fs-2">
                                <i class="fas fa-building"></i>
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
                                <h6 class="card-title text-muted mb-0">Email</h6>
                                <p class="mb-0 small">{{ $facultyRecord->email }}</p>
                            </div>
                            <div class="text-warning fs-2">
                                <i class="fas fa-envelope"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Courses -->
        <div class="row mt-4">
            <div class="col-12">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white border-bottom">
                        <h5 class="mb-0">Your Courses</h5>
                    </div>
                    <div class="table-responsive">
                        <table class="table mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Course Name</th>
                                    <th>Code</th>
                                    <th>Department</th>
                                    <th>Students</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($courses as $course)
                                    <tr>
                                        <td>{{ $course->name }}</td>
                                        <td><span class="badge bg-primary">{{ $course->code }}</span></td>
                                        <td>{{ $course->department->name }}</td>
                                        <td>
                                            <span class="badge bg-success">{{ $course->students()->count() }} students</span>
                                        </td>
                                        <td>
                                            <a href="{{ route('faculty.courses.show', $course) }}" class="btn btn-sm btn-outline-primary">View</a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center text-muted py-4">You don't have any courses assigned yet</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    @if($courses->hasPages())
                        <div class="card-footer bg-white">
                            {{ $courses->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    @else
        <div class="alert alert-warning">
            <h5>Faculty Record Not Found</h5>
            <p>Your email doesn't match any faculty record in the system. Please contact administration.</p>
        </div>
    @endif
</div>
@endsection
