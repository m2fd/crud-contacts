<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\Personne;
use AppBundle\Form\PersonneType;

/**
 * Personne controller.
 *
 * @Route("/personne")
 */
class PersonneController extends Controller
{
    /**
     * Lists all Personne entities.
     *
     * @Route("/", name="personne_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $personnes = $em->getRepository('AppBundle:Personne')->findAll();

        return $this->render('personne/index.html.twig', array(
            'personnes' => $personnes,
        ));
    }

    /**
     * Creates a new Personne entity.
     *
     * @Route("/new", name="personne_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $personne = new Personne();
        $form = $this->createForm('AppBundle\Form\PersonneType', $personne);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($personne);
            $em->flush();

            return $this->redirectToRoute('personne_show', array('id' => $personne->getId()));
        }

        return $this->render('personne/new.html.twig', array(
            'personne' => $personne,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Personne entity.
     *
     * @Route("/{id}", name="personne_show")
     * @Method("GET")
     */
    public function showAction(Personne $personne)
    {
        $deleteForm = $this->createDeleteForm($personne);

        return $this->render('personne/show.html.twig', array(
            'personne' => $personne,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Personne entity.
     *
     * @Route("/{id}/edit", name="personne_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Personne $personne)
    {
        $deleteForm = $this->createDeleteForm($personne);
        $editForm = $this->createForm('AppBundle\Form\PersonneType', $personne);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($personne);
            $em->flush();

            return $this->redirectToRoute('personne_edit', array('id' => $personne->getId()));
        }

        return $this->render('personne/edit.html.twig', array(
            'personne' => $personne,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Personne entity.
     *
     * @Route("/{id}", name="personne_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Personne $personne)
    {
        $form = $this->createDeleteForm($personne);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($personne);
            $em->flush();
        }

        return $this->redirectToRoute('personne_index');
    }

    /**
     * Creates a form to delete a Personne entity.
     *
     * @param Personne $personne The Personne entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Personne $personne)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('personne_delete', array('id' => $personne->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
