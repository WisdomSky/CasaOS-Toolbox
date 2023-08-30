<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Symfony\Component\Process\Process;

class Toolbox
{
    public function getToolboxLatestVersion() {

        $url = 'https://registry.hub.docker.com/v2/repositories/wisdomsky/casaos-toolbox/tags/?page_size=100&page=1';

        try {
            $response = Http::get($url);

            if ($response->successful()) {

                $data = $response->json();

                $tags = collect($data['results'])->filter(function($tag){
                    return $tag['name'] !== 'latest';
                })->values();

                return $tags[0]['name'];
            } else {
                return null;
            }
        } catch (\Exception $e) {

            return $e->getMessage();
        }
    }


}
