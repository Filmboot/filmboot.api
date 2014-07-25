<?php

/**
 * (c) benatespina <benatespina@gmail.com>
 *
 * This file belongs to myClapboard.
 * The source code of application includes a LICENSE file
 * with all information about license.
 */

namespace spec\Myclapboard\UserBundle\Manager;

use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\AbstractQuery;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping\ClassMetadata;
use Doctrine\ORM\QueryBuilder;
use PhpSpec\ObjectBehavior;

/**
 * Class UserManagerSpec.
 *
 * @package spec\Myclapboard\UserBundle\Manager
 */
class UserManagerSpec extends ObjectBehavior
{
    function let(
        ManagerRegistry $managerRegistry,
        EntityManager $manager,
        EntityRepository $repository,
        ClassMetadata $metadata
    )
    {
        $managerRegistry->getManagerForClass('Myclapboard\UserBundle\Entity\User')
            ->shouldBeCalled()->willReturn($manager);
        $manager->getRepository('Myclapboard\UserBundle\Entity\User')
            ->shouldBeCalled()->willReturn($repository);
        $manager->getClassMetadata('Myclapboard\UserBundle\Entity\User')
            ->shouldBeCalled()->willReturn($metadata);
        $metadata->getName()
            ->shouldBeCalled()->willReturn('Myclapboard\UserBundle\Entity\User');
        $this->beConstructedWith($managerRegistry, 'Myclapboard\UserBundle\Entity\User');
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Myclapboard\UserBundle\Manager\UserManager');
    }

    function it_creates_user()
    {
        $this->create()->shouldReturnAnInstanceOf('Myclapboard\UserBundle\Entity\User');
    }

    function it_finds_all(EntityRepository $repository, QueryBuilder $queryBuilder, AbstractQuery $query)
    {
        $repository->createQueryBuilder('u')
            ->shouldBeCalled()->willReturn($queryBuilder);
        $queryBuilder->select(array('u', 'r', 're'))
            ->shouldBeCalled()->willReturn($queryBuilder);
        $queryBuilder->leftJoin('u.ratings', 'r')
            ->shouldBeCalled()->willReturn($queryBuilder);
        $queryBuilder->leftJoin('u.reviews', 're')
            ->shouldBeCalled()->willReturn($queryBuilder);
        $queryBuilder->getQuery()->shouldBeCalled()->willReturn($query);

        $query->getResult()->shouldBeCalled()->willReturn(array());

        $this->findAll()->shouldReturn(array());
    }
}
