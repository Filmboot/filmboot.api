<?php

/**
 * This file belongs to myClapboard.
 * The source code of application includes a LICENSE file
 * with all information about license.
 *
 * @author benatespina <benatespina@gmail.com>
 * @author gorkalaucirica <gorka.lauzirika@gmail.com>
 */

namespace Myclapboard\AwardBundle\Manager;

use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * Class AwardWonManager.
 *
 * @package Myclapboard\AwardBundle\Manager
 */
class AwardWonManager
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
     * @return \Myclapboard\AwardBundle\Entity\AwardWon
     */
    public function create()
    {
        return new $this->class();
    }

    /**
     * Finds all the awards of the id of movie given.
     *
     * @param string $id The movie id
     *
     * @return array<\Myclapboard\AwardBundle\Model\AwardWonInterface>
     */
    public function findAllByMovie($id)
    {
        return $this->repository->findBy(array('movie' => $id));
    }

    /**
     * Finds all the awards of the id of artist given.
     *
     * @param string $id The artist id
     *
     * @return array<\Myclapboard\AwardBundle\Model\AwardWonInterface>
     */
    public function findAllByArtist($id)
    {
        $queryBuilder = $this->repository->createQueryBuilder('aw');

        $query = $queryBuilder->select(array('aw', 'a', 'd', 'w'))
            ->leftJoin('aw.actor', 'a')
            ->leftJoin('aw.director', 'd')
            ->leftJoin('aw.writer', 'w')
            ->where($queryBuilder->expr()->eq('a.artist', ':id'))
            ->orWhere($queryBuilder->expr()->eq('d.artist', ':id'))
            ->orWhere($queryBuilder->expr()->eq('w.artist', ':id'))
            ->setParameter(':id', $id)
            ->getQuery();

        return $query
            ->setHint(
                \Doctrine\ORM\Query::HINT_CUSTOM_OUTPUT_WALKER,
                'Gedmo\\Translatable\\Query\\TreeWalker\\TranslationWalker'
            )
            ->getResult();
    }
}
