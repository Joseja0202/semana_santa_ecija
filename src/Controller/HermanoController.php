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




class HermanoController extends AbstractController
{
    /*Get hermano for id 

    -Metodo GET para obtener un hermano por id

    */
        #[Route('/api/hermano/{id}', name: 'heramano_get', methods: ['GET'])]
        function getHermanoforId(ManagerRegistry $doctrine ,$id) : Response{
        
        $entityManager = $doctrine->getManager();
        $hermano = $entityManager->getRepository(Hermano::class)->find($id);


        if ($hermano == null) {
            return new JsonResponse([
                'error' => 'Hermano no encontrado'
            ], 404);
        }

        $result = new \stdClass();
        $result->id = $hermano->getId();
        $result->apellido1 = $hermano->getApellido1();
        $result->apellido2 = $hermano->getApellido2();
        $result->fecha_nacimiento = $hermano->getFechaNacimiento();
        $result->telefono = $hermano->getTelefono();
        $result->direccion = $hermano->getDireccion();
        $result->dni = $hermano->getDni();
        $result->hermandad = $hermano->getHermandad()->getId();
        
        return new JsonResponse($result);
    }




    /*Get hermanos

    -Metodo GET para obtener todos los hermanos

    */
    #[Route('/api/hermanos', name: 'hermanos_get', methods: ['GET'])]
    function getHermanos(ManagerRegistry $doctrine) : Response{

        $entityManager = $doctrine->getManager();
        $hermanos = $entityManager->getRepository(Hermano::class)->findAll();

        $listaHermanos = array();
        foreach ($hermanos as $hermano) {

            $result = new \stdClass();
            $result->id = $hermano->getId();
            $result->apellido1 = $hermano->getApellido1();
            $result->apellido2 = $hermano->getApellido2();
            $result->fecha_nacimiento = $hermano->getFechaNacimiento();
            $result->telefono = $hermano->getTelefono();
            $result->direccion = $hermano->getDireccion();
            $result->dni = $hermano->getDni();
            $result->hermandad = $hermano->getHermandad()->getId();
            
            array_push($listaHermanos, $result);
            
        }
        return new JsonResponse($listaHermanos);
    }


    /*Get hermanos por cada hermandad

    -Metodo GET para obtener todos los hermanos de cada hermandad

    */
    #[Route('/api/listaHermanos/{idHermandad}', name: 'tareas_idHermandad', methods: ['GET'])]
    function getListaHermanosIdHermandad(ManagerRegistry $doctrine ,$idHermandad) : Response{

    $entityManager = $doctrine->getManager();
    $hermandad = $entityManager->getRepository(Hermandad::class)->find($idHermandad);


    if ($hermandad == null) {
        return new JsonResponse([
            'error' => 'Hermandad no encontrada'
        ], 404);
    }

    $result = new \stdClass();
    $result->id = $hermandad->getId();
    $result->hermanos = array();
    foreach ($hermandad->getHermanos() as $hermano) {
        $result->hermanos[] = $this->generateUrl('hermanos_get', [
            'id' => $hermano->getId(),
        ], UrlGeneratorInterface::ABSOLUTE_URL);
    }

    return new JsonResponse($result);
    }



    /*Post hermano

    -Metodo POST para crear un hermano
    
    */
    #[Route('/api/hermano', name: 'hermano_post', methods: ['POST'])]
    function postHermano(ManagerRegistry $doctrine, Request $request) : Response{

        $entityManager = $doctrine->getManager();
        $hermandad = $entityManager->getRepository(Hermandad::class)->findOneBy(['id' => $request->request->get('hermandad')]);

        if ($hermandad == null){
        return new JsonResponse([
            'error' => 'Hermano no creado'
        ], 404);
        }  
        
        

        $hermano = new Hermano();
        $hermano->setNombre($request->request->get("nombre"));
        $hermano->setApellido1($request->request->get("apellido1"));
        $hermano->setApellido2($request->request->get("apellido2"));
        $hermano->setFechaNacimiento($request->request->get("fechaNacimiento"));
        $hermano->setTelefono($request->request->get("telefono"));
        $hermano->setDireccion($request->request->get("direccion"));
        $hermano->setDni($request->request->get("dni"));
        $hermano->setHermandad($hermandad);
        $entityManager->persist($hermano);
        $entityManager->flush();

        $result = new \stdClass();
        $result->id = $hermano->getId();
        $result->nombre = $hermano->getNombre();
        $result->apellido1 = $hermano->getApellido1();
        $result->apellido2 = $hermano->getApellido2();
        $result->fecha_nacimiento = $hermano->getFechaNacimiento();
        $result->telefono = $hermano->getTelefono();
        $result->direccion = $hermano->getDireccion();
        $result->dni = $hermano->getDni();
        $result->hermandad = $hermano->getHermandad()->getId();


        

        return new JsonResponse($result);

    }





    /*Put hermano

    -Metodo PUT para crear un hermano
    
    */
    #[Route('/api/hermano/{id}', name: 'hermano_put', methods: ['PUT'])]
    function putHermano(ManagerRegistry $doctrine,Request $request, $id) {

        $entityManager = $doctrine->getManager();
        $hermano = $entityManager->getRepository(Hermano::class)->find($id);

        if ($hermano == null) {
            return new JsonResponse([
            'error' => 'Hermano incorrecto'
            ], 404);
        }
        
        $fecha = date_create_from_format("d-m-Y" , $request->request->get("fechaNacimiento"));

        $hermano->setNombre($request->request->get("nombre"));
        $hermano->setApellido1($request->request->get("apellido1"));
        $hermano->setApellido2($request->request->get("apellido2"));
        $hermano->setFechaNacimiento($fecha);
        $hermano->setTelefono($request->request->get("telefono"));
        $hermano->setDireccion($request->request->get("direccion"));
        $hermano->setDni($request->request->get("dni"));
        
        $entityManager->flush();

        $result = new \stdClass();
        $result->id = $hermano->getId();
        $result->nombre = $hermano->getNombre();
        $result->apellido1 = $hermano->getApellido1();
        $result->apellido2 = $hermano->getApellido2();
        $result->fecha_nacimiento = $hermano->getFechaNacimiento();
        $result->telefono = $hermano->getTelefono();
        $result->direccion = $hermano->getDireccion();
        $result->dni = $hermano->getDni();
        $result->hermandad = $hermano->getHermandad()->getId();

        return new JsonResponse($result);
    }





    /*Delete hermano

    -Metodo DELETE para crear un hermano
    
    */
    #[Route('/api/hermano/{id}', name: 'hermano_delete', methods: ['DELETE'])]
    function deleteHermano(ManagerRegistry $doctrine, $id) {

        $entityManager = $doctrine->getManager();
        $hermano = $entityManager->getRepository(Hermano::class)->find($id);

        if ($hermano == null) {
            return new JsonResponse([
            'error' => 'Hermano no encontrado'], 404);
        }

        $entityManager->remove($hermano);
        $entityManager->flush();

        return new JsonResponse(null,204);
    }



}