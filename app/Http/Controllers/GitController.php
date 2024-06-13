<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GitController extends Controller
{
    public function pull()
    {
        // Define the directory of your Git repository
        $repo_dir = base_path('kolown_app');
        
        // Define the commands you want to execute
        $git_command = 'git pull origin inertia';
        $composer_command = 'composer install';
    
        // Change to the repository directory
        chdir($repo_dir);
    
        // Execute the git command
        $git_output = shell_exec($git_command);
    
        // Execute the composer command
        $composer_output = shell_exec($composer_command);
    
        // Output the result
        return response()->json([
            'git_command_executed' => $git_command,
            'git_output' => $git_output,
            'composer_command_executed' => $composer_command,
            'composer_output' => $composer_output,
        ]);
    }
}
