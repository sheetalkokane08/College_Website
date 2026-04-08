@extends('layouts.faculty')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="mb-4">
                <a href="{{ route('faculty.courses.index') }}" class="btn btn-outline-secondary">
                    <i class="fas fa-arrow-left"></i> Back to Courses
                </a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-4 mb-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Course Information</h5>
                    <dl class="row">
                        <dt class="col-sm-6">Course Name:</dt>
                        <dd class="col-sm-6">{{ $course->name }}</dd>

                        <dt class="col-sm-6">Code:</dt>
                        <dd class="col-sm-6"><span class="badge bg-primary">{{ $course->code }}</span></dd>

                        <dt class="col-sm-6">Department:</dt>
                        <dd class="col-sm-6">{{ $course->department->name }}</dd>

                        <dt class="col-sm-6">Credits:</dt>
                        <dd class="col-sm-6">{{ $course->credits }}</dd>

                        <dt class="col-sm-6">Total Students:</dt>
                        <dd class="col-sm-6"><span class="badge bg-success">{{ $students->total() }}</span></dd>
                    </dl>
                </div>
            </div>
        </div>

        <div class="col-lg-8 mb-4">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-bottom">
                    <h5 class="mb-0">Enrolled Students ({{ $students->total() }})</h5>
                </div>
                <div class="table-responsive">
                    <table class="table mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Student Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Enrolled Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($students as $student)
                                <tr>
                                    <td>{{ $student->name }}</td>
                                    <td>{{ $student->email }}</td>
                                    <td>{{ $student->phone ?? 'N/A' }}</td>
                                    <td>
                                        @if($student->pivot->enrolled_at)
                                            {{ is_string($student->pivot->enrolled_at) ? \Carbon\Carbon::parse($student->pivot->enrolled_at)->format('M d, Y') : $student->pivot->enrolled_at->format('M d, Y') }}
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center text-muted py-4">No students enrolled yet</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                @if($students->hasPages())
                    <div class="card-footer bg-white">
                        {{ $students->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
