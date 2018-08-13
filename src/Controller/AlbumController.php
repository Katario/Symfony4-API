<?php
namespace App\Controller;

use App\Entity\Album;
use App\Form\AlbumType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AlbumController extends Controller
{

    /**
     * Post one album
     * (Route to display Form Use, not really useful with API Platform)
     *
     * @Route("/api/test/albums", methods={"POST"})
     *
     * @param EntityManagerInterface $em
     * @param Request $request
     * @return Response
     * @throws \Exception
     */
    public function createAlbum(EntityManagerInterface $em, Request $request) {
        $album = new Album();
        $form = $this->createForm(AlbumType::class, $album);
        $form->handleRequest($request);
        $form->submit($request);

        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $data = $form->getData();

                $album->setTitle($data->getTitle());
                $album->setArtist($data->getArtist());
                $album->setYear($data->getYear());
                $album->setImg($data->getImg());

                $em = $this->getDoctrine()->getManager();
                $em->persist($album);
                $em->flush();

            }
            catch(\Exception $e) {
                /* TODO add the errors properly */
                throw new \Exception('Something went wrong!');
            }

            return new JsonResponse($album);
        }
        throw new \Exception("Not submitted!");
    }
}
