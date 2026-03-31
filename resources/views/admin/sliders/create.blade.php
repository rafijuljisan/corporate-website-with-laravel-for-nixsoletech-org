<x-app-layout>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <x-app.navbar />
        <div class="container-fluid py-4 px-5">
            <div class="row">
                <div class="col-12 col-lg-8 m-auto">
                    <div class="card border shadow-xs mb-4">
                        <div class="card-header border-bottom pb-0">
                            <div class="d-sm-flex align-items-center mb-3">
                                <div>
                                    <h6 class="font-weight-semibold text-lg mb-0">Add New Slide</h6>
                                    <p class="text-sm mb-0">Create a new hero slider entry for the homepage.</p>
                                </div>
                                <div class="ms-auto">
                                    <a href="{{ route('sliders.index') }}" class="btn btn-sm btn-white">← Back to Slides</a>
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            <form action="{{ route('sliders.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                {{-- Title --}}
                                <div class="mb-3">
                                    <label for="title" class="form-label font-weight-bold">Slide Title <span class="text-danger">*</span></label>
                                    <input type="text" name="title" id="title"
                                           class="form-control @error('title') is-invalid @enderror"
                                           value="{{ old('title') }}"
                                           placeholder="e.g., Industry-Leading Logistics Solutions"
                                           required>
                                    @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>

                                {{-- Subtitle --}}
                                <div class="mb-3">
                                    <label for="subtitle" class="form-label font-weight-bold">Subtitle / Eyebrow Text</label>
                                    <input type="text" name="subtitle" id="subtitle"
                                           class="form-control @error('subtitle') is-invalid @enderror"
                                           value="{{ old('subtitle') }}"
                                           placeholder="e.g., Trusted by 200+ companies worldwide">
                                    @error('subtitle') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>

                                {{-- Badge label --}}
                                <div class="mb-3">
                                    <label for="badge_label" class="form-label font-weight-bold">Badge Label <span class="text-muted text-xs">(small pill shown above title)</span></label>
                                    <input type="text" name="badge_label" id="badge_label"
                                           class="form-control @error('badge_label') is-invalid @enderror"
                                           value="{{ old('badge_label') }}"
                                           placeholder="e.g., New Service · Award Winning · #1 in Asia">
                                    @error('badge_label') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>

                                {{-- Description --}}
                                <div class="mb-3">
                                    <label for="description" class="form-label font-weight-bold">Description</label>
                                    <textarea name="description" id="description" rows="3"
                                              class="form-control @error('description') is-invalid @enderror"
                                              placeholder="Short body text shown under the title on the slide…">{{ old('description') }}</textarea>
                                    @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>

                                {{-- Image --}}
                                <div class="mb-3">
                                    <label for="image" class="form-label font-weight-bold">Background Image <span class="text-danger">*</span></label>
                                    <input type="file" name="image" id="image" accept="image/*"
                                           class="form-control @error('image') is-invalid @enderror"
                                           onchange="previewImage(this)" required>
                                    <small class="text-muted">Recommended: 1920×900px, JPG or WebP, max 4MB</small>
                                    @error('image') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    <div id="imagePreview" class="mt-2" style="display:none;">
                                        <img id="previewImg" src="" alt="Preview"
                                             style="max-height:180px;border-radius:10px;border:1px solid #ddd;">
                                    </div>
                                </div>

                                {{-- Overlay --}}
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="overlay_color" class="form-label font-weight-bold">Overlay Colour</label>
                                        <div class="d-flex align-items-center gap-2">
                                            <input type="color" name="overlay_color" id="overlay_color"
                                                   class="form-control form-control-color"
                                                   value="{{ old('overlay_color', '#000000') }}" style="width:48px;height:38px;">
                                            <span class="text-sm text-muted">Dark overlay tint on the image</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="overlay_opacity" class="form-label font-weight-bold">
                                            Overlay Opacity: <span id="opacityVal">{{ old('overlay_opacity', 50) }}%</span>
                                        </label>
                                        <input type="range" name="overlay_opacity" id="overlay_opacity"
                                               class="form-range"
                                               min="0" max="100" value="{{ old('overlay_opacity', 50) }}"
                                               oninput="document.getElementById('opacityVal').textContent = this.value + '%'">
                                    </div>
                                </div>

                                <hr class="my-4">

                                {{-- CTA Buttons --}}
                                <p class="font-weight-bold mb-3">Call-to-Action Buttons <span class="text-muted text-xs">(optional)</span></p>
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label class="form-label">Primary Button Text</label>
                                        <input type="text" name="button_text" class="form-control"
                                               value="{{ old('button_text') }}" placeholder="e.g., Explore Services">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Primary Button URL</label>
                                        <input type="text" name="button_url" class="form-control"
                                               value="{{ old('button_url') }}" placeholder="e.g., /services">
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <div class="col-md-6">
                                        <label class="form-label">Secondary Button Text</label>
                                        <input type="text" name="button_text_2" class="form-control"
                                               value="{{ old('button_text_2') }}" placeholder="e.g., Contact Us">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Secondary Button URL</label>
                                        <input type="text" name="button_url_2" class="form-control"
                                               value="{{ old('button_url_2') }}" placeholder="e.g., /contact">
                                    </div>
                                </div>

                                <hr class="my-4">

                                {{-- Order + Active --}}
                                <div class="row mb-4">
                                    <div class="col-md-4">
                                        <label for="order" class="form-label font-weight-bold">Display Order</label>
                                        <input type="number" name="order" id="order" class="form-control"
                                               value="{{ old('order', 0) }}" min="0">
                                        <small class="text-muted">Lower number = appears first</small>
                                    </div>
                                    <div class="col-md-8 d-flex align-items-end pb-1">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" name="is_active"
                                                   id="is_active" value="1"
                                                   {{ old('is_active', '1') ? 'checked' : '' }}>
                                            <label class="form-check-label" for="is_active">Active (visible on homepage)</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-end">
                                    <a href="{{ route('sliders.index') }}" class="btn btn-white me-2">Cancel</a>
                                    <button type="submit" class="btn btn-dark">Save Slide</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <x-app.footer />
        </div>
    </main>

    <script>
        function previewImage(input) {
            const preview = document.getElementById('imagePreview');
            const img     = document.getElementById('previewImg');
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = e => { img.src = e.target.result; preview.style.display = 'block'; };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
</x-app-layout>