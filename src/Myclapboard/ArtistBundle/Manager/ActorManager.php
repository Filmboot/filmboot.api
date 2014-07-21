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
use Myclapboard\ArtistBundle\Model\ArtistInterface;
use Myclapboard\MovieBundle\Model\MovieInterface;

/**
 * Class ActorManager.
 *
 * @package Myclapboard\ArtistBundle\Manager
 */
class ActorManager
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
     * @return \Myclapboard\ArtistBundle\Entity\Actor
     */
    public function create()
    {
        return new $this->class();
    }

    /**
     * Finds the actor with artist and movie given.
     *
     * @param \Myclapboard\ArtistBundle\Model\ArtistInterface $artist The artist
     * @param \Myclapboard\MovieBundle\Model\MovieInterface   $movie  The movie
     *
     * @return null|\Myclapboard\ArtistBundle\Entity\Actor
     */
    public function findOneByArtistAndMovie(ArtistInterface $artist, MovieInterface $movie)
    {
        return $this->repository->findOneBy(array('artist' => $artist, 'movie' => $movie));
    }

    /**
     * Finds all the actors of the id of movie given.
     *
     * @param string $id The movie id
     *
     * @return array<\Myclapboard\ArtistBundle\Entity\Actor>
     */
    public function findAllByMovie($id)
    {
        return $this->repository->findBy(array('movie' => $id));
    }
}
