<?php

/**
 * (c) benatespina <benatespina@gmail.com>
 * This file belongs to myClapboard.
 * The source code of application includes a LICENSE file
 * with all information about license.
 */

namespace Myclapboard\UserBundle\Manager;

use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * Class ReviewManager.
 *
 * @package Myclapboard\UserBundle\Manager
 */
class ReviewManager
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
     * @return \Myclapboard\UserBundle\Entity\Review
     */
    public function create()
    {
        return new $this->class();
    }

    /**
     * Finds all of reviews of user and ordered by values given.
     * Can do pagination if $page is changed, starting from 0
     * and it can limit the search if $count is changed.
     *
     * @param string $id    The id of user logged
     * @param string $order The order value
     * @param int    $count The number of results
     * @param int    $page  The number of page
     *
     * @return array<\Myclapboard\UserBundle\Model\RatingInterface>
     */
    public function findAll($id, $order, $count = 10, $page = 0)
    {
        if ($order === 'movie') {
            $order = 'm.title';
        } elseif ($order === 'date') {
            $order = 'createdAt';
        }
        $queryBuilder = $this->repository->createQueryBuilder('r');

        $query = $queryBuilder->select(array('r', 'u', 'm'))
            ->leftJoin('r.user', 'u')
            ->leftJoin('r.movie', 'm')
            ->where($queryBuilder->expr()->eq('u.id', ':id'))
            ->setParameter(':id', $id)
            ->setMaxResults($count)
            ->setFirstResult($count * $page)
            ->orderBy($order)
            ->getQuery();

        return $query
            ->setHint(
                \Doctrine\ORM\Query::HINT_CUSTOM_OUTPUT_WALKER,
                'Gedmo\\Translatable\\Query\\TreeWalker\\TranslationWalker'
            )
            ->getResult();
    }

    /**
     * Finds the rating with the id given.
     *
     * @param string $id The id
     *
     * @return \Myclapboard\UserBundle\Model\ReviewInterface
     */
    public function findOneById($id)
    {
        $queryBuilder = $this->repository->createQueryBuilder('r');

        $query = $queryBuilder->select(array('r', 'u', 'm'))
            ->leftJoin('r.user', 'u')
            ->leftJoin('r.movie', 'm')
            ->where($queryBuilder->expr()->eq('r.id', ':id'))
            ->setParameter(':id', $id)
            ->getQuery();

        return $query
            ->setHint(
                \Doctrine\ORM\Query::HINT_CUSTOM_OUTPUT_WALKER,
                'Gedmo\\Translatable\\Query\\TreeWalker\\TranslationWalker'
            )
            ->getOneOrNullResult();
    }
}
