<?php

/**
 * Created by PhpStorm.
 * User: Lenovo
 * Date: 22/11/2016
 * Time: 19:43
 */
namespace MyApp\UserBundle\Redirection;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationSuccessHandlerInterface;
class AfterLoginRedirection implements AuthenticationSuccessHandlerInterface
{
    /**
     * @var \Symfony\Component\Routing\RouterInterface
     */
    private $router;

    /**
     * @param RouterInterface $router
     */
    public function __construct(RouterInterface $router)
    {
        $this->router = $router;
    }

    /**
     * @param Request $request
     * @param TokenInterface $token
     * @return RedirectResponse
     */
    public function onAuthenticationSuccess(Request $request, TokenInterface $token)
    {

        $roles = $token->getRoles();

        $rolesTab = array_map(function ($role) {
            return $role->getRole();
        }, $roles); // S'il s'agit d'un admin ou d'un super admin on le redirige vers le backoffice
        $user = $token->getUser();
        if($user->getEtat()=='1') {


            if (in_array('ROLE_SUPER_ADMIN', $rolesTab, true)) {
                $redirection = new RedirectResponse($this->router->generate('super-admin'));
            } elseif (in_array('ROLE_AGENT', $rolesTab, true)) {
                $redirection = new RedirectResponse($this->router->generate('agent'));
            } elseif (in_array('ROLE_CLIENT', $rolesTab, true)) {
                return $redirection = new RedirectResponse($this->router->generate('profile_user'));
            } else {
                $redirection = new RedirectResponse($this->router->generate('login'));
            }
        }
        else{
            $redirection = new RedirectResponse($this->router->generate('404'));

        }




        return $redirection;

    }
}