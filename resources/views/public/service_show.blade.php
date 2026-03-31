@extends('layouts.public')

@section('content')
    {{-- ══ PAGE HEADER ══ --}}
    <div class="bg-light py-5 mb-5 border-bottom">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-2">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-decoration-none text-muted">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('services') }}" class="text-decoration-none text-muted">Services</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ $service->title }}</li>
                        </ol>
                    </nav>
                    <h1 class="fw-bold display-5 mb-0 d-flex align-items-center gap-3">
                        @if($service->icon)
                            <i class="{{ $service->icon }}" style="color: {{ $settings->primary_color ?? '#0d6efd' }};"></i>
                        @endif
                        {{ $service->title }}
                    </h1>
                </div>
            </div>
        </div>
    </div>

    {{-- ══ MAIN CONTENT ══ --}}
    <div class="container mb-5 pb-5">
        <div class="row g-5">
            
            {{-- Left Column: Service Details --}}
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body p-4 p-md-5">
                        <h3 class="fw-bold mb-4">About this Service</h3>
                        
                        {{-- {!! nl2br(e()) !!} safely converts newlines from your textarea into HTML <br> tags --}}
                        <div class="text-muted" style="line-height: 1.8; font-size: 1.05rem;">
                            {!! nl2br(e($service->description)) !!}
                        </div>

                        <hr class="my-5">
                        
                        <a href="{{ route('services') }}" class="btn btn-outline-dark">
                            <i class="bi bi-arrow-left me-2"></i> Back to All Services
                        </a>
                    </div>
                </div>
            </div>

            {{-- Right Column: Call to Action / Contact Sidebar --}}
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm bg-dark text-white sticky-top" style="top: 100px;">
                    <div class="card-body p-4 p-md-5 text-center">
                        <div class="mb-4">
                            <i class="bi bi-chat-square-text-fill display-4" style="color: {{ $settings->primary_color ?? '#0d6efd' }};"></i>
                        </div>
                        <h4 class="fw-bold mb-3">Ready to get started?</h4>
                        <p class="text-light opacity-75 mb-4">
                            Contact our team today to discuss how our <strong>{{ $service->title }}</strong> services can help your business grow.
                        </p>
                        
                        <a href="{{ route('contact') }}?subject={{ urlencode('Inquiry about ' . $service->title) }}" class="btn btn-lg w-100 border-0 text-white mb-3" style="background-color: {{ $settings->primary_color ?? '#0d6efd' }};">
                            Contact Us
                        </a>

                        @if($settings->contact_phone)
                            <p class="mb-0 text-sm">
                                Or call us at: <br>
                                <a href="tel:{{ preg_replace('/[^0-9+]/', '', $settings->contact_phone) }}" class="text-white fw-bold text-decoration-none fs-5">
                                    {{ $settings->contact_phone }}
                                </a>
                            </p>
                        @endif
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection