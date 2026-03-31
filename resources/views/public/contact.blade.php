@extends('layouts.public')

@section('content')
    <div class="container my-5">
        
        <div class="row justify-content-center g-4">
            {{-- ══ CONTACT INFORMATION COLUMN ══ --}}
            <div class="col-lg-4 mb-4 mb-lg-0">
                <div class="card shadow-sm border-0 h-100 bg-light">
                    <div class="card-body p-4 p-md-5">
                        <h3 class="fw-bold mb-4">Get in Touch</h3>
                        <p class="text-muted mb-4">We'd love to hear from you. Please reach out to us using the contact details below or fill out the form.</p>

                        {{-- Address --}}
                        @if($settings->contact_address || $settings->contact_address_2)
                        <div class="d-flex mb-4">
                            <div class="me-3 fs-4" style="color: {{ $settings->primary_color ?? '#C8102E' }};">
                                <i class="bi bi-geo-alt-fill"></i>
                            </div>
                            <div>
                                <h6 class="fw-bold mb-1">Our Location</h6>
                                <p class="text-muted mb-0">
                                    {{ $settings->contact_address }}<br>
                                    {{ $settings->contact_address_2 }}
                                </p>
                            </div>
                        </div>
                        @endif

                        {{-- Phone --}}
                        @if($settings->contact_phone || $settings->contact_phone_2)
                        <div class="d-flex mb-4">
                            <div class="me-3 fs-4" style="color: {{ $settings->primary_color ?? '#C8102E' }};">
                                <i class="bi bi-telephone-fill"></i>
                            </div>
                            <div>
                                <h6 class="fw-bold mb-1">Call Us</h6>
                                <p class="text-muted mb-0">
                                    @if($settings->contact_phone)
                                        <a href="tel:{{ preg_replace('/[^0-9+]/', '', $settings->contact_phone) }}" class="text-decoration-none text-muted">{{ $settings->contact_phone }}</a><br>
                                    @endif
                                    @if($settings->contact_phone_2)
                                        <a href="tel:{{ preg_replace('/[^0-9+]/', '', $settings->contact_phone_2) }}" class="text-decoration-none text-muted">{{ $settings->contact_phone_2 }}</a>
                                    @endif
                                </p>
                            </div>
                        </div>
                        @endif

                        {{-- Email --}}
                        @if($settings->contact_email)
                        <div class="d-flex mb-4">
                            <div class="me-3 fs-4" style="color: {{ $settings->primary_color ?? '#C8102E' }};">
                                <i class="bi bi-envelope-fill"></i>
                            </div>
                            <div>
                                <h6 class="fw-bold mb-1">Email Us</h6>
                                <p class="text-muted mb-0">
                                    <a href="mailto:{{ $settings->contact_email }}" class="text-decoration-none text-muted">{{ $settings->contact_email }}</a>
                                </p>
                            </div>
                        </div>
                        @endif

                        {{-- Office Hours --}}
                        @if($settings->office_days || ($settings->office_open && $settings->office_close))
                        <div class="d-flex mb-4">
                            <div class="me-3 fs-4" style="color: {{ $settings->primary_color ?? '#C8102E' }};">
                                <i class="bi bi-clock-fill"></i>
                            </div>
                            <div>
                                <h6 class="fw-bold mb-1">Office Hours</h6>
                                <p class="text-muted mb-0">
                                    @if($settings->office_days)
                                        {{ $settings->office_days }}<br>
                                    @endif
                                    @if($settings->office_open && $settings->office_close)
                                        {{ \Carbon\Carbon::parse($settings->office_open)->format('h:i A') }} - {{ \Carbon\Carbon::parse($settings->office_close)->format('h:i A') }}
                                    @endif
                                </p>
                            </div>
                        </div>
                        @endif

                        {{-- Social Media Links --}}
                        <div class="mt-5">
                            <h6 class="fw-bold mb-3">Follow Us</h6>
                            <div class="d-flex gap-2">
                                @if($settings->facebook_url)
                                    <a href="{{ $settings->facebook_url }}" target="_blank" class="btn btn-outline-dark border-0 shadow-sm"><i class="bi bi-facebook"></i></a>
                                @endif
                                @if($settings->twitter_url)
                                    <a href="{{ $settings->twitter_url }}" target="_blank" class="btn btn-outline-dark border-0 shadow-sm"><i class="bi bi-twitter-x"></i></a>
                                @endif
                                @if($settings->linkedin_url)
                                    <a href="{{ $settings->linkedin_url }}" target="_blank" class="btn btn-outline-dark border-0 shadow-sm"><i class="bi bi-linkedin"></i></a>
                                @endif
                                @if($settings->instagram_url)
                                    <a href="{{ $settings->instagram_url }}" target="_blank" class="btn btn-outline-dark border-0 shadow-sm"><i class="bi bi-instagram"></i></a>
                                @endif
                                @if($settings->youtube_url)
                                    <a href="{{ $settings->youtube_url }}" target="_blank" class="btn btn-outline-dark border-0 shadow-sm"><i class="bi bi-youtube"></i></a>
                                @endif
                                @if($settings->whatsapp_number)
                                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $settings->whatsapp_number) }}" target="_blank" class="btn btn-outline-dark border-0 shadow-sm"><i class="bi bi-whatsapp"></i></a>
                                @endif
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            {{-- ══ CONTACT FORM COLUMN ══ --}}
            <div class="col-lg-8">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-body p-4 p-md-5">
                        <h3 class="fw-bold mb-4">Send us a Message</h3>
                        
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        <form action="{{ route('contact.submit') }}" method="POST">
                            @csrf
                            
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="name" class="form-label fw-bold">Your Name</label>
                                    <input type="text" class="form-control bg-light border-0" id="name" name="name" placeholder="John Doe" required>
                                </div>
                                <div class="col-md-6 mt-3 mt-md-0">
                                    <label for="email" class="form-label fw-bold">Email Address</label>
                                    <input type="email" class="form-control bg-light border-0" id="email" name="email" placeholder="john@example.com" required>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="subject" class="form-label fw-bold">Subject</label>
                                <input type="text" class="form-control bg-light border-0" id="subject" name="subject" placeholder="How can we help?" required>
                            </div>

                            <div class="mb-4">
                                <label for="message" class="form-label fw-bold">Message</label>
                                <textarea class="form-control bg-light border-0" id="message" name="message" rows="6" placeholder="Write your message here..." required></textarea>
                            </div>

                            <div class="d-grid">
                                <button type="submit" class="btn btn-lg text-white" style="background-color: {{ $settings->primary_color ?? '#0d6efd' }};">
                                    Send Message <i class="bi bi-send ms-2"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        {{-- ══ GOOGLE MAPS ROW ══ --}}
        @if($settings->contact_map_embed)
        <div class="row mt-5">
            <div class="col-12">
                <div class="card shadow-sm border-0 overflow-hidden">
                    <iframe 
                        src="{{ $settings->contact_map_embed }}" 
                        width="100%" 
                        height="450" 
                        style="border:0;" 
                        allowfullscreen="" 
                        loading="lazy" 
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
            </div>
        </div>
        @endif

    </div>
@endsection