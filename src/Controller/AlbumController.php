<?php
namespace App\Controller;

use App\Entity\Album;
use App\Form\AlbumType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\Routing\Annotation\Route;

class AlbumController extends Controller
{

    /**
     * Post one album
     * (Route to display Form Use, not really useful with API Platform)
     *
     * @Route("/api/test/albums", methods={"POST"})
     *
     * @param Request $request
     *
     * @return JsonResponse | BadRequestHttpException
     */
    public function createAlbum(Request $request)
    {
        $album = new Album();
        $form = $this->createForm(AlbumType::class, $album);
        $form->handleRequest($request);
        $form->submit($request);

        if ($form->isSubmitted() && $form->isValid()) {
                $form->getData();
                $em = $this->getDoctrine()->getManager();
                $em->persist($album);
                $em->flush();

            return new JsonResponse($album, 200);
        }
        return new BadRequestHttpException("Not submitted!");
    }
}
