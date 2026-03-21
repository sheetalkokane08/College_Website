@extends('layouts.faculty')

@section('content')
<div class="container-fluid py-4">
    <h1 class="mb-4">Edit Notice</h1>

    <form action="{{ route('faculty.notices.update', $notice) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $notice->title) }}" required>
            @error('title')<div class="text-danger">{{ $message }}</div>@enderror
        </div>
        <div class="mb-3">
            <label for="body" class="form-label">Body</label>
            <textarea name="body" id="body" rows="5" class="form-control" required>{{ old('body', $notice->body) }}</textarea>
            @error('body')<div class="text-danger">{{ $message }}</div>@enderror
        </div>
        <button type="submit" class="btn btn-primary">Update and Resubmit</button>
        <a href="{{ route('faculty.notices.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection