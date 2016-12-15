<?php
namespace Rendu\AdminBundle\Controller;

use Rendu\AdminBundle\Form\FilmType;
use Rendu\CinemaBundle\Entity\Film;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


/**
 * @Route("/admin/cinemas")
 */
class AdminCinemaController extends Controller
{
    /**
     * @Route("/ajout", name="admin_film_ajout)
     */
    public function addAction()
    {
        $film = new Film(); //on crée un nouveau film vide
        $form = $this->createForm(FilmType::class, $film); //on le lie à un formulaire de type filmType

        $form->handleRequest($request); //on lie le formulaire à la requête HTTP

        if ($form->isSubmitted() && $form->isValid()) { //si le formulaire a bien été soumis et qu'il est valide
            $film = $form->getData(); //on crée un objet Genre avec les valeurs du formulaire soumis

            $em = $this->getDoctrine()->getManager(); //on récupère le gestionnaire d'entités de Doctrine

            $em->persist($film); //on s'en sert pour enregistrer le genre (mais pas encore dans la base de données)

            $em->flush(); //écriture en base de toutes les données persistées

            return $this->redirectToRoute('admin_film_liste'); //puis on redirige l'utilisateur vers la page des genres
        }

        return $this->render(
            'RenduAdminBundle:Film:form.html.twig',
            ['form' => $form->createView()]
        );
    }

    /**
     * @Route("/liste", name="admin_film_liste")
     */
    public function listAction()
    {
        $films = $this->getDoctrine()->getRepository('RenduCinemaBundle:Film')->findAll();

        return $this->render(
            'RenduAdminBundle:Film:list.html.twig',
            ['films' => $films]
        );
    }


    /**
     * @Route("/modif/{id}", name="admin_film_modif", requirements={"id": "\d+"})
     */
    public function editAction(Request $request, $id)
    {
        //on récupère le bon Genre en fonction de l'id donnée dans l'URL
        $film = $this->getDoctrine()->getRepository('RenduCinemaBundle:Film')->find($id);

        $form = $this->createForm(FilmType::class, $film); //on le lie à un formulaire de type GenreType
        //Le formulaire sera donc prérempli avec les données de l'objet Genre récupéré en base de données.

        //puis on exécute le même traitement que pour l'ajout
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $film = $form->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($film);
            $em->flush();

            return $this->redirectToRoute('admin_film_liste');
        }

        return $this->render(
            'RenduAdminBundle:Film:form.html.twig',
            ['form' => $form->createView()]
        );
    }

    /**
     * @Route("/supprimer/{id}", name="admin_film_supprimer", requirements={"id": "\d+"})
     */
    public function deleteAction($id)
    {
        //on récupère le bon Genre en fonction de l'id donnée dans l'URL
        $film = $this->getDoctrine()->getRepository('RenduCinemaBundle:Film')->find($id);

        $em = $this->getDoctrine()->getManager(); //on récupère le gestionnaire
        $em->remove($film); //on supprime cette entité
        $em->flush(); //exécution en base

        return $this->redirectToRoute('admin_film_liste'); //redirection vers la liste
    }
}

