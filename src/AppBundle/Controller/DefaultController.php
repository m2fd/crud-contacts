<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Access allowed for all users logged, not logged, ROLE\_USER, ROLE\_ADMIN
 *
 * default route to index
 *
 * @package AppBundle\Controller
 */
class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->container->getParameter('kernel.root_dir') . '/..'),
        ]);
    }

    /**
     * @Route("/unauthorized", name="unauthorized")
     *
     */
    public function unauthorizedAction()
    {

        $token = $this->get('security.context')->getToken();

        //Si user loggé
        if (isset($token))
        {
            $user = $this->get('security.context')->getToken()->getUser();
            $roles = $user->getRoles();

            switch ($roles[0])
            {
                //TODO: Page d'inscription
                case User::ROLE_INACTIVE: $mess = 'Redirection to SignUp form (INACTIVE)';
                    break;
                //TODO: Page de renseignement CB
                case User::ROLE_ACTIVE_CC_PROBLEM: $mess = 'Redirection to CB form (ACTIVE_CC_PROBLEM)';
                    break;
                //TODO: Page de réabonnement
                case User::ROLE_ACTIVE_NO_ACCESS: $mess = 'Redirection subscription form (ACTIVE_NO_ACCESS)';
                    break;
                default: $mess = 'Default redirection';
                    break;
            }
        }
        //Sinon, redirection sur logout -> renvoie sur login
        else
        {
            return $this->redirect($this->generateUrl('form_login'));
        }

        return $this->render('error403.html.twig', array ('mess' => $mess));
}
}
