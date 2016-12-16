<?php
namespace Rendu\AdminBundle\Controller;

use Rendu\CinemaBundle\Entity\Personne;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Rendu\AdminBundle\Form\PersonneType;

/**
 * @Route("/admin/personnes")
 */
class AdminPersonneController extends Controller
{
    /**
     * @Route("/ajout", name="admin_personne_ajout")
     */
    public function addAction(Request $request)
    {
        $personne = new Personne();
        $form = $this->createForm(PersonneType::class, $personne);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $personne = $form->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($personne);
            $em->flush();

            return $this->redirectToRoute('admin_personne_liste');
        }

        return $this->render(
            'RenduAdminBundle:Personne:form.html.twig',
            ['form' => $form->createView()]
        );
    }

    /**
     * @Route("/liste", name="admin_personne_liste")
     */
    public function listAction()
    {
        $personnes = $this->getDoctrine()->getRepository('RenduCinemaBundle:Personne')->findAll();

        return $this->render(
            'RenduAdminBundle:Personne:list.html.twig',
            ['personnes' => $personnes]
        );
    }

    /**
     * @Route("/modif/{id}", name="admin_personne_modif", requirements={"id": "\d+"})
     */
    public function editAction(Request $request, $id)
    {
        $personne = $this->getDoctrine()->getRepository('RenduCinemaBundle:Personne')->find($id);

        $form = $this->createForm(PersonneType::class, $personne);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $personne = $form->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($personne);
            $em->flush();

            return $this->redirectToRoute('admin_personne_liste');
        }

        return $this->render(
            'RenduAdminBundle:Personne:form.html.twig',
            ['form' => $form->createView()]
        );
    }

    /**
     * @Route("/supprimer/{id}", name="admin_personne_supprimer", requirements={"id": "\d+"})
     */
    public function deleteAction($id)
    {
        $personne = $this->getDoctrine()->getRepository('RenduCinemaBundle:Personne')->find($id);

        $em = $this->getDoctrine()->getManager();
        $em->remove($personne);
        $em->flush();

        return $this->redirectToRoute('admin_personne_liste');
    }
}