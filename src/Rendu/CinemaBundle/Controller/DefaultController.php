<?php

namespace Rendu\CinemaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/")
     */
    public function indexAction()
    {
        return $this->render('RenduCinemaBundle:Default:index.html.twig');
    }

    /**
     * @Route("/Film", name="list_des_films")
     */
    public function listFilm()
    {
        return $this->render('RenduCinemaBundle:Film:list.html.twig');
    }

}
