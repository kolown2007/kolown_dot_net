<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;

use DefStudio\Telegraph\Facades\Telegraph;
use DefStudio\Telegraph\Models\TelegraphBot;
use Illuminate\Support\Facades\Log;

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

       
        //telegram bot function
        try {
            // Retrieve the bot from the database
            $bot = TelegraphBot::where('name', 'KoloWn')->firstOrFail();

            // Ensure the bot token is set
            if (!$bot->token) {
                throw new \Exception('Telegram bot token is not set.');
            }

            // Send a message to Telegram
            $response = Telegraph::bot($bot)
                ->chat('-4593600795') // Ghostwriter chat ID
                ->message('comsec:' . "<b> $request->content </b>")
                ->send();

            // Log the response for debugging
            Log::info('Telegram message sent successfully', ['response' => $response]);

            return response()->json(['message' => 'Route accessed']);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            // Log the error for debugging
            Log::error('Failed to send Telegram message: Bot not found', ['error' => $e->getMessage()]);

            return response()->json(['message' => 'Bot not found'], 404);
        } catch (\Exception $e) {
            // Log the error for debugging
            Log::error('Failed to send Telegram message', ['error' => $e->getMessage()]);

            return response()->json(['message' => 'Failed to send message'], 500);
        }
    }


    }
