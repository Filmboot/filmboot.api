<?php

/**
 * (c) benatespina <benatespina@gmail.com>
 *
 * This file belongs to Myclapboard.
 * The source code of application includes a LICENSE file
 * with all information about license.
 */

namespace Myclapboard\AwardBundle\Manager;

use Doctrine\ORM\EntityManager;

/**
 * Class AwardManager.
 *
 * @package Myclapboard\AwardBundle\Manager
 */
class AwardManager
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
     * @return \Myclapboard\AwardBundle\Entity\Award
     */
    public function create()
    {
        return new $this->class();
    }

    /**
     * Finds award with name given.
     *
     * @param string $name The name of award
     *
     * @return null|\Myclapboard\AwardBundle\Model\AwardInterface
     */
    public function findOneByName($name)
    {
        return $this->repository->findOneBy(array('name' => $name));
    }
}
