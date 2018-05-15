<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class ConfiguracionController extends Controller
{

    /**
     * 
     * @Route("/Perfil", name="configuracion")
     * 
     */
    public function configuracionAction(Request $peticion) {

        $em = $this->getDoctrine()->getManager();
        $usuario = $em->getRepository("AppBundle\Entity\User");

            $usu = $this->getUser()->getUsername();
            $id = $this->getUser()->getId();     
            $user = $usuario->find($id); 

            $formulario=$this->createForm('AppBundle\Form\UserType',$user);
    
            
            $formulario->handleRequest($peticion);

            if($formulario->isSubmitted()) {

                $em->flush();  
                $password = $this->getUser()->getPassword();
                $contra = $this->getUser()->setPassword(password_hash($password, PASSWORD_BCRYPT));
                $em->persist($contra);
                $em->flush();
                return $this->redirectToRoute("configuracion");
            }    
       
         return $this->render("perfil/configuracion.html.twig", 
         ["user" => $user, "formulario" => $formulario->createView(), "usu" => $usu]);


    }
}
