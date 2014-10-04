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

/**
 * Class ArtistManager.
 *
 * @package Myclapboard\ArtistBundle\Manager
 */
class ArtistManager
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
     * @return \Myclapboard\ArtistBundle\Entity\Artist
     */
    public function create()
    {
        return new $this->class();
    }

    /**
     * Finds artist with firstName and lastName given.
     *
     * @param string $firstName The first name
     * @param string $lastName  The last name
     *
     * @return null|\Myclapboard\ArtistBundle\Model\ArtistInterface
     */
    public function findOneByFullName($firstName, $lastName)
    {
        return $this->repository->findOneBy(
            array('firstName' => $firstName, 'lastName' => $lastName)
        );
    }

    /**
     * Finds all of artists ordered by value given.
     * Can do pagination if $page is changed, starting from 0
     * and it can limit the search if $count is changed.
     *
     * @param string $order The order value
     * @param string $query The query
     * @param int    $count The number of results
     * @param int    $page  The number of page
     *
     * @return array<\Myclapboard\ArtistBundle\Model\ArtistInterface>
     */
    public function findAll($order, $query = '', $count = 10, $page = 0)
    {
        $order = 'a.' . $order;
        $whereSql = ' 1=1 ';
        $parameters = array();

        if ($query !== '') {
            $whereSql .= 'AND a.firstName LIKE :firstName OR a.lastName LIKE :lastName';
            $parameters['firstName'] = '%' . $query . '%';
            $parameters['lastName'] = '%' . $query . '%';
        }

        $queryBuilder = $this->repository->createQueryBuilder('a');

        $query = $queryBuilder->select(array('a', 'ac', 'd', 'w', 'i'))
            ->leftJoin('a.actors', 'ac')
            ->leftJoin('a.directors', 'd')
            ->leftJoin('a.writers', 'w')
            ->leftJoin('a.images', 'i')
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
     * Finds the artist with id given.
     *
     * @param string $id The id
     *
     * @return null|\Myclapboard\ArtistBundle\Model\ArtistInterface
     */
    public function findOneById($id)
    {
        $queryBuilder = $this->repository->createQueryBuilder('a');

        $query = $queryBuilder->select(array('a', 'ac', 'd', 'w', 'i'))
            ->leftJoin('a.actors', 'ac')
            ->leftJoin('a.directors', 'd')
            ->leftJoin('a.writers', 'w')
            ->leftJoin('a.images', 'i')
            ->where($queryBuilder->expr()->eq('a.id', ':id'))
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
