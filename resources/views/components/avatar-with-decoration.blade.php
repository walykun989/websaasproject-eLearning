@props(['user', 'size' => 'w-8 h-8', 'showBadge' => false])

@php
$style = $user->border_style;
$hasDecoration = false;
$isSmall = (bool) preg_match('/w-[1-6]/', $size);

if ($style === 'solid') {
    $ring = $isSmall ? 'ring-1' : 'ring-4';
    $styleClasses = "bg-black text-white {$ring} ring-white";
} elseif ($style === 'dashed') {
    $ring = $isSmall ? 'ring-1' : 'ring-4';
    $styleClasses = "bg-black text-white {$ring} ring-white";
    if (!$isSmall) $styleClasses .= ' ring-dashed';
} elseif ($style === 'double') {
    $ring = $isSmall ? 'ring-2' : 'ring-[6px]';
    $styleClasses = "bg-black text-white {$ring} ring-white";
    if (!$isSmall) $styleClasses .= ' ring-double';
} elseif (in_array($style, ['space-orbit','space-nebula','space-constellation','nature-vines','nature-floral','nature-sunburst','water-bubbles','water-waves','water-whirlpool']) && $user->tier === 'sangar') {
    $hasDecoration = true;
    $styleClasses = 'bg-black text-white';
} else {
    $ring = $isSmall ? 'ring-1' : 'ring-2';
    $styleClasses = "bg-black text-white {$ring} ring-white";
}
@endphp

