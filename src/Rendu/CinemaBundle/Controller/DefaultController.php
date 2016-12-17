<?php

namespace Rendu\CinemaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="index")
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
        $films = $this->getDoctrine()->getRepository('RenduCinemaBundle:Film')->findAll();
        return $this->render('RenduCinemaBundle:Film:list.html.twig',
            ['films' => $films]);
    }

    /**
     * @Route("/Real", name="list_des_realisateurs")
     */
    public function listReal()
    {


        $reals = $this->getDoctrine()->getRepository('RenduCinemaBundle:Personne')->findAll();
        $today = new \DateTime();
        return $this->render('RenduCinemaBundle:Film:list2.html.twig',
            ['reals' => $reals, 'today' => $today]);
    }

    /**
     * @Route("/Real/{id}", requirements={"id": "\d+"}, name="real_films")
     */
    public function showReal($id)
    {
        $query = $this->getDoctrine()
            ->getRepository('RenduCinemaBundle:Film')
            ->createQueryBuilder('p')
            ->where('p.realisateur = :id')
            ->setParameter('id', $id)
            ->getQuery();

        $films = $query->getResult();

        $aut=$this->getDoctrine()->getRepository('RenduCinemaBundle:Personne')->find($id);

        return $this->render(
            'RenduCinemaBundle:Film:show.html.twig',
            ['films' => $films,
            'auth' => $aut]
        );
    }

}
