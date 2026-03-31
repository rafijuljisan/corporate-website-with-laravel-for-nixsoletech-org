<x-app-layout>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <x-app.navbar />
        <div class="container-fluid py-4 px-5">
            <div class="row">
                <div class="col-12">

                    @if ($errors->any())
                        <div class="alert alert-danger text-white alert-dismissible fade show" role="alert">
                            <span class="text-sm fw-bold">Whoops! Could not save settings:</span>
                            <ul class="mb-0 mt-1 text-sm ps-3">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close text-lg py-3 opacity-10" data-bs-dismiss="alert">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                    @endif

                    <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        {{-- Tab Navigation --}}
                        <ul class="nav nav-tabs mb-0 border-bottom" id="settingsTabs" role="tablist">
                            @foreach([
                                ['id' => 'branding',     'icon' => '🎨', 'label' => 'Branding'],
                                ['id' => 'contact',      'icon' => '📍', 'label' => 'Contact'],
                                ['id' => 'social',       'icon' => '🔗', 'label' => 'Social Media'],
                                ['id' => 'seo',          'icon' => '🔍', 'label' => 'SEO'],
                                ['id' => 'opengraph',    'icon' => '📣', 'label' => 'Open Graph'],
                                ['id' => 'analytics',    'icon' => '📊', 'label' => 'Analytics'],
                                ['id' => 'appearance',   'icon' => '✨', 'label' => 'Appearance'],
                                ['id' => 'maintenance',  'icon' => '🔧', 'label' => 'Maintenance'],
                            ] as $tab)
                            <li class="nav-item" role="presentation">
                                <button class="nav-link {{ $loop->first ? 'active' : '' }} text-sm py-2 px-3"
                                        id="{{ $tab['id'] }}-tab"
                                        data-bs-toggle="tab"
                                        data-bs-target="#{{ $tab['id'] }}"
                                        type="button" role="tab">
                                    {{ $tab['icon'] }} {{ $tab['label'] }}
                                </button>
                            </li>
                            @endforeach
                        </ul>

                        <div class="tab-content" id="settingsTabContent">

                            {{-- ══ TAB 1: BRANDING ══ --}}
                            <div class="tab-pane fade show active" id="branding" role="tabpanel">
                                <div class="card border shadow-xs mb-4 border-top-0 rounded-top-0">
                                    <div class="card-body p-4">
                                        <h6 class="font-weight-semibold text-lg mb-1">Branding</h6>
                                        <p class="text-sm text-secondary mb-4">Site identity, logo and favicon.</p>

                                        <div class="row g-3">
                                            <div class="col-md-6">
                                                <label class="form-label font-weight-bold">Site Name <span class="text-danger">*</span></label>
                                                <input type="text" name="site_name" class="form-control"
                                                       value="{{ old('site_name', $settings->site_name) }}" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label font-weight-bold">Slogan / Tagline</label>
                                                <input type="text" name="site_slogan" class="form-control"
                                                       value="{{ old('site_slogan', $settings->site_slogan) }}"
                                                       placeholder="e.g. Building Tomorrow, Today">
                                            </div>

                                            {{-- Logo --}}
                                            <div class="col-md-4">
                                                <label class="form-label font-weight-bold">Site Logo (Light)</label>
                                                @if($settings->logo_url)
                                                    <div class="mb-2 p-2 bg-dark rounded" style="width:fit-content;">
                                                        <img src="{{ $settings->logo_url }}" alt="Logo" style="height:40px;">
                                                    </div>
                                                @endif
                                                <input type="file" name="site_logo" class="form-control" accept="image/*">
                                                <small class="text-muted">PNG or SVG with transparent background. Max 2MB.</small>
                                            </div>

                                            <div class="col-md-4">
                                                <label class="form-label font-weight-bold">Site Logo (Dark variant)</label>
                                                @if($settings->logo_dark_url)
                                                    <div class="mb-2 p-2 bg-light border rounded" style="width:fit-content;">
                                                        <img src="{{ $settings->logo_dark_url }}" alt="Dark Logo" style="height:40px;">
                                                    </div>
                                                @endif
                                                <input type="file" name="site_logo_dark" class="form-control" accept="image/*">
                                                <small class="text-muted">Used on light backgrounds. Optional.</small>
                                            </div>

                                            <div class="col-md-4">
                                                <label class="form-label font-weight-bold">Favicon</label>
                                                @if($settings->favicon_url)
                                                    <div class="mb-2">
                                                        <img src="{{ $settings->favicon_url }}" alt="Favicon" style="height:32px;width:32px;object-fit:contain;">
                                                    </div>
                                                @endif
                                                <input type="file" name="site_favicon" class="form-control" accept=".ico,.png,.jpg">
                                                <small class="text-muted">ICO or 32×32 PNG. Max 512KB.</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- ══ TAB 2: CONTACT ══ --}}
                            <div class="tab-pane fade" id="contact" role="tabpanel">
                                <div class="card border shadow-xs mb-4 border-top-0 rounded-top-0">
                                    <div class="card-body p-4">
                                        <h6 class="font-weight-semibold text-lg mb-1">Contact Information</h6>
                                        <p class="text-sm text-secondary mb-4">Used in the footer, contact page and emails.</p>

                                        <div class="row g-3">
                                            <div class="col-md-6">
                                                <label class="form-label font-weight-bold">Email Address</label>
                                                <input type="email" name="contact_email" class="form-control"
                                                       value="{{ old('contact_email', $settings->contact_email) }}"
                                                       placeholder="info@example.com">
                                            </div>
                                            <div class="col-md-3">
                                                <label class="form-label font-weight-bold">Primary Phone</label>
                                                <input type="text" name="contact_phone" class="form-control"
                                                       value="{{ old('contact_phone', $settings->contact_phone) }}"
                                                       placeholder="+880 2222 275 392">
                                            </div>
                                            <div class="col-md-3">
                                                <label class="form-label font-weight-bold">Secondary Phone</label>
                                                <input type="text" name="contact_phone_2" class="form-control"
                                                       value="{{ old('contact_phone_2', $settings->contact_phone_2) }}"
                                                       placeholder="+880 ...">
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label font-weight-bold">Address Line 1</label>
                                                <input type="text" name="contact_address" class="form-control"
                                                       value="{{ old('contact_address', $settings->contact_address) }}"
                                                       placeholder="57 Kemal Ataturk Avenue">
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label font-weight-bold">Address Line 2</label>
                                                <input type="text" name="contact_address_2" class="form-control"
                                                       value="{{ old('contact_address_2', $settings->contact_address_2) }}"
                                                       placeholder="Banani C/A, Dhaka 1213, Bangladesh">
                                            </div>
                                            <div class="col-md-12">
                                                <label class="form-label font-weight-bold">Google Maps Embed URL</label>
                                                <input type="url" name="contact_map_embed" class="form-control"
                                                       value="{{ old('contact_map_embed', $settings->contact_map_embed) }}"
                                                       placeholder="https://maps.google.com/maps?...">
                                                    @error('contact_map_embed')
                                                        <span class="text-danger text-xs">{{ $message }}</span>
                                                    @enderror
                                                <small class="text-muted">Google Maps → Share → Embed a map → copy the src URL only.</small>
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label font-weight-bold">Office Opens</label>
                                                <input type="time" name="office_open" class="form-control"
                                                       value="{{ old('office_open', $settings->office_open) }}">
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label font-weight-bold">Office Closes</label>
                                                <input type="time" name="office_close" class="form-control"
                                                       value="{{ old('office_close', $settings->office_close) }}">
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label font-weight-bold">Office Days</label>
                                                <input type="text" name="office_days" class="form-control"
                                                       value="{{ old('office_days', $settings->office_days) }}"
                                                       placeholder="e.g. Sun – Thu">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- ══ TAB 3: SOCIAL MEDIA ══ --}}
                            <div class="tab-pane fade" id="social" role="tabpanel">
                                <div class="card border shadow-xs mb-4 border-top-0 rounded-top-0">
                                    <div class="card-body p-4">
                                        <h6 class="font-weight-semibold text-lg mb-1">Social Media</h6>
                                        <p class="text-sm text-secondary mb-4">Links used in the footer social icons.</p>

                                        <div class="row g-3">
                                            @foreach([
                                                ['name' => 'facebook_url',  'label' => 'Facebook',  'icon' => 'bi-facebook',  'placeholder' => 'https://facebook.com/yourpage'],
                                                ['name' => 'twitter_url',   'label' => 'X / Twitter','icon' => 'bi-twitter-x', 'placeholder' => 'https://x.com/yourhandle'],
                                                ['name' => 'linkedin_url',  'label' => 'LinkedIn',  'icon' => 'bi-linkedin',  'placeholder' => 'https://linkedin.com/company/...'],
                                                ['name' => 'instagram_url', 'label' => 'Instagram', 'icon' => 'bi-instagram', 'placeholder' => 'https://instagram.com/yourhandle'],
                                                ['name' => 'youtube_url',   'label' => 'YouTube',   'icon' => 'bi-youtube',   'placeholder' => 'https://youtube.com/@yourchannel'],
                                                ['name' => 'whatsapp_number','label'=> 'WhatsApp Number','icon'=>'bi-whatsapp','placeholder'=>'8801712345678 (digits only, with country code)'],
                                            ] as $s)
                                            <div class="col-md-6">
                                                <label class="form-label font-weight-bold">{{ $s['label'] }}</label>
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="bi {{ $s['icon'] }}"></i></span>
                                                    <input type="text" name="{{ $s['name'] }}" class="form-control"
                                                           value="{{ old($s['name'], $settings->{$s['name']}) }}"
                                                           placeholder="{{ $s['placeholder'] }}">
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- ══ TAB 4: SEO ══ --}}
                            <div class="tab-pane fade" id="seo" role="tabpanel">
                                <div class="card border shadow-xs mb-4 border-top-0 rounded-top-0">
                                    <div class="card-body p-4">
                                        <h6 class="font-weight-semibold text-lg mb-1">Search Engine Optimisation</h6>
                                        <p class="text-sm text-secondary mb-4">Default meta tags used on pages that don't set their own.</p>

                                        <div class="row g-3">
                                            <div class="col-md-12">
                                                <label class="form-label font-weight-bold">Meta Title <span class="text-muted text-xs">(max 70 chars)</span></label>
                                                <input type="text" name="meta_title" class="form-control" maxlength="70"
                                                       value="{{ old('meta_title', $settings->meta_title) }}"
                                                       placeholder="My Corporate Site – Industry Leading Solutions"
                                                       oninput="updateCount(this,'metaTitleCount')">
                                                <small class="text-muted"><span id="metaTitleCount">{{ strlen($settings->meta_title ?? '') }}</span>/70</small>
                                            </div>
                                            <div class="col-md-12">
                                                <label class="form-label font-weight-bold">Meta Description <span class="text-muted text-xs">(max 160 chars)</span></label>
                                                <textarea name="meta_description" class="form-control" rows="3" maxlength="160"
                                                          placeholder="A short summary of your site shown in Google search results…"
                                                          oninput="updateCount(this,'metaDescCount')">{{ old('meta_description', $settings->meta_description) }}</textarea>
                                                <small class="text-muted"><span id="metaDescCount">{{ strlen($settings->meta_description ?? '') }}</span>/160</small>
                                            </div>
                                            <div class="col-md-8">
                                                <label class="form-label font-weight-bold">Meta Keywords</label>
                                                <input type="text" name="meta_keywords" class="form-control"
                                                       value="{{ old('meta_keywords', $settings->meta_keywords) }}"
                                                       placeholder="logistics, shipping, corporate, bangladesh">
                                                <small class="text-muted">Comma-separated. Low SEO value today but harmless.</small>
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label font-weight-bold">Author</label>
                                                <input type="text" name="meta_author" class="form-control"
                                                       value="{{ old('meta_author', $settings->meta_author) }}"
                                                       placeholder="Your Company Name">
                                            </div>
                                            <div class="col-md-12">
                                                <label class="form-label font-weight-bold">Default OG / Share Image</label>
                                                @if($settings->og_image_url)
                                                    <div class="mb-2">
                                                        <img src="{{ $settings->og_image_url }}" alt="OG Image"
                                                             style="max-height:80px;border-radius:8px;border:1px solid #ddd;">
                                                    </div>
                                                @endif
                                                <input type="file" name="meta_image" class="form-control" accept="image/*">
                                                <small class="text-muted">Recommended 1200×630px. Shown when sharing links on social media.</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- ══ TAB 5: OPEN GRAPH ══ --}}
                            <div class="tab-pane fade" id="opengraph" role="tabpanel">
                                <div class="card border shadow-xs mb-4 border-top-0 rounded-top-0">
                                    <div class="card-body p-4">
                                        <h6 class="font-weight-semibold text-lg mb-1">Open Graph & Twitter Card</h6>
                                        <p class="text-sm text-secondary mb-4">Controls how links appear when shared on Facebook, LinkedIn, X etc.</p>

                                        <div class="row g-3">
                                            <div class="col-md-12">
                                                <label class="form-label font-weight-bold">OG Title <span class="text-muted text-xs">(max 95 chars)</span></label>
                                                <input type="text" name="og_title" class="form-control" maxlength="95"
                                                       value="{{ old('og_title', $settings->og_title) }}"
                                                       placeholder="Leave blank to use Meta Title">
                                            </div>
                                            <div class="col-md-12">
                                                <label class="form-label font-weight-bold">OG Description <span class="text-muted text-xs">(max 200 chars)</span></label>
                                                <textarea name="og_description" class="form-control" rows="2" maxlength="200"
                                                          placeholder="Leave blank to use Meta Description">{{ old('og_description', $settings->og_description) }}</textarea>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label font-weight-bold">OG Type</label>
                                                <select name="og_type" class="form-select">
                                                    <option value="website"  {{ ($settings->og_type ?? 'website')  === 'website'  ? 'selected' : '' }}>website</option>
                                                    <option value="article"  {{ ($settings->og_type ?? '')         === 'article'  ? 'selected' : '' }}>article</option>
                                                </select>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label font-weight-bold">Twitter Card Style</label>
                                                <select name="twitter_card" class="form-select">
                                                    <option value="summary_large_image" {{ ($settings->twitter_card ?? 'summary_large_image') === 'summary_large_image' ? 'selected' : '' }}>summary_large_image (big image)</option>
                                                    <option value="summary"             {{ ($settings->twitter_card ?? '') === 'summary' ? 'selected' : '' }}>summary (small thumbnail)</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- ══ TAB 6: ANALYTICS ══ --}}
                            <div class="tab-pane fade" id="analytics" role="tabpanel">
                                <div class="card border shadow-xs mb-4 border-top-0 rounded-top-0">
                                    <div class="card-body p-4">
                                        <h6 class="font-weight-semibold text-lg mb-1">Analytics & Tracking</h6>
                                        <p class="text-sm text-secondary mb-4">IDs are injected into every page automatically.</p>

                                        <div class="row g-3">
                                            <div class="col-md-6">
                                                <label class="form-label font-weight-bold">Google Analytics ID</label>
                                                <input type="text" name="google_analytics_id" class="form-control"
                                                       value="{{ old('google_analytics_id', $settings->google_analytics_id) }}"
                                                       placeholder="G-XXXXXXXXXX">
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label font-weight-bold">Google Tag Manager ID</label>
                                                <input type="text" name="google_tag_manager_id" class="form-control"
                                                       value="{{ old('google_tag_manager_id', $settings->google_tag_manager_id) }}"
                                                       placeholder="GTM-XXXXXXX">
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label font-weight-bold">Google Site Verification</label>
                                                <input type="text" name="google_site_verification" class="form-control"
                                                       value="{{ old('google_site_verification', $settings->google_site_verification) }}"
                                                       placeholder="Paste the content="" value here">
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label font-weight-bold">Facebook Pixel ID</label>
                                                <input type="text" name="facebook_pixel_id" class="form-control"
                                                       value="{{ old('facebook_pixel_id', $settings->facebook_pixel_id) }}"
                                                       placeholder="123456789012345">
                                            </div>
                                            <div class="col-md-12">
                                                <label class="form-label font-weight-bold">Custom &lt;head&gt; Scripts</label>
                                                <textarea name="header_scripts" class="form-control font-monospace" rows="4"
                                                          placeholder="<!-- Paste any <script> or <meta> tags to inject into <head> -->">{{ old('header_scripts', $settings->header_scripts) }}</textarea>
                                            </div>
                                            <div class="col-md-12">
                                                <label class="form-label font-weight-bold">Custom Footer Scripts <span class="text-muted text-xs">(before &lt;/body&gt;)</span></label>
                                                <textarea name="footer_scripts" class="form-control font-monospace" rows="4"
                                                          placeholder="<!-- Paste any <script> tags to inject before </body> -->">{{ old('footer_scripts', $settings->footer_scripts) }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- ══ TAB 7: APPEARANCE ══ --}}
                            <div class="tab-pane fade" id="appearance" role="tabpanel">
                                <div class="card border shadow-xs mb-4 border-top-0 rounded-top-0">
                                    <div class="card-body p-4">
                                        <h6 class="font-weight-semibold text-lg mb-1">Appearance</h6>
                                        <p class="text-sm text-secondary mb-4">Site-wide colours, footer text and announcement bar.</p>

                                        <div class="row g-3">
                                            <div class="col-md-4">
                                                <label class="form-label font-weight-bold">Primary / Accent Colour</label>
                                                <div class="d-flex align-items-center gap-2">
                                                    <input type="color" name="primary_color" class="form-control form-control-color"
                                                           value="{{ old('primary_color', $settings->primary_color ?? '#C8102E') }}"
                                                           style="width:48px;height:38px;">
                                                    <span class="text-sm text-muted">Used for buttons, links and accents</span>
                                                </div>
                                            </div>
                                            <div class="col-md-8">
                                                <label class="form-label font-weight-bold">Footer Copyright Text</label>
                                                <input type="text" name="footer_text" class="form-control"
                                                       value="{{ old('footer_text', $settings->footer_text) }}"
                                                       placeholder="© 2025 My Corporate Site. All rights reserved.">
                                                <small class="text-muted">Leave blank to auto-generate from site name + year.</small>
                                            </div>
                                            <div class="col-md-9">
                                                <label class="form-label font-weight-bold">Announcement Bar Message</label>
                                                <input type="text" name="announcement_bar" class="form-control"
                                                       value="{{ old('announcement_bar', $settings->announcement_bar) }}"
                                                       placeholder="🎉 We are now serving 40+ countries! Learn more →">
                                            </div>
                                            <div class="col-md-3 d-flex align-items-end pb-1">
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" type="checkbox"
       name="announcement_bar_active" id="announcementActive"
       value="1" {{ (old('_token') ? old('announcement_bar_active') : $settings->announcement_bar_active) ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="announcementActive">Show Bar</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- ══ TAB 8: MAINTENANCE ══ --}}
                            <div class="tab-pane fade" id="maintenance" role="tabpanel">
                                <div class="card border shadow-xs mb-4 border-top-0 rounded-top-0">
                                    <div class="card-body p-4">
                                        <h6 class="font-weight-semibold text-lg mb-1">Maintenance Mode</h6>
                                        <p class="text-sm text-secondary mb-4">When enabled, visitors see the maintenance message instead of the site. Logged-in admins can still browse normally.</p>

                                        <div class="row g-3">
                                            <div class="col-md-12">
                                                <div class="form-check form-switch mb-3">
                                                    <input class="form-check-input" type="checkbox"
       name="maintenance_mode" id="maintenanceMode"
       value="1" {{ (old('_token') ? old('maintenance_mode') : $settings->maintenance_mode) ? 'checked' : '' }}>
                                                    <label class="form-check-label font-weight-bold" for="maintenanceMode">
                                                        Enable Maintenance Mode
                                                        @if($settings->maintenance_mode)
                                                            <span class="badge bg-warning text-dark ms-2">CURRENTLY ON</span>
                                                        @endif
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <label class="form-label font-weight-bold">Maintenance Message</label>
                                                <textarea name="maintenance_message" class="form-control" rows="3"
                                                          placeholder="We're performing scheduled maintenance. We'll be back shortly!">{{ old('maintenance_message', $settings->maintenance_message) }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>{{-- end tab-content --}}

                        {{-- Sticky Save Button --}}
                        <div class="d-flex justify-content-end mt-2 mb-4">
                            <button type="submit" class="btn btn-dark px-5">
                                💾 Save All Settings
                            </button>
                        </div>

                    </form>
                </div>
            </div>
            <x-app.footer />
        </div>
    </main>

    <script>
        // Character counters for SEO fields
        function updateCount(input, spanId) {
            document.getElementById(spanId).textContent = input.value.length;
        }
    </script>
</x-app-layout>