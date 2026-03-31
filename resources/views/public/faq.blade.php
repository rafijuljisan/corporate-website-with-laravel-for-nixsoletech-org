@extends('layouts.public')

@section('content')
    {{-- ══ HERO SECTION ══ --}}
    <div class="bg-light py-5 mb-5 border-bottom position-relative overflow-hidden">
        {{-- Subtle brand color tint --}}
        <div class="position-absolute top-0 start-0 w-100 h-100" style="background-color: {{ $settings->primary_color ?? '#0d6efd' }}; opacity: 0.03;"></div>
        
        <div class="container text-center position-relative">
            <span class="badge bg-white text-dark mb-3 px-3 py-2 rounded-pill fw-semibold shadow-sm">Help & Support</span>
            <h1 class="fw-bold h2 mb-2">Frequently Asked Questions</h1>
            <p class="text-muted mx-auto mb-0" style="max-width: 600px; font-size: 1.05rem;">
                Find quick answers to common questions about our corporate services, processes, and policies.
            </p>
        </div>
    </div>

    {{-- ══ FAQ ACCORDION ══ --}}
    <div class="container mb-5 pb-5">
        <div class="row justify-content-center">
            <div class="col-lg-9">
                
                @if($faqs->count() > 0)
                    <div class="accordion custom-accordion" id="faqAccordion">
                        @foreach($faqs as $index => $faq)
                            <div class="accordion-item border-0 mb-3 shadow-sm rounded-4 overflow-hidden transition-hover">
                                <h2 class="accordion-header" id="heading{{ $index }}">
                                    <button class="accordion-button {{ $index == 0 ? '' : 'collapsed' }} fw-bold bg-white fs-5" 
                                            type="button" 
                                            data-bs-toggle="collapse" 
                                            data-bs-target="#collapse{{ $index }}" 
                                            aria-expanded="{{ $index == 0 ? 'true' : 'false' }}" 
                                            aria-controls="collapse{{ $index }}">
                                        {{ $faq->question }}
                                    </button>
                                </h2>
                                <div id="collapse{{ $index }}" 
                                     class="accordion-collapse collapse {{ $index == 0 ? 'show' : '' }}" 
                                     aria-labelledby="heading{{ $index }}" 
                                     data-bs-parent="#faqAccordion">
                                    <div class="accordion-body text-muted bg-white border-top border-light" style="line-height: 1.7;">
                                        {!! nl2br(e($faq->answer)) !!}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-5 bg-light rounded-4 border border-dashed">
                        <i class="bi bi-question-circle fs-1 text-muted opacity-50 mb-3 d-block"></i>
                        <h5 class="text-muted">No FAQs are available at the moment.</h5>
                        <p class="text-muted mb-0">Please check back later or contact our support team directly.</p>
                    </div>
                @endif

                {{-- ══ BOTTOM CTA BOX ══ --}}
                <div class="mt-5">
                    <div class="card border-0 rounded-4 overflow-hidden" style="background-color: {{ $settings->primary_color ?? '#0d6efd' }}10;">
                        <div class="card-body p-4 p-md-5 text-center">
                            <i class="bi bi-headset display-5 mb-3 d-block" style="color: {{ $settings->primary_color ?? '#0d6efd' }};"></i>
                            <h3 class="fw-bold mb-3">Still have questions?</h3>
                            <p class="text-muted mx-auto mb-4" style="max-width: 500px;">
                                Can't find the answer you're looking for? Our dedicated support team is here to help you with whatever you need.
                            </p>
                            <a href="{{ route('contact') }}" class="btn text-white px-4 py-2 fw-bold rounded-pill shadow-sm" style="background-color: {{ $settings->primary_color ?? '#0d6efd' }};">
                                Contact Us <i class="bi bi-arrow-right ms-2"></i>
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    {{-- ══ CUSTOM STYLES ══ --}}
    <style>
        /* Accordion overrides for a cleaner, floating card look */
        .custom-accordion .accordion-item {
            background-color: transparent;
        }
        
        /* Remove the default Bootstrap blue background when an item is open */
        .custom-accordion .accordion-button:not(.collapsed) {
            color: {{ $settings->primary_color ?? '#0d6efd' }};
            background-color: #fff;
            box-shadow: inset 0 -1px 0 rgba(0,0,0,.125);
        }

        /* Color the active chevron icon to match your brand */
        .custom-accordion .accordion-button:not(.collapsed)::after {
            filter: brightness(0) saturate(100%);
            /* Optional: You can tint the chevron using CSS filters if needed, but keeping it dark/primary looks best */
        }

        /* Remove the ugly focus outline when clicking */
        .custom-accordion .accordion-button:focus {
            box-shadow: none;
            border-color: rgba(0,0,0,.125);
        }

        /* Subtle lift effect on hover */
        .transition-hover {
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }
        .transition-hover:hover {
            transform: translateY(-2px);
            box-shadow: 0 .5rem 1rem rgba(0,0,0,.1)!important;
        }
    </style>
@endsection