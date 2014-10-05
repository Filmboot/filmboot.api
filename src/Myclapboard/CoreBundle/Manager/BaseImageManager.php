<?php

/**
 * This file belongs to myClapboard.
 * The source code of application includes a LICENSE file
 * with all information about license.
 *
 * @author benatespina <benatespina@gmail.com>
 * @author gorkalaucirica <gorka.lauzirika@gmail.com>
 */

namespace Myclapboard\CoreBundle\Manager;

use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * Class BaseImageManager.
 *
 * @package Myclapboard\CoreBundle\Manager
 */
class BaseImageManager
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
     * @return \Myclapboard\CoreBundle\Entity\BaseImage
     */
    public function create()
    {
        return new $this->class();
    }
}
