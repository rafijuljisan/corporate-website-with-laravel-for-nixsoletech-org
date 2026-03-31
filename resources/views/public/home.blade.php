@extends('layouts.public')

@push('styles')
<style>
/* ── CSS Variables ───────────────────────────────────────── */
:root {
    --hs-red:    #C8102E;
    --hs-white:  #ffffff;
    --hs-height: min(90vh, 680px);
}

/* ══════════════════════════════════════════════════════════
   HERO SLIDER
══════════════════════════════════════════════════════════ */
.hero-slider {
    position: relative;
    width: 100%;
    height: var(--hs-height);
    overflow: hidden;
    background: #0a0a0a;
    user-select: none;
}

.hs-track { position: relative; width: 100%; height: 100%; }

.hs-slide {
    position: absolute;
    inset: 0;
    opacity: 0;
    pointer-events: none;
    transition: opacity 0.9s cubic-bezier(.4,0,.2,1);
}
.hs-slide.hs-active {
    opacity: 1;
    pointer-events: auto;
}

/* Background Ken Burns */
.hs-bg {
    position: absolute;
    inset: 0;
    background-size: cover;
    background-position: center;
    transform: scale(1.06);
    transition: transform 7s ease-out;
}
.hs-slide.hs-active .hs-bg { transform: scale(1); }

/* Overlay */
.hs-overlay { position: absolute; inset: 0; }

/* Content */
.hs-content {
    position: absolute;
    inset: 0;
    display: flex;
    flex-direction: column;
    justify-content: center;
    max-width: 100%;
    padding: 0 calc((100% - 1380px) / 2 + 2rem);  /* matches nav-inner max-width + padding */
}

/* Staggered entrance animations */
.hs-slide.hs-active .hs-badge,
.hs-slide.hs-active .hs-eyebrow,
.hs-slide.hs-active .hs-title,
.hs-slide.hs-active .hs-description,
.hs-slide.hs-active .hs-actions {
    animation: hsFadeUp 0.7s ease both;
}
.hs-slide.hs-active .hs-badge      { animation-delay: 0.05s; }
.hs-slide.hs-active .hs-eyebrow    { animation-delay: 0.15s; }
.hs-slide.hs-active .hs-title      { animation-delay: 0.25s; }
.hs-slide.hs-active .hs-description{ animation-delay: 0.36s; }
.hs-slide.hs-active .hs-actions    { animation-delay: 0.46s; }

@keyframes hsFadeUp {
    from { opacity: 0; transform: translateY(28px); }
    to   { opacity: 1; transform: translateY(0); }
}

/* Badge */
.hs-badge {
    display: inline-flex;
    align-items: center;
    gap: 7px;
    background: rgba(255,255,255,0.12);
    border: 1px solid rgba(255,255,255,0.25);
    backdrop-filter: blur(8px);
    color: #fff;
    font-size: 0.7rem;
    font-weight: 600;
    letter-spacing: 0.12em;
    text-transform: uppercase;
    padding: 5px 14px;
    border-radius: 100px;
    margin-bottom: 16px;
    width: fit-content;
}
.hs-badge-dot {
    width: 6px; height: 6px;
    background: var(--hs-red);
    border-radius: 50%;
    animation: pulse 1.6s infinite;
}
@keyframes pulse {
    0%,100% { transform:scale(1); opacity:1; }
    50%      { transform:scale(1.7); opacity:.4; }
}

/* Eyebrow */
.hs-eyebrow {
    font-size: 0.78rem;
    font-weight: 500;
    letter-spacing: 0.14em;
    text-transform: uppercase;
    color: rgba(255,255,255,0.6);
    margin-bottom: 10px;
}

/* Title */
.hs-title {
    font-size: clamp(2.8rem, 7vw, 5.5rem);
    font-weight: 700;
    line-height: 1.1;
    color: #fff;
    margin-bottom: 18px;
}

/* Description */
.hs-description {
    font-size: clamp(0.88rem, 1.4vw, 1rem);
    line-height: 1.8;
    color: rgba(255,255,255,0.7);
    margin-bottom: 32px;
    max-width: 520px;
}

/* CTA buttons */
.hs-actions { display: flex; flex-wrap: wrap; gap: 14px; }

