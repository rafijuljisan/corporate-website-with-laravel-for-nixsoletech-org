<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\ContactMessage;
use App\Models\Faq;
use App\Models\Slider;

class PublicController extends Controller
{
    public function home()
    {
        // Active sliders
        $sliders = Slider::active()->get();

        // Active services 
        $services = Service::where('is_active', true)->take(6)->get();

        // Grab exactly 6 active gallery images for the homepage
        $homeGalleries = \App\Models\Gallery::where('is_active', true)->latest()->take(6)->get();

        return view('public.home', compact('sliders', 'services', 'homeGalleries'));
    }

    public function about()
    {
        return view('public.about');
    }

    public function contact()
    {
        return view('public.contact');
    }

    public function submitContact(Request $request)
    {
        $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        ContactMessage::create($request->all());

        return redirect()->route('contact')->with('success', 'Thank you for reaching out! We will get back to you shortly.');
    }

    public function faq()
    {
        $faqs = Faq::where('is_active', true)->get();

        return view('public.faq', compact('faqs'));
    }
    // Add this method inside your PublicController
    public function services()
    {
        // Fetch all active services
        $services = \App\Models\Service::where('is_active', true)->get();

        return view('public.services', compact('services'));
    }
    // Add this method inside your PublicController
    public function showService(\App\Models\Service $service)
    {
        // If someone tries to access a hidden service, show a 404 page
        abort_if(!$service->is_active, 404);

        return view('public.service_show', compact('service'));
    }
    public function gallery()
    {
        $galleries = \App\Models\Gallery::where('is_active', true)->latest()->get();
        return view('public.gallery', compact('galleries'));
    }
    public function career()
    {
        $jobs = \App\Models\Career::where('is_active', true)->latest()->get();
        return view('public.career', compact('jobs'));
    }
}