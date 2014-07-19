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
 * Class MovieManager.
 *
 * @package Myclapboard\MovieBundle\Manager
 */
class MovieManager
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
     * @return \Myclapboard\MovieBundle\Entity\Movie
     */
    public function create()
    {
        return new $this->class();
    }

    /**
     * Finds movie with title given.
     *
     * @param string $title The title of movie
     *
     * @return null|\Myclapboard\MovieBundle\Model\MovieInterface
     */
    public function findOneByTitle($title)
    {
        return $this->repository->findOneBy(array('title' => $title));
    }

    /**
     * Finds all of movies ordered by value given.
     * Can do pagination if $page is changed, starting from 0
     * and it can limit the search if $count is changed.
     *
     * @param string $order The order value
     * @param string $query The query
     * @param int    $count The number of results
     * @param int    $page  The number of page
     *
     * @return array<\Myclapboard\MovieBundle\Model\MovieInterface>
     */
    public function findAll($order, $query = "", $count = 10, $page = 0)
    {
        $order = 'm.' . $order;
        $whereSql = ' 1=1 ';
        $parameters = array();

        if ($query !== '') {
            $whereSql .= 'AND m.title LIKE :title ';
            $parameters['title'] = '%' . $query . '%';
        }

        $queryBuilder = $this->repository->createQueryBuilder('m');

        $query = $queryBuilder->select(array('m', 'c', 'a', 'i'))
            ->leftJoin('m.country', 'c')
            ->leftJoin('m.awards', 'a')
            ->leftJoin('m.images', 'i')
            ->where($whereSql)
            ->setParameters($parameters)
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
     * Finds the movie with id given.
     *
     * @param string $id The id
     *
     * @return null|\Myclapboard\MovieBundle\Model\MovieInterface
     */
    public function findOneById($id)
    {
        $queryBuilder = $this->repository->createQueryBuilder('m');

        $query = $queryBuilder->select(array('m', 'c', 'ca', 'd', 'w', 'g', 'a', 'i'))
            ->leftJoin('m.country', 'c')
            ->leftJoin('m.cast', 'ca')
            ->leftJoin('m.directors', 'd')
            ->leftJoin('m.writers', 'w')
            ->leftJoin('m.genres', 'g')
            ->leftJoin('m.awards', 'a')
            ->leftJoin('m.images', 'i')
            ->where($queryBuilder->expr()->eq('m.id', ':id'))
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
