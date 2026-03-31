@extends('layouts.public')

@section('content')
    {{-- ══ PAGE HERO HEADER ══ --}}
    <div class="bg-light py-5 mb-5 border-bottom">
        <div class="container text-center">
            <h1 class="fw-bold display-5 mb-3">About <span style="color: {{ $settings->primary_color ?? '#C8102E' }};">{{ $settings->site_name ?? 'Nixsoletech' }}</span></h1>
            <p class="lead text-muted mx-auto" style="max-width: 700px;">
                A forward-looking corporate group delivering integrated solutions across global markets, infrastructure, and technology.
            </p>
        </div>
    </div>

    <div class="container mb-5 pb-5">
        
        {{-- ══ TOP SECTION: DESCRIPTION & SIDEBAR ══ --}}
        <div class="row g-5 mb-5">
            {{-- Main Company Description --}}
            <div class="col-lg-8">
                <h3 class="fw-bold mb-4">Who We Are</h3>
                <p class="text-muted" style="line-height: 1.8; font-size: 1.05rem;">
                    <strong>{{ $settings->site_name ?? 'Nixsoletech' }}</strong> is a diversified, multi-service corporate organization dedicated to delivering smart, scalable, and practical solutions across a wide array of global industries. We combine operational excellence with deep industry knowledge to help our clients improve efficiency, expand their global reach, and maximize their growth potential.
                </p>
                <p class="text-muted" style="line-height: 1.8; font-size: 1.05rem;">
                    Our business operates through dedicated concerns in six core areas: <strong>Construction, Trading, Logistics, Export-Import, Supplier networks, and IT Technology & Services</strong>. Whether we are building critical infrastructure, optimizing global supply chains, or implementing cutting-edge software solutions, our goal is to provide reliable, high-quality, and innovative results tailored to the modern market.
                </p>
                <p class="text-muted" style="line-height: 1.8; font-size: 1.05rem;">
                    With a strong focus on quality, operational transparency, and long-term partnerships, we continue to expand our services to support businesses, educational organizations, and corporate clients worldwide. We believe in leveraging our multi-disciplinary expertise to simplify complex operations and create sustainable growth.
                </p>
            </div>

            {{-- Dynamic Contact Sidebar --}}
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm bg-dark text-white rounded-4 overflow-hidden">
                    <div class="card-body p-4 p-md-5">
                        <h4 class="fw-bold mb-4 border-bottom border-secondary pb-3">Contact Details</h4>
                        
                        @if($settings->contact_email)
                            <div class="d-flex mb-3 align-items-center">
                                <i class="bi bi-envelope-fill fs-4 me-3" style="color: {{ $settings->primary_color ?? '#C8102E' }};"></i>
                                <div>
                                    <span class="d-block text-white-50 small">Email Us</span>
                                    <a href="mailto:{{ explode(',', $settings->contact_email)[0] }}" class="text-white text-decoration-none fw-semibold">{{ explode(',', $settings->contact_email)[0] }}</a>
                                </div>
                            </div>
                        @endif

                        @if($settings->contact_phone)
                            <div class="d-flex mb-3 align-items-center">
                                <i class="bi bi-telephone-fill fs-4 me-3" style="color: {{ $settings->primary_color ?? '#C8102E' }};"></i>
                                <div>
                                    <span class="d-block text-white-50 small">Call Us</span>
                                    <a href="tel:{{ preg_replace('/[^0-9+]/', '', $settings->contact_phone) }}" class="text-white text-decoration-none fw-semibold">{{ $settings->contact_phone }}</a>
                                </div>
                            </div>
                        @endif

                        @if($settings->contact_address)
                            <div class="d-flex align-items-center">
                                <i class="bi bi-geo-alt-fill fs-4 me-3" style="color: {{ $settings->primary_color ?? '#C8102E' }};"></i>
                                <div>
                                    <span class="d-block text-white-50 small">Visit Us</span>
                                    <span class="text-white fw-semibold">{{ $settings->contact_address }}</span>
                                </div>
                            </div>
                        @endif
                        
                        <div class="mt-4 pt-4 border-top border-secondary">
                            <a href="{{ route('contact') }}" class="btn w-100 fw-bold" style="background-color: {{ $settings->primary_color ?? '#C8102E' }}; color: white;">
                                Get in Touch
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- ══ MISSION & VISION SECTION ══ --}}
        <div class="row g-4 mb-5">
            <div class="col-md-6">
                <div class="card h-100 border-0 shadow-sm rounded-4 p-4 p-md-5" style="border-top: 5px solid {{ $settings->primary_color ?? '#C8102E' }} !important;">
                    <div class="d-flex align-items-center mb-3">
                        <i class="bi bi-bullseye fs-1 me-3" style="color: {{ $settings->primary_color ?? '#C8102E' }};"></i>
                        <h3 class="fw-bold mb-0">Our Mission</h3>
                    </div>
                    <p class="text-muted mb-0" style="line-height: 1.7;">
                        Our mission is to empower businesses and societies by providing robust infrastructure, seamless global trade networks, and innovative IT solutions. We aim to deliver high-quality, integrated services that accelerate growth, improve operational efficiency, and exceed international standards.
                    </p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card h-100 border-0 shadow-sm rounded-4 p-4 p-md-5" style="border-top: 5px solid #212529 !important;">
                    <div class="d-flex align-items-center mb-3">
                        <i class="bi bi-eye-fill fs-1 me-3 text-dark"></i>
                        <h3 class="fw-bold mb-0">Our Vision</h3>
                    </div>
                    <p class="text-muted mb-0" style="line-height: 1.7;">
                        Our vision is to become a leading multi-disciplinary corporate group recognized globally for innovation, reliability, and customer-focused solutions. We strive to build a future where our diverse business concerns drive sustainable success and positive societal impact worldwide.
                    </p>
                </div>
            </div>
        </div>

        {{-- ══ CORE VALUES SECTION ══ --}}
        <div class="text-center mb-5 pt-4">
            <h2 class="fw-bold mb-2">Our Core Values</h2>
            <p class="text-muted">The principles that guide our work and partnerships.</p>
        </div>
        <div class="row g-4 mb-5 pb-4">
            @php
                $values = [
                    ['icon' => 'bi-lightbulb', 'title' => 'Innovation', 'desc' => 'We continuously explore new ideas and technologies.'],
                    ['icon' => 'bi-shield-check', 'title' => 'Integrity', 'desc' => 'We maintain transparency and honesty in all operations.'],
                    ['icon' => 'bi-award', 'title' => 'Quality', 'desc' => 'We ensure professional and reliable service delivery.'],
                    ['icon' => 'bi-graph-up-arrow', 'title' => 'Client Success', 'desc' => 'Our clients’ growth is our priority.'],
                    ['icon' => 'bi-gear-wide-connected', 'title' => 'Efficiency', 'desc' => 'We focus on smart and practical solutions.'],
                    ['icon' => 'bi-people', 'title' => 'Collaboration', 'desc' => 'We believe in long-term partnerships.']
                ];
            @endphp

            @foreach($values as $value)
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm h-100 text-center p-4 rounded-4 transition-hover">
                        <div class="card-body">
                            <div class="mb-3 d-inline-flex align-items-center justify-content-center rounded-circle" style="width: 60px; height: 60px; background-color: {{ $settings->primary_color ?? '#C8102E' }}15;">
                                <i class="bi {{ $value['icon'] }} fs-4" style="color: {{ $settings->primary_color ?? '#C8102E' }};"></i>
                            </div>
                            <h5 class="fw-bold mb-2">{{ $value['title'] }}</h5>
                            <p class="text-muted mb-0 small">{{ $value['desc'] }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- ══ WHY CHOOSE US & SERVICES OVERVIEW ══ --}}
        <div class="row g-5 bg-light p-4 p-md-5 rounded-4 border">
            <div class="col-md-6">
                <h3 class="fw-bold mb-4">Why Choose Us</h3>
                <ul class="list-unstyled">
                    @foreach([
                        'Diverse expertise across multiple industries',
                        'End-to-end operational transparency',
                        'Highly rigorous supplier and quality control',
                        'Global reach with a localized understanding',
                        'Commitment to continuous improvement',
                        'Reliable, performance-oriented work culture'
                    ] as $reason)
                        <li class="mb-3 d-flex align-items-center text-muted">
                            <i class="bi bi-check-circle-fill me-3 fs-5" style="color: {{ $settings->primary_color ?? '#C8102E' }};"></i>
                            <span style="font-size: 1.05rem;">{{ $reason }}</span>
                        </li>
                    @endforeach
                </ul>
            </div>
            
            <div class="col-md-6">
                <h3 class="fw-bold mb-4">Our Services Overview</h3>
                <p class="text-muted mb-4">Our integrated corporate structure allows clients to access a comprehensive suite of solutions:</p>
                <div class="row g-3">
                    @foreach([
                        'Construction',
                        'Trading',
                        'Logistics',
                        'Export-Import',
                        'Supplier',
                        'IT Technology & Service'
                    ] as $service)
                        <div class="col-sm-6">
                            <div class="p-3 bg-white border shadow-sm rounded-3 fw-semibold text-center text-dark" style="font-size: 0.95rem;">
                                {{ $service }}
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="mt-4 pt-2">
                    <a href="{{ route('services') }}" class="btn btn-outline-dark w-100">Explore Our Services <i class="bi bi-arrow-right ms-2"></i></a>
                </div>
            </div>
        </div>

    </div>

    {{-- Optional Hover CSS for the Core Value Cards --}}
    <style>
        .transition-hover {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .transition-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 .5rem 1rem rgba(0,0,0,.15)!important;
        }
    </style>
@endsection