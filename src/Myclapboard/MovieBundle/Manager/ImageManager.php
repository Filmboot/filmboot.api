<?php

/**
 * (c) benatespina <benatespina@gmail.com>
 *
 * This file belongs to myClapboard.
 * The source code of application includes a LICENSE file
 * with all information about license.
 */

namespace Myclapboard\MovieBundle\Manager;

use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * Class ImageManager.
 *
 * @package Myclapboard\MovieBundle\Manager
 */
class ImageManager
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
     * @return \Myclapboard\MovieBundle\Entity\Image
     */
    public function create()
    {
        return new $this->class();
    }

    /**
     * Finds all the images of the id of movie given.
     *
     * @param string $id The movie id
     *
     * @return array<\Myclapboard\MovieBundle\Model\ImageInterface>
     */
    public function findAllBy($id)
    {
        return $this->repository->findBy(array('movie' => $id));
    }

    /**
     * Finds the image with name given.
     *
     * @param string $name The name
     *
     * @return null|\Myclapboard\MovieBundle\Model\ImageInterface
     */
    public function findOneByName($name)
    {
        return $this->repository->findOneBy(array('name' => $name));
    }
}
