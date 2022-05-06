<?php

namespace App\Controller;

use App\Entity\Hermano;
use App\Entity\Hermandad;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Doctrine\Persistence\ManagerRegistry;




class HermandadController extends AbstractController
{

    /* Get hermandades: 

        -Método para obtener toda la información de las hermandades (id / nombre)

    */
    #[Route('/api/hermandades', name: 'hermandades_get', methods: ['GET'])]
    function getHermandades(ManagerRegistry $doctrine) : Response{

        $entityManager = $doctrine->getManager();
        $hermandades = $entityManager->getRepository(Hermandad::class)->findAll();

        $listaHermandades = array();
        foreach ($hermandades as $hermandad) {

            $result = new \stdClass();
            $result->id = $hermandad->getId();
            $result->nombre = $hermandad->getNombre();
            
            array_push($listaHermandades, $result);
            
        }
        return new JsonResponse($listaHermandades);
    }


}