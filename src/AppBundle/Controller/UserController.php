<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 28/01/16
 * Time: 15:53.
 */

namespace AppBundle\Controller;

use AppBundle\Form\Personne2Type;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 *
 * Access allowed for users with ROLE_ADMIN
 *
 * CRUD controller for User entity
 * @package AppBundle\Controller
 */
class UserController extends Controller
{
    /**
     * @Route(path="/register2",name="user_register")
     *
     * @param Request $request
     * @return Response
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function registerAction(Request $request)
    {
        if ($request->isMethod('POST')) {
            //recup du service user_register, defini dans services.yaml
            $register = $this->get('user_register');
            // si 2eme appel, ce sera la meme instance
            //$register= $this->get('user_register');
            $register->createUser(
                $request->request->get('username'),
                $request->request->get('password')
            );

            return new Response('Utilisateur enregistré.');
        }

        // form created by php bin/console generate:doctrine:form AppBundle:Personne2
        $form = $this->createForm(Personne2Type::class);

        return $this->render('user/register.html.twig', ['form' => $form]);
    }
}
