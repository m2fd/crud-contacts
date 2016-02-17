<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Entity\Personne;

/**
 * Access allowed for users with ROLE_ADMIN, and ROLE_USER
 *
 * CRUD controller for personne entity
 *
 * @Route("/personne")
 * @Security("has_role('ROLE_USER')")

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
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     * @Security("has_role('ROLE_ADMIN')")
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

            $this->sendMail('new', $personne);

            return $this->redirectToRoute('personne_show', array('id' => $personne->getId()));
        }

        return $this->render('personne/new.html.twig', array(
            'personne' => $personne,
            'form' => $form->createView(),
        ));
    }

    /**
     * @param String $action
     * @param Personne $personne
     */
    public function sendMail(String $action, Personne $personne)
    {
        $mailer = $this->get('mailer');
        #$mailer->setMailer('smtp');
        #$mailer->send('no-reply@localhost', $personne->getEmail(),  'Information: '.$action,
        #    'A new user named'.$personne->getFirstname()." ".$personne->getLastname());
        $template = 'Emails/newuser.html.twig';

        if ($action == 'edit') {
            $template = 'Emails/edituser.html.twig';
        }

        $message = \Swift_Message::newInstance()
             ->setSubject('Information: '.$action)
             ->setFrom('no-reply@localhost')
             ->setTo('user@localhost')
             ->setBody(
                 $this->renderView(
                     // app/Resources/views/Emails/registration.html.twig
                     $template,
                     array('name' => $personne->getFirstname().' '.$personne->getLastname(),
                         'city' => $personne->getCity(),
                         'firm' => $personne->getFirm(),
                         'bdate' => $personne->getBirthDate()->format('d/m/Y'),
                         'status' => $personne->getNamedStatus(),
                         'phone' => $personne->getTelephone(),
                         'website' => $personne->getWebSite(),
                         )
                 ),
                 'text/html'
             )
                 #'A new user named '.$personne->getFirstname()." ".$personne->getLastname(). " was created")
        ;
        $mailer->send($message);
    }

    /**
     * Finds and displays a Personne entity.
     *
     * @Route("/{id}", name="personne_show")
     * @Method("GET")
     * @param Personne $personne
     * @return \Symfony\Component\HttpFoundation\Response
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
     * @param Request $request
     * @param Personne $personne
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function editAction(Request $request, Personne $personne)
    {
        $logger = $this->get('logger');
        $deleteForm = $this->createDeleteForm($personne);
        $editForm = $this->createForm('AppBundle\Form\PersonneType', $personne);
        $editForm->handleRequest($request);

        dump($this->container, $personne);

        $logger->addDebug('form is valid: '.($editForm->isValid()));

        if ($editForm->isSubmitted() && $editForm->isValid()) {

            // data is an array with "name", "email", and "message" keys
            $data = $editForm->getData();
            $logger->addDebug('req post Status: '.$request->request->get('personne[status]'));
            $logger->addDebug('req get data: '.$data);

            #$personne->setStatus($request->request->get('personne[status]'));

            $em = $this->getDoctrine()->getManager();
            $em->persist($personne);
            $em->flush();

            $this->sendMail('edit', $personne);

            #return $this->redirectToRoute('personne_edit', array('id' => $personne->getId()));
            return $this->redirectToRoute('personne_index', array('id' => $personne->getId()));
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
     * @param Request $request
     * @param Personne $personne
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
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
