@php
    $notices = \App\Models\Notice::approved()->latest()->take(5)->get();
@endphp

@if($notices->isNotEmpty())
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white">
                    <h5 class="mb-0">Notices</h5>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        @foreach($notices as $notice)
                            <li class="list-group-item">
                                <strong>{{ $notice->title }}</strong>
                                <p class="mb-0 small text-muted">{{ Str::limit($notice->body, 100) }}</p>
                                <span class="text-secondary small">Posted by {{ $notice->faculty->name ?? 'Faculty' }} on {{ $notice->created_at->format('M d, Y') }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endif
