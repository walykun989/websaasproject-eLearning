<?php

namespace App\Http\Controllers\Pengajar;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\PrivateSession;
use App\Models\User;
use Illuminate\Http\Request;

class PrivateSessionController extends Controller
{
    public function index()
    {
        $sessions = auth()->user()->privateSessions()
            ->with(['user', 'course'])
            ->latest('scheduled_at')
            ->paginate(15);

        return view('pengajar.private-sessions.index', compact('sessions'));
    }

    public function create()
    {
        $sangarUsers = User::peserta()
            ->byTier('sangar')
            ->active()
            ->get();

        $courses = auth()->user()->taughtCourses()->active()->get();

        return view('pengajar.private-sessions.create', compact('sangarUsers', 'courses'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'course_id' => 'nullable|exists:courses,id',
            'title' => 'required|string|max:255',
            'scheduled_at' => 'required|date|after:now',
            'duration_minutes' => 'required|integer|min:15|max:180',
            'meeting_link' => 'nullable|url',
            'notes' => 'nullable|string',
        ]);

        $user = User::findOrFail($validated['user_id']);
        if ($user->tier !== 'sangar') {
            return back()->with('error', 'Private sessions are only available for Sangar tier users');
        }

        if (isset($validated['course_id'])) {
            $course = Course::findOrFail($validated['course_id']);
            if ($course->pengajar_id !== auth()->id()) {
                return back()->with('error', 'You can only schedule sessions for your own courses');
            }
        }

        $validated['pengajar_id'] = auth()->id();
        $validated['status'] = 'scheduled';

        PrivateSession::create($validated);

        return redirect()->route('pengajar.private-sessions.index')
            ->with('success', 'Private session scheduled successfully');
    }

    public function edit(PrivateSession $privateSession)
    {
        if ($privateSession->pengajar_id !== auth()->id()) {
            abort(403, 'Unauthorized');
        }

        $sangarUsers = User::peserta()
            ->byTier('sangar')
            ->active()
            ->get();

        $courses = auth()->user()->taughtCourses()->active()->get();

        return view('pengajar.private-sessions.edit', compact('privateSession', 'sangarUsers', 'courses'));
    }

    public function update(Request $request, PrivateSession $privateSession)
    {
        if ($privateSession->pengajar_id !== auth()->id()) {
            abort(403, 'Unauthorized');
        }

        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'course_id' => 'nullable|exists:courses,id',
            'title' => 'required|string|max:255',
            'scheduled_at' => 'required|date',
            'duration_minutes' => 'required|integer|min:15|max:180',
            'meeting_link' => 'nullable|url',
            'notes' => 'nullable|string',
            'status' => 'required|in:scheduled,completed,cancelled',
        ]);

        $user = User::findOrFail($validated['user_id']);
        if ($user->tier !== 'sangar') {
            return back()->with('error', 'Private sessions are only available for Sangar tier users');
        }

        if (isset($validated['course_id'])) {
            $course = Course::findOrFail($validated['course_id']);
            if ($course->pengajar_id !== auth()->id()) {
                return back()->with('error', 'You can only schedule sessions for your own courses');
            }
        }

        $privateSession->update($validated);

        return redirect()->route('pengajar.private-sessions.index')
            ->with('success', 'Private session updated successfully');
    }

    public function destroy(PrivateSession $privateSession)
    {
        if ($privateSession->pengajar_id !== auth()->id()) {
            abort(403, 'Unauthorized');
        }

        $privateSession->delete();

        return redirect()->route('pengajar.private-sessions.index')
            ->with('success', 'Private session deleted successfully');
    }

    public function complete(PrivateSession $privateSession)
    {
        if ($privateSession->pengajar_id !== auth()->id()) {
            abort(403, 'Unauthorized');
        }

        $privateSession->update(['status' => 'completed']);

        return back()->with('success', 'Session marked as completed');
    }
}
