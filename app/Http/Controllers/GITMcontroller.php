<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GITMcontroller extends Controller
{
    public function gitm()
    {
        // Your logic here
        
        // Example response data
        $data = [
            [
                'key' => 'mountain',
                'url' => 'https://archive.kolown.net/wp-content/uploads/2024/06/favicon.jpg'
            ],
            [
                'key' => 'mountain2',
                'url' => 'https://archive.kolown.net/wp-content/uploads/2024/06/3.jpg'
            ]
        ];
        
        return response()->json($data);
    }
}
