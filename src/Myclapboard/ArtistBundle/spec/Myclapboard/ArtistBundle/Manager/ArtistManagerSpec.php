<?php

/**
 * This file belongs to myClapboard.
 * The source code of application includes a LICENSE file
 * with all information about license.
 *
 * @author benatespina <benatespina@gmail.com>
 * @author gorkalaucirica <gorka.lauzirika@gmail.com>
 */

namespace spec\Myclapboard\ArtistBundle\Manager;

use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\AbstractQuery;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping\ClassMetadata;
use Doctrine\ORM\Query\Expr;
use Doctrine\ORM\QueryBuilder;
use Myclapboard\ArtistBundle\Model\Interfaces\ArtistInterface;
use PhpSpec\ObjectBehavior;

/**
 * Class ArtistManagerSpec.
 *
 * @package spec\Myclapboard\ArtistBundle\Manager
 */
class ArtistManagerSpec extends ObjectBehavior
{
    function let(
        ManagerRegistry $managerRegistry,
        EntityManager $manager,
        EntityRepository $repository,
        ClassMetadata $metadata
    )
    {
        $managerRegistry->getManagerForClass('Myclapboard\ArtistBundle\Entity\Artist')
            ->shouldBeCalled()->willReturn($manager);
        $manager->getRepository('Myclapboard\ArtistBundle\Entity\Artist')
            ->shouldBeCalled()->willReturn($repository);
        $manager->getClassMetadata('Myclapboard\ArtistBundle\Entity\Artist')
            ->shouldBeCalled()->willReturn($metadata);
        $metadata->getName()
            ->shouldBeCalled()->willReturn('Myclapboard\ArtistBundle\Entity\Artist');
        $this->beConstructedWith($managerRegistry, 'Myclapboard\ArtistBundle\Entity\Artist');
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Myclapboard\ArtistBundle\Manager\ArtistManager');
    }

    function it_creates_artist()
    {
        $this->create()->shouldReturnAnInstanceOf('Myclapboard\ArtistBundle\Entity\Artist');
    }

    function it_finds_one_by_full_name(EntityRepository $repository, ArtistInterface $artist)
    {
        $repository->findOneBy(array('firstName' => 'Quentin', 'lastName' => 'Tarantino'))
            ->shouldBeCalled()->willReturn($artist);

        $this->findOneByFullName('Quentin', 'Tarantino');
    }

    function it_finds_all_with_defaults_values(
        EntityRepository $repository,
        QueryBuilder $queryBuilder,
        AbstractQuery $query,
        ArtistInterface $artist
    )
    {
        $repository->createQueryBuilder('a')->shouldBeCalled()->willReturn($queryBuilder);

        $queryBuilder->select(array('a', 'ac', 'd', 'w', 'i'))
            ->shouldBeCalled()->willReturn($queryBuilder);
        $queryBuilder->leftJoin('a.actors', 'ac')->shouldBeCalled()->willReturn($queryBuilder);
        $queryBuilder->leftJoin('a.directors', 'd')->shouldBeCalled()->willReturn($queryBuilder);
        $queryBuilder->leftJoin('a.writers', 'w')->shouldBeCalled()->willReturn($queryBuilder);
        $queryBuilder->leftJoin('a.images', 'i')->shouldBeCalled()->willReturn($queryBuilder);

        $queryBuilder->where(' 1=1 ')->shouldBeCalled()->willReturn($queryBuilder);
        $queryBuilder->setParameters(array())->shouldBeCalled()->willReturn($queryBuilder);
        $queryBuilder->setMaxResults(10)->shouldBeCalled()->willReturn($queryBuilder);
        $queryBuilder->setFirstResult(10 * 0)->shouldBeCalled()->willReturn($queryBuilder);
        $queryBuilder->orderBy('a.lastName')->shouldBeCalled()->willReturn($queryBuilder);
        $queryBuilder->getQuery()->shouldBeCalled()->willReturn($query);
        $query
            ->setHint(
                \Doctrine\ORM\Query::HINT_CUSTOM_OUTPUT_WALKER,
                'Gedmo\\Translatable\\Query\\TreeWalker\\TranslationWalker'
            )
            ->shouldBeCalled()->willReturn($query);
        $query->getResult()->shouldBeCalled()->willReturn($artist);

        $this->findAll('lastName');
    }

    function it_filters_artist_with_query_parameter(
        EntityRepository $repository,
        QueryBuilder $queryBuilder,
        AbstractQuery $query,
        ArtistInterface $artist
    )
    {
        $repository->createQueryBuilder('a')->shouldBeCalled()->willReturn($queryBuilder);

        $queryBuilder->select(array('a', 'ac', 'd', 'w', 'i'))
            ->shouldBeCalled()->willReturn($queryBuilder);
        $queryBuilder->leftJoin('a.actors', 'ac')->shouldBeCalled()->willReturn($queryBuilder);
        $queryBuilder->leftJoin('a.directors', 'd')->shouldBeCalled()->willReturn($queryBuilder);
        $queryBuilder->leftJoin('a.writers', 'w')->shouldBeCalled()->willReturn($queryBuilder);
        $queryBuilder->leftJoin('a.images', 'i')->shouldBeCalled()->willReturn($queryBuilder);

        $queryBuilder->where(' 1=1 AND a.firstName LIKE :firstName OR a.lastName LIKE :lastName')
            ->shouldBeCalled()->willReturn($queryBuilder);
        $queryBuilder->setParameters(array('firstName' => '%leo%', 'lastName' => '%leo%'))
            ->shouldBeCalled()->willReturn($queryBuilder);
        $queryBuilder->setMaxResults(10)->shouldBeCalled()->willReturn($queryBuilder);
        $queryBuilder->setFirstResult(10 * 0)->shouldBeCalled()->willReturn($queryBuilder);
        $queryBuilder->orderBy('a.firstName')->shouldBeCalled()->willReturn($queryBuilder);
        $queryBuilder->getQuery()->shouldBeCalled()->willReturn($query);
        $query
            ->setHint(
                \Doctrine\ORM\Query::HINT_CUSTOM_OUTPUT_WALKER,
                'Gedmo\\Translatable\\Query\\TreeWalker\\TranslationWalker'
            )
            ->shouldBeCalled()->willReturn($query);
        $query->getResult()->shouldBeCalled()->willReturn($artist);

        $this->findAll('firstName', 'leo');
    }

    function it_finds_one_by_id(
        EntityRepository $repository,
        QueryBuilder $queryBuilder,
        AbstractQuery $query,
        ArtistInterface $artist,
        Expr $expr,
        Expr\Comparison $comparison
    )
    {
        $repository->createQueryBuilder('a')->shouldBeCalled()->willReturn($queryBuilder);

        $queryBuilder->select(array('a', 'ac', 'd', 'w', 'i'))
            ->shouldBeCalled()->willReturn($queryBuilder);
        $queryBuilder->leftJoin('a.actors', 'ac')->shouldBeCalled()->willReturn($queryBuilder);
        $queryBuilder->leftJoin('a.directors', 'd')->shouldBeCalled()->willReturn($queryBuilder);
        $queryBuilder->leftJoin('a.writers', 'w')->shouldBeCalled()->willReturn($queryBuilder);
        $queryBuilder->leftJoin('a.images', 'i')->shouldBeCalled()->willReturn($queryBuilder);
        $queryBuilder->expr()->shouldBeCalled()->willReturn($expr);
        $expr->eq('a.id', ':id')->shouldBeCalled()->willReturn($comparison);
        $queryBuilder->where($comparison)->shouldBeCalled()->willReturn($queryBuilder);
        $queryBuilder->setParameter(':id', 'artist-id')->shouldBeCalled()->willReturn($queryBuilder);
        $queryBuilder->getQuery()->shouldBeCalled()->willReturn($query);
        $query
            ->setHint(
                \Doctrine\ORM\Query::HINT_CUSTOM_OUTPUT_WALKER,
                'Gedmo\\Translatable\\Query\\TreeWalker\\TranslationWalker'
            )
            ->shouldBeCalled()->willReturn($query);
        $query->getOneOrNullResult()->shouldBeCalled()->willReturn($artist);

        $this->findOneById('artist-id')->shouldReturn($artist);
    }
}
