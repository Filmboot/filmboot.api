<?php

/**
 * (c) benatespina <benatespina@gmail.com>
 *
 * This file belongs to Filmbot.
 * The source code of application includes a LICENSE file
 * with all information about license.
 */

namespace spec\Filmbot\MovieBundle\Manager;

use Doctrine\ORM\AbstractQuery;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping\ClassMetadata;
use Doctrine\ORM\QueryBuilder;
use Filmbot\MovieBundle\Model\MovieInterface;
use PhpSpec\ObjectBehavior;

/**
 * Class MovieManagerSpec.
 *
 * @package spec\Filmbot\MovieBundle\Manager
 */
class MovieManagerSpec extends ObjectBehavior
{
    function let(EntityManager $manager, EntityRepository $repository, ClassMetadata $metadata)
    {
        $manager->getRepository('Filmbot\MovieBundle\Entity\Movie')
            ->shouldBeCalled()->willReturn($repository);
        $manager->getClassMetadata('Filmbot\MovieBundle\Entity\Movie')
            ->shouldBeCalled()->willReturn($metadata);
        $metadata->name = 'Filmbot\MovieBundle\Entity\Movie';
        $this->beConstructedWith($manager, 'Filmbot\MovieBundle\Entity\Movie');
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Filmbot\MovieBundle\Manager\MovieManager');
    }

    function it_creates_movies()
    {
        $this->create()->shouldReturnAnInstanceOf('Filmbot\MovieBundle\Entity\Movie');
    }

    function it_finds_one_by_title(EntityRepository $repository, MovieInterface $movie)
    {
        $repository->findOneBy(array('title' => 'movie-title'))
            ->shouldBeCalled()->willReturn($movie);

        $this->findOneByTitle('movie-title');
    }

    function it_finds_all_with_defaults_values(
        EntityRepository $repository,
        QueryBuilder $queryBuilder,
        AbstractQuery $query,
        MovieInterface $movie
    )
    {
        $repository->createQueryBuilder('m')->shouldBeCalled()->willReturn($queryBuilder);

        $queryBuilder->select(array('m', 'c', 'ca', 'd', 'w', 'g'))
            ->shouldBeCalled()->willReturn($queryBuilder);
        $queryBuilder->leftJoin('m.country', 'c')->shouldBeCalled()->willReturn($queryBuilder);
        $queryBuilder->leftJoin('m.cast', 'ca')->shouldBeCalled()->willReturn($queryBuilder);
        $queryBuilder->leftJoin('m.directors', 'd')->shouldBeCalled()->willReturn($queryBuilder);
        $queryBuilder->leftJoin('m.writers', 'w')->shouldBeCalled()->willReturn($queryBuilder);
        $queryBuilder->leftJoin('m.genres', 'g')->shouldBeCalled()->willReturn($queryBuilder);
        $queryBuilder->where(" 1=1 ")->shouldBeCalled()->willReturn($queryBuilder);
        $queryBuilder->setParameters(array())->shouldBeCalled()->willReturn($queryBuilder);
        $queryBuilder->setMaxResults(10)->shouldBeCalled()->willReturn($queryBuilder);
        $queryBuilder->setFirstResult(10 * 0)->shouldBeCalled()->willReturn($queryBuilder);
        $queryBuilder->orderBy('m.title')->shouldBeCalled()->willReturn($queryBuilder);
        $queryBuilder->getQuery()->shouldBeCalled()->willReturn($query);
        $query
            ->setHint(
                \Doctrine\ORM\Query::HINT_CUSTOM_OUTPUT_WALKER,
                'Gedmo\\Translatable\\Query\\TreeWalker\\TranslationWalker'
            )
            ->shouldBeCalled()->willReturn($query);
        $query->getResult()->shouldBeCalled()->willReturn($movie);

        $this->findAll('title');
    }

    function it_filters_knowledge_with_query_parameter(
        EntityRepository $repository,
        QueryBuilder $queryBuilder,
        AbstractQuery $query,
        MovieInterface $movie
    )
    {
        $repository->createQueryBuilder('m')->shouldBeCalled()->willReturn($queryBuilder);

        $queryBuilder->select(array('m', 'c', 'ca', 'd', 'w', 'g'))
            ->shouldBeCalled()->willReturn($queryBuilder);
        $queryBuilder->leftJoin('m.country', 'c')->shouldBeCalled()->willReturn($queryBuilder);
        $queryBuilder->leftJoin('m.cast', 'ca')->shouldBeCalled()->willReturn($queryBuilder);
        $queryBuilder->leftJoin('m.directors', 'd')->shouldBeCalled()->willReturn($queryBuilder);
        $queryBuilder->leftJoin('m.writers', 'w')->shouldBeCalled()->willReturn($queryBuilder);
        $queryBuilder->leftJoin('m.genres', 'g')->shouldBeCalled()->willReturn($queryBuilder);
        $queryBuilder->where(" 1=1 AND m.title LIKE :title ")->shouldBeCalled()->willReturn($queryBuilder);
        $queryBuilder->setParameters(array('title' => '%dj%'))->shouldBeCalled()->willReturn($queryBuilder);
        $queryBuilder->setMaxResults(10)->shouldBeCalled()->willReturn($queryBuilder);
        $queryBuilder->setFirstResult(10 * 0)->shouldBeCalled()->willReturn($queryBuilder);
        $queryBuilder->orderBy('m.country')->shouldBeCalled()->willReturn($queryBuilder);
        $queryBuilder->getQuery()->shouldBeCalled()->willReturn($query);
        $query
            ->setHint(
                \Doctrine\ORM\Query::HINT_CUSTOM_OUTPUT_WALKER,
                'Gedmo\\Translatable\\Query\\TreeWalker\\TranslationWalker'
            )
            ->shouldBeCalled()->willReturn($query);
        $query->getResult()->shouldBeCalled()->willReturn($movie);

        $this->findAll('country', "dj");
    }
}
