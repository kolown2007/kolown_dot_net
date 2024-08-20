<?php
namespace App\Http\Controllers;
use Symfony\Component\BrowserKit\HttpBrowser;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\DomCrawler\Crawler;

use Illuminate\Http\Request;

class WebScrapController extends Controller
{
    public function scrapeHeadline()
    {
        $client = new HttpBrowser(HttpClient::create());
        $crawler = $client->request('GET', 'https://www.rappler.com/'); // Example news website

        // Adjust the CSS selector to match the main headline element on the target website
     

        // $headlineNode = $crawler->filter('h3 > a')->first();

        // if ($headlineNode->count() > 0) {
        //     $headline = $headlineNode->text();
        // } else {
        //     $headline = 'No headline found';
        // }

        $headlineNodes = $crawler->filter('h3');

        $headlines = [];
        $headlineNodes->each(function (Crawler $node) use (&$headlines) {
            $headlines[] = $node->text();
        });

        return response()->json(['main_headline' => $headlines]);
    }
}
 