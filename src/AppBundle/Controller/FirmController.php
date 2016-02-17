<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\Firm;

/**
 * Firm controller.
 *
 * @Route("/firm")
 * @Security("has_role('ROLE_ADMIN')")
 */
class FirmController extends Controller
{
    /**
     * Lists all Firm entities.
     *
     * @Route("/", name="firm_index")
     * @Method("GET")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $firms = $em->getRepository('AppBundle:Firm')->findAll();

        return $this->render('firm/index.html.twig', array(
            'firms' => $firms,
        ));
    }

    /**
     * Creates a new Firm entity.
     *
     * @Route("/new", name="firm_new")
     * @Method({"GET", "POST"})
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function newAction(Request $request)
    {
        $firm = new Firm();
        $form = $this->createForm('AppBundle\Form\FirmType', $firm);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($firm);
            $em->flush();

            return $this->redirectToRoute('firm_show', array('id' => $firm->getId()));
        }

        return $this->render('firm/new.html.twig', array(
            'firm' => $firm,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Firm entity.
     *
     * @Route("/{id}", name="firm_show")
     * @Method("GET")
     * @param Firm $firm
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showAction(Firm $firm)
    {
        $deleteForm = $this->createDeleteForm($firm);

        return $this->render('firm/show.html.twig', array(
            'firm' => $firm,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Firm entity.
     *
     * @Route("/{id}/edit", name="firm_edit")
     * @Method({"GET", "POST"})
     * @param Request $request
     * @param Firm $firm
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function editAction(Request $request, Firm $firm)
    {
        $deleteForm = $this->createDeleteForm($firm);
        $editForm = $this->createForm('AppBundle\Form\FirmType', $firm);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($firm);
            $em->flush();

            return $this->redirectToRoute('firm_edit', array('id' => $firm->getId()));
        }

        return $this->render('firm/edit.html.twig', array(
            'firm' => $firm,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Firm entity.
     *
     * @Route("/{id}", name="firm_delete")
     * @Method("DELETE")
     * @param Request $request
     * @param Firm $firm
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function deleteAction(Request $request, Firm $firm)
    {
        $form = $this->createDeleteForm($firm);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($firm);
            $em->flush();
        }

        return $this->redirectToRoute('firm_index');
    }

    /**
     * Creates a form to delete a Firm entity.
     *
     * @param Firm $firm The Firm entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Firm $firm)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('firm_delete', array('id' => $firm->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
