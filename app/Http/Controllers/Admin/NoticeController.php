<?php

namespace App\Http\Controllers\Admin;

use App\Models\Notice;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class NoticeController
{
    /**
     * List all notices (with filter for pending)
     */
    public function index(): View
    {
        $notices = Notice::with('faculty')
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('admin.notices.index', compact('notices'));
    }

    /**
     * Show pending notices that require approval
     */
    public function pending(): View
    {
        $notices = Notice::where('approved', false)
            ->with('faculty')
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('admin.notices.pending', compact('notices'));
    }

    /**
     * Approve a notice
     */
    public function approve(Notice $notice): RedirectResponse
    {
        $notice->approved = true;
        $notice->save();

        return back()->with('success', 'Notice approved and visible to everyone.');
    }

    /**
     * Delete a notice (maybe spam or inappropriate)
     */
    public function destroy(Notice $notice): RedirectResponse
    {
        $notice->delete();
        return back()->with('success', 'Notice deleted.');
    }
}
