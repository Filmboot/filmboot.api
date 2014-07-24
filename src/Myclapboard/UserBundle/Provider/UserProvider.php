<?php

namespace Myclapboard\UserBundle\Provider;

/**
 * (c) benatespina <benatespina@gmail.com>
 *
 * This file belongs to myClapboard.
 * The source code of application includes a LICENSE file
 * with all information about license.
 */

use Doctrine\Common\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Security\Core\Encoder\EncoderFactory;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;

/**
 * Class UserProvider.
 *
 * @package Myclapboard\UserBundle\Provider
 */
class UserProvider implements UserProviderInterface
{
    /**
     * @var \Doctrine\ORM\EntityManager
     */
    protected $manager;

    /**
     * @var \Doctrine\ORM\EntityRepository
     */
    protected $repository;

    /**
     * @var string
     */
    protected $class;

    /**
     * @var \Symfony\Component\HttpFoundation\Session\Session
     */
    protected $session;

    /**
     * @var EncoderFactory
     */
    protected $encoderFactory;

    /**
     * Constructor.
     *
     * @param ManagerRegistry $managerRegistry The manager registry
     * @param Session         $session         The session
     * @param EncoderFactory  $encoderFactory  The encoder factory
     * @param string          $class           The name of class
     */
    public function __construct(
        ManagerRegistry $managerRegistry,
        Session $session,
        EncoderFactory $encoderFactory,
        $class
    )
    {
        $this->manager = $managerRegistry->getManagerForClass($class);
        $this->repository = $this->manager->getRepository($class);
        $this->session = $session;
        $this->encoderFactory = $encoderFactory;
        $this->class = $this->manager->getClassMetadata($class)->getName();
    }

    /**
     * {@inheritdoc}
     */
    public function loadUserByUsername($username)
    {
        $queryBuilder = $this->repository->createQueryBuilder('u');

        $query = $queryBuilder->select(array('u'))
            ->where($queryBuilder->expr()->eq('u.email', ':username'))
            ->setParameter('username', $username)
            ->getQuery();

        $user = $query->getOneOrNullResult();

        if ($user === null) {
            throw new UsernameNotFoundException();
        }

        return $user;
    }

    /**
     * {@inheritdoc}
     */
    public function refreshUser(UserInterface $user)
    {
        $class = get_class($user);
        if (!$this->supportsClass($class)) {
            throw new UnsupportedUserException(
                sprintf('Instances of "%s" are not supported.', $class)
            );
        }

        return $this->loadUserByUsername($user->getUsername());
    }

    /**
     * {@inheritdoc}
     */
    public function supportsClass($class)
    {
        return $this->class === $class || is_subclass_of($class, $this->class);
    }
}
