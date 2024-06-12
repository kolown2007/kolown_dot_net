<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use OpenAI\Laravel\Facades\OpenAI;
use Illuminate\Http\Request;

class OpenAIController extends Controller
{
  
    public function aiTextRevision()
    {
        // Read the message.txt file
        $message = Storage::get('message.txt');

        // Read the current storyline
        $message2 = Storage::get('currentstory.txt');

        
        // Use the OpenAI API to process the text
        $result = OpenAI::chat()->create([
            'model' => 'gpt-3.5-turbo',
            'messages' => [
                ['role' => 'user', 'content' => "
                revise this story: $message based on the input from this text as inspiration: $message2
                make the new story 15 sentence line long"],
               
            ],
        ]);

        // Copy the current message.txt content to the archive folder
        $date = date('d_m');
        $messageArchive = "archive/message{$date}.txt";
        $storyArchive = "archive/story{$date}.txt";
        Storage::copy('message.txt', $messageArchive);
        Storage::copy('currentstory.txt', $storyArchive);

        // Empty the text inside the message.txt and currentstory file
        Storage::put('message.txt', '');
        Storage::put('currentstory.txt', $result->choices[0]->message->content);

       $newStory = Storage::get('currentstory.txt');

       $newStoryArray = preg_split('/(?<=[.!?])\s+/', $newStory);
       return '<pre>' . implode("\n", $newStoryArray) . '</pre>';
    }

    }

