<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    // Shows the settings form
    // Shows the settings form
    public function index()
    {
        // FIX: Ensure you are getting the first single row, or creating it if it doesn't exist
        $settings = Setting::firstOrCreate([]);

        return view('admin.settings.index', compact('settings'));
    }

    // Saves all settings
    public function update(Request $request)
    {
        $request->validate([
            'site_name'          => 'required|string|max:255',
            'site_slogan'        => 'nullable|string|max:255',
            'site_logo'          => 'nullable|image|mimes:png,jpg,jpeg,svg,webp|max:2048',
            'site_logo_dark'     => 'nullable|image|mimes:png,jpg,jpeg,svg,webp|max:2048',
            'site_favicon'       => 'nullable|mimes:ico,png,jpg,jpeg|max:512',
            'contact_email'      => 'nullable|email|max:255',
            'contact_phone'      => 'nullable|string|max:50',
            'contact_phone_2'    => 'nullable|string|max:50',
            'contact_address'    => 'nullable|string|max:500',
            'contact_address_2'  => 'nullable|string|max:500',
            'contact_map_embed' => 'nullable|string',
            'office_open'  => 'nullable|string',
            'office_close' => 'nullable|string',
            'office_days'        => 'nullable|string|max:100',
            'meta_title'         => 'nullable|string|max:70',
            'meta_description'   => 'nullable|string|max:160',
            'meta_keywords'      => 'nullable|string|max:500',
            'meta_image'         => 'nullable|image|mimes:png,jpg,jpeg,webp|max:2048',
            'meta_author'        => 'nullable|string|max:255',
            'og_title'           => 'nullable|string|max:95',
            'og_description'     => 'nullable|string|max:200',
            'og_type'            => 'nullable|in:website,article',
            'twitter_card'       => 'nullable|in:summary,summary_large_image',
            'google_analytics_id'       => 'nullable|string|max:30',
            'google_tag_manager_id'     => 'nullable|string|max:30',
            'google_site_verification'  => 'nullable|string|max:100',
            'facebook_pixel_id'         => 'nullable|string|max:50',
            'header_scripts'     => 'nullable|string',
            'footer_scripts'     => 'nullable|string',
            'facebook_url'       => 'nullable|string|max:255',
            'twitter_url'        => 'nullable|string|max:255',
            'linkedin_url'       => 'nullable|string|max:255',
            'instagram_url'      => 'nullable|string|max:255',
            'youtube_url'        => 'nullable|string|max:255',
            'whatsapp_number'    => 'nullable|string|max:20',
            'primary_color'      => 'nullable|string|max:7',
            'footer_text'        => 'nullable|string|max:500',
            'announcement_bar'   => 'nullable|string|max:255',
            'maintenance_message'=> 'nullable|string|max:1000',
        ]);

        $settings = Setting::firstOrCreate([]);
        $data     = $request->except(['_token', '_method',
                        'site_logo', 'site_logo_dark', 'site_favicon', 'meta_image']);

        // ── File uploads ──────────────────────────────────
        foreach ([
            'site_logo'      => 'logos',
            'site_logo_dark' => 'logos',
            'site_favicon'   => 'logos',
            'meta_image'     => 'seo',
        ] as $field => $folder) {
            if ($request->hasFile($field)) {
                // Delete old file
                if ($settings->$field) {
                    Storage::disk('public')->delete($settings->$field);
                }
                $data[$field] = $request->file($field)->store($folder, 'public');
            }
        }

        // ── Booleans (checkboxes) ─────────────────────────
        $data['announcement_bar_active'] = $request->boolean('announcement_bar_active');
        $data['maintenance_mode']        = $request->boolean('maintenance_mode');

        $settings->update($data);

        // Clear cache so changes appear immediately everywhere
        Setting::clearCache();

        return redirect()->route('admin.settings.index')
                         ->with('success', 'Settings saved successfully.');
    }
}