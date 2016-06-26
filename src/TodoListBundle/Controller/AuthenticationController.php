<?php

namespace TodoListBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\Authentication\Token\PreAuthenticatedToken;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\User\User;

/**
 * Description of AuthenticationController
 *
 * @author maxime
 */
class AuthenticationController extends Controller {

    public function callbackAction(Request $request) {

        if ($request->query->get('error')) {
            return $this->render('TodoListBundle:Default:index.html.twig');
        }

        if ($request->query->get('code')) {
            $client = $this->get('happyr.google.api.client');

            $client->authenticate($request->query->get('code'));

            $accessToken = $client->getAccessToken();
            $security = $this->get('security.token_storage');

            $token = $security->getToken();

            //$user = new User("anon", "anon", array(['AUTH_OK']));
            $token = new PreAuthenticatedToken(
                    json_encode($accessToken), null, $token->getProviderKey(), ['ROLE_OK']
            );

            $security->setToken($token);
        }

        //return $this->render('default/index.html.twig', [
        //  'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..'),
        // ]);
        //return $this->render('TodoListBundle:Default:index.html.twig');


        return $this->redirectToRoute('todo_list_list');
    }

    public function disconnectAction() {

        $securityStorage = $this->get('security.token_storage');
        $securityStorage->setToken(null);

        return $this->redirectToRoute('todo_list_list');
    }

}
