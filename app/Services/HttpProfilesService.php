<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use App\Contracts\ProfilesServiceContract;

class HttpProfilesService implements ProfilesServiceContract
{
    public function getProfiles()
    {
        $endpoint = "https://run.mocky.io/v3/c7a4777f-e383-4122-8a89-70f29a6830c0";
        return Http::get($endpoint)->json()['data'];
    }
}
