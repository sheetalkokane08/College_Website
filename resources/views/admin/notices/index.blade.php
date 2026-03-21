@extends('layouts.admin')

@section('content')
<div class="container-fluid py-4">
    <div class="row mb-4">
        <div class="col-12">
            <h1>All Notices</h1>
            <a href="{{ route('admin.notices.pending') }}" class="btn btn-warning">Pending Approval</a>
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
                                <th>Faculty</th>
                                <th>Status</th>
                                <th>Created At</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($notices as $notice)
                                <tr>
                                    <td>{{ $notice->title }}</td>
                                    <td>{{ $notice->faculty->name ?? 'N/A' }}</td>
                                    <td>
                                        @if($notice->approved)
                                            <span class="badge bg-success">Approved</span>
                                        @else
                                            <span class="badge bg-warning">Pending</span>
                                        @endif
                                    </td>
                                    <td>{{ $notice->created_at->format('M d, Y') }}</td>
                                    <td>
                                        @if(!$notice->approved)
                                            <form action="{{ route('admin.notices.approve', $notice) }}" method="POST" class="d-inline">
                                                @csrf
                                                <button class="btn btn-sm btn-success">Approve</button>
                                            </form>
                                            <form action="{{ route('admin.notices.destroy', $notice) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-sm btn-danger" onclick="return confirm('Reject (delete) this notice?')">Reject</button>
                                            </form>
                                        @else
                                            <form action="{{ route('admin.notices.destroy', $notice) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-sm btn-outline-danger" onclick="return confirm('Delete this notice?')">Delete</button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center text-muted">No notices found.</td>
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
