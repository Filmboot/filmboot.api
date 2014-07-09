<?php

/**
 * (c) benatespina <benatespina@gmail.com>
 *
 * This file belongs to myClapboard.
 * The source code of application includes a LICENSE file
 * with all information about license.
 */

namespace spec\Myclapboard\ArtistBundle\Manager;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping\ClassMetadata;
use PhpSpec\ObjectBehavior;

/**
 * Class DirectorManagerSpec.
 *
 * @package spec\Myclapboard\ArtistBundle\Manager
 */
class DirectorManagerSpec extends ObjectBehavior
{
    function let(EntityManager $manager, EntityRepository $repository, ClassMetadata $metadata)
    {
        $manager->getRepository('Myclapboard\ArtistBundle\Entity\Director')
            ->shouldBeCalled()->willReturn($repository);
        $manager->getClassMetadata('Myclapboard\ArtistBundle\Entity\Director')
            ->shouldBeCalled()->willReturn($metadata);
        $metadata->name = 'Myclapboard\ArtistBundle\Entity\Director';
        $this->beConstructedWith($manager, 'Myclapboard\ArtistBundle\Entity\Director');
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Myclapboard\ArtistBundle\Manager\DirectorManager');
    }

    function it_creates_director()
    {
        $this->create()->shouldReturnAnInstanceOf('Myclapboard\ArtistBundle\Entity\Director');
    }
}
