@extends('layouts.faculty')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <h1 class="mb-4">My Courses</h1>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="table-responsive">
                    <table class="table mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Course Name</th>
                                <th>Code</th>
                                <th>Department</th>
                                <th>Credits</th>
                                <th>Students Enrolled</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($courses as $course)
                                <tr>
                                    <td>{{ $course->name }}</td>
                                    <td><span class="badge bg-primary">{{ $course->code }}</span></td>
                                    <td>{{ $course->department->name }}</td>
                                    <td>{{ $course->credits }}</td>
                                    <td>
                                        <span class="badge bg-success">{{ $course->students()->count() }}</span>
                                    </td>
                                    <td>
                                        <a href="{{ route('faculty.courses.show', $course) }}" class="btn btn-sm btn-outline-primary">
                                            <i class="fas fa-eye"></i> View Students
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center text-muted py-4">No courses found</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            @if($courses->hasPages())
                <div class="d-flex justify-content-center mt-4">
                    {{ $courses->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
