<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service; 
// use App\Models\Gallery; // (Uncomment if you want to loop through individual gallery items too)

class SitemapController extends Controller
{
    public function index()
    {
        // Fetch your dynamic data
        $services = Service::where('is_active', true)->get();
        
        // Return the view as an XML document
        return response()->view('sitemap.index', compact('services'))
                         ->header('Content-Type', 'text/xml');
    }
}