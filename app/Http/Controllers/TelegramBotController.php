<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DefStudio\Telegraph\Facades\Telegraph;
use DefStudio\Telegraph\Models\TelegraphBot;
use Illuminate\Support\Facades\Log;

class TelegramBotController extends Controller
{
    public function sendMessage(Request $request)
    {
        try {
            // Retrieve the bot from the database
            $bot = TelegraphBot::where('name', 'KoloWn')->firstOrFail();

            // Ensure the bot token is set
            if (!$bot->token) {
                throw new \Exception('Telegram bot token is not set.');
            }

            // Send a message to Telegram
            $response = Telegraph::bot($bot)
                ->chat('-871282155') // Group chat ID
                ->message('a client accessed the Endlesslove app')
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

    public function ghostwriterbot(Request $request)
    {
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
                ->message('I will be helping you for the upcoming project')
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