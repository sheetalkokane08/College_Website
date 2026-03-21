@extends('layouts.admin')

@section('content')
<div class="container-fluid py-4">
    <div class="row mb-4">
        <div class="col-12">
            <a href="{{ route('admin.students.index') }}" class="btn btn-secondary mb-2">
                <i class="fas fa-arrow-left"></i> Back
            </a>
            <h1>{{ $student->name }}</h1>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4 mb-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h6 class="card-title text-muted">Email</h6>
                    <p class="card-text">{{ $student->email }}</p>

                    <h6 class="card-title text-muted mt-3">Phone</h6>
                    <p class="card-text">{{ $student->phone ?? '-' }}</p>

                    <h6 class="card-title text-muted mt-3">Member Since</h6>
                    <p class="card-text">{{ $student->created_at->format('M d, Y') }}</p>

                    <h6 class="card-title text-muted mt-3">Total Enrollments</h6>
                    <p class="card-text">{{ $student->courses()->count() }}</p>
                </div>
            </div>
        </div>

        <div class="col-md-8 mb-4">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-bottom">
                    <h5 class="mb-0">Enrolled Courses</h5>
                </div>
                <div class="table-responsive">
                    <table class="table mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Course Name</th>
                                <th>Code</th>
                                <th>Department</th>
                                <th>Credits</th>
                                <th>Semester</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($enrollments as $enrollment)
                                <tr>
                                    <td>{{ $enrollment->course->name }}</td>
                                    <td><span class="badge bg-info">{{ $enrollment->course->code }}</span></td>
                                    <td>{{ $enrollment->course->department->name }}</td>
                                    <td>{{ $enrollment->course->credits }}</td>
                                    <td>{{ $enrollment->semester ?? '-' }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center text-muted py-4">No enrollments</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-center mt-4">
                {{ $enrollments->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
