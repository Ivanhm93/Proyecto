<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use AppBundle\Entity\User;

class AutenticacionController extends Controller
{

    /**
     *
     * @Route("/registro", name="registro")
     * 
     */
    public function registroAction(Request $peticion) {

        $usuario=new User();
        $rol=$this->getDoctrine()->getRepository("AppBundle\Entity\Rol");
        $rol=$rol->find("1");

        $formulario=$this->createForm('AppBundle\Form\UserType',$usuario);

            $formulario->handleRequest($peticion);

            //Condición que se ejecuta si se envía el formulario y es válido
            if($formulario->isSubmitted() && $formulario->isValid())
            {

                $em = $this->getDoctrine()->getManager();
                $user_repo = $em->getRepository('AppBundle:User');
                
                //Consulta a la base de datos que consulta si el username existe
                $query = $em->createQuery('SELECT u FROM AppBundle:User u WHERE u.nick = :nick');
                
                $user_isset = $query->getResult();

                $usuario=$formulario->getData();

                //Encripta la contraseña introducida
                $usuario->setPassword(password_hash($usuario->getPassword(), PASSWORD_BCRYPT));
                $usuario->addRol($rol);

                $em=$this->getDoctrine()->getManager();
                $em->persist($usuario);
                $em->flush();

                return $this->redirectToRoute("homepage");
            }

            //LLamada a la vista
            return $this->render(
            "autenticacion/registro.html.twig", ["formulario"=>$formulario->createView()]);
    }


    /**
     *
     * @Route("/nick-test", name="nick")
     * 
     */
    public function nickAction(Request $peticion) {

        //Recojo por GET el username
        $nick = $peticion->get("nick");
			
        $em = $this->getDoctrine()->getManager();

        //Buscar el username recogido por GET en la base de datos
        $user_repo = $em->getRepository("AppBundle:User");
        $user_isset = $user_repo->findOneBy(array ("username" => $nick));
        
        //Condición que se ejecuta si se encuentra el username en la base de datos
        if(count($user_isset) >= 1 && is_object($user_isset)) {
            
            $result = "usado";
        }
        //Se ejecuta si no encuentra el username en la base de datos
        else {
            
            $result = "sinusar";
        }
        
        return new Response($result);
    }

    /**
     *
     * @Route("/login", name="login")
     * 
     */
    public function loginAction(Request $request)
    {
        //Creo el formulario del login
        $formulario=$this->createFormBuilder()
        ->add("username",TextType::class, array(
            'label' => 'Usuario',
            'attr' => array(
            'class' => 'form-control',
            'style' => 'margin-bottom:2%'
        )))
        ->add("password",PasswordType::class, array(
            'label' => 'Contraseña',
            'attr' => array(
            'class' => 'form-control'
        )))
        ->add("Login",SubmitType::class, array(
            'label' => 'Inicio',
            'attr' => array(
            'class' => 'form-submit btn btn-primary',
            'style' => 'margin-top:8%')))
        ->getForm();

        //Utilizo herramientas de seguridad de las que dispone por defecto Symfony
       $autenticacionUtils=$this->get('security.authentication_utils');
       $error=$autenticacionUtils->getLastAuthenticationError();
       return $this->render("autenticacion/Login.html.twig",
    ["error"=>$error,"formulario"=>$formulario->createView()]);
    }

    /**
     * @Route("/login_check", name="login_check_seguridad")
     *
     * @return void
     */
    public function loginCheckAction()
    {

    }

    /**
     * @Route("/logout", name="logout")
     */
    public function logoutAction()
    {

    }


    /**
     * @Route("/loginRedireccion", name="loginRedireccion")
     */
    public function loginRedireccion()
    {
        
        return $this->redirectToRoute('homepage');

    }

}
