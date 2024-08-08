<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GitController extends Controller
{
    public function pull()
    {
        // Define the directory of your Git repository
        $repo_dir = base_path('/kolown_dot_net/kolown_dot_net');

        // Define the command you want to execute
        $command = 'git pull origin inertia';

        // Check if the directory exists
        if (is_dir($repo_dir)) {
            // Attempt to change to the repository directory
            if (chdir($repo_dir)) {
                // Execute the command
                $output = shell_exec($command);

                // Output the result
                return response()->json([
                    'command_executed' => $command,
                    'output' => $output,
                ]);
            } else {
                return response()->json([
                    'error' => "Failed to change directory to $repo_dir",
                ], 500);
            }
        } else {
            return response()->json([
                'error' => "Directory $repo_dir does not exist",
            ], 404);
        }
    }
}
