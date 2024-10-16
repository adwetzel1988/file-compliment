<?php

namespace App\Http\Controllers;

use App\Models\Complaint;
use App\Models\Message;
use App\Notifications\NewMessageNotification;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function store(Request $request, Complaint $complaint)
    {
        $validatedData = $request->validate([
            'content' => 'required|string',
        ]);

        $message = new Message([
            'content' => $validatedData['content'],
            'sender_id' => auth()->id(),
        ]);

        $complaint->messages()->save($message);

        // Send notification to the user if the complaint has a user and the user is not the sender
        if ($complaint->user && $complaint->user->id !== auth()->id()) {
            $complaint->user->notify(new NewMessageNotification($message));
        }

        return redirect()->back()->with('success', 'Message sent successfully.');
    }
}
