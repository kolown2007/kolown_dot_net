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


        $headlineNodes = $crawler->filter('h3');

        $headlines = [];
        $headlineNodes->each(function (Crawler $node) use (&$headlines) {
            $headlines[] = $node->text();
        });

        return response()->json(['main_headline' => $headlines]);
    }
}
 