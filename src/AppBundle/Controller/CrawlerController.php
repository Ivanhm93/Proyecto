<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Goutte\Client;

class CrawlerController extends Controller
{


    /**
    * @Route("/Otras", name="crawler")
    */
    public function crawlerAction()
    {        

        $client = new Client();
        $crawler = $client->request('GET', 'https://www.enalquiler.com/search?provincia=26&poblacion=24954&habitaciones=2');
        $crawler->filter('.property-list')->each(function ($node) {

            print_r("<br/>");
            print_r("<br/>");
            print_r($node->html());
            print_r("<br/>");
            print_r("<br/>");
        });

        return $this->render('default/crawler.html.twig');
        
    }

}
