@extends('layouts.faculty')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <h1 class="mb-4">My Notices</h1>
            <a href="{{ route('faculty.notices.create') }}" class="btn btn-primary mb-3">New Notice</a>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="table-responsive">
                    <table class="table mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Title</th>
                                <th>Status</th>
                                <th>Created At</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($notices as $notice)
                                <tr>
                                    <td>{{ $notice->title }}</td>
                                    <td>
                                        @if($notice->approved)
                                            <span class="badge bg-success">Approved</span>
                                        @else
                                            <span class="badge bg-warning">Pending</span>
                                        @endif
                                    </td>
                                    <td>{{ $notice->created_at->format('M d, Y') }}</td>
                                    <td>
                                        <a href="{{ route('faculty.notices.edit', $notice) }}" class="btn btn-sm btn-outline-secondary">Edit</a>
                                        <form action="{{ route('faculty.notices.destroy', $notice) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-outline-danger" onclick="return confirm('Delete this notice?')">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center text-muted">No notices created yet.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                @if($notices->hasPages())
                    <div class="card-footer">
                        {{ $notices->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
