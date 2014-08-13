<?php

namespace Myclapboard\UserBundle\Security;

use Myclapboard\UserBundle\Manager\UserManager;
use Myclapboard\UserBundle\Model\Account;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;


class ApiKeyUserProvider implements UserProviderInterface
{
    /** @var \Myclapboard\UserBundle\Manager\UserManager */
    protected $manager;

    public function __construct(UserManager $manager)
    {
        $this->manager = $manager;
    }

    public function getUsernameForApiKey($apiKey)
    {
        $user = $this->manager->findByApiKey($apiKey);

        if($user) {
            return $user->getUsername();
        }
        else {
            return null;
        }
    }

    public function loadUserByUsername($username)
    {
        return $this->manager->findByUsername($username);
    }

    public function refreshUser(UserInterface $user)
    {
        // this is used for storing authentication in the session
        // but in this example, the token is sent in each request,
        // so authentication can be stateless. Throwing this exception
        // is proper to make things stateless
        throw new UnsupportedUserException();
    }

    public function supportsClass($class)
    {
        return 'Symfony\Component\Security\Core\User\User' === $class;
    }

    public function onAuthenticationFailure(Request $request, AuthenticationException $exception)
    {
        return new Response("Authentication Failed.", 403);
    }
} 