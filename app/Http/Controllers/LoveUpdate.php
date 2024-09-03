<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Love;

class LoveUpdate extends Controller
{
  

    public function updateLove(Request $request)
    {
        $love = Love::first();
        if ($love) {
            $love->love += 10;
            $love->save();
        } else {
            Love::create(['love' => 10]);
        }

        return response()->json(['message' => 'Love count updated'], 200);
    }

}
