<?php

namespace Sorethea\Assign;

use Illuminate\Support\Facades\Http;

class Assign
{
    public function justDoIt(){
        $response = Http::get('https://inspiration.goprogram.ai/');
        return $response['quote'] . ' -' . $response['author'];
    }
}