<div class="relative inline-block {{ $size }} flex-shrink-0">
    @if($hasDecoration)
    <div class="absolute pointer-events-none" style="top: -15%; left: -15%; width: 130%; height: 130%; z-index: 0;">
        @if($style === 'space-orbit')
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 120 120" fill="none" class="w-full h-full"><circle cx="60" cy="60" r="52" stroke="#6366f1" stroke-width="1.5" stroke-dasharray="4 4" /><circle cx="10" cy="40" r="6" fill="#8b5cf6" /><circle cx="110" cy="80" r="4" fill="#a78bfa" /><circle cx="70" cy="8" r="3" fill="#e2e8f0" /></svg>
        @elseif($style === 'space-nebula')
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 120 120" fill="none" class="w-full h-full"><defs><linearGradient id="nebula{{ $user->id }}" x1="0%" y1="0%" x2="100%" y2="100%"><stop offset="0%" stop-color="#ec4899" /><stop offset="50%" stop-color="#8b5cf6" /><stop offset="100%" stop-color="#3b82f6" /></linearGradient><filter id="glow{{ $user->id }}" x="-20%" y="-20%" width="140%" height="140%"><feGaussianBlur stdDeviation="3" result="blur" /><feComposite in="SourceGraphic" in2="blur" operator="over" /></filter></defs><circle cx="60" cy="60" r="53" stroke="url(#nebula{{ $user->id }})" stroke-width="4" filter="url(#glow{{ $user->id }})" /></svg>
        @elseif($style === 'space-constellation')
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 120 120" fill="none" class="w-full h-full"><circle cx="60" cy="60" r="50" stroke="#1e293b" stroke-width="2" /><polyline points="20,20 40,10 70,15 100,30" stroke="#fde047" stroke-width="1.5" fill="none" /><circle cx="20" cy="20" r="2.5" fill="#fef08a" /><circle cx="40" cy="10" r="2" fill="#fef08a" /><circle cx="70" cy="15" r="3" fill="#fef08a" /><circle cx="100" cy="30" r="2" fill="#fef08a" /></svg>
        @elseif($style === 'nature-vines')
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 120 120" fill="none" class="w-full h-full"><circle cx="60" cy="60" r="51" stroke="#22c55e" stroke-width="3" /><path d="M 12 50 Q 0 40 10 30" stroke="#16a34a" stroke-width="2" fill="none" stroke-linecap="round" /><path d="M 108 70 Q 120 80 110 90" stroke="#16a34a" stroke-width="2" fill="none" stroke-linecap="round" /><ellipse cx="10" cy="30" rx="4" ry="7" transform="rotate(45 10 30)" fill="#4ade80" /><ellipse cx="110" cy="90" rx="4" ry="7" transform="rotate(45 110 90)" fill="#4ade80" /></svg>
        @elseif($style === 'nature-floral')
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 120 120" fill="none" class="w-full h-full"><circle cx="60" cy="60" r="50" stroke="#fbcfe8" stroke-width="2" /><circle cx="20" cy="20" r="8" fill="#f472b6" /><circle cx="15" cy="28" r="6" fill="#f9a8d4" /><circle cx="28" cy="15" r="6" fill="#f9a8d4" /><circle cx="100" cy="100" r="8" fill="#f472b6" /><circle cx="92" cy="105" r="6" fill="#f9a8d4" /><circle cx="105" cy="92" r="6" fill="#f9a8d4" /></svg>
        @elseif($style === 'nature-sunburst')
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 120 120" fill="none" class="w-full h-full"><circle cx="60" cy="60" r="48" stroke="#fbbf24" stroke-width="2" /><path d="M 60 5 L 60 12" stroke="#fbbf24" stroke-width="3" stroke-linecap="round" /><path d="M 60 115 L 60 108" stroke="#fbbf24" stroke-width="3" stroke-linecap="round" /><path d="M 5 60 L 12 60" stroke="#fbbf24" stroke-width="3" stroke-linecap="round" /><path d="M 115 60 L 108 60" stroke="#fbbf24" stroke-width="3" stroke-linecap="round" /><path d="M 20 20 L 26 26" stroke="#fbbf24" stroke-width="3" stroke-linecap="round" /><path d="M 100 100 L 94 94" stroke="#fbbf24" stroke-width="3" stroke-linecap="round" /></svg>
        @elseif($style === 'water-bubbles')
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 120 120" fill="none" class="w-full h-full"><circle cx="60" cy="60" r="50" stroke="#38bdf8" stroke-width="1.5" /><circle cx="15" cy="80" r="10" fill="#7dd3fc" fill-opacity="0.8" /><circle cx="8" cy="95" r="5" fill="#bae6fd" /><circle cx="28" cy="90" r="7" fill="#38bdf8" fill-opacity="0.6" /><circle cx="105" cy="30" r="8" fill="#7dd3fc" fill-opacity="0.8" /><circle cx="112" cy="18" r="4" fill="#bae6fd" /></svg>
        @elseif($style === 'water-waves')
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 120 120" fill="none" class="w-full h-full"><path d="M 10 60 C 10 20, 50 10, 80 15 C 110 20, 110 80, 80 105 C 50 130, 10 100, 10 60 Z" stroke="#0ea5e9" stroke-width="3" fill="none" /><path d="M 15 60 C 15 25, 50 18, 75 22 C 100 25, 105 75, 75 95 C 50 115, 15 90, 15 60 Z" stroke="#0284c7" stroke-width="1.5" fill="none" /></svg>
        @elseif($style === 'water-whirlpool')
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 120 120" fill="none" class="w-full h-full"><path d="M 60 10 A 50 50 0 0 1 110 60" stroke="#0284c7" stroke-width="4" stroke-linecap="round" fill="none" /><path d="M 110 60 A 50 50 0 0 1 60 110" stroke="#0ea5e9" stroke-width="2" stroke-linecap="round" fill="none" /><path d="M 60 110 A 50 50 0 0 1 10 60" stroke="#38bdf8" stroke-width="4" stroke-linecap="round" fill="none" /><path d="M 10 60 A 50 50 0 0 1 60 10" stroke="#7dd3fc" stroke-width="2" stroke-linecap="round" fill="none" /></svg>
        @endif
    </div>
    @endif

    <div class="relative w-full h-full flex items-center justify-center text-sm font-light rounded-full overflow-hidden {{ $styleClasses }}" style="z-index: 1;">
        @if($user->profile_photo)
        <img src="{{ asset('storage/' . $user->profile_photo) }}" alt="{{ $user->name }}" class="w-full h-full object-cover rounded-full">
        @else
        {{ strtoupper(substr($user->name, 0, 1)) }}
        @endif
    </div>

    @if($showBadge && $user->tier === 'sangar')
    <div class="absolute -bottom-1 -right-1 w-4 h-4 bg-gradient-to-br from-yellow-400 to-orange-500 rounded-full flex items-center justify-center shadow" style="z-index: 2;">
        <svg class="w-2.5 h-2.5 text-white" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
    </div>
    @endif
</div>
