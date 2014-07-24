<?php

/**
 * (c) benatespina <benatespina@gmail.com>
 *
 * This file belongs to myClapboard.
 * The source code of application includes a LICENSE file
 * with all information about license.
 */

namespace spec\Myclapboard\UserBundle\Provider;

use Doctrine\Common\Collections\Expr\Comparison;
use Doctrine\ORM\AbstractQuery;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping\ClassMetadata;
use Doctrine\ORM\Query\Expr;
use Doctrine\ORM\QueryBuilder;
use Myclapboard\UserBundle\Model\UserInterface;
use PhpSpec\ObjectBehavior;
use Symfony\Bridge\Doctrine\ManagerRegistry;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Security\Core\Encoder\EncoderFactory;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;

/**
 * Class UserProviderSpec.
 *
 * @package spec\Myclapboard\UserBundle\Provider
 */
class UserProviderSpec extends ObjectBehavior
{
    function let(
        ManagerRegistry $managerRegistry,
        EntityManager $manager,
        EntityRepository $repository,
        Session $session,
        EncoderFactory $encoderFactory,
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
        
       $this->beConstructedWith($managerRegistry, $session, $encoderFactory, 'Myclapboard\UserBundle\Entity\User'); 
    }
    
    function it_is_initializable()
    {
        $this->shouldHaveType('Myclapboard\UserBundle\Provider\UserProvider');
    }

    function it_implements_user_interface()
    {
        $this->shouldImplement('Symfony\Component\Security\Core\User\UserProviderInterface');
    }
    
    function it_does_not_load_user_by_username_because_user_does_not_exist(
        EntityRepository $repository,
        QueryBuilder $queryBuilder,
        Expr $expr,
        Comparison $comparison,
        AbstractQuery $query
    )
    {
        $repository->createQueryBuilder('u')
            ->shouldBeCalled()->willReturn($queryBuilder);

        $queryBuilder->select(array('u'))->shouldBeCalled()->willReturn($queryBuilder);
        $queryBuilder->expr()->shouldBeCalled()->willReturn($expr);
        $expr->eq('u.email', ':username')->shouldBeCalled()->willReturn($comparison);
        $queryBuilder->where($comparison)->shouldBeCalled()->willReturn($queryBuilder);
        $queryBuilder->setParameter('username', 'my-username')
            ->shouldBeCalled()->willReturn($queryBuilder);
        $queryBuilder->getQuery()->shouldBeCalled()->willReturn($query);

        $query->getOneOrNullResult()->shouldBeCalled()->willReturn(null);
        
        $this->shouldThrow(new UsernameNotFoundException())
            ->during('loadUserByUsername', array('my-username'));
    }
    
    function it_loads_user_by_username(
        EntityRepository $repository,
        QueryBuilder $queryBuilder,
        Expr $expr,
        Comparison $comparison,
        AbstractQuery $query,
        UserInterface $user
    )
    {
        $repository->createQueryBuilder('u')
            ->shouldBeCalled()->willReturn($queryBuilder);

        $queryBuilder->select(array('u'))->shouldBeCalled()->willReturn($queryBuilder);
        $queryBuilder->expr()->shouldBeCalled()->willReturn($expr);
        $expr->eq('u.email', ':username')->shouldBeCalled()->willReturn($comparison);
        $queryBuilder->where($comparison)->shouldBeCalled()->willReturn($queryBuilder);
        $queryBuilder->setParameter('username', 'my-username')
            ->shouldBeCalled()->willReturn($queryBuilder);
        $queryBuilder->getQuery()->shouldBeCalled()->willReturn($query);

        $query->getOneOrNullResult()->shouldBeCalled()->willReturn($user);

        $this->loadUserByUsername('my-username')->shouldReturn($user);
    }
    function it_does_not_refresh_because_it_does_not_supported(
        \Symfony\Component\Security\Core\User\UserInterface $user
    )
    {
        $this->shouldThrow(
            new UnsupportedUserException(
                sprintf('Instances of "%s" are not supported.', 'Double\UserInterface\P93')
            )
        )->during('refreshUser', array($user));
    }
    
    function it_refreshes_user()
    {
    }
    
    function it_supports_class()
    {
        $this->supportsClass('Myclapboard\UserBundle\Entity\User')->shouldReturn(true);
    }

    function it_supports_class_if_is_subclass()
    {
    }
}
