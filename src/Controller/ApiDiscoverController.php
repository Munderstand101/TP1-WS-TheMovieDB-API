<?php

namespace App\Controller;

use App\Service\TheMovieDbService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ApiDiscoverController extends AbstractController
{

    private $theMovieDbService;

    public function __construct(TheMovieDbService $theMovieDbService)
    {
        $this->theMovieDbService = $theMovieDbService;
    }

    #[Route('/api/discover/movie', name: 'api_discover_movie',methods: ["GET"])]
    public function discoverMovies(): JsonResponse
    {
        try {
            $movies = $this->theMovieDbService->discoverMovies();

            return new JsonResponse($movies);
        } catch (\Exception $e) {
            return new JsonResponse(['error' => $e->getMessage()], 500);
        }
    }
}