.hs-btn {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 13px 28px;
    font-size: 0.84rem;
    font-weight: 600;
    letter-spacing: 0.04em;
    border-radius: 6px;
    text-decoration: none;
    transition: all 0.22s;
}
.hs-btn-primary {
    background: var(--hs-red);
    color: #fff;
    border: 2px solid var(--hs-red);
}
.hs-btn-primary:hover {
    background: #a00d25;
    border-color: #a00d25;
    color: #fff;
    transform: translateY(-2px);
    box-shadow: 0 8px 24px rgba(200,16,46,.4);
}
.hs-btn-ghost {
    background: transparent;
    color: #fff;
    border: 2px solid rgba(255,255,255,0.4);
}
.hs-btn-ghost:hover {
    background: rgba(255,255,255,0.1);
    border-color: rgba(255,255,255,0.8);
    color: #fff;
    transform: translateY(-2px);
}

/* Arrows */
.hs-arrow {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    z-index: 20;
    width: 48px; height: 48px;
    background: rgba(255,255,255,0.1);
    border: 1px solid rgba(255,255,255,0.2);
    backdrop-filter: blur(8px);
    color: #fff;
    border-radius: 50%;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: background 0.2s, transform 0.2s;
}
.hs-arrow:hover {
    background: var(--hs-red);
    border-color: var(--hs-red);
    transform: translateY(-50%) scale(1.1);
}
.hs-prev { left: clamp(1rem, 3vw, 2.5rem); }
.hs-next { right: clamp(1rem, 3vw, 2.5rem); }

/* Dot indicators */
.hs-dots {
    position: absolute;
    bottom: 28px;
    left: 50%;
    transform: translateX(-50%);
    z-index: 20;
    display: flex;
    gap: 8px;
}
.hs-dot {
    width: 8px; height: 8px;
    background: rgba(255,255,255,0.35);
    border: none;
    border-radius: 50%;
    cursor: pointer;
    transition: all 0.3s;
    padding: 0;
}
.hs-dot.hs-dot-active {
    background: #fff;
    width: 28px;
    border-radius: 4px;
}

/* Progress bar */
.hs-progress {
    position: absolute;
    bottom: 0; left: 0; right: 0;
    height: 3px;
    background: rgba(255,255,255,0.15);
    z-index: 20;
}
.hs-progress-bar {
    height: 100%;
    background: var(--hs-red);
    width: 0%;
    transition: width linear;
}

/* Slide counter */
.hs-counter {
    position: absolute;
    bottom: 40px;
    right: clamp(1rem, 3vw, 2.5rem);
    z-index: 20;
    display: flex;
    align-items: center;
    gap: 10px;
    font-size: 0.78rem;
    font-weight: 600;
    color: rgba(255,255,255,0.55);
    letter-spacing: 0.05em;
}
#hsCurrent { color: #fff; font-size: 1rem; }
.hs-counter-sep { width: 24px; height: 1px; background: rgba(255,255,255,0.4); }

