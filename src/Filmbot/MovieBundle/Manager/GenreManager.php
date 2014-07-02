<?php

/**
 * (c) benatespina <benatespina@gmail.com>
 *
 * This file belongs to Filmbot.
 * The source code of application includes a LICENSE file
 * with all information about license.
 */

namespace Filmbot\MovieBundle\Manager;

use Doctrine\ORM\EntityManager;

/**
 * Class GenreManager.
 *
 * @package Filmbot\MovieBundle\Manager
 */
class GenreManager
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
     * Constructor
     *
     * @param \Doctrine\ORM\EntityManager $manager The entityManager
     * @param string                      $class   The class
     */
    public function __construct(EntityManager $manager, $class)
    {
        $this->manager = $manager;
        $this->repository = $manager->getRepository($class);
        $this->class = $manager->getClassMetadata($class)->name;
    }

    /**
     * Returns a new instance of a class
     *
     * @return \Filmbot\MovieBundle\Entity\Genre
     */
    public function create()
    {
        return new $this->class();
    }

    /**
     * Finds genre with name given.
     *
     * @param string $name The name of genre
     *
     * @return null|\Filmbot\MovieBundle\Model\GenreInterface
     */
    public function findOneByName($name)
    {
        return $this->repository->findOneBy(array('name' => $name));
    }
}