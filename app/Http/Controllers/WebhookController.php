<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

class WebhookController extends Controller
{
    public function handleWebhook(Request $request)
    {
        $process = Process::fromShellCommandline('git pull origin inertia');

        $process->run();

        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }

        return response('Webhook handled', 200);
    }
}