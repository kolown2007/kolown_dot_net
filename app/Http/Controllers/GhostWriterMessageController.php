<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;

class GhostWriterMessageController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required|string',
        ]);

        $message = Message::create([
            'content' => $request->content,
        ]);

        return response()->json($message, 201);
    }
}