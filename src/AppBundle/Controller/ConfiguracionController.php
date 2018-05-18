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
        $password = $this->getUser()->getPassword();

        $id = $this->getUser()->getId();     
        $user = $usuario->find($id); 

        $formulario=$this->createForm('AppBundle\Form\UserType',$user);
              
        $formulario->handleRequest($peticion);

        if($formulario->isSubmitted()) {

            $form = $formulario->getData();

            $contra = $formulario->getData()->getPassword();

            if($contra == $password) {

                $em->persist($form);
                $em->flush();
            }
            else {

                $form->setPassword(password_hash($form->getPassword(), PASSWORD_BCRYPT));
                $em->persist($form);
                $em->flush();
            }

            return $this->redirectToRoute("configuracion");
        }    
       
         return $this->render("perfil/configuracion.html.twig", 
         ["user" => $user, "formulario" => $formulario->createView(), "usu" => $usu]);


    }
}
