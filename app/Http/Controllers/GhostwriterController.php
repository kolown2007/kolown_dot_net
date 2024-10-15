<?php

namespace App\Http\Controllers;
use OpenAI\Laravel\Facades\OpenAI;
use Symfony\Component\BrowserKit\HttpBrowser;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\DomCrawler\Crawler;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Exception;

use DefStudio\Telegraph\Facades\Telegraph;
use DefStudio\Telegraph\Models\TelegraphBot;
use Illuminate\Support\Facades\Log;

use App\Models\Message;

class GhostwriterController extends Controller
{
    private $headlinesString;
    private $contents;
    private $story;

    public function ghoststory()
    {
        try {
            $this->fetchHeadlines();
            $this->getAndClearMessages();
            $this->generateStory();
            $this->sendToTelegram();
            $this->saveStoryToFile();

            return response($this->story, 200)
                ->header('Content-Type', 'text/plain');
        } catch (Exception $e) {
            Log::error('Error generating ghost story', ['error' => $e->getMessage()]);
            return response('Failed to generate story', 500)
                ->header('Content-Type', 'text/plain');
        }
    }

    private function fetchHeadlines()
    {
        $client = new HttpBrowser(HttpClient::create());
        $crawler = $client->request('GET', 'https://www.rappler.com/');
        $headlineNodes = $crawler->filter('h3');

        $headlines = [];
        $headlineNodes->each(function (Crawler $node) use (&$headlines) {
            $headlines[] = $node->text();
        });

        $headlines = array_map('htmlspecialchars', $headlines);

        // Convert the array of headlines into a single string
        $this->headlinesString = implode(', ', $headlines);
    }

    private function getAndClearMessages()
    {
        $this->contents = Message::pluck('content');
        Message::truncate();
    }

    private function generateStory()
    {
        $result = OpenAI::chat()->create([
            'model' => 'gpt-4o-mini',
            'messages' => [
                [
                    'role' => 'user',
                    'content' => "
                        create a fictional scifi story, make it like star wars based on: {$this->headlinesString} and make inspiration from: {$this->contents}.
                        Make the new story 15 sentences long, each sentence connected to the next, including scifi concepts like time-travel, aliens, space, and robots."
                ],
            ],
        ]);

        $this->story = $result['choices'][0]['message']['content'] ?? 'No story generated.';
    }

    private function sendToTelegram()
    {
        try {
            $bot = TelegraphBot::where('name', 'KoloWn')->firstOrFail();

            if (!$bot->token) {
                throw new \Exception('Telegram bot token is not set.');
            }

            $response = Telegraph::bot($bot)
                ->chat('-4593600795') // Ghostwriter chat ID
                ->message('ghostStory: <b>' . htmlspecialchars($this->story) . '</b>')
                ->send();

            Log::info('Telegram message sent successfully', ['response' => $response]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            Log::error('Failed to send Telegram message: Bot not found', ['error' => $e->getMessage()]);
            throw new Exception('Bot not found');
        } catch (\Exception $e) {
            Log::error('Failed to send Telegram message', ['error' => $e->getMessage()]);
            throw new Exception('Failed to send message');
        }
    }

    private function saveStoryToFile()
    {
        $filePath = storage_path('app/public/story.txt');
        file_put_contents($filePath, $this->story);
    }

    public function ghoststory2()
    {
        $filePath = storage_path('app/public/story.txt');

        if (!file_exists($filePath)) {
            return response('File not found.', 404)
                ->header('Content-Type', 'text/plain');
        }

        $story = file_get_contents($filePath);

        return response($story, 200)
            ->header('Content-Type', 'text/plain');
    }
}