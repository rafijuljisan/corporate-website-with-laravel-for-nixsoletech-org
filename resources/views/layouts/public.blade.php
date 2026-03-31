<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Corporate Website</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;600;700&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.min.css">

    <style>
        :root {
            --red:       #C8102E;
            --red-dark:  #A00D25;
            --red-light: #F9E5E9;
            --ink:       #111318;
            --mid:       #4A4D55;
            --muted:     #9098A9;
            --border:    #E8EAED;
            --bg:        #F8F8F6;
            --white:     #FFFFFF;
        }
        

        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'DM Sans', sans-serif;
            background: var(--white);
            color: var(--ink);
            -webkit-font-smoothing: antialiased;
        }

/* ── TOP BAR ── */
        .top-bar {
            background: var(--red); /* Brand Red Background */
            color: var(--white);
            font-size: 0.85rem;
            padding: 10px 0;
            font-weight: 500;
        }
        
        .top-bar a { 
            color: var(--white); 
            text-decoration: none; 
            transition: opacity 0.2s ease;
        }

        .top-bar a:hover {
            opacity: 0.8;
        }

        .top-bar-divider {
            width: 1px;
            height: 14px;
            background-color: rgba(255, 255, 255, 0.4);
            margin: 0 15px;
        }

        /* The social icons */
        .top-bar-social a {
            color: var(--white);
            font-size: 0.9rem;
            text-decoration: none;
            transition: transform 0.2s ease;
            display: inline-block;
        }
        
        .top-bar-social a:hover {
            transform: translateY(-2px);
        }

        /* ── NAVBAR ── */
        .site-nav {
            position: sticky;
            top: 0;
            z-index: 1000;
            background: var(--white);
            border-bottom: 1px solid var(--border);
            padding: 0;
            transition: box-shadow 0.3s;
        }
        .site-nav.scrolled { box-shadow: 0 4px 24px rgba(0,0,0,0.07); }

        .nav-inner {
            display: flex;
            align-items: center;
            justify-content: space-between;
            height: 90px; /* Made slightly taller for the new layout */
            padding: 0 2rem;
            max-width: 1380px;
            margin: 0 auto;
        }

        /* Brand */
        .brand {
            display: flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
        }
        .brand-icon {
            width: 38px;
            height: 38px;
            background: var(--red);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .brand-icon svg { width: 22px; height: 22px; fill: white; }
        .brand-name {
            font-family: 'Cormorant Garamond', serif;
            font-size: 1.35rem;
            font-weight: 700;
            color: var(--ink);
            letter-spacing: 0.04em;
            text-transform: uppercase;
        }

        /* Nav links */
        .nav-links {
            display: flex;
            align-items: center;
            gap: 0;
            list-style: none;
        }
        .nav-links > li > a,
        .nav-links > li > .nav-drop-toggle {
            display: flex;
            align-items: center;
            gap: 4px;
            padding: 0 18px;
            height: 72px;
            font-size: 0.82rem;
            font-weight: 500;
            letter-spacing: 0.05em;
            text-transform: uppercase;
            color: var(--mid);
            text-decoration: none;
            border-bottom: 2px solid transparent;
            transition: color 0.2s, border-color 0.2s;
            background: none;
            border-top: none;
            border-left: none;
            border-right: none;
            cursor: pointer;
            white-space: nowrap;
        }
        .nav-links > li > a:hover,
        .nav-links > li > .nav-drop-toggle:hover {
            color: var(--ink);
        }
        .nav-links > li > a.active,
        .nav-links > li > a.active:hover {
            color: var(--red);
            border-bottom-color: var(--red);
        }

        /* Dropdown */
        .nav-drop { position: relative; }
        .dropdown-menu-custom {
            display: none;
            position: absolute;
            top: calc(100% + 0px);
            left: 0;
            min-width: 240px;
            background: var(--white);
            border: 1px solid var(--border);
            border-top: 3px solid var(--red);
            border-radius: 0 0 10px 10px;
            box-shadow: 0 16px 40px rgba(0,0,0,0.1);
            padding: 8px 0;
            z-index: 200;
        }
        .nav-drop:hover .dropdown-menu-custom { display: block; }
        .dropdown-menu-custom a {
            display: block;
            padding: 11px 22px;
            font-size: 0.82rem;
            color: var(--mid);
            text-decoration: none;
            letter-spacing: 0.02em;
            transition: background 0.15s, color 0.15s, padding 0.15s;
        }
        .dropdown-menu-custom a:hover {
            background: var(--red-light);
            color: var(--red);
            padding-left: 28px;
        }
/* ── NEW NAVBAR CTA (Right Side) ── */
        .nav-contact-cta {
            display: flex;
            align-items: center;
            gap: 15px;
        }
        
        .nav-contact-icon {
            font-size: 2.2rem;
            color: var(--red);
            line-height: 1;
        }
        
        .nav-contact-text {
            display: flex;
            flex-direction: column;
        }
        
        .nav-contact-label {
            font-size: 0.8rem;
            color: var(--muted);
            font-weight: 600;
            margin-bottom: -2px;
        }
        
        .nav-contact-value {
            font-size: 1.15rem;
            color: var(--ink); /* Brand Black */
            font-weight: 800;
            text-decoration: none;
            transition: color 0.2s ease;
        }
        
        .nav-contact-value:hover {
            color: var(--red);
        }
        /* CTA button */
        .nav-cta {
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .btn-nav-cta {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            background: var(--red);
            color: white !important;
            font-size: 0.78rem;
            font-weight: 600;
            letter-spacing: 0.06em;
            text-transform: uppercase;
            padding: 10px 22px;
            border-radius: 6px;
            text-decoration: none;
            border: 2px solid var(--red);
            transition: background 0.2s, transform 0.15s;
        }
        .btn-nav-cta:hover {
            background: var(--red-dark);
            border-color: var(--red-dark);
            transform: translateY(-1px);
        }

        /* Mobile toggle */
        .nav-toggle {
            display: none;
            background: none;
            border: 1.5px solid var(--border);
            border-radius: 6px;
            padding: 7px 10px;
            color: var(--ink);
            cursor: pointer;
            font-size: 1.1rem;
        }

        /* ── MAIN CONTENT ── */
        .site-main {
            min-height: 70vh;
        }
/* ── MOBILE MENU ── */
.mobile-menu {
    background: var(--white);
    border-top: 1px solid var(--border);
    padding: 12px 0;
    box-shadow: 0 8px 24px rgba(0,0,0,0.08);
}

.mobile-menu a {
    display: block;
    padding: 12px 2rem;
    font-size: 0.9rem;
    font-weight: 500;
    color: var(--mid);
    text-decoration: none;
    text-transform: uppercase;
    letter-spacing: 0.05em;
    border-left: 3px solid transparent;
    transition: all 0.2s ease;
}

.mobile-menu a:hover,
.mobile-menu a.active {
    color: var(--red);
    background: var(--red-light);
    border-left-color: var(--red);
}

/* Show toggle on mobile */
@media (max-width: 991px) {
    .nav-toggle { display: flex; }
    .nav-contact-cta { display: none !important; }
}
@media (max-width: 991px) {
    .nav-inner {
        height: 70px;
        padding: 0 1rem;
    }
}
/* ═══════════════════════════════════════════════════
   FOOTER — TOP CONTACT BAR  (overlaps footer, centered)
═══════════════════════════════════════════════════ */
.footer-contact-bar {
    background: transparent;
    position: relative;
    z-index: 2;
    padding: 0 2rem;
    margin-bottom: -50px; /* pulls it DOWN so it overlaps the dark footer */
}

.contact-bar-inner {
    max-width: 1380px;
    margin: 0 auto;
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 0;
    border-radius: 4px;
    overflow: hidden;
    box-shadow: 0 8px 32px rgba(200, 16, 46, 0.30);
}

.contact-bar-box {
    display: flex;
    align-items: center;           /* vertically center icon + text */
    justify-content: center;       /* horizontally center the whole group */
    gap: 16px;
    padding: 30px 32px;
    background: var(--red);
    border-right: 1px solid rgba(255, 255, 255, 0.15);
    text-align: left;
    transition: background 0.25s ease;
}
.contact-bar-box:last-child {
    border-right: none;
}
.contact-bar-box:hover {
    background: var(--red-dark);
}

/* Bare white icon — no background box */
.cbar-icon {
    color: #ffffff;
    font-size: 1.5rem;
    flex-shrink: 0;
    background: none;
    border: none;
    width: auto;
    height: auto;
    border-radius: 0;
    display: flex;
    align-items: center;
    justify-content: center;
}

.cbar-text strong {
    display: block;
    font-size: 0.9rem;
    font-weight: 800;
    letter-spacing: 0.1em;
    text-transform: uppercase;
    color: #ffffff;
    margin-bottom: 6px;
}
.cbar-text span,
.cbar-text a {
    color: rgba(255, 255, 255, 0.88);
    font-size: 0.88rem;
    font-weight: 400;
    text-decoration: none;
    line-height: 1.65;
    display: block;
    transition: color 0.2s;
}
.cbar-text a:hover {
    color: #ffffff;
    text-decoration: underline;
}

/* Footer must add top padding equal to overlap + breathing room */
.site-footer {
    padding-top: 90px;
}

/* ── Responsive ── */
@media (max-width: 991px) {
    .footer-contact-bar { margin-bottom: -40px; }
    .site-footer { padding-top: 80px; }
}

@media (max-width: 767px) {
    .footer-contact-bar {
        padding: 0 1rem;
        margin-bottom: 0;
    }
    .site-footer { padding-top: 40px; }
    .contact-bar-inner { grid-template-columns: 1fr; }
    .contact-bar-box {
        border-right: none;
        border-bottom: 1px solid rgba(255, 255, 255, 0.15);
    }
    .contact-bar-box:last-child { border-bottom: none; }
}

/* ═══════════════════════════════════════════════════
   FOOTER — MAIN BODY
═══════════════════════════════════════════════════ */
.site-footer {
    background-color: #111318;
    color: #a0a6b5;
    padding: 70px 0 0;
    font-family: 'DM Sans', sans-serif;
}

.footer-inner {
    max-width: 1380px;
    margin: 0 auto;
    padding: 0 2rem;
}

.footer-grid {
    display: grid;
    grid-template-columns: 1.7fr 1fr 1fr 1.4fr;
    gap: 50px;
    padding-bottom: 60px;
}


/* ── Column 1: Brand ── */
.footer-brand-link {
    display: inline-flex;
    align-items: center;
    text-decoration: none;
    margin-bottom: 1rem;
}

.footer-brand-icon {
    width: 40px;
    height: 40px;
    background: var(--red);
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 12px;
    flex-shrink: 0;
}

.footer-brand-name {
    color: #ffffff;
    font-size: 1.5rem;
    font-weight: 800;
    letter-spacing: 0.5px;
}

.footer-tagline {
    font-size: 0.93rem;
    line-height: 1.85;
    color: #a0a6b5;
    margin: 16px 0 20px;
}

.footer-map-wrap {
    border-radius: 10px;
    overflow: hidden;
    height: 185px;
    border: 1px solid rgba(200, 16, 46, 0.20);
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.35);
}
.footer-map-wrap iframe { display: block; }


/* ── Column Headings ── */
.footer-heading {
    font-size: 1.1rem;
    font-weight: 700;
    color: #ffffff;
    text-transform: uppercase;
    letter-spacing: 0.8px;
    padding-bottom: 14px;
    margin-bottom: 22px;
    border-bottom: 1px solid rgba(255, 255, 255, 0.07);
    position: relative;
}
.footer-heading::after {
    content: '';
    position: absolute;
    bottom: -1px; left: 0;
    width: 36px;
    height: 2px;
    background: var(--red);
}


/* ── Footer Links ── */
.footer-links {
    list-style: none;
    padding: 0;
    margin: 0;
}
.footer-links li { margin-bottom: 11px; }
.footer-links a {
    color: #a0a6b5;
    text-decoration: none;
    font-size: 0.93rem;
    display: inline-flex;
    align-items: center;
    transition: color 0.25s ease;
}
.footer-links a i {
    color: var(--red);
    font-size: 0.7rem;
    margin-right: 10px;
    transition: transform 0.25s ease;
}
.footer-links a:hover { color: var(--red); }
.footer-links a:hover i { transform: translateX(5px); }


/* ── Column 4: Contact Items ── */
.footer-contact-item {
    display: flex;
    align-items: flex-start;
    margin-bottom: 20px;
}

.footer-contact-icon {
    width: 42px;
    height: 42px;
    background: rgba(200, 16, 46, 0.10);
    border: 1px solid rgba(200, 16, 46, 0.20);
    color: var(--red);
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.1rem;
    margin-right: 14px;
    flex-shrink: 0;
}

.footer-contact-text strong {
    display: block;
    color: #ffffff;
    font-size: 0.78rem;
    text-transform: uppercase;
    letter-spacing: 0.6px;
    font-weight: 700;
    margin-bottom: 4px;
}
.footer-contact-text span,
.footer-contact-text a {
    color: #a0a6b5;
    font-size: 0.92rem;
    text-decoration: none;
    line-height: 1.55;
    display: block;
    transition: color 0.2s;
}
.footer-contact-text a:hover { color: var(--red); }


/* ── Social Links ── */
.social-links {
    display: flex;
    gap: 9px;
    margin-top: 12px;
    flex-wrap: wrap;
}

.social-link {
    width: 38px;
    height: 38px;
    background: #1a1d24;
    border: 1px solid rgba(255, 255, 255, 0.08);
    color: #ffffff;
    border-radius: 7px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1rem;
    text-decoration: none;
    transition: background 0.3s ease, border-color 0.3s ease, transform 0.3s ease, box-shadow 0.3s ease;
}
.social-link:hover {
    background: var(--red);
    border-color: var(--red);
    color: #ffffff;
    transform: translateY(-3px);
    box-shadow: 0 8px 20px rgba(200, 16, 46, 0.35);
}


/* ═══════════════════════════════════════════════════
   FOOTER — BOTTOM BAR
═══════════════════════════════════════════════════ */
.footer-bottom-wrapper {
    background: #0a0b0e;
    padding: 22px 0;
    border-top: 1px solid rgba(255, 255, 255, 0.05);
}

.footer-bottom {
    max-width: 1380px;
    margin: 0 auto;
    padding: 0 2rem;
    display: flex;
    align-items: center;
    justify-content: space-between;
    font-size: 0.88rem;
    color: #a0a6b5;
}

.footer-bottom-right {
    display: flex;
    align-items: center;
    gap: 4px;
    font-size: 0.88rem;
    color: #a0a6b5;
}

.footer-bottom-links {
    display: flex;
    gap: 20px;
}

.footer-bottom-links a {
    color: #ffffff;
    text-decoration: none;
    font-weight: 600;
    transition: color 0.3s ease;
}
.footer-bottom-links a:hover { color: var(--red); }


/* ═══════════════════════════════════════════════════
   FOOTER — RESPONSIVE
═══════════════════════════════════════════════════ */
@media (max-width: 1100px) {
    .footer-grid { grid-template-columns: 1fr 1fr; }
}

@media (max-width: 767px) {
    .contact-bar-inner { grid-template-columns: 1fr; }
    .contact-bar-box {
        border-right: none;
        border-bottom: 1px solid rgba(255, 255, 255, 0.06);
    }
    .contact-bar-box:last-child { border-bottom: none; }
}

@media (max-width: 575px) {
    .footer-grid { grid-template-columns: 1fr; }
    .footer-bottom {
        flex-direction: column;
        gap: 14px;
        text-align: center;
    }
    .footer-bottom-right {
        flex-direction: column;
        gap: 8px;
    }
}

        /* ── CONTENT PLACEHOLDER STYLES ── */
        .page-hero {
            background: linear-gradient(135deg, var(--bg) 0%, #fff 100%);
            padding: 80px 0;
            border-bottom: 1px solid var(--border);
        }
        .hero-eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-size: 0.72rem;
            font-weight: 600;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            color: var(--red);
            margin-bottom: 16px;
        }
        .hero-eyebrow::before {
            content: '';
            display: inline-block;
            width: 24px;
            height: 2px;
            background: var(--red);
        }
        .hero-title {
            font-family: 'Cormorant Garamond', serif;
            font-size: clamp(2.2rem, 5vw, 3.8rem);
            font-weight: 700;
            color: var(--ink);
            line-height: 1.1;
            letter-spacing: -0.01em;
        }
        .hero-subtitle {
            font-size: 1rem;
            color: var(--muted);
            margin-top: 16px;
            max-width: 560px;
            line-height: 1.7;
        }
    </style>
    @stack('styles')   {{-- add this --}}
</head>
<body>

    <div class="top-bar d-none d-lg-block">
        <div class="container-fluid" style="max-width: 1380px; padding: 0 2rem;">
            <div class="d-flex justify-content-between align-items-center">
                
                {{-- Left Side: Location & Email --}}
                <div class="d-flex align-items-center">
                    @if($settings->contact_address)
                        <div class="d-flex align-items-center gap-2">
                            <i class="bi bi-geo-alt"></i>
                            <span>{{ Str::limit($settings->contact_address, 40) }}</span>
                        </div>
                    @endif

                    @if($settings->contact_address && $settings->contact_email)
                        <div class="top-bar-divider"></div>
                    @endif

                    @if($settings->contact_email)
                        <div class="d-flex align-items-center gap-2">
                            <i class="bi bi-envelope"></i>
                            <a href="mailto:{{ explode(',', $settings->contact_email)[0] }}">{{ explode(',', $settings->contact_email)[0] }}</a>
                        </div>
                    @endif
                </div>

                {{-- Right Side: Hours & Social Icons --}}
                <div class="d-flex align-items-center">
                    @if($settings->office_open && $settings->office_close)
                        <div class="d-flex align-items-center gap-2 me-4">
                            <i class="bi bi-clock"></i>
                            <span>Office Hours: {{ \Carbon\Carbon::parse($settings->office_open)->format('g:i A') }} – {{ \Carbon\Carbon::parse($settings->office_close)->format('g:i A') }}</span>
                        </div>
                    @endif

                    <div class="top-bar-social d-flex gap-3">
                        @if($settings->facebook_url)
                            <a href="{{ $settings->facebook_url }}" target="_blank" title="Facebook"><i class="bi bi-facebook"></i></a>
                        @endif
                        @if($settings->twitter_url)
                            <a href="{{ $settings->twitter_url }}" target="_blank" title="X / Twitter"><i class="bi bi-twitter-x"></i></a>
                        @endif
                        @if($settings->linkedin_url)
                            <a href="{{ $settings->linkedin_url }}" target="_blank" title="LinkedIn"><i class="bi bi-linkedin"></i></a>
                        @endif
                        @if($settings->youtube_url)
                            <a href="{{ $settings->youtube_url }}" target="_blank" title="YouTube"><i class="bi bi-youtube"></i></a>
                        @endif
                    </div>
                </div>

            </div>
        </div>
    </div>

    <nav class="site-nav" id="siteNav">
        <div class="nav-inner">

            <a class="brand" href="{{ route('home') }}">
                @if(!empty($settings->site_logo))
                    <img src="{{ asset('storage/' . $settings->site_logo) }}" alt="{{ $settings->site_name ?? 'Site Logo' }}" style="height: 45px; width: auto; max-width: 220px;">
                @else
                    <div class="brand-icon">
                        <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M3 17 L12 4 L21 17 H15 L12 12 L9 17 Z"/></svg>
                    </div>
                    <span class="brand-name">
                        {{ $settings->site_name ?? 'MyCorporate' }}
                    </span>
                @endif
            </a>

            <ul class="nav-links d-none d-lg-flex">
                <li><a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">Home <i class="bi bi-chevron-down ms-1" style="font-size: 0.6rem;"></i></a></li>
                <li><a href="{{ route('about') }}" class="{{ request()->routeIs('about') ? 'active' : '' }}">About Us <i class="bi bi-chevron-down ms-1" style="font-size: 0.6rem;"></i></a></li>
                <li><a href="{{ route('public.career') }}" class="{{ request()->routeIs('public.career') ? 'active' : '' }}">Career <i class="bi bi-chevron-down ms-1" style="font-size: 0.6rem;"></i></a></li>
                
                {{-- SERVICES DROPDOWN --}}
                <li class="nav-drop">
                    <button class="nav-drop-toggle {{ request()->routeIs('services') || request()->routeIs('public.services.show') ? 'active' : '' }}">
                        Services <i class="bi bi-chevron-down ms-1" style="font-size:0.6rem;"></i>
                    </button>
                    <div class="dropdown-menu-custom">
                        <a href="{{ route('services') }}" class="fw-bold border-bottom pb-2 mb-1" style="color: var(--red);">View All Services</a>
                        @foreach($navServices as $service)
                            <a href="{{ route('public.services.show', $service) }}">{{ $service->title }}</a>
                        @endforeach
                    </div>
                </li>

                <li><a href="{{ route('public.gallery') }}" class="{{ request()->routeIs('public.gallery') ? 'active' : '' }}">Gallery <i class="bi bi-chevron-down ms-1" style="font-size: 0.6rem;"></i></a></li>
                <li><a href="{{ route('faq') }}" class="{{ request()->routeIs('faq') ? 'active' : '' }}">FAQ <i class="bi bi-chevron-down ms-1" style="font-size: 0.6rem;"></i></a></li>
                <li><a href="{{ route('contact') }}" class="{{ request()->routeIs('contact') ? 'active' : '' }}">Contact Us <i class="bi bi-chevron-down ms-1" style="font-size: 0.6rem;"></i></a></li>
            </ul>

            <div class="nav-contact-cta d-none d-xl-flex">
                <div class="nav-contact-icon">
                    <i class="bi bi-chat-square-text-fill"></i>
                </div>
                <div class="nav-contact-text">
                    <span class="nav-contact-label">Have any Questions?</span>
                    <a href="mailto:{{ explode(',', $settings->contact_email ?? 'info@nixsoletech.org')[0] }}" class="nav-contact-value">
                        {{ explode(',', $settings->contact_email ?? 'info@nixsoletech.org')[0] }}
                    </a>
                </div>
            </div>

            <button class="nav-toggle d-lg-none" id="navToggle" aria-label="Toggle menu">
                <i class="bi bi-list"></i>
            </button>
        </div>

        <div class="mobile-menu" id="mobileMenu" style="display:none;">
            <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">Home</a>
            <a href="{{ route('about') }}" class="{{ request()->routeIs('about') ? 'active' : '' }}">About</a>
            <a href="{{ route('public.career') }}" class="{{ request()->routeIs('public.career') ? 'active' : '' }}">Career</a>
            <a href="{{ route('services') }}" class="{{ request()->routeIs('services') ? 'active' : '' }}">Services</a>
            <a href="{{ route('faq') }}" class="{{ request()->routeIs('faq') ? 'active' : '' }}">FAQ</a>
            <a href="{{ route('public.gallery') }}" class="{{ request()->routeIs('public.gallery') ? 'active' : '' }}">Gallery</a>
            <a href="{{ route('contact') }}" class="{{ request()->routeIs('contact') ? 'active' : '' }}">Contact Us</a>
        </div>
    </nav>

    <!-- MAIN CONTENT -->
    <main class="site-main">
        @yield('content')
    </main>

    <!-- FOOTER -->
    {{-- ═══════════════════════════════════════════════
        SECTION 1 — TOP CONTACT BAR
    ═══════════════════════════════════════════════ --}}
    <div class="footer-contact-bar">
        <div class="contact-bar-inner">

            <div class="contact-bar-box">
                <div class="cbar-icon"><i class="bi bi-house-door-fill"></i></div>
                <div class="cbar-text">
                    <strong>Head Office</strong>
                    <span>{{ $settings->contact_address ?? '—' }}</span>
                </div>
            </div>

            <div class="contact-bar-box">
                <div class="cbar-icon"><i class="bi bi-telephone-fill"></i></div>
                <div class="cbar-text">
                    <strong>Call Us</strong>
                    <a href="tel:{{ preg_replace('/[^0-9+]/', '', $settings->contact_phone ?? '') }}">
                        {{ $settings->contact_phone ?? '—' }}
                    </a>
                </div>
            </div>

            <div class="contact-bar-box">
                <div class="cbar-icon"><i class="bi bi-envelope-fill"></i></div>
                <div class="cbar-text">
                    <strong>Email Us</strong>
                    <a href="mailto:{{ explode(',', $settings->contact_email ?? '')[0] }}">
                        {{ explode(',', $settings->contact_email ?? '—')[0] }}
                    </a>
                </div>
            </div>

        </div>
    </div>

{{-- ═══════════════════════════════════════════════
     SECTION 2 — MAIN FOOTER GRID
═══════════════════════════════════════════════ --}}
<footer class="site-footer">
    <div class="footer-inner">
        <div class="footer-grid">

            {{-- ── Column 1: Brand & Map ── --}}
            <div class="footer-brand">
                <a class="footer-brand-link" href="{{ route('home') }}">
                    @if(!empty($settings->site_logo_dark))
                        <img src="{{ asset('storage/' . $settings->site_logo_dark) }}"
                             alt="{{ $settings->site_name ?? 'Site Logo' }}"
                             style="height:45px;width:auto;max-width:220px;">
                    @elseif(!empty($settings->site_logo))
                        <img src="{{ asset('storage/' . $settings->site_logo) }}"
                             alt="{{ $settings->site_name ?? 'Site Logo' }}"
                             style="height:45px;width:auto;max-width:220px;">
                    @else
                        <div class="footer-brand-icon">
                            <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" style="height:20px;width:20px;">
                                <path d="M3 17 L12 4 L21 17 H15 L12 12 L9 17 Z" fill="white"/>
                            </svg>
                        </div>
                        <span class="footer-brand-name">{{ $settings->site_name ?? 'MyCorporate' }}</span>
                    @endif
                </a>

                <p class="footer-tagline">
                    {{ $settings->site_slogan ?? 'A forward-looking corporate group delivering integrated solutions across global markets.' }}
                </p>

                @if($settings->contact_map_embed)
                    <div class="footer-map-wrap">
                        <iframe
                            src="{{ $settings->contact_map_embed }}"
                            width="100%" height="100%"
                            style="border:0;" allowfullscreen=""
                            loading="lazy" referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                    </div>
                @endif
            </div>

            {{-- ── Column 2: Useful Links ── --}}
            <div>
                <p class="footer-heading">Useful Links</p>
                <ul class="footer-links">
                    <li><a href="{{ route('home') }}"><i class="bi bi-chevron-right"></i> Home</a></li>
                    <li><a href="{{ route('about') }}"><i class="bi bi-chevron-right"></i> About Us</a></li>
                    <li><a href="{{ route('services') }}"><i class="bi bi-chevron-right"></i> Services</a></li>
                    <li><a href="{{ route('faq') }}"><i class="bi bi-chevron-right"></i> FAQ &amp; Blog</a></li>
                    <li><a href="{{ route('public.gallery') }}"><i class="bi bi-chevron-right"></i> Gallery</a></li>
                    <li><a href="{{ route('contact') }}"><i class="bi bi-chevron-right"></i> Contact</a></li>
                    <li><a href="{{ route('public.career') }}"><i class="bi bi-chevron-right"></i> Careers</a></li>
                </ul>
            </div>

            {{-- ── Column 3: Our Services ── --}}
            <div>
                <p class="footer-heading">Our Services</p>
                <ul class="footer-links">
                    @if(isset($navServices) && $navServices->count() > 0)
                        @foreach($navServices->take(6) as $service)
                            <li>
                                <a href="{{ route('public.services.show', $service) }}">
                                    <i class="bi bi-chevron-right"></i> {{ $service->title }}
                                </a>
                            </li>
                        @endforeach
                    @else
                        <li><a href="#"><i class="bi bi-chevron-right"></i> Construction</a></li>
                        <li><a href="#"><i class="bi bi-chevron-right"></i> Trading</a></li>
                        <li><a href="#"><i class="bi bi-chevron-right"></i> Logistics</a></li>
                        <li><a href="#"><i class="bi bi-chevron-right"></i> Export-Import</a></li>
                        <li><a href="#"><i class="bi bi-chevron-right"></i> Supplier</a></li>
                        <li><a href="#"><i class="bi bi-chevron-right"></i> IT Technology &amp; Service</a></li>
                    @endif
                </ul>
            </div>

            {{-- ── Column 4: Additional Info ── --}}
            <div>
                <p class="footer-heading">Additional Info</p>

                @if($settings->contact_address_2)
                <div class="footer-contact-item">
                    <div class="footer-contact-icon"><i class="bi bi-geo-alt-fill"></i></div>
                    <div class="footer-contact-text">
                        <strong>Secondary Address</strong>
                        <span>{{ $settings->contact_address_2 }}</span>
                    </div>
                </div>
                @endif

                @if($settings->office_days)
                <div class="footer-contact-item">
                    <div class="footer-contact-icon"><i class="bi bi-clock-fill"></i></div>
                    <div class="footer-contact-text">
                        <strong>Working Days</strong>
                        <span>{{ $settings->office_days }}</span>
                        @if($settings->office_hours ?? false)
                            <span>{{ $settings->office_hours }}</span>
                        @endif
                    </div>
                </div>
                @endif

                <div class="social-links">
                    @if($settings->facebook_url)
                        <a href="{{ $settings->facebook_url }}" target="_blank" class="social-link" title="Facebook"><i class="bi bi-facebook"></i></a>
                    @endif
                    @if($settings->twitter_url)
                        <a href="{{ $settings->twitter_url }}" target="_blank" class="social-link" title="X / Twitter"><i class="bi bi-twitter-x"></i></a>
                    @endif
                    @if($settings->linkedin_url)
                        <a href="{{ $settings->linkedin_url }}" target="_blank" class="social-link" title="LinkedIn"><i class="bi bi-linkedin"></i></a>
                    @endif
                    @if($settings->instagram_url)
                        <a href="{{ $settings->instagram_url }}" target="_blank" class="social-link" title="Instagram"><i class="bi bi-instagram"></i></a>
                    @endif
                    @if($settings->youtube_url)
                        <a href="{{ $settings->youtube_url }}" target="_blank" class="social-link" title="YouTube"><i class="bi bi-youtube"></i></a>
                    @endif
                    @if($settings->whatsapp_number)
                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $settings->whatsapp_number) }}"
                           target="_blank" class="social-link" title="WhatsApp"><i class="bi bi-whatsapp"></i></a>
                    @endif
                </div>
            </div>

        </div>
    </div>

    {{-- ═══════════════════════════════════════════════
         SECTION 3 — BOTTOM BAR
    ═══════════════════════════════════════════════ --}}
    <div class="footer-bottom-wrapper">
        <div class="footer-bottom">
            <span>&copy; {{ date('Y') }} {{ $settings->site_name ?? 'MyCorporate' }}. All Rights Reserved.</span>
            <div class="footer-bottom-right">
                <span>Designed with care &nbsp;&middot;&nbsp;</span>
                <div class="footer-bottom-links">
                    <a href="#">Terms</a>
                    <a href="#">Privacy</a>
                    <a href="#">Support</a>
                </div>
            </div>
        </div>
    </div>

</footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Sticky nav shadow on scroll
        const nav = document.getElementById('siteNav');
        window.addEventListener('scroll', () => {
            nav.classList.toggle('scrolled', window.scrollY > 10);
        });

        // Mobile menu toggle
        const toggle = document.getElementById('navToggle');
        const menu   = document.getElementById('mobileMenu');
        toggle.addEventListener('click', () => {
            const isOpen = menu.style.display !== 'none';
            menu.style.display = isOpen ? 'none' : 'block';
            toggle.querySelector('i').className = isOpen ? 'bi bi-list' : 'bi bi-x-lg';
        });
    </script>
    @stack('scripts')  {{-- add this --}}
</body>
</html>