/* Fallback jumbotron (shown when no slides exist) */
.hero-fallback {
    background: linear-gradient(135deg, #f8f8f6 0%, #fff 100%);
    padding: 90px 0;
    text-align: center;
    border-bottom: 1px solid #eaeaea;
}
.hero-fallback h1 {
    font-family: 'Cormorant Garamond', 'Georgia', serif;
    font-size: clamp(2rem, 5vw, 3.4rem);
    font-weight: 700;
    color: #111;
    margin-bottom: 16px;
}
.hero-fallback p {
    font-size: 1.05rem;
    color: #666;
    max-width: 560px;
    margin: 0 auto;
    line-height: 1.75;
}

/* ══════════════════════════════════════════════════════════
   SERVICES SECTION
══════════════════════════════════════════════════════════ */
.services-section { padding: 80px 0; }

.services-eyebrow {
    display: block;
    font-size: 0.72rem;
    font-weight: 600;
    letter-spacing: 0.14em;
    text-transform: uppercase;
    color: var(--hs-red);
    margin-bottom: 10px;
}
.services-heading {
    font-size: clamp(1.8rem, 4vw, 2.6rem);
    font-weight: 700;
    color: #111;
    margin-bottom: 0;
}
.services-rule {
    width: 48px; height: 3px;
    background: var(--hs-red);
    border-radius: 2px;
    margin: 16px auto 0;
}

.svc-card {
    background: #fff;
    border: 1px solid #eaeaea;
    border-radius: 14px;
    padding: 32px 28px;
    height: 100%;
    display: flex;
    flex-direction: column;
    transition: box-shadow 0.25s, transform 0.25s, border-color 0.25s;
}
.svc-card:hover {
    box-shadow: 0 16px 40px rgba(0,0,0,0.08);
    transform: translateY(-4px);
    border-color: var(--hs-red);
}
.svc-icon-wrap {
    width: 52px; height: 52px;
    background: #fef0f2;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--hs-red);
    font-size: 1.35rem;
    margin-bottom: 20px;
    transition: background 0.2s, color 0.2s;
}
.svc-card:hover .svc-icon-wrap {
    background: var(--hs-red);
    color: #fff;
}
.svc-title {
    font-size: 1.05rem;
    font-weight: 700;
    color: #111;
    margin-bottom: 10px;
}
.svc-text {
    font-size: 0.88rem;
    color: #666;
    line-height: 1.75;
    flex: 1;
    margin-bottom: 22px;
}
.svc-link {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    font-size: 0.78rem;
    font-weight: 700;
    letter-spacing: 0.06em;
    text-transform: uppercase;
    color: var(--hs-red);
    text-decoration: none;
    transition: gap 0.2s;
}
.svc-link:hover { gap: 10px; color: var(--hs-red); }

/* ── Mobile ──────────────────────────────────────────────── */
@media (max-width: 575px) {
    :root { --hs-height: 88vh; }
    .hs-content { padding: 0 1.25rem; }
    .hs-arrow  { display: none; }
    .hs-counter { display: none; }
}
/* ══════════════════════════════════════════════════════════
   HOME GALLERY SECTION
══════════════════════════════════════════════════════════ */
.home-gal-section { 
    padding: 80px 0; 
    background: #f8f8f6; /* Slight off-white to separate it from the services section */
}

.home-gal-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
    gap: 24px;
    margin-top: 40px;
}

.home-gal-item {
    position: relative;
    border-radius: 12px;
    overflow: hidden;
    aspect-ratio: 4/3;
    background: #111;
    display: block;
}

.home-gal-img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.7s cubic-bezier(0.2, 0.8, 0.2, 1);
}

.home-gal-overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(to top, rgba(0,0,0,0.8) 0%, rgba(0,0,0,0) 60%);
    opacity: 0;
    transition: opacity 0.4s ease;
    display: flex;
    align-items: flex-end;
    padding: 24px;
}

.home-gal-item:hover .home-gal-img { 
    transform: scale(1.08); 
}

.home-gal-item:hover .home-gal-overlay { 
    opacity: 1; 
}

.home-gal-title {
    color: #fff;
    font-family: 'DM Sans', sans-serif;
    font-weight: 600;
    font-size: 1.1rem;
    margin: 0;
    transform: translateY(15px);
    transition: transform 0.4s cubic-bezier(0.2, 0.8, 0.2, 1);
}

.home-gal-item:hover .home-gal-title { 
    transform: translateY(0); 
}

.home-gal-btn-wrap { 
    text-align: center; 
    margin-top: 48px; 
}
/* ══════════════════════════════════════════════════════════
   HOME BLOG SECTION
══════════════════════════════════════════════════════════ */
:root {
    --blog-blue: #C8102E; /* Now it's Brand Red! */
    --blog-yellow: #FBBF24; 
}

.blog-section {
    padding: 80px 0;
    background-color: #f8f9fa; /* Very light gray background */
}

.blog-eyebrow {
    display: inline-block;
    background-color: var(--blog-yellow);
    color: #ffffff;
    font-size: 0.75rem;
    font-weight: 700;
    letter-spacing: 0.1em;
    text-transform: uppercase;
    padding: 6px 16px;
    margin-bottom: 16px;
}

.blog-heading {
    color: var(--blog-blue);
    font-family: 'DM Sans', sans-serif;
    font-weight: 800;
    font-size: clamp(2rem, 4vw, 2.5rem);
    text-transform: uppercase;
    margin-bottom: 48px;
    letter-spacing: 0.02em;
}

.blog-card {
    background: #ffffff;
    border: none;
    border-radius: 0; /* Square corners like the reference */
    box-shadow: 0 4px 15px rgba(0,0,0,0.05);
    height: 100%;
    display: flex;
    flex-direction: column;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.blog-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 12px 25px rgba(0,0,0,0.1);
}

.blog-img-wrap {
    position: relative;
    width: 100%;
    aspect-ratio: 4/3;
    overflow: hidden;
}

.blog-img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.5s ease;
}

.blog-card:hover .blog-img {
    transform: scale(1.05);
}

.blog-date-badge {
    position: absolute;
    top: 0;
    right: 0;
    background-color: var(--blog-blue);
    color: #ffffff;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    padding: 8px 12px;
    min-width: 60px;
}

.blog-date-month {
    font-size: 0.75rem;
    text-transform: uppercase;
    font-weight: 600;
    line-height: 1;
    margin-bottom: 2px;
}

.blog-date-day {
    font-size: 1.4rem;
    font-weight: 800;
    line-height: 1;
}

.blog-card-body {
    padding: 24px;
    flex-grow: 1;
    display: flex;
    flex-direction: column;
}

.blog-card-title {
    font-size: 1.1rem;
    font-weight: 700;
    color: #111318;
    text-transform: uppercase;
    line-height: 1.4;
    margin-bottom: 16px;
    text-decoration: none;
    transition: color 0.2s;
}

.blog-card-title:hover {
    color: var(--blog-blue);
}

.blog-card-meta {
    font-size: 0.85rem;
    color: #6c757d;
    margin-top: auto; /* Pushes meta to the bottom if titles vary in length */
}

.blog-card-meta strong {
    color: #111318;
    font-weight: 600;
}

.blog-btn {
    background-color: var(--blog-blue);
    color: #ffffff;
    font-weight: 700;
    font-size: 0.9rem;
    text-transform: uppercase;
    letter-spacing: 0.05em;
    padding: 14px 32px;
    border: none;
    border-radius: 4px;
    transition: background-color 0.2s, transform 0.2s;
    text-decoration: none;
    display: inline-block;
}

.blog-btn:hover {
    background-color: #A00D25; /* Darker red for hover */
    color: #ffffff;
    transform: translateY(-2px);
}
/* ══════════════════════════════════════════════════════════
   PROCESS & EXPERTISE SECTION
══════════════════════════════════════════════════════════ */
:root {
    --nix-blue: #C8102E;   /* Now it's Brand Red! */
    --nix-yellow: #FCD34D; 
}

.process-section {
    padding: 80px 0 60px;
    background-color: #ffffff;
}

.process-title {
    color: var(--nix-blue);
    font-weight: 800;
    font-size: 2.2rem;
    text-transform: uppercase;
    letter-spacing: 0.02em;
    margin-bottom: 12px;
}

.process-subtitle {
    color: #333333;
    font-weight: 700;
    font-size: 1.15rem;
    line-height: 1.5;
    margin-bottom: 20px;
}

.process-text {
    color: #6c757d;
    font-size: 0.95rem;
    line-height: 1.7;
    margin-bottom: 30px;
}

.process-btn {
    background-color: var(--nix-blue);
    color: #ffffff;
    font-weight: 700;
    font-size: 0.85rem;
    text-transform: uppercase;
    padding: 12px 28px;
    border: none;
    border-radius: 4px;
    transition: background-color 0.2s, transform 0.2s;
    text-decoration: none;
    display: inline-block;
}

.process-btn:hover {
    background-color: #A00D25; /* Darker red for hover */
    color: #ffffff;
    transform: translateY(-2px);
}

/* Custom Progress Bars */
.custom-progress-wrap {
    margin-bottom: 30px;
}

.custom-progress-label {
    display: flex;
    justify-content: space-between;
    font-size: 0.8rem;
    font-weight: 600;
    color: #6c757d;
    text-transform: uppercase;
    margin-bottom: 8px;
}

.custom-progress-label .pct {
    color: var(--nix-blue);
}

.custom-progress-track {
    width: 100%;
    height: 6px;
    background-color: #f1f3f5;
    border-radius: 4px;
    position: relative;
}

.custom-progress-fill {
    height: 100%;
    background-color: var(--nix-yellow);
    border-radius: 4px;
    position: relative;
}

.custom-progress-thumb {
    position: absolute;
    right: -7px;
    top: 50%;
    transform: translateY(-50%);
    width: 16px;
    height: 16px;
    background-color: var(--nix-yellow);
    border-radius: 50%;
    border: 2px solid #ffffff;
    box-shadow: 0 1px 3px rgba(0,0,0,0.1);
}

