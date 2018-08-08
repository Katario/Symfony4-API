<?php

namespace App\Controller;


use App\Entity\Album;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

class AlbumController extends Controller {

    /**
     * Return all albums
     * @Route("/api/albums", methods={"GET"})
     *
     * @return Response
     */
    public function allAlbums() {
        $repository = $this->getDoctrine()->getRepository(Album::class);
        $albums     = $repository->findAll();

        $encoder    = new JsonEncoder();
        $normalizer = new ObjectNormalizer();

        $normalizer->setCircularReferenceHandler(function ($object) {
            return $object->getId();
        });

        $serializer = new Serializer([$normalizer], [$encoder]);
        $response = new Response($serializer->serialize($albums, 'json'));

        return $response;
    }

    /**
     * Return one album
     *
     * @Route("/api/albums/{id}")
     *
     * @ParamConverter("album", class="App\Entity\Album", options={"mapping": {"id": "id"}})
     *
     * @param Album $album
     * @return Response
     */
    public function oneAlbum(Album $album) {
        $encoder    = new JsonEncoder();
        $normalizer = new ObjectNormalizer();

        $normalizer->setCircularReferenceHandler(function ($object) {
            return $object->getId();
        });

        $serializer = new Serializer([$normalizer], [$encoder]);

        $response   = new Response($serializer->serialize($album, 'json'));

        return $response;
    }

    /**
     * Post one album
     * @Route("/api/albums", methods={"POST"})
     *
     * @param EntityManagerInterface $em
     * @param Request $request
     * @return Response
     */
    public function newAlbum(EntityManagerInterface $em, Request $request) {

        $album = new Album();
        $album->setTitle('This is a title');
        $album->setArtist('This is an artist');
        $album->setYear(2018);
        $album->setImg('This is an image');

        $em->persist($album);
        $em->flush();

        $response = new Response();

        return $response;
    }
}