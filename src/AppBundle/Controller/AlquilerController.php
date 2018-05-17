<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use AppBundle\Entity\Apartamento;
use AppBundle\Form\ApartamentoType;

class AlquilerController extends Controller
{

    /**
     * 
     * @Route("/Alquiler", name="alquiler")
     * 
     */
    public function alquilerAction(Request $peticion) {

        $apartamento=new Apartamento();
        $formulario=$this->createForm('AppBundle\Form\ApartamentoType',$apartamento);
        $em = $this->getDoctrine()->getManager();
        $id = $this->getUser()->getId();
        $propiedad = $em->getRepository("AppBundle\Entity\Apartamento")->findBy(array('user'=> $id));
        $alquilado = $em->getRepository("AppBundle\Entity\Alquiler")->findBy(array('user'=> $id));

        $formulario->handleRequest($peticion);

        if($formulario->isSubmitted()) {

             // Recogemos el fichero
             $foto=$formulario['imagen']->getData();
            
             // Sacamos la extensión del fichero
             $ext=$foto->guessExtension();
             
             // Le ponemos un nombre al fichero
             $galeria_nombre=time().".".$ext;
             
             // Guardamos el fichero en el directorio uploads que estará en el directorio /web del framework
             $foto->move("imagenes", $galeria_nombre);
             
             // Establecemos el nombre de fichero en el atributo de la entidad
             $apartamento->setImagen($galeria_nombre);

            $apartamento=$formulario->getData();
            $usuario = $this->getUser();
            $apartamento->setUser($usuario);
            $em=$this->getDoctrine()->getManager();
            $em->persist($apartamento);
            $em->flush();

            return $this->redirectToRoute("alquiler");
        }
        
        //LLamada a la vista
        return $this->render("perfil/alquiler.html.twig",
        ["formulario"=>$formulario->createView(), "propiedad" => $propiedad, "alquilado" => $alquilado]);
    }

     /**
     * 
     * @Route("/Alquiler/Borrar/{id}", name="borrarAlquiler")
     * 
     */
    public function borrarAlquilerAction($id) {

        $apartamento=$this->getDoctrine()->getRepository("AppBundle\Entity\Apartamento");
        $apartamento=$apartamento->findOneBy(array('id' => $id));

        $query = $this->getDoctrine()->getManager()->createQuery('delete FROM AppBundle:Apartamento ap where ap.id =:id')
                      ->setParameter('id', $id);;
        $result = $query->getResult();
        
        $us=$this->getDoctrine()->getManager();
        $us->persist($apartamento);
        $us->flush();

        return $this->redirectToRoute("alquiler");
    }
}