/* ══════════════════════════════════════════════════════════
   STATISTICS COUNTER SECTION
══════════════════════════════════════════════════════════ */
/* ══════════════════════════════════════════════════════════
   STATISTICS COUNTER SECTION (Red Background & White Text)
══════════════════════════════════════════════════════════ */
.stats-section {
    background-color: var(--nix-blue); /* Pulls your brand red variable */
    padding: 60px 0;
    border-top: none; 
    border-bottom: none;
}

.stat-box {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 15px;
    padding: 15px 0;
}

.stat-icon {
    font-size: 2.8rem;
    color: rgba(255, 255, 255, 0.4); /* Faded white for a sleek watermarked look */
    line-height: 1;
}

.stat-content {
    display: flex;
    flex-direction: column;
}

.stat-number {
    color: #ffffff; /* Solid white numbers */
    font-size: 2.2rem;
    font-weight: 800;
    line-height: 1;
    margin-bottom: 4px;
}

.stat-text {
    color: rgba(255, 255, 255, 0.85); /* Slightly softened white for the label */
    font-size: 0.85rem;
    font-weight: 500;
}

/* Vertical dividers for desktop */
@media (min-width: 992px) {
    .stat-col:not(:last-child) .stat-box {
        border-right: 1px solid rgba(255, 255, 255, 0.15); /* Faint white divider lines */
    }
}
</style>
@endpush

@section('content')

{{-- ══════════════════════════════════════════════════════════
     HERO — slider if slides exist, fallback jumbotron if not
══════════════════════════════════════════════════════════ --}}

@if($sliders->isNotEmpty())

