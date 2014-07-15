<?php

/**
 * (c) benatespina <benatespina@gmail.com>
 *
 * This file belongs to myClapboard.
 * The source code of application includes a LICENSE file
 * with all information about license.
 */

namespace Myclapboard\ArtistBundle\Manager;

use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * Class ArtistManager.
 *
 * @package Myclapboard\ArtistBundle\Manager
 */
class ArtistManager
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
     * @return \Myclapboard\ArtistBundle\Entity\Artist
     */
    public function create()
    {
        return new $this->class();
    }

    /**
     * Finds artist with firstName and lastName given.
     *
     * @param string $firstName The first name
     * @param string $lastName  The last name
     *
     * @return null|\Myclapboard\ArtistBundle\Model\ArtistInterface
     */
    public function findOneByFullName($firstName, $lastName)
    {
        return $this->repository->findOneBy(
            array('firstName' => $firstName, 'lastName' => $lastName)
        );
    }
}
