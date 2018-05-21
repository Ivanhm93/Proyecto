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

        //Recojo el username y la password del usuario logeado
        $usu = $this->getUser()->getUsername();
        $password = $this->getUser()->getPassword();

        //Recojo la id del usuario logeado
        $id = $this->getUser()->getId();     
        $user = $usuario->find($id); 

        $formulario=$this->createForm('AppBundle\Form\UserType',$user);
              
        $formulario->handleRequest($peticion);

        //Condición que se ejecuta si se envía el formulario
        if($formulario->isSubmitted()) {

            $form = $formulario->getData();

            $contra = $formulario->getData()->getPassword();

            //Condición que se ejecuta si no se ha modificado la password del usuario
            if($contra == $password) {

                $em->persist($form);
                $em->flush();
            }
            //Se ejecuta si se ha modificado la password del usuario
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
