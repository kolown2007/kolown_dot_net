<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use OpenAI\Laravel\Facades\OpenAI;
use Illuminate\Http\Request;

class OpenAIController extends Controller
{
    public function readAndProcessFile()
    {
        // Read the message.txt file
        $message = Storage::get('message.txt');

        // Use the OpenAI API to process the text
    $result = OpenAI::chat()->create([
        'model' => 'gpt-3.5-turbo',
        'messages' => [
            ['role' => 'user', 'content' => $message],
        ],
    ]);

    // Print the response
    dd($result->choices[0]->message->content);
    }
}
