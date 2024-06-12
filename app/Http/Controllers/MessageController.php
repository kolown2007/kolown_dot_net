<?php

//this controller is for reading the messages in message.txt file 

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;

class MessageController extends Controller
{
    public function showMessage()
{
    // Read the content of the message.txt file
    $message = Storage::get('message.txt');

    // Convert the string into an array of lines
    $lines = explode("\n", $message);

    // Wrap the lines in <pre> tags and return them
    return '<pre>' . implode("\n", $lines) . '</pre>';
}
}