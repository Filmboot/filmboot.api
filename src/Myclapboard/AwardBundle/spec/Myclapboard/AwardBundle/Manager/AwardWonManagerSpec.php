<?php

/**
 * (c) benatespina <benatespina@gmail.com>
 *
 * This file belongs to myClapboard.
 * The source code of application includes a LICENSE file
 * with all information about license.
 */

namespace spec\Myclapboard\AwardBundle\Manager;

use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\AbstractQuery;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping\ClassMetadata;
use Doctrine\ORM\Query\Expr;
use Doctrine\ORM\Query\Expr\Comparison;
use Doctrine\ORM\QueryBuilder;
use PhpSpec\ObjectBehavior;

/**
 * Class AwardWonManagerSpec.
 *
 * @package spec\Myclapboard\ArtistBundle\Manager
 */
class AwardWonManagerSpec extends ObjectBehavior
{
    function let(
        ManagerRegistry $managerRegistry,
        EntityManager $manager,
        EntityRepository $repository,
        ClassMetadata $metadata
    )
    {
        $managerRegistry->getManagerForClass('Myclapboard\AwardBundle\Entity\AwardWon')
            ->shouldBeCalled()->willReturn($manager);
        $manager->getRepository('Myclapboard\AwardBundle\Entity\AwardWon')
            ->shouldBeCalled()->willReturn($repository);
        $manager->getClassMetadata('Myclapboard\AwardBundle\Entity\AwardWon')
            ->shouldBeCalled()->willReturn($metadata);
        $metadata->getName()
            ->shouldBeCalled()->willReturn('Myclapboard\AwardBundle\Entity\AwardWon');
        $this->beConstructedWith($managerRegistry, 'Myclapboard\AwardBundle\Entity\AwardWon');
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Myclapboard\AwardBundle\Manager\AwardWonManager');
    }

    function it_creates_awardWon()
    {
        $this->create()->shouldReturnAnInstanceOf('Myclapboard\AwardBundle\Entity\AwardWon');
    }

    function it_finds_all_by_movie(EntityRepository $repository)
    {
        $repository->findBy(array('movie' => 'movie-id'))
            ->shouldBeCalled()->willReturn(array());

        $this->findAllByMovie('movie-id')->shouldReturn(array());
    }
    
    function it_finds_all_by_artist(
        EntityRepository $repository,
        QueryBuilder $queryBuilder,
        AbstractQuery $query,
        Expr $expr,
        Comparison $comparison,
        Comparison $comparison2,
        Comparison $comparison3
    )
    {
        $repository->createQueryBuilder('aw')->shouldBeCalled()->willReturn($queryBuilder);

        $queryBuilder->select(array('aw', 'a', 'd', 'w'))
            ->shouldBeCalled()->willReturn($queryBuilder);
        $queryBuilder->leftJoin('aw.actor', 'a')->shouldBeCalled()->willReturn($queryBuilder);
        $queryBuilder->leftJoin('aw.director', 'd')->shouldBeCalled()->willReturn($queryBuilder);
        $queryBuilder->leftJoin('aw.writer', 'w')->shouldBeCalled()->willReturn($queryBuilder);
        $queryBuilder->expr()->shouldBeCalled()->willReturn($expr);
        $expr->eq('a.artist', ':id')->shouldBeCalled()->willReturn($comparison);
        $queryBuilder->where($comparison)->shouldBeCalled()->willReturn($queryBuilder);
        $expr->eq('d.artist', ':id')->shouldBeCalled()->willReturn($comparison2);
        $queryBuilder->orWhere($comparison2)->shouldBeCalled()->willReturn($queryBuilder);
        $expr->eq('w.artist', ':id')->shouldBeCalled()->willReturn($comparison3);
        $queryBuilder->orWhere($comparison3)->shouldBeCalled()->willReturn($queryBuilder);
        $queryBuilder->setParameter(':id', 'artist-id')->shouldBeCalled()->willReturn($queryBuilder);
        $queryBuilder->getQuery()->shouldBeCalled()->willReturn($query);
        $query
            ->setHint(
                \Doctrine\ORM\Query::HINT_CUSTOM_OUTPUT_WALKER,
                'Gedmo\\Translatable\\Query\\TreeWalker\\TranslationWalker'
            )
            ->shouldBeCalled()->willReturn($query);
        $query->getResult()->shouldBeCalled()->willReturn(array());
        
        $this->findAllByArtist('artist-id')->shouldReturn(array());
    }
}
