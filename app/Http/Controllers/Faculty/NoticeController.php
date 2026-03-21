<?php

namespace App\Http\Controllers\Faculty;

use App\Http\Requests\StoreNoticeRequest;
use App\Http\Requests\UpdateNoticeRequest;
use App\Models\Notice;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class NoticeController
{
    public function index(): View
    {
        $faculty = auth()->user();
        $facultyRecord = $faculty->facultyRecord;

        $notices = Notice::where('faculty_id', $facultyRecord?->id)
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('faculty.notices.index', compact('notices'));
    }

    public function create(): View
    {
        return view('faculty.notices.create');
    }

    public function store(StoreNoticeRequest $request): RedirectResponse
    {
        $facultyId = auth()->user()->facultyRecord?->id;
        Notice::create([
            'title' => $request->title,
            'body' => $request->body,
            'faculty_id' => $facultyId,
            'approved' => false,
        ]);

        return redirect()->route('faculty.notices.index')->with('success', 'Notice submitted for approval.');
    }

    public function edit(Notice $notice): View
    {
        return view('faculty.notices.edit', compact('notice'));
    }

    public function update(UpdateNoticeRequest $request, Notice $notice): RedirectResponse
    {
        $notice->update($request->only(['title', 'body']));
        // reset approval when edited
        $notice->approved = false;
        $notice->save();

        return redirect()->route('faculty.notices.index')->with('success', 'Notice updated and resubmitted for approval.');
    }

    public function destroy(Notice $notice): RedirectResponse
    {
        $notice->delete();
        return redirect()->route('faculty.notices.index')->with('success', 'Notice deleted.');
    }
}
