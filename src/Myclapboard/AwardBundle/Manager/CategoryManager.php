<?php

/**
 * (c) benatespina <benatespina@gmail.com>
 *
 * This file belongs to myClapboard.
 * The source code of application includes a LICENSE file
 * with all information about license.
 */

namespace Myclapboard\AwardBundle\Manager;

use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * Class CategoryManager.
 *
 * @package Myclapboard\AwardBundle\Manager
 */
class CategoryManager
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
     * @return \Myclapboard\AwardBundle\Entity\Category
     */
    public function create()
    {
        return new $this->class();
    }

    /**
     * Finds category with name given.
     *
     * @param string $name The name of category
     *
     * @return null|\Myclapboard\AwardBundle\Model\CategoryInterface
     */
    public function findOneByName($name)
    {
        return $this->repository->findOneBy(array('name' => $name));
    }
}
