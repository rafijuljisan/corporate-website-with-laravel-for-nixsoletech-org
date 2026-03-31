<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use Illuminate\Http\Request;

class ContactMessageController extends Controller
{
    // Fetch all messages and show the inbox
    public function index()
    {
        // Get all messages, sorted by the newest ones first
        $messages = ContactMessage::latest()->get();
        return view('admin.messages.index', compact('messages'));
    }

    // Delete a message
    public function destroy(ContactMessage $message)
    {
        $message->delete();
        return redirect()->back()->with('success', 'Message deleted successfully.');
    }
}