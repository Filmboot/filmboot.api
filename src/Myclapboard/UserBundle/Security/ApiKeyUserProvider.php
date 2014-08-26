<?php

/**
 * (c) benatespina <benatespina@gmail.com>
 *
 * This file belongs to myClapboard.
 * The source code of application includes a LICENSE file
 * with all information about license.
 */

namespace Myclapboard\UserBundle\Security;

use Myclapboard\UserBundle\Manager\UserManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;

/**
 * Class ApiKeyUserProvider.
 *
 * @package Myclapboard\UserBundle\Security
 */
class ApiKeyUserProvider implements UserProviderInterface
{
    /**
     * @var \Myclapboard\UserBundle\Manager\UserManager
     */
    protected $manager;

    /**
     * Constructor.
     *
     * @param \Myclapboard\UserBundle\Manager\UserManager $manager The manager
     */
    public function __construct(UserManager $manager)
    {
        $this->manager = $manager;
    }

    /**
     * Gets username for api key.
     *
     * @param string $apiKey The api key
     *
     * @return null|\Myclapboard\UserBundle\Manager\UserManager
     */
    public function getUsernameForApiKey($apiKey)
    {
        $user = $this->manager->findByApiKey($apiKey);

        if ($user !== null) {
            return $user->getUsername();
        } else {
            return null;
        }
    }

    /**
     * {@inheritdoc}
     */
    public function loadUserByUsername($username)
    {
        return $this->manager->findByUsername($username);
    }

    /**
     * {@inheritdoc}
     */
    public function refreshUser(UserInterface $user)
    {
        throw new UnsupportedUserException();
    }

    /**
     * {@inheritdoc}
     */
    public function supportsClass($class)
    {
        return 'Symfony\Component\Security\Core\User\User' === $class;
    }

    /**
     * {@inheritdoc}
     */
    public function onAuthenticationFailure(Request $request, AuthenticationException $exception)
    {
        return new Response('Authentication Failed.', 403);
    }
}
