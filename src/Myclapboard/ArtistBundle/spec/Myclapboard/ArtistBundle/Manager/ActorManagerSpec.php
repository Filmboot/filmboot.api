<?php

/**
 * (c) benatespina <benatespina@gmail.com>
 *
 * This file belongs to myClapboard.
 * The source code of application includes a LICENSE file
 * with all information about license.
 */

namespace spec\Myclapboard\ArtistBundle\Manager;

use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping\ClassMetadata;
use PhpSpec\ObjectBehavior;

/**
 * Class ActorManagerSpec.
 *
 * @package spec\Myclapboard\ArtistBundle\Manager
 */
class ActorManagerSpec extends ObjectBehavior
{
    function let(
        ManagerRegistry $managerRegistry,
        EntityManager $manager,
        EntityRepository $repository,
        ClassMetadata $metadata
    )
    {
        $managerRegistry->getManagerForClass('Myclapboard\ArtistBundle\Entity\Actor')
            ->shouldBeCalled()->willReturn($manager);
        $manager->getRepository('Myclapboard\ArtistBundle\Entity\Actor')
            ->shouldBeCalled()->willReturn($repository);
        $manager->getClassMetadata('Myclapboard\ArtistBundle\Entity\Actor')
            ->shouldBeCalled()->willReturn($metadata);
        $metadata->getName()
            ->shouldBeCalled()->willReturn('Myclapboard\ArtistBundle\Entity\Actor');
        $this->beConstructedWith($managerRegistry, 'Myclapboard\ArtistBundle\Entity\Actor');
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Myclapboard\ArtistBundle\Manager\ActorManager');
    }

    function it_creates_actor()
    {
        $this->create()->shouldReturnAnInstanceOf('Myclapboard\ArtistBundle\Entity\Actor');
    }
}
