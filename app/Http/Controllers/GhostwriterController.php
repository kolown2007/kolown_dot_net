<?php

namespace App\Http\Controllers;
use OpenAI\Laravel\Facades\OpenAI;

use Symfony\Component\BrowserKit\HttpBrowser;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\DomCrawler\Crawler;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Exception;

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

        // Use the OpenAI API to process the text
        $result = OpenAI::chat()->create([
            'model' => 'gpt-4o-mini',
            'messages' => [
                ['role' => 'user', 
                'content' => "
                create a fictional scifi fictional story, make it like star wars like based on: $headlinesString 
                make the new story 15 sentence line long, each sentence story is connected to each other, include scifi concepts like time-travel, aliens, space, and robots."],
               
            ],

            
        ]);

        $story = $result['choices'][0]['message']['content'] ?? 'No story generated.';

        //return response()->json(['story' => $story]);

        return response($story, 200)
        ->header('Content-Type', 'text/plain');



    
    }

    
}
