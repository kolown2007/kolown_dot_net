<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

class NodeController extends Controller
{
    public function runCommands()
    {
        // Define the directory of your Node.js project
        $node_dir = base_path('');

        // Define the commands you want to execute
        $commands = [
            'npm install',
            //'npm run build'
        ];

        // Check if the directory exists
        if (is_dir($node_dir)) {
            // Attempt to change to the Node.js project directory
            if (chdir($node_dir)) {
                $output = [];

                // Execute each command
                foreach ($commands as $command) {
                    $process = Process::fromShellCommandline($command);
                    $process->setWorkingDirectory($node_dir);
                    $process->run();

                    // Check if the process was successful
                    if (!$process->isSuccessful()) {
                        return response()->json([
                            'error' => $process->getErrorOutput(),
                        ], 500);
                    }

                    // Collect the output
                    $output[] = $process->getOutput();
                }

                // Output the result
                return response()->json([
                    'commands_executed' => $commands,
                    'output' => $output,
                ]);
            } else {
                return response()->json([
                    'error' => "Failed to change directory to $node_dir",
                ], 500);
            }
        } else {
            return response()->json([
                'error' => "Directory $node_dir does not exist",
            ], 404);
        }
    }
}