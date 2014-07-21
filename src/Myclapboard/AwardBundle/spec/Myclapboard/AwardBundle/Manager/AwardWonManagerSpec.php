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
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping\ClassMetadata;
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
}
