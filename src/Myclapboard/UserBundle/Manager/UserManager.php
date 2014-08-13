<?php

/**
 * (c) benatespina <benatespina@gmail.com>
 * This file belongs to myClapboard.
 * The source code of application includes a LICENSE file
 * with all information about license.
 */

namespace Myclapboard\UserBundle\Manager;

use Doctrine\Common\Persistence\ManagerRegistry;
use Myclapboard\UserBundle\Model\BasicInfoInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\Util\SecureRandom;

/**
 * Class UserManager.
 *
 * @package Myclapboard\UserBundle\Manager
 */
class UserManager
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
     * Constructor.
     *
     * @param \Doctrine\Common\Persistence\ManagerRegistry $managerRegistry The manager registry
     * @param string                                       $class           The class
     */
    public function __construct(ManagerRegistry $managerRegistry, $class)
    {
        $this->manager = $managerRegistry->getManagerForClass($class);
        $this->repository = $this->manager->getRepository($class);
        $this->class = $this->manager->getClassMetadata($class)->getName();
    }

    /**
     * Returns a new instance of a class.
     *
     * @return \Myclapboard\UserBundle\Entity\User
     */
    public function create()
    {
        return new $this->class();
    }

    /**
     * Find all the users of the database
     *
     * @return array<\Myclapboard\UserBundle\Entity\User>
     */
    public function findAll()
    {
        $queryBuilder = $this->repository->createQueryBuilder('u');

        $query = $queryBuilder->select(array('u', 'r', 're'))
            ->leftJoin('u.ratings', 'r')
            ->leftJoin('u.reviews', 're')
            ->getQuery();

        return $query->getResult();
    }

    /**
     * Finds user by API key string
     *
     * @param string $apiKey API key string
     *
     * @return null|UserInterface
     */
    public function findByApiKey($apiKey)
    {
        return $this->repository->findOneBy(array('apiKey' => $apiKey));
    }

    /**
     * Finds user by its username
     *
     * @param string $username Username string
     *
     * @return null|UserInterface
     */
    public function findByUsername($username)
    {
        return $this->repository->findOneBy(array('email' => $username));
    }

    public function createApiKey(BasicInfoInterface $user)
    {
        $token = md5(uniqid($user->getEmail(), true));

        $user->setApiKey($token);

        $this->manager->persist($user);
        $this->manager->flush();

        return $token;
    }
}
