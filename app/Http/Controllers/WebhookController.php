<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WebhookController extends Controller
{
    public function handleWebhook(Request $request)
    {
        // Define the directory of your Git repository
        $repo_dir = '/kolown_dot_net/kolown_dot_net';

        // Define the command you want to execute
        $command = 'git pull origin main';

        // Change to the repository directory
        chdir($repo_dir);

        // Execute the command
        $output = shell_exec($command);

        // Return the output
        return response("<pre>Command executed: $command</pre><pre>$output</pre>", 200)
            ->header('Content-Type', 'text/html');
    }
}