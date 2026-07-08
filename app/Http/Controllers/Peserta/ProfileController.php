<?php

namespace App\Http\Controllers\Peserta;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class ProfileController extends Controller
{
    public function edit()
    {
        $user = auth()->user();
        return view('peserta.profile.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $user = auth()->user();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'border_style' => 'nullable|string|in:solid,dashed,dotted,double,space-orbit,space-nebula,space-constellation,nature-vines,nature-floral,nature-sunburst,water-bubbles,water-waves,water-whirlpool',
            'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'remove_photo' => 'nullable|boolean',
            'current_password' => 'nullable|required_with:new_password',
            'new_password' => ['nullable', 'required_with:current_password', 'confirmed', Rules\Password::defaults()],
        ]);

        // Tier-gating: Premium avatar decorations only for Sangar users
        $premiumStyles = ['space-orbit', 'space-nebula', 'space-constellation', 'nature-vines', 'nature-floral', 'nature-sunburst', 'water-bubbles', 'water-waves', 'water-whirlpool'];
        if (in_array($request->border_style, $premiumStyles) && $user->tier !== 'sangar') {
            return back()->withErrors(['border_style' => 'Premium avatar decorations are only available for W.I.B Sangar subscribers. Upgrade to unlock!']);
        }

        // Handle profile photo removal
        if ($request->remove_photo == '1' && $user->profile_photo) {
            \Storage::disk('public')->delete($user->profile_photo);
            $validated['profile_photo'] = null;
        }

        // Handle profile photo upload
        if ($request->hasFile('profile_photo')) {
            // Delete old photo if exists
            if ($user->profile_photo) {
                \Storage::disk('public')->delete($user->profile_photo);
            }

            // Store new photo
            $path = $request->file('profile_photo')->store('profile_photos', 'public');
            $validated['profile_photo'] = $path;
        }

        if ($request->filled('current_password')) {
            if (!Hash::check($request->current_password, $user->password)) {
                return back()->withErrors(['current_password' => 'Current password is incorrect']);
            }
            $validated['password'] = Hash::make($request->new_password);
        }

        $user->update($validated);

        return back()->with('success', 'Profile updated successfully');
    }
}