<section class="hero-slider" id="heroSlider">
    <div class="hs-track" id="hsTrack">
        @foreach($sliders as $index => $slide)
        <div class="hs-slide {{ $index === 0 ? 'hs-active' : '' }}" data-index="{{ $index }}">

            {{-- Background image --}}
            <div class="hs-bg"
                 style="background-image: url('{{ $slide->image_url }}');"></div>

            {{-- Colour overlay --}}
            <div class="hs-overlay"
                 style="background: {{ $slide->overlay_css }};"></div>

            {{-- Slide content --}}
            <div class="hs-content">

                @if($slide->badge_label)
                <div class="hs-badge">
                    <span class="hs-badge-dot"></span>
                    {{ $slide->badge_label }}
                </div>
                @endif

                @if($slide->subtitle)
                <p class="hs-eyebrow">{{ $slide->subtitle }}</p>
                @endif

                <h1 class="hs-title">{{ $slide->title }}</h1>

                @if($slide->description)
                <p class="hs-description">{{ $slide->description }}</p>
                @endif

                @if($slide->button_text || $slide->button_text_2)
                <div class="hs-actions">
                    @if($slide->button_text)
                    <a href="{{ $slide->button_url ?? '#' }}" class="hs-btn hs-btn-primary">
                        {{ $slide->button_text }}
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                    </a>
                    @endif
                    @if($slide->button_text_2)
                    <a href="{{ $slide->button_url_2 ?? '#' }}" class="hs-btn hs-btn-ghost">
                        {{ $slide->button_text_2 }}
                    </a>
                    @endif
                </div>
                @endif

            </div>
        </div>
        @endforeach
    </div>

    {{-- Only render controls when there's more than one slide --}}
    @if($sliders->count() > 1)

    <button class="hs-arrow hs-prev" id="hsPrev" aria-label="Previous slide">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M15 18l-6-6 6-6"/></svg>
    </button>
    <button class="hs-arrow hs-next" id="hsNext" aria-label="Next slide">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M9 18l6-6-6-6"/></svg>
    </button>

    <div class="hs-dots" id="hsDots">
        @foreach($sliders as $index => $slide)
        <button class="hs-dot {{ $index === 0 ? 'hs-dot-active' : '' }}"
                data-index="{{ $index }}"
                aria-label="Go to slide {{ $index + 1 }}"></button>
        @endforeach
    </div>

    <div class="hs-progress">
        <div class="hs-progress-bar" id="hsProgress"></div>
    </div>

    <div class="hs-counter">
        <span id="hsCurrent">01</span>
        <span class="hs-counter-sep"></span>
        <span>{{ str_pad($sliders->count(), 2, '0', STR_PAD_LEFT) }}</span>
    </div>

    @endif
</section>

@else

{{-- Fallback when no active slides have been added yet --}}
<div class="hero-fallback">
    <div class="container">
        <h1>Welcome to Our Corporate Website</h1>
        <p>We provide industry-leading solutions to help your business grow. Explore our services below and see how we can help you achieve your goals.</p>
    </div>
</div>

@endif
{{-- ══════════════════════════════════════════════════════════
     STATISTICS COUNTER SECTION
══════════════════════════════════════════════════════════ --}}
<section class="stats-section">
    <div class="container-fluid px-lg-5">
        <div class="row g-4 justify-content-center">
            
            {{-- Stat 1 --}}
            <div class="col-sm-6 col-lg-3 stat-col">
                <div class="stat-box">
                    <i class="bi bi-globe stat-icon"></i>
                    <div class="stat-content">
                        <span class="stat-number">40+</span>
                        <span class="stat-text">Countries Served</span>
                    </div>
                </div>
            </div>

            {{-- Stat 2 --}}
            <div class="col-sm-6 col-lg-3 stat-col">
                <div class="stat-box">
                    <i class="bi bi-people stat-icon"></i>
                    <div class="stat-content">
                        <span class="stat-number">500+</span>
                        <span class="stat-text">Dedicated Employees</span>
                    </div>
                </div>
            </div>

            {{-- Stat 3 --}}
            <div class="col-sm-6 col-lg-3 stat-col">
                <div class="stat-box">
                    <i class="bi bi-gear stat-icon"></i>
                    <div class="stat-content">
                        <span class="stat-number">1200+</span>
                        <span class="stat-text">Projects Completed</span>
                    </div>
                </div>
            </div>

            {{-- Stat 4 --}}
            <div class="col-sm-6 col-lg-3 stat-col">
                <div class="stat-box">
                    <i class="bi bi-award stat-icon"></i>
                    <div class="stat-content">
                        <span class="stat-number">35</span>
                        <span class="stat-text">Awards & Recognitions</span>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
{{-- ══════════════════════════════════════════════════════════
     SERVICES SECTION
══════════════════════════════════════════════════════════ --}}
<section class="services-section">
    <div class="container">

        {{-- Section header --}}
        <div class="row mb-5">
            <div class="col-12 text-center">
                <span class="services-eyebrow">What We Offer</span>
                <h2 class="services-heading">Our Services</h2>
                <div class="services-rule mx-auto"></div>
            </div>
        </div>

        {{-- Service cards --}}
        <div class="row g-4">
            @forelse($services as $service)
            <div class="col-md-6 col-lg-4">
                <div class="svc-card">
                    <div class="svc-icon-wrap">
                        @if($service->icon)
                            <i class="{{ $service->icon }}"></i>
                        @else
                            {{-- Generic fallback icon --}}
                            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/>
                            </svg>
                        @endif
                    </div>
                    <h5 class="svc-title">{{ $service->title }}</h5>
                    <p class="svc-text">{{ Str::limit($service->description, 120) }}</p>
                    <a href="#" class="svc-link">
                        Learn More
                        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                    </a>
                </div>
            </div>
            @empty
            <div class="col-12 text-center py-5">
                <p class="text-muted">No services are currently available. Check back soon!</p>
            </div>
            @endforelse
        </div>

    </div>
</section>
{{-- ══════════════════════════════════════════════════════════
     PROCESS & EXPERTISE SECTION
══════════════════════════════════════════════════════════ --}}
<section class="process-section">
    <div class="container">
        <div class="row align-items-center">
            
            {{-- Left Column: Text Content --}}
            <div class="col-lg-5 mb-5 mb-lg-0 pe-lg-5">
                <h2 class="process-title">Our Expertise</h2>
                <h4 class="process-subtitle">
                    Interactively empower diverse corporate imperatives through integrated global solutions.
                </h4>
                <p class="process-text">
                    At Nixsoletech, we dynamically redefine industry standards across Construction, Logistics, Trading, and IT Technology. We progress enabled "outside the box" thinking via scalable quality vectors, objectively unleashing optimal core competencies for our clients worldwide.
                </p>
                <a href="{{ route('about') }}" class="process-btn">Read The Story</a>
            </div>

            {{-- Right Column: Progress Bars --}}
            <div class="col-lg-7 ps-lg-4">
                
                {{-- Progress Item 1 --}}
                <div class="custom-progress-wrap">
                    <div class="custom-progress-label">
                        <span>IT Technology & Solutions</span>
                        <span class="pct">92%</span>
                    </div>
                    <div class="custom-progress-track">
                        <div class="custom-progress-fill" style="width: 92%;">
                            <div class="custom-progress-thumb"></div>
                        </div>
                    </div>
                </div>

                {{-- Progress Item 2 --}}
                <div class="custom-progress-wrap">
                    <div class="custom-progress-label">
                        <span>Global Logistics & Transportation</span>
                        <span class="pct">85%</span>
                    </div>
                    <div class="custom-progress-track">
                        <div class="custom-progress-fill" style="width: 85%;">
                            <div class="custom-progress-thumb"></div>
                        </div>
                    </div>
                </div>

                {{-- Progress Item 3 --}}
                <div class="custom-progress-wrap">
                    <div class="custom-progress-label">
                        <span>Construction & Infrastructure</span>
                        <span class="pct">78%</span>
                    </div>
                    <div class="custom-progress-track">
                        <div class="custom-progress-fill" style="width: 78%;">
                            <div class="custom-progress-thumb"></div>
                        </div>
                    </div>
                </div>

                {{-- Progress Item 4 --}}
                <div class="custom-progress-wrap mb-0">
                    <div class="custom-progress-label">
                        <span>Export-Import & Trading</span>
                        <span class="pct">88%</span>
                    </div>
                    <div class="custom-progress-track">
                        <div class="custom-progress-fill" style="width: 88%;">
                            <div class="custom-progress-thumb"></div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>
{{-- ══════════════════════════════════════════════════════════
     HOME GALLERY SECTION
══════════════════════════════════════════════════════════ --}}
<section class="home-gal-section">
    <div class="container">
        
        {{-- Section header (Reuses your existing services header classes for consistency) --}}
        <div class="row mb-4">
            <div class="col-12 text-center">
                <span class="services-eyebrow">Our Portfolio</span>
                <h2 class="services-heading">Recent Projects</h2>
                <div class="services-rule mx-auto"></div>
            </div>
        </div>

        {{-- Gallery Grid --}}
        <div class="home-gal-grid">
            @forelse($homeGalleries as $gallery)
                <div class="home-gal-item">
                    <img src="{{ asset('storage/' . $gallery->image) }}" alt="{{ $gallery->title }}" class="home-gal-img">
                    @if($gallery->title)
                        <div class="home-gal-overlay">
                            <h6 class="home-gal-title">{{ $gallery->title }}</h6>
                        </div>
                    @endif
                </div>
            @empty
                <div class="col-12 text-center py-4" style="grid-column: 1 / -1;">
                    <p class="text-muted">More project photos coming soon.</p>
                </div>
            @endforelse
        </div>

        {{-- View All Button --}}
        <div class="home-gal-btn-wrap">
            <a href="{{ route('public.gallery') }}" class="hs-btn hs-btn-primary">
                View Full Gallery
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="margin-left: 6px;"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
            </a>
        </div>

    </div>
</section>
{{-- ══════════════════════════════════════════════════════════
     BLOG & MEDIA SECTION
══════════════════════════════════════════════════════════ --}}
<section class="blog-section">
    <div class="container">
        
        {{-- Section Header --}}
        <div class="row">
            <div class="col-12 text-center">
                <span class="blog-eyebrow">News and Media</span>
                <h2 class="blog-heading">Latest From Blog</h2>
            </div>
        </div>

        {{-- Blog Grid --}}
        <div class="row g-4 mb-5">
            
            {{-- Article 1 --}}
            <div class="col-md-6 col-lg-4">
                <div class="blog-card">
                    <div class="blog-img-wrap">
                        {{-- Replace with your actual image path later --}}
                        <img src="https://parametric-architecture.com/wp-content/uploads/2025/12/Smart-Materials-1_00-1600x1106.webp" alt="Smart Bridge Infrastructure" class="blog-img">
                        <div class="blog-date-badge">
                            <span class="blog-date-month">Apr</span>
                            <span class="blog-date-day">02</span>
                        </div>
                    </div>
                    <div class="blog-card-body">
                        <a href="#" class="blog-card-title">Innovations In Smart Materials For Sustainable Infrastructure Projects</a>
                        <div class="blog-card-meta">
                            By <strong>Mark Davis</strong> in Construction
                        </div>
                    </div>
                </div>
            </div>

            {{-- Article 2 --}}
            <div class="col-md-6 col-lg-4">
                <div class="blog-card">
                    <div class="blog-img-wrap">
                        {{-- Replace with your actual image path later --}}
                        <img src="https://d3lkc3n5th01x7.cloudfront.net/wp-content/uploads/2023/04/14003540/The-role-of-AI-in-logistics-and-supply-chain-banner.png" alt="Automated Logistics Warehouse" class="blog-img">
                        <div class="blog-date-badge">
                            <span class="blog-date-month">Mar</span>
                            <span class="blog-date-day">25</span>
                        </div>
                    </div>
                    <div class="blog-card-body">
                        <a href="#" class="blog-card-title">Harnessing Big Data And AI For Next-Generation Logistics Optimization</a>
                        <div class="blog-card-meta">
                            By <strong>Elena Petrova</strong> in Logistics
                        </div>
                    </div>
                </div>
            </div>

            {{-- Article 3 --}}
            <div class="col-md-6 col-lg-4">
                <div class="blog-card">
                    <div class="blog-img-wrap">
                        {{-- Replace with your actual image path later --}}
                        <img src="https://aidoos.com/media/main-image/integrating-iot-for-real-time-monit/Top-IoT-device-examples.png" alt="Industrial Technician with Tablet" class="blog-img">
                        <div class="blog-date-badge">
                            <span class="blog-date-month">Mar</span>
                            <span class="blog-date-day">15</span>
                        </div>
                    </div>
                    <div class="blog-card-body">
                        <a href="#" class="blog-card-title">Enhancing Field Efficiency With Real-Time IoT Data And Remote Monitoring Solutions</a>
                        <div class="blog-card-meta">
                            By <strong>Christopher Lee</strong> in Technology
                        </div>
                    </div>
                </div>
            </div>

        </div>

        {{-- Read More Button --}}
        <div class="row">
            <div class="col-12 text-center">
                <a href="#" class="blog-btn">Read The Blog</a>
            </div>
        </div>

    </div>
</section>
@endsection

@push('scripts')
<script>
(function () {
    const DURATION = 5000; // ms per slide

    const slides   = document.querySelectorAll('.hs-slide');
    const dots     = document.querySelectorAll('.hs-dot');
    const counter  = document.getElementById('hsCurrent');
    const progress = document.getElementById('hsProgress');
    const prevBtn  = document.getElementById('hsPrev');
    const nextBtn  = document.getElementById('hsNext');

    if (!slides.length) return;

    let current = 0;
    let timer   = null;

    const pad = n => String(n + 1).padStart(2, '0');

    function goTo(idx) {
        slides[current].classList.remove('hs-active');
        if (dots[current]) dots[current].classList.remove('hs-dot-active');

        current = (idx + slides.length) % slides.length;

        slides[current].classList.add('hs-active');
        if (dots[current])  dots[current].classList.add('hs-dot-active');
        if (counter)        counter.textContent = pad(current);

        resetProgress();
    }

    const next = () => goTo(current + 1);
    const prev = () => goTo(current - 1);

    /* Progress bar */
    function resetProgress() {
        if (!progress) return;
        progress.style.transition = 'none';
        progress.style.width      = '0%';
        void progress.offsetWidth; // force reflow
        progress.style.transition = `width ${DURATION}ms linear`;
        progress.style.width      = '100%';
    }

    /* Autoplay */
    function startAutoplay() {
        clearInterval(timer);
        timer = setInterval(next, DURATION);
    }

    /* Arrow buttons */
    if (prevBtn) prevBtn.addEventListener('click', () => { prev(); startAutoplay(); });
    if (nextBtn) nextBtn.addEventListener('click', () => { next(); startAutoplay(); });

    /* Dot buttons */
    dots.forEach((dot, i) => {
        dot.addEventListener('click', () => { goTo(i); startAutoplay(); });
    });

    /* Touch / swipe */
    let touchX = 0;
    const slider = document.getElementById('heroSlider');
    if (slider) {
        slider.addEventListener('touchstart', e => { touchX = e.changedTouches[0].screenX; }, { passive: true });
        slider.addEventListener('touchend',   e => {
            const diff = touchX - e.changedTouches[0].screenX;
            if (Math.abs(diff) > 40) { diff > 0 ? next() : prev(); startAutoplay(); }
        }, { passive: true });

        /* Pause on hover */
        slider.addEventListener('mouseenter', () => clearInterval(timer));
        slider.addEventListener('mouseleave', startAutoplay);
    }

    /* Init */
    resetProgress();
    startAutoplay();
})();
</script>
@endpush