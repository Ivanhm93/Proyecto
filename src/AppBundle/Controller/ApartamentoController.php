<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Comentario;
use AppBundle\Entity\User;
use AppBundle\Entity\Foto;
use AppBundle\Entity\Alquiler;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class ApartamentoController extends Controller
{
    /**
     * @Route("/Apartamento/{id}", name="apartamento")
     * @param Request $query
     */
    public function apartamentoAction($id, Request $peticion, Request $peticion2,
    Request $peticion3, Request $peticion4, Request $peticion5)
    {

        $alquiler=new Alquiler();

        $apartamento=$this->getDoctrine()->getRepository("AppBundle\Entity\Apartamento");
        $apartamento=$apartamento->findOneBy(array('id' => $id));
        $fotito = $apartamento->getImagen();

        $slider = $this->getDoctrine()->getRepository("AppBundle\Entity\Foto");
        $slider = $slider->findBy(array('apartamento' => $id));

        $correo1 = $apartamento->getUser()->getId();
        $correo2=$this->getDoctrine()->getRepository("AppBundle\Entity\User");
        $correo2=$correo2->findOneBy(array('id' => $correo1));
        $correo=$correo2->getEmail();

        $comentario=new Comentario();
        $formulario=$this->createForm('AppBundle\Form\ComentarioType',$comentario);
        $user = new User();

        $loged = $this->getUser()->getId();
        $usuario=$this->getDoctrine()->getRepository("AppBundle\Entity\User");
        $usuario = $usuario->findOneBy(array('id' => $loged));

        $nombre = $this->getUser()->getNombre();
        $apellido = $this->getUser()->getNombre(); 

        $galeria=new Foto();
        $formulario2=$this->createForm('AppBundle\Form\FotoType',$galeria);

        $totales = $this->getDoctrine()->getRepository("AppBundle\Entity\Comentario");
        $totales = $totales->findAll();

        $fecha =  date('d/m/Y');

        //Creo el formulario
        $formulario5=$this->createFormBuilder()
        ->add("nombre",TextType::class, array(
            'label' => 'Nombre',
            'attr' => array(
            'class' => 'form-control',
        )))
        ->add("apellidos",TextType::class, array(
            'label' => 'Apellidos',
            'attr' => array(
            'class' => 'form-control',
        )))
        ->add("telefono",TextType::class, array(
            'label' => 'Teléfono',
            'attr' => array(
            'class' => 'form-control',
        )))
        ->add("email",EmailType::class, array(
            'label' => 'Email',
            'attr' => array(
            'class' => 'form-control',
        )))
        ->add("mensaje",TextareaType::class, array(
            'label' => 'Mensaje',
            'attr' => array(
            'class' => 'form-control',
            'style' => 'max-height: 200px; min-height: 100px;'
        )))
        ->add("enviar",SubmitType::class, array(
            'label' => 'Enviar',
            'attr' => array(
            'class' => 'form-submit btn btn-primary',
            'style' => 'margin-top:5%')))
        ->getForm();

        if ($peticion5->isMethod('POST')) {

            $formulario5->handleRequest($peticion5);

            if ($formulario5->isValid()) {

                $nombre = $formulario5->getData()['nombre'];
                $apellidos = $formulario5->getData()['apellidos'];
                $email = $formulario5->getData()['email'];
                $telefono = $formulario5->getData()['telefono'];
                $mensaje = $formulario5->getData()['mensaje'];
                $cuerpo = "Un usuario de la web chustor.es desea alquilar su apartamento en $apartamento"."\n\n\n"."Datos de contacto: "."\n"."Nombre: $apellidos".", ".$nombre."\n"."Teléfono: ".$telefono."\n"."Email: ".$email."\n"."Mensaje: ".$mensaje;
                mail($correo,"Alquiler Apartamento: $apartamento",$cuerpo) ;
            }
        }

        $formulario4=$this->createForm('AppBundle\Form\AlquilerType',$alquiler);
        $formulario4->handleRequest($peticion4);

        if($formulario4->isSubmitted())
        {

            $alquilado=$formulario4->getData();

            $em4=$this->getDoctrine()->getManager();
            $alquiler->setApartamentoId($id);
            $em4->persist($alquilado);
            $em4->flush();

        }

        $formulario3=$this->createForm('AppBundle\Form\ApartamentoType',$apartamento);
        $formulario3->handleRequest($peticion3);

        if($formulario3->isSubmitted())
        {

            $em2=$this->getDoctrine()->getManager();
            $update=$formulario3->getData();

            if($update->getImagen() == null) {

                $updateImagen=$formulario3->getData()->setImagen($fotito);
                $em2->persist($updateImagen);
                $em2->flush();
            }
            else {
 
                $em2->persist($update);
                $em2->flush();
            }

        }

        $formulario->handleRequest($peticion);

        if($formulario->isSubmitted())
        {

            $comentario=$formulario->getData();
            $comentario->setFecha($fecha);
            $comentario->setNombre($nombre);
            $comentario->setApellidos($apellido);
            $comentario->setApartamento($apartamento);
            $comentario->setUser($usuario);

            $em=$this->getDoctrine()->getManager();
            $em->persist($comentario);
            $em->flush();

            return $this->redirectToRoute('apartamento',['id' => $id]);

        }

            //LLamada a la vista
            return $this->render("apartamento/apartamento.html.twig",
            ["formulario"=>$formulario->createView(),
            'apartamento' => $apartamento, 'comentarios' => $totales, 
            'alquiler' => $formulario4->createView(), 'fotos' => $slider,
            'contacto' => $formulario5->createView(),'formulario3' => $formulario3->createView()]);

    }

    /**
     * 
     * @Route("/Apartamento/Galeria/{id}", name="crudGaleria")
     * 
     */
    public function crudGaleria($id, Request $peticion) {

        $apartamento=$this->getDoctrine()->getRepository("AppBundle\Entity\Apartamento");
        $apartamento=$apartamento->findOneBy(array('id' => $id));

        $foto=$this->getDoctrine()->getRepository("AppBundle\Entity\Foto");
        $foto=$foto->findBy(array('apartamento' => $apartamento));

        $galeria= new Foto();
        $formulario=$this->createForm('AppBundle\Form\FotoType', $galeria);

        $fotos=$this->getDoctrine()->getRepository("AppBundle\Entity\Foto");
        $fotos=$fotos->findBy(array('apartamento' => $apartamento));        

	    $formulario->handleRequest($peticion);

        if($formulario->isSubmitted())
        {

            // Recogemos el fichero
            $foto=$formulario['imagen']->getData();
            
            // Sacamos la extensión del fichero
            $ext=$foto->guessExtension();
            
            // Le ponemos un nombre al fichero
            $galeria_nombre=time().".".$ext;
            
            // Guardamos el fichero en el directorio uploads que estará en el directorio /web del framework
            $foto->move("imagenes", $galeria_nombre);
            
            // Establecemos el nombre de fichero en el atributo de la entidad
            $galeria->setImagen($galeria_nombre);
            $galeria->setApartamento($apartamento);

            $em=$this->getDoctrine()->getManager();
            $em->persist($galeria);
            $em->flush();

            return $this->redirectToRoute('crudGaleria',['id' => $id]);

        }

        //LLamada a la vista
        return $this->render("perfil/crudGaleria.html.twig", 
        ['fotos' => $foto, 'apar' => $apartamento, 'formulario' => $formulario->createView()]);
    }

    /**
     * 
     * @Route("/Apartamento/Galeria/Borrar/{apar}/{id}", name="borrarGaleria")
     * 
     */
    public function borrarGaleria($apar, $id) {

        $formulario=$this->createForm('AppBundle\Form\FotoType');

        $apartamento=$this->getDoctrine()->getRepository("AppBundle\Entity\Apartamento");
        $apartamento=$apartamento->findOneBy(array('id' => $apar));

        $foto=$this->getDoctrine()->getRepository("AppBundle\Entity\Foto");
        $foto=$foto->findBy(array('apartamento' => $apar));

        $query = $this->getDoctrine()->getManager()->createQuery('delete FROM AppBundle:Foto f where f.id =:id')
        ->setParameter('id', $id);;
        $result = $query->getResult();

        $em=$this->getDoctrine()->getManager();
        $em->flush();

        //LLamada a la vista
        return $this->redirectToRoute("crudGaleria",['id' => $apar]);
    }

}