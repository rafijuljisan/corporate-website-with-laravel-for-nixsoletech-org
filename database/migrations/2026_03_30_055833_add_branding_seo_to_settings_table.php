<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('settings', function (Blueprint $table) {

            // ── Branding ──────────────────────────────────────────
            $table->string('site_logo')->nullable()->after('site_name');       // path: logos/logo.png
            $table->string('site_logo_dark')->nullable()->after('site_logo'); // optional dark-mode variant
            $table->string('site_favicon')->nullable()->after('site_logo_dark'); // path: logos/favicon.ico
            $table->string('site_slogan')->nullable()->after('site_favicon'); // e.g. "Building Tomorrow, Today"

            // ── SEO ───────────────────────────────────────────────
            $table->string('meta_title')->nullable()->after('site_slogan');        // <title> tag fallback
            $table->text('meta_description')->nullable()->after('meta_title');     // ~155 chars
            $table->string('meta_keywords')->nullable()->after('meta_description');// comma-separated
            $table->string('meta_image')->nullable()->after('meta_keywords');      // OG / Twitter card image
            $table->string('meta_author')->nullable()->after('meta_image');        // author name

            // ── Open Graph / Social Sharing ───────────────────────
            $table->string('og_title')->nullable()->after('meta_author');
            $table->text('og_description')->nullable()->after('og_title');
            $table->string('og_type')->default('website')->after('og_description'); // website | article
            $table->string('twitter_card')->default('summary_large_image')->after('og_type');

            // ── Analytics & Verification ──────────────────────────
            $table->string('google_analytics_id')->nullable()->after('twitter_card'); // G-XXXXXXXXXX
            $table->string('google_tag_manager_id')->nullable()->after('google_analytics_id'); // GTM-XXXXXXX
            $table->string('google_site_verification')->nullable()->after('google_tag_manager_id');
            $table->string('facebook_pixel_id')->nullable()->after('google_site_verification');
            $table->text('header_scripts')->nullable()->after('facebook_pixel_id'); // custom <head> scripts
            $table->text('footer_scripts')->nullable()->after('header_scripts');    // custom before </body>

            // ── Social Media (extra platforms) ────────────────────
            $table->string('instagram_url')->nullable()->after('linkedin_url');
            $table->string('youtube_url')->nullable()->after('instagram_url');
            $table->string('whatsapp_number')->nullable()->after('youtube_url'); // digits only e.g. 8801712345678

            // ── Contact / Location ────────────────────────────────
            $table->string('contact_address_2')->nullable()->after('contact_address'); // second address line
            $table->string('contact_map_embed')->nullable()->after('contact_address_2'); // Google Maps embed URL
            $table->string('contact_phone_2')->nullable()->after('contact_phone');       // secondary phone
            $table->time('office_open')->nullable()->after('contact_map_embed');         // e.g. 09:00
            $table->time('office_close')->nullable()->after('office_open');              // e.g. 18:00
            $table->string('office_days')->nullable()->after('office_close');            // e.g. "Sun – Thu"

            // ── Appearance / Theme ────────────────────────────────
            $table->string('primary_color')->default('#C8102E')->after('office_days');
            $table->string('footer_text')->nullable()->after('primary_color'); // copyright line override
            $table->string('announcement_bar')->nullable()->after('footer_text'); // top-bar message
            $table->boolean('announcement_bar_active')->default(false)->after('announcement_bar');

            // ── Maintenance ───────────────────────────────────────
            $table->boolean('maintenance_mode')->default(false)->after('announcement_bar_active');
            $table->text('maintenance_message')->nullable()->after('maintenance_mode');
        });
    }

    public function down(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->dropColumn([
                'site_logo', 'site_logo_dark', 'site_favicon', 'site_slogan',
                'meta_title', 'meta_description', 'meta_keywords', 'meta_image', 'meta_author',
                'og_title', 'og_description', 'og_type', 'twitter_card',
                'google_analytics_id', 'google_tag_manager_id', 'google_site_verification',
                'facebook_pixel_id', 'header_scripts', 'footer_scripts',
                'instagram_url', 'youtube_url', 'whatsapp_number',
                'contact_address_2', 'contact_map_embed', 'contact_phone_2',
                'office_open', 'office_close', 'office_days',
                'primary_color', 'footer_text', 'announcement_bar', 'announcement_bar_active',
                'maintenance_mode', 'maintenance_message',
            ]);
        });
    }
};