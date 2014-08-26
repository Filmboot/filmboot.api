<?php

/**
 * (c) benatespina <benatespina@gmail.com>
 *
 * This file belongs to myClapboard.
 * The source code of application includes a LICENSE file
 * with all information about license.
 */

namespace spec\Myclapboard\UserBundle\Manager;

use Doctrine\Common\Collections\Expr\Comparison;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\AbstractQuery;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping\ClassMetadata;
use Doctrine\ORM\Query\Expr;
use Doctrine\ORM\QueryBuilder;
use Myclapboard\UserBundle\Model\RatingInterface;
use PhpSpec\ObjectBehavior;

/**
 * Class RatingManagerSpec.
 *
 * @package spec\Myclapboard\UserBundle\Manager
 */
class RatingManagerSpec extends ObjectBehavior
{
    function let(
        ManagerRegistry $managerRegistry,
        EntityManager $manager,
        EntityRepository $repository,
        ClassMetadata $metadata
    )
    {
        $managerRegistry->getManagerForClass('Myclapboard\UserBundle\Entity\Rating')
            ->shouldBeCalled()->willReturn($manager);
        $manager->getRepository('Myclapboard\UserBundle\Entity\Rating')
            ->shouldBeCalled()->willReturn($repository);
        $manager->getClassMetadata('Myclapboard\UserBundle\Entity\Rating')
            ->shouldBeCalled()->willReturn($metadata);
        $metadata->getName()
            ->shouldBeCalled()->willReturn('Myclapboard\UserBundle\Entity\Rating');
        $this->beConstructedWith($managerRegistry, 'Myclapboard\UserBundle\Entity\Rating');
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Myclapboard\UserBundle\Manager\RatingManager');
    }

    function it_creates_rating()
    {
        $this->create()->shouldReturnAnInstanceOf('Myclapboard\UserBundle\Entity\Rating');
    }

    function it_finds_all(
        EntityRepository $repository,
        QueryBuilder $queryBuilder,
        Expr $expr,
        Comparison $comparison,
        AbstractQuery $query
    )
    {
        $repository->createQueryBuilder('r')->shouldBeCalled()->willReturn($queryBuilder);
        $queryBuilder->select(array('r', 'u', 'm'))->shouldBeCalled()->willReturn($queryBuilder);
        $queryBuilder->leftJoin('r.user', 'u')->shouldBeCalled()->willReturn($queryBuilder);
        $queryBuilder->leftJoin('r.movie', 'm')->shouldBeCalled()->willReturn($queryBuilder);
        $queryBuilder->expr()->shouldBeCalled()->willReturn($expr);
        $expr->eq('u.id', ':id')->shouldBeCalled()->willReturn($comparison);
        $queryBuilder->where($comparison)->shouldBeCalled()->willReturn($queryBuilder);
        $queryBuilder->setParameter(':id', 'user-id')->shouldBeCalled()->willReturn($queryBuilder);
        $queryBuilder->setMaxResults(10)->shouldBeCalled()->willReturn($queryBuilder);
        $queryBuilder->setFirstResult(10 * 0)->shouldBeCalled()->willReturn($queryBuilder);
        $queryBuilder->orderBy('m.title')->shouldBeCalled()->willReturn($queryBuilder);
        $queryBuilder->getQuery()->shouldBeCalled()->willReturn($query);
        $query
            ->setHint(
                \Doctrine\ORM\Query::HINT_CUSTOM_OUTPUT_WALKER,
                'Gedmo\\Translatable\\Query\\TreeWalker\\TranslationWalker'
            )->shouldBeCalled()->willReturn($query);
        $query->getResult()->shouldBeCalled()->willReturn(array());

        $this->findAll('user-id', 'movie', 10, 0)->shouldReturn(array());
    }

    function it_finds_all_by_date(
        EntityRepository $repository,
        QueryBuilder $queryBuilder,
        Expr $expr,
        Comparison $comparison,
        AbstractQuery $query
    )
    {
        $repository->createQueryBuilder('r')->shouldBeCalled()->willReturn($queryBuilder);
        $queryBuilder->select(array('r', 'u', 'm'))->shouldBeCalled()->willReturn($queryBuilder);
        $queryBuilder->leftJoin('r.user', 'u')->shouldBeCalled()->willReturn($queryBuilder);
        $queryBuilder->leftJoin('r.movie', 'm')->shouldBeCalled()->willReturn($queryBuilder);
        $queryBuilder->expr()->shouldBeCalled()->willReturn($expr);
        $expr->eq('u.id', ':id')->shouldBeCalled()->willReturn($comparison);
        $queryBuilder->where($comparison)->shouldBeCalled()->willReturn($queryBuilder);
        $queryBuilder->setParameter(':id', 'user-id')->shouldBeCalled()->willReturn($queryBuilder);
        $queryBuilder->setMaxResults(10)->shouldBeCalled()->willReturn($queryBuilder);
        $queryBuilder->setFirstResult(10 * 0)->shouldBeCalled()->willReturn($queryBuilder);
        $queryBuilder->orderBy('r.date')->shouldBeCalled()->willReturn($queryBuilder);
        $queryBuilder->getQuery()->shouldBeCalled()->willReturn($query);
        $query
            ->setHint(
                \Doctrine\ORM\Query::HINT_CUSTOM_OUTPUT_WALKER,
                'Gedmo\\Translatable\\Query\\TreeWalker\\TranslationWalker'
            )->shouldBeCalled()->willReturn($query);
        $query->getResult()->shouldBeCalled()->willReturn(array());

        $this->findAll('user-id', 'date', 10, 0)->shouldReturn(array());
    }

    function it_finds_one_by_user_and_movie(
        EntityRepository $repository,
        QueryBuilder $queryBuilder,
        Expr $expr,
        Comparison $comparison,
        Comparison $comparison2,
        AbstractQuery $query,
        RatingInterface $rating
    )
    {
        $repository->createQueryBuilder('r')->shouldBeCalled()->willReturn($queryBuilder);
        $queryBuilder->select(array('r', 'u', 'm'))->shouldBeCalled()->willReturn($queryBuilder);
        $queryBuilder->leftJoin('r.user', 'u')->shouldBeCalled()->willReturn($queryBuilder);
        $queryBuilder->leftJoin('r.movie', 'm')->shouldBeCalled()->willReturn($queryBuilder);
        $queryBuilder->expr()->shouldBeCalled()->willReturn($expr);
        $expr->eq('r.user', ':user')->shouldBeCalled()->willReturn($comparison);
        $queryBuilder->where($comparison)->shouldBeCalled()->willReturn($queryBuilder);
        $expr->eq('r.movie', ':movie')->shouldBeCalled()->willReturn($comparison2);
        $queryBuilder->andWhere($comparison2)->shouldBeCalled()->willReturn($queryBuilder);
        $queryBuilder->setParameters(array(':user' => 'user-id', ':movie' => 'movie-id'))
            ->shouldBeCalled()->willReturn($queryBuilder);
        $queryBuilder->getQuery()->shouldBeCalled()->willReturn($query);
        $query
            ->setHint(
                \Doctrine\ORM\Query::HINT_CUSTOM_OUTPUT_WALKER,
                'Gedmo\\Translatable\\Query\\TreeWalker\\TranslationWalker'
            )->shouldBeCalled()->willReturn($query);
        $query->getOneOrNullResult()->shouldBeCalled()->willReturn($rating);

        $this->findOneByUserAndMovie('user-id', 'movie-id')->shouldReturn($rating);
    }
}
