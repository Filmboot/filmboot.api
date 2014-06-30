<?php

/**
 * (c) benatespina <benatespina@gmail.com>
 *
 * This file belongs to Filmboot.
 * The source code of application includes a LICENSE file
 * with all information about license.
 */

namespace spec\Filmboot\ArtistBundle\Manager;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping\ClassMetadata;
use PhpSpec\ObjectBehavior;

class ArtistManagerSpec extends ObjectBehavior
{
    function let(EntityManager $manager, EntityRepository $repository, ClassMetadata $metadata)
    {
        $manager->getRepository('Filmboot\ArtistBundle\Entity\Artist')
            ->shouldBeCalled()->willReturn($repository);
        $manager->getClassMetadata('Filmboot\ArtistBundle\Entity\Artist')
            ->shouldBeCalled()->willReturn($metadata);
        $metadata->name = 'Filmboot\ArtistBundle\Entity\Artist';
        $this->beConstructedWith($manager, 'Filmboot\ArtistBundle\Entity\Artist');
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Filmboot\ArtistBundle\Manager\ArtistManager');
    }

    function it_creates_knowledge()
    {
        $this->create()->shouldReturnAnInstanceOf('Filmboot\ArtistBundle\Entity\Artist');
    }
}
