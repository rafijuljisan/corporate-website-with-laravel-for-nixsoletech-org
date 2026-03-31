@extends('layouts.public')

@section('content')
    {{-- ══ HERO SECTION ══ --}}
    {{-- ══ HERO SECTION (MODERN CORPORATE) ══ --}}
    {{-- ══ HERO SECTION (COMPACT) ══ --}}
    <div class="bg-light py-4 mb-4 border-bottom position-relative overflow-hidden">
        <div class="position-absolute top-0 start-0 w-100 h-100" style="background-color: {{ $settings->primary_color ?? '#0d6efd' }}; opacity: 0.03;"></div>
        
        <div class="container text-center position-relative">
            <h1 class="fw-bold h2 mb-2">Our Gallery</h1>
            <p class="text-muted mx-auto mb-0" style="max-width: 600px; font-size: 1.05rem;">
                Explore our latest projects, corporate milestones, and moments that define our journey.
            </p>
        </div>
    </div>

    {{-- ══ GALLERY GRID ══ --}}
    <div class="container mb-5 pb-5">
        <div class="row g-4">
            @forelse($galleries as $gallery)
                <div class="col-sm-6 col-md-4">
                    {{-- 
                        We add data-bs-toggle and custom data attributes here. 
                        This turns the entire card into a clickable trigger for the modal.
                    --}}
                    <div class="card border-0 shadow-sm rounded-4 overflow-hidden gallery-card h-100"
                         data-bs-toggle="modal" 
                         data-bs-target="#galleryLightbox"
                         data-img-src="{{ asset('storage/' . $gallery->image) }}"
                         data-img-title="{{ $gallery->title ?? '' }}"
                         style="cursor: pointer;">
                         
                        {{-- Image Wrapper --}}
                        <div class="position-relative bg-dark" style="height: 320px;">
                            <img src="{{ asset('storage/' . $gallery->image) }}" alt="{{ $gallery->title }}" class="w-100 h-100 gallery-img" style="object-fit: cover;">
                            
                            {{-- Hover Overlay --}}
                            <div class="gallery-overlay position-absolute top-0 start-0 w-100 h-100 d-flex flex-column align-items-center justify-content-center">
                                <div class="zoom-icon-wrapper rounded-circle d-flex align-items-center justify-content-center mb-2" style="width: 50px; height: 50px; background-color: {{ $settings->primary_color ?? '#0d6efd' }};">
                                    <i class="bi bi-arrows-fullscreen text-white fs-5"></i>
                                </div>
                            </div>
                            
                            {{-- Dynamic Color Accent Bar --}}
                            <div class="accent-bar position-absolute bottom-0 start-0 w-100" style="height: 4px; background-color: {{ $settings->primary_color ?? '#0d6efd' }}; transform: scaleX(0); transform-origin: left; transition: transform 0.4s ease;"></div>
                        </div>

                        {{-- Caption (Only renders if a title exists) --}}
                        @if($gallery->title)
                            <div class="card-body text-center py-3 bg-white">
                                <h6 class="fw-semibold mb-0 text-dark">{{ $gallery->title }}</h6>
                            </div>
                        @endif
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-5">
                    <div class="p-5 bg-light rounded-4 border border-dashed">
                        <i class="bi bi-images mb-3 fs-1 d-block opacity-50"></i>
                        <p class="text-muted fs-5 mb-0">Our gallery is currently being updated. Check back soon!</p>
                    </div>
                </div>
            @endforelse
        </div>
    </div>

    {{-- ══ LIGHTBOX MODAL ══ --}}
    <div class="modal fade" id="galleryLightbox" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content bg-transparent border-0">
                
                {{-- Close Button --}}
                <div class="modal-header border-0 position-absolute top-0 end-0 z-3 p-3">
                    <button type="button" class="btn-close btn-close-white fs-5" data-bs-dismiss="modal" aria-label="Close" style="filter: drop-shadow(0 2px 4px rgba(0,0,0,0.5));"></button>
                </div>
                
                {{-- Image Container --}}
                <div class="modal-body text-center p-0 position-relative">
                    <div class="d-flex flex-column align-items-center justify-content-center w-100" style="min-height: 50vh;">
                        {{-- A loading spinner that shows while the high-res image loads --}}
                        <div class="spinner-border text-light position-absolute z-n1" role="status" id="lightboxSpinner">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                        
                        <img src="" id="lightboxImage" class="img-fluid rounded-2 shadow-lg d-none" alt="Gallery Image" style="max-height: 85vh; object-fit: contain;">
                        
                        <h5 id="lightboxCaption" class="text-white mt-3 fw-light" style="text-shadow: 0 2px 4px rgba(0,0,0,0.8);"></h5>
                    </div>
                </div>

            </div>
        </div>
    </div>

    {{-- ══ STYLES ══ --}}
    <style>
        .gallery-card {
            transition: transform 0.4s ease, box-shadow 0.4s ease;
        }
        .gallery-img {
            transition: transform 0.6s ease, opacity 0.4s ease;
        }
        .gallery-overlay {
            background: linear-gradient(to top, rgba(0,0,0,0.7) 0%, rgba(0,0,0,0.2) 100%);
            opacity: 0;
            transition: opacity 0.4s ease;
        }
        .zoom-icon-wrapper {
            transform: translateY(20px);
            opacity: 0;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        /* Hover States */
        .gallery-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 1rem 3rem rgba(0,0,0,0.15) !important;
        }
        .gallery-card:hover .gallery-img {
            transform: scale(1.08);
            opacity: 0.8;
        }
        .gallery-card:hover .gallery-overlay {
            opacity: 1;
        }
        .gallery-card:hover .zoom-icon-wrapper {
            transform: translateY(0);
            opacity: 1;
        }
        .gallery-card:hover .accent-bar {
            transform: scaleX(1);
        }

        /* Dim the background heavily when modal is open */
        .modal-backdrop.show {
            opacity: 0.9;
            background-color: #000;
        }
    </style>

    {{-- ══ SCRIPTS ══ --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const lightboxModal = document.getElementById('galleryLightbox');
            const lightboxImage = document.getElementById('lightboxImage');
            const lightboxCaption = document.getElementById('lightboxCaption');
            const lightboxSpinner = document.getElementById('lightboxSpinner');

            if(lightboxModal) {
                // When modal is about to show
                lightboxModal.addEventListener('show.bs.modal', function (event) {
                    // Button that triggered the modal
                    const trigger = event.relatedTarget;
                    
                    // Extract info from data-* attributes
                    const imgSrc = trigger.getAttribute('data-img-src');
                    const imgTitle = trigger.getAttribute('data-img-title');

                    // Reset image state for smooth loading
                    lightboxImage.classList.add('d-none');
                    lightboxSpinner.classList.remove('d-none');
                    
                    // Set new source
                    lightboxImage.src = imgSrc;
                    lightboxCaption.textContent = imgTitle;

                    // Once the image actually downloads, hide spinner and show image
                    lightboxImage.onload = function() {
                        lightboxSpinner.classList.add('d-none');
                        lightboxImage.classList.remove('d-none');
                        // Add a subtle fade-in animation
                        lightboxImage.animate([
                            { opacity: 0, transform: 'scale(0.98)' },
                            { opacity: 1, transform: 'scale(1)' }
                        ], { duration: 300, easing: 'ease-out' });
                    };
                });

                // Clear contents when modal hides so the next image doesn't flash the old one
                lightboxModal.addEventListener('hidden.bs.modal', function () {
                    lightboxImage.src = '';
                    lightboxCaption.textContent = '';
                });
            }
        });
    </script>
@endsection