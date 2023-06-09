<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MovieController extends AbstractController
{
    #[Route('/movie', name: 'app_movie')]
    public function index(): Response
    {
        $apiKey = '2fab5b95cf684fbdfcaed81aa7e44344';
        $apiUrl = 'https://api.themoviedb.org/3/movie/popular?api_key=' . $apiKey;

        $httpClient = HttpClient::create();
        $response = $httpClient->request('GET', $apiUrl);
        $movies = $response->toArray()['results'];

        return $this->render('movie/index.html.twig', [
            'movies' => $movies,
        ]);
    }
}
