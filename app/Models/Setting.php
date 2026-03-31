<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Setting extends Model
{
    protected $fillable = [
        // Original columns
        'site_name', 'contact_email', 'contact_phone', 'contact_address',
        'facebook_url', 'twitter_url', 'linkedin_url',

        // Branding
        'site_logo', 'site_logo_dark', 'site_favicon', 'site_slogan',

        // SEO
        'meta_title', 'meta_description', 'meta_keywords', 'meta_image', 'meta_author',

        // Open Graph
        'og_title', 'og_description', 'og_type', 'twitter_card',

        // Analytics
        'google_analytics_id', 'google_tag_manager_id', 'google_site_verification',
        'facebook_pixel_id', 'header_scripts', 'footer_scripts',

        // Social extras
        'instagram_url', 'youtube_url', 'whatsapp_number',

        // Contact extras
        'contact_address_2', 'contact_map_embed', 'contact_phone_2',
        'office_open', 'office_close', 'office_days',

        // Appearance
        'primary_color', 'footer_text', 'announcement_bar', 'announcement_bar_active',

        // Maintenance
        'maintenance_mode', 'maintenance_message',
    ];

    protected $casts = [
        'announcement_bar_active' => 'boolean',
        'maintenance_mode'        => 'boolean',
    ];

    // ── Singleton helper ──────────────────────────────────
    // Usage anywhere: Setting::get() or app('settings')
    public static function get(): self
    {
        return Cache::rememberForever('site_settings', function () {
            return self::firstOrCreate([], ['site_name' => 'My Corporate Site']);
        });
    }

    // Call this after saving so the cache reflects changes immediately
    public static function clearCache(): void
    {
        Cache::forget('site_settings');
    }

    // ── URL Accessors (returns full public URL or null) ───
    public function getLogoUrlAttribute(): ?string
    {
        return $this->site_logo ? asset('storage/' . $this->site_logo) : null;
    }

    public function getLogoDarkUrlAttribute(): ?string
    {
        return $this->site_logo_dark ? asset('storage/' . $this->site_logo_dark) : null;
    }

    public function getFaviconUrlAttribute(): ?string
    {
        return $this->site_favicon ? asset('storage/' . $this->site_favicon) : null;
    }

    public function getOgImageUrlAttribute(): ?string
    {
        return $this->meta_image ? asset('storage/' . $this->meta_image) : null;
    }
}