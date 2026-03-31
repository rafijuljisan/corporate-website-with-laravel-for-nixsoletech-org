@extends('layouts.public')

@section('content')
    {{-- ══ HERO HEADER ══ --}}
    <div class="position-relative bg-dark text-white py-5 mb-5 overflow-hidden">
        {{-- Optional subtle background tint using your primary color --}}
        <div class="position-absolute top-0 start-0 w-100 h-100" style="background-color: {{ $settings->primary_color ?? '#0d6efd' }}; opacity: 0.05;"></div>

        <div class="container text-center position-relative py-5">
            <span class="badge bg-white text-dark mb-3 px-3 py-2 rounded-pill fw-semibold shadow-sm">What We Do</span>
            <h1 class="fw-bolder display-4 mb-3">Our Services</h1>
            <p class="lead text-light mx-auto mb-0" style="max-width: 650px; opacity: 0.85;">
                Discover the comprehensive range of professional solutions designed to help your business scale, innovate, and succeed.
            </p>
        </div>
    </div>

    {{-- ══ SERVICES GRID ══ --}}
    <div class="container mb-5 pb-5">
        <div class="row g-4 justify-content-center">
            
            @forelse($services as $service)
                {{-- d-flex ensures all columns stretch to match the tallest card in the row --}}
                <div class="col-md-6 col-lg-4 d-flex">
                    <div class="card service-card w-100 border-0 shadow-sm position-relative rounded-4">
                        <div class="card-body p-4 p-md-5 d-flex flex-column">
                            
                            {{-- Icon --}}
                            @if($service->icon)
                                <div class="icon-box mb-4 d-inline-flex align-items-center justify-content-center rounded-4" style="width: 70px; height: 70px; background-color: {{ $settings->primary_color ?? '#0d6efd' }}15;">
                                    <i class="{{ $service->icon }} fs-3 icon-zoom" style="color: {{ $settings->primary_color ?? '#0d6efd' }};"></i>
                                </div>
                            @endif

                            {{-- Title & Description --}}
                            <h4 class="fw-bold mb-3">{{ $service->title }}</h4>
                            
                            {{-- flex-grow-1 pushes the bottom link down, Str::limit prevents overflow --}}
                            <p class="text-muted mb-4 flex-grow-1" style="line-height: 1.7;">
                                {{ \Illuminate\Support\Str::limit($service->description, 120, '...') }}
                            </p>

                            {{-- Clickable Link --}}
                            <div class="mt-auto pt-4 border-top">
                                {{-- .stretched-link makes the whole parent card clickable --}}
                                <a href="{{ route('public.services.show', $service) }}" class="text-decoration-none fw-bold stretched-link d-inline-flex align-items-center" style="color: {{ $settings->primary_color ?? '#0d6efd' }};">
                                    Explore Service
                                    <i class="bi bi-arrow-right ms-2 arrow-move"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                {{-- Fallback if no services exist yet --}}
                <div class="col-12 text-center py-5">
                    <div class="p-5 bg-light rounded-4 border border-dashed">
                        <div class="text-muted fs-5">
                            <i class="bi bi-tools mb-3 fs-1 d-block opacity-50"></i>
                            We are currently updating our list of services. Please check back soon!
                        </div>
                    </div>
                </div>
            @endforelse

        </div>
    </div>

    {{-- ══ CUSTOM STYLES ══ --}}
    <style>
        .service-card {
            transition: all 0.3s ease;
            border: 1px solid rgba(0,0,0,0.05) !important;
        }
        
        .icon-zoom, .arrow-move {
            transition: transform 0.3s ease;
        }

        /* Hover Effects */
        .service-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 1rem 3rem rgba(0,0,0,0.1) !important;
        }

        /* Slightly enlarge the icon on hover */
        .service-card:hover .icon-zoom {
            transform: scale(1.15);
        }

        /* Slide the arrow to the right on hover */
        .service-card:hover .arrow-move {
            transform: translateX(5px);
        }
    </style>
@endsection