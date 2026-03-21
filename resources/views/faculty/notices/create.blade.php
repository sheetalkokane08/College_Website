@extends('layouts.faculty')

@section('content')
<div class="container-fluid py-4">
    <h1 class="mb-4">New Notice</h1>

    <form action="{{ route('faculty.notices.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}" required>
            @error('title')<div class="text-danger">{{ $message }}</div>@enderror
        </div>
        <div class="mb-3">
            <label for="body" class="form-label">Body</label>
            <textarea name="body" id="body" rows="5" class="form-control" required>{{ old('body') }}</textarea>
            @error('body')<div class="text-danger">{{ $message }}</div>@enderror
        </div>
        <button type="submit" class="btn btn-primary">Submit for Approval</button>
        <a href="{{ route('faculty.notices.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
