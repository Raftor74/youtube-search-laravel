<?php

namespace App\Modules\YouTube;

use GuzzleHttp\Client;

class VideoSearch
{
    protected $url;
    protected $apiKey;

    public function __construct(string $url, string $apiKey)
    {
        $this->url = $url;
        $this->apiKey = $apiKey;
    }

    public function search(string $query, int $maxResults = 20): array
    {
        $params = $this->getSearchParams($query, $maxResults);
        $client = new Client();
        $response = $client->request('GET', $this->url, ['query' => $params]);
        $responseData = json_decode($response->getBody(), true);
        return $this->makeVideoListFromResponse($responseData);
    }

    protected function getSearchParams(string $query, int $maxResults)
    {
        return [
            'key' => $this->apiKey,
            'part' => 'snippet',
            'maxResults' => $maxResults,
            'q' => $query,
            'type' => 'video',
        ];
    }

    protected function makeVideoListFromResponse(array $response): array
    {
        $list = [];
        foreach ($response['items'] as $item) {
            $list[] = $this->makeVideoFromResponse($item);
        }
        return $list;
    }

    protected function makeVideoFromResponse(array $response): Video
    {
        $snippet = $response['snippet'];
        $images = $snippet['thumbnails'];
        $videoId = $response['id']['videoId'];
        $title = $snippet['title'];
        $imgUrl = $images['medium']['url'];
        return new Video($videoId, $title, $imgUrl);
    }
}
