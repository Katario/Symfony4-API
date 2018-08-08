<?php

namespace App\Controller;


use App\Entity\Song;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class SongController {

    /**
     * Post song
     * @Route("/api/songs", methods={"POST"})
     *
     * @param EntityManagerInterface $em
     * @param Request $request
     * @return Response
     */
    public function newSong(EntityManagerInterface $em, Request $request) {

        $song = new Song();
        $song->setTitle('This is a title');
        $song->setLength('This is an artist');
        $song->setRating(2018);
//        $song->addAlbum($this->getDoctrine()->getRepository());

        $em->persist($song);
        $em->flush();

        $response = new Response();

        return $response;
    }
}