<?php
namespace Rendu\AdminBundle\Controller;

use Rendu\CinemaBundle\Entity\Genre;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Rendu\AdminBundle\Form\GenreType;

/**
 * @Route("/admin/genre")
 */
class AdminGenreController extends Controller
{
    /**
     * @Route("/ajout", name="admin_genre_ajout")
     */
    public function addAction(Request $request)
    {
        $genre = new Genre();
        $form = $this->createForm(GenreType::class, $genre);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $genre = $form->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($genre);
            $em->flush();

            return $this->redirectToRoute('admin_genre_liste');
        }

        return $this->render(
            'RenduAdminBundle:Genre:form.html.twig',
            ['form' => $form->createView()]
        );
    }

    /**
     * @Route("/liste", name="admin_genre_liste")
     */
    public function listAction()
    {
        $genres = $this->getDoctrine()->getRepository('RenduCinemaBundle:Genre')->findAll();

        return $this->render(
            'RenduAdminBundle:Genre:list.html.twig',
            ['genres' => $genres]
        );
    }

    /**
     * @Route("/modif/{id}", name="admin_genre_modif", requirements={"id": "\d+"})
     */
    public function editAction(Request $request, $id)
    {
        $genre = $this->getDoctrine()->getRepository('RenduCinemaBundle:Genre')->find($id);

        $form = $this->createForm(GenreType::class, $genre);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $genre = $form->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($genre);
            $em->flush();

            return $this->redirectToRoute('admin_genre_liste');
        }

        return $this->render(
            'RenduAdminBundle:Genre:form.html.twig',
            ['form' => $form->createView()]
        );
    }

    /**
     * @Route("/supprimer/{id}", name="admin_genre_supprimer", requirements={"id": "\d+"})
     */
    public function deleteAction($id)
    {
        $genre = $this->getDoctrine()->getRepository('RenduCinemaBundle:Genre')->find($id);

        $em = $this->getDoctrine()->getManager();
        $em->remove($genre);
        $em->flush();

        return $this->redirectToRoute('admin_genre_liste');
    }
}