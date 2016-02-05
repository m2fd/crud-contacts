<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 28/01/16
 * Time: 15:53
 */

namespace AppBundle\Controller;

use AppBundle\Form\Personne2Type;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    /**
     * @Route(path="/register",name="user_register")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function registerAction(Request $request)
    {
        if ($request->isMethod('POST')){
            //recup du service user_register, defini dans services.yaml
            $register= $this->get('user_register');
            // si 2eme appel, ce sera la meme instance
            //$register= $this->get('user_register');
            $register->createUser(
                $request->request->get('username'),
                $request->request->get('password')
            );

            return new Response('Utilisateur enregistré.');
        }

        // form created by php bin/console generate:doctrine:form AppBundle:Personne2
        $form= $this->createForm( Personne2Type::class);
        return $this->render('user/register.html.twig', ['form'=>$form]);
    }

}