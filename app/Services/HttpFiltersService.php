<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use App\Contracts\FiltersServiceContract;

class HttpFiltersService implements FiltersServiceContract
{
    public function getFilters()
    {
        $endpoint = "https://run.mocky.io/v3/06b8dd68-7d6d-4857-85ff-b58e204acbf4";
        return Http::get($endpoint)->json()['data'];
    }
}
