<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class RedireccionController extends Controller
{


    /**
     * 
     * @Route("/Redireccion", name="redireccion")
     * 
     */
    public function Redireccion() {

       
        return $this->redirectToRoute("homepage");
    }


}
