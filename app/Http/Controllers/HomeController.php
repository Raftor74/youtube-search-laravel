<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Modules\YouTube\VideoSearch;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $videoList = [];
        $maxResults = (int)$request->get('max_results', 20);
        $query = (string)$request->get('query', '');
        $maxResultsList = [
            ['name' => 10, 'value' => 10],
            ['name' => 20, 'value' => 20],
            ['name' => 50, 'value' => 50],
        ];

        if (strlen($query)) {
            $client = $this->getYouTubeSearchClient();
            $videoList = $client->search($query, $maxResults);
        }

        return view('index', [
            'videoList' => $videoList,
            'maxResults' => $maxResults,
            'query' => $query,
            'maxResultsList' => $maxResultsList,
        ]);
    }

    public function about()
    {
        return view('about');
    }

    protected function getYouTubeSearchClient()
    {
        $url = config('services.youtube.url');
        $apiKey = config('services.youtube.api_key');
        return new VideoSearch($url, $apiKey);
    }

}
