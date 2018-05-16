<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class DefaultController extends Controller
{
    /**
     * @Route("/home", name="homepage")
     */
    public function indexAction(Request $peticion)
    {        

        $em = $this->getDoctrine()->getManager();
        $propiedad = $em->getRepository("AppBundle\Entity\Apartamento")->findAll();
        $provincias = $em->getRepository("AppBundle\Entity\Provincia")->findAll();
        $localidades = $em->getRepository("AppBundle\Entity\Localidad")->findAll();

        if(count($peticion->request)  > 0) {

            $data = $peticion->request->all();
            $formProvincia = $data['provincia'];
            if($formProvincia != 'Provincias') {
    
                $formLocalidad = $data['localidad'];
            }
            $formPrecio = $data['precio'];
            $formDesde = $data['desde'];
            $formHasta = $data['hasta'];
            $formHabitaciones = $data['habitaciones'];
            $formPersonas = $data['personas']; 

            $precios = explode(" - ", $formPrecio);

            $precio1 = $precios[0];
            $precio2= $precios[1];

            $query = $em->createQuery(
                "SELECT ap
                FROM AppBundle:Apartamento ap
                WHERE ap.localidad = $formLocalidad and ap.precio BETWEEN '$precio1' and '$precio2'
                and ap.numPersonas = $formPersonas and ap.numHabitaciones = $formHabitaciones"
            );
            
            $propiedad = $query->getResult();

            if($this->getUser() != null) {

                $usuario = $this->getUser()->getUsername();
    
                return $this->render('default/home.html.twig',["usuario"=>$usuario, "propiedad" => $propiedad,
                'provincia' => $provincias, 'localidad' => $localidades]);
            }
            else {
    
                return $this->render('default/home.html.twig',["propiedad" => $propiedad, 
                'provincia' => $provincias, 'localidad' => $localidades]);
            }
            
        }

        if($this->getUser() != null) {

            $usuario = $this->getUser()->getUsername();

            return $this->render('default/home.html.twig',["usuario"=>$usuario, "propiedad" => $propiedad,
            'provincia' => $provincias, 'localidad' => $localidades]);
        }
        else {

            return $this->render('default/home.html.twig',["propiedad" => $propiedad, 
            'provincia' => $provincias, 'localidad' => $localidades]);
        }

    }

    /**
     * @Route("/home/{prov}", name="provincias")
     * @Method({"GET"})
     */
    public function localidadAction(Request $request, $prov) {

        if($request->isXmlHttpRequest())
        {
            $encoders = array(new JsonEncoder(),new XmlEncoder());
            $normalizers = array(new ObjectNormalizer());

            $serializer = new Serializer($normalizers, $encoders);

            $em = $this->getDoctrine()->getManager();
            $posts =  $em->getRepository('AppBundle\Entity\Localidad')->findBy(array('provinciaId'=> $prov));
            $response = new JsonResponse();
            $response->setStatusCode(200);
            $response->setData(array(
                'response' => 'success',
                'posts' => $serializer->serialize($posts, 'json')
            ));
            return $response;
        }

    }

}
