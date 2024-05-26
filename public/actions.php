<?php
// Define the directory of your Git repository
$repo_dir = '/kolown_dot_net/kolown_dot_net';

// Define the command you want to execute
$command = 'git pull origin inertia';

// Change to the repository directory
chdir($repo_dir);

// Execute the command
$output = shell_exec($command);

// Output the result
echo "<pre>Command executed: $command</pre>";
echo "<pre>$output</pre>";
?>