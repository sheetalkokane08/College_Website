@extends('layouts.student')

@section('content')
@include('partials.notices')

<div class="row mb-4">
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <h2>Welcome, {{ auth()->user()->name }}!</h2>
                <p class="text-muted">Here's your academic overview</p>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card text-center">
            <div class="card-body">
                <h3 class="text-primary">{{ $enrollments_count }}</h3>
                <p class="text-muted">Enrolled Courses</p>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Your Enrolled Courses</h5>
            </div>
            <div class="table-responsive">
                <table class="table mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Course Name</th>
                            <th>Code</th>
                            <th>Faculty</th>
                            <th>Credits</th>
                            <th>Semester</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($enrolled_courses as $course)
                            <tr>
                                <td>{{ $course->name }}</td>
                                <td><span class="badge bg-info">{{ $course->code }}</span></td>
                                <td>{{ $course->faculty->name }}</td>
                                <td>{{ $course->credits }}</td>
                                <td><span class="badge bg-primary">{{ $course->pivot->semester ?? 'N/A' }}</span></td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted py-4">
                                    You haven't enrolled in any courses yet.
                                    <a href="{{ route('student.courses.index') }}">Browse available courses</a>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Pagination -->
        @if($enrolled_courses->hasPages())
            <div class="d-flex justify-content-center mt-4">
                {{ $enrolled_courses->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
