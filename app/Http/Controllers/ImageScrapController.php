<?php

namespace App\Http\Controllers;

use Symfony\Component\BrowserKit\HttpBrowser;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\DomCrawler\Crawler;
use Illuminate\Http\Request;

class ImageScrapController extends Controller
{
    public function leeumimagescrapper()
    {
        $url = 'https://www.leeumhoam.org/leeum/collection/modern?params=Y';
        $browser = new HttpBrowser(HttpClient::create());

        try {
            $crawler = $browser->request('GET', $url);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to fetch the URL'], 500);
        }

        $images = [];
        try {
            $crawler->filter('img')->each(function (Crawler $node, $i) use (&$images, $url) {
                $src = $node->attr('src') ?: $node->attr('data-src');
                if ($src) {
                    // Convert relative URLs to absolute URLs
                    if (parse_url($src, PHP_URL_SCHEME) === null) {
                        $src = rtrim($url, '/') . '/' . ltrim($src, '/');
                    }
                    $images[] = htmlspecialchars($src, ENT_QUOTES, 'UTF-8');
                }
            });
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to parse the HTML'], 500);
        }
    
        return response()->json($images);
    }





    
}