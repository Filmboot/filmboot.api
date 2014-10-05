<?php

/**
 * This file belongs to myClapboard.
 * The source code of application includes a LICENSE file
 * with all information about license.
 *
 * @author benatespina <benatespina@gmail.com>
 * @author gorkalaucirica <gorka.lauzirika@gmail.com>
 */

namespace Myclapboard\ArtistBundle\Manager;

use Doctrine\Common\Persistence\ManagerRegistry;
use Myclapboard\ArtistBundle\Model\ArtistInterface;
use Myclapboard\MovieBundle\Model\MovieInterface;

/**
 * Class DirectorManager.
 *
 * @package Myclapboard\ArtistBundle\Manager
 */
class DirectorManager
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
     * @return \Myclapboard\ArtistBundle\Entity\Director
     */
    public function create()
    {
        return new $this->class();
    }

    /**
     * Finds the director with artist and movie given.
     *
     * @param \Myclapboard\ArtistBundle\Model\ArtistInterface $artist The artist
     * @param \Myclapboard\MovieBundle\Model\MovieInterface   $movie  The movie
     *
     * @return null|\Myclapboard\ArtistBundle\Entity\Director
     */
    public function findOneByArtistAndMovie(ArtistInterface $artist, MovieInterface $movie)
    {
        return $this->repository->findOneBy(array('artist' => $artist, 'movie' => $movie));
    }
}
