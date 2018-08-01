<?php

namespace App\Controller;


use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class AlbumController {

  /**
   * @Route("/test")
   *
   * @return \Symfony\Component\HttpFoundation\JsonResponse
   */
  public function helloWorld() {
    $response = new JsonResponse([
      'ping' => 'pong'
    ]);

    return $response;
  }
}