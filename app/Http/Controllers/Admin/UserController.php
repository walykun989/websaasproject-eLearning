<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::query();

        if ($request->filled('role')) {
            $query->where('role', $request->role);
        }

        if ($request->filled('tier')) {
            $query->where('tier', $request->tier);
        }

        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('email', 'like', '%' . $request->search . '%');
            });
        }

        $users = $query->latest()->paginate(20);

        return view('admin.users.index', compact('users'));
    }

    public function show(User $user)
    {
        $user->load(['orders', 'reviews', 'certificates']);

        $stats = [
            'total_orders' => $user->orders()->count(),
            'total_spent' => $user->orders()->accepted()->sum('amount'),
            'courses_reviewed' => $user->reviews()->count(),
            'certificates_earned' => $user->certificates()->count(),
        ];

        if ($user->role === 'pengajar') {
            $stats['courses_taught'] = $user->taughtCourses()->count();
            $stats['total_materials'] = $user->taughtCourses()->withCount('materials')->get()->sum('materials_count');
        }

        return view('admin.users.show', compact('user', 'stats'));
    }

    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'role' => 'required|in:admin,pengajar,peserta',
            'tier' => 'required|in:free,apik,sangar',
            'is_active' => 'boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');

        $user->update($validated);

        return redirect()->route('admin.users.index')
            ->with('success', 'User updated successfully');
    }

    public function toggleStatus($id)
    {
        $user = User::findOrFail($id);
        $user->update(['is_active' => !$user->is_active]);

        return back()->with('success', 'User status updated');
    }
}
