<?php

namespace Sorethea\Assign;

class Assign
{
    public function justDoIt(){
        $response = Http::get('https://inspiration.goprogram.ai/');
        return $response['quote'] . ' -' . $response['author'];
    }
}
