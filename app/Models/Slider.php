<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'subtitle',
        'description',
        'image_path',
        'button_text',
        'button_url',
        'button_text_2',
        'button_url_2',
        'badge_label',
        'overlay_color',
        'overlay_opacity',
        'order',
        'is_active',
    ];

    protected $casts = [
        'is_active'       => 'boolean',
        'overlay_opacity' => 'integer',
        'order'           => 'integer',
    ];

    // ── Scopes ──────────────────────────────────────────

    /** Only published, sorted by the admin-defined order */
    public function scopeActive($query)
    {
        return $query->where('is_active', true)->orderBy('order');
    }

    // ── Accessors ────────────────────────────────────────

    /** Returns a full public URL for use in <img src=""> */
    public function getImageUrlAttribute(): string
    {
        return asset('storage/' . $this->image_path);
    }

    /**
     * Converts overlay_color (#hex) + overlay_opacity (0-100)
     * into an rgba() CSS value ready to drop into inline styles.
     */
    public function getOverlayCssAttribute(): string
    {
        $hex     = ltrim($this->overlay_color, '#');
        $r       = hexdec(substr($hex, 0, 2));
        $g       = hexdec(substr($hex, 2, 2));
        $b       = hexdec(substr($hex, 4, 2));
        $opacity = round($this->overlay_opacity / 100, 2);

        return "rgba({$r}, {$g}, {$b}, {$opacity})";
    }
}