<?php

namespace App\Http\Controllers;
use OpenAI\Laravel\Facades\OpenAI;
use Symfony\Component\BrowserKit\HttpBrowser;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\DomCrawler\Crawler;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Exception;

use App\Models\Message;

class GhostwriterController extends Controller
{
    public function ghoststory(){

        $client = new HttpBrowser(HttpClient::create());
        $crawler = $client->request('GET', 'https://www.rappler.com/'); // Example news website
        $headlineNodes = $crawler->filter('h3');

        $headlines = [];
        $headlineNodes->each(function (Crawler $node) use (&$headlines) {
            $headlines[] = $node->text();
        });

        $headlines = array_map('htmlspecialchars', $headlines);

        // Convert the array of headlines into a single string
        $headlinesString = implode(', ', $headlines);


        //get text from submissions
        $contents = Message::pluck('content');
        //delete the messages
        Message::truncate();


        // Use the OpenAI API to process the text
        $result = OpenAI::chat()->create([
            'model' => 'gpt-4o-mini',
            'messages' => [
                ['role' => 'user', 
                'content' => "
                create a fictional scifi fictional story, make it like star wars like based on: $headlinesString and make inspiration from: $contents
                make the new story 15 sentence line long, each sentence story is connected to each other, include scifi concepts like time-travel, aliens, space, and robots."],
               
            ],

            
        ]);

        $story = $result['choices'][0]['message']['content'] ?? 'No story generated.';

        //return response()->json(['story' => $story]);
        $filePath = storage_path('app/public/story.txt');
        file_put_contents($filePath, $story);

        return response($story, 200)
        ->header('Content-Type', 'text/plain');
    
    }


    //story APi function

    public function ghoststory2(){
            // Define the path to the .txt file
    $filePath = storage_path('app/public/story.txt');

    // Check if the file exists
    if (!file_exists($filePath)) {
        return response('File not found.', 404)
            ->header('Content-Type', 'text/plain');
    }

    // Read the contents of the file
    $story = file_get_contents($filePath);

    // Return the contents in the response
    return response($story, 200)
        ->header('Content-Type', 'text/plain');

    }


}
