<?php

namespace App\Service;

use Symfony\Component\HttpClient\HttpClient;

class TheMovieDbService
{
    private $apiKey;
    private $client;

    public function __construct(string $apiKey)
    {
        $this->apiKey = $apiKey;
        $this->client = HttpClient::create();
    }

    public function discoverMovies(array $parameters = [])
    {
        $parameters['api_key'] = $this->apiKey;

        $response = $this->client->request('GET', 'https://api.themoviedb.org/3/discover/movie', [
            'query' => $parameters,
        ]);

        $statusCode = $response->getStatusCode();

        if ($statusCode === 200) {
            return $response->toArray();
        } else {
            throw new \Exception('Une erreur s\'est produite lors de la récupération des données.');
        }
    }
}
