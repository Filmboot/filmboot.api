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
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping\ClassMetadata;
use PhpSpec\ObjectBehavior;

/**
 * Class ReviewManagerSpec.
 *
 * @package spec\Myclapboard\UserBundle\Manager
 */
class ReviewManagerSpec extends ObjectBehavior
{
    function let(
        ManagerRegistry $managerRegistry,
        EntityManager $manager,
        EntityRepository $repository,
        ClassMetadata $metadata
    )
    {
        $managerRegistry->getManagerForClass('Myclapboard\UserBundle\Entity\Review')
            ->shouldBeCalled()->willReturn($manager);
        $manager->getRepository('Myclapboard\UserBundle\Entity\Review')
            ->shouldBeCalled()->willReturn($repository);
        $manager->getClassMetadata('Myclapboard\UserBundle\Entity\Review')
            ->shouldBeCalled()->willReturn($metadata);
        $metadata->getName()
            ->shouldBeCalled()->willReturn('Myclapboard\UserBundle\Entity\Review');
        $this->beConstructedWith($managerRegistry, 'Myclapboard\UserBundle\Entity\Review');
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Myclapboard\UserBundle\Manager\ReviewManager');
    }

    function it_creates_review()
    {
        $this->create()->shouldReturnAnInstanceOf('Myclapboard\UserBundle\Entity\Review');
    }
}
