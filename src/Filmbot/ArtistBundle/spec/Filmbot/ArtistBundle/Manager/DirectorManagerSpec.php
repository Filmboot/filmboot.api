<?php

/**
 * (c) benatespina <benatespina@gmail.com>
 *
 * This file belongs to Filmbot.
 * The source code of application includes a LICENSE file
 * with all information about license.
 */

namespace spec\Filmbot\ArtistBundle\Manager;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping\ClassMetadata;
use PhpSpec\ObjectBehavior;

/**
 * Class DirectorManagerSpec.
 *
 * @package spec\Filmbot\ArtistBundle\Manager
 */
class DirectorManagerSpec extends ObjectBehavior
{
    function let(EntityManager $manager, EntityRepository $repository, ClassMetadata $metadata)
    {
        $manager->getRepository('Filmbot\ArtistBundle\Entity\Director')
            ->shouldBeCalled()->willReturn($repository);
        $manager->getClassMetadata('Filmbot\ArtistBundle\Entity\Director')
            ->shouldBeCalled()->willReturn($metadata);
        $metadata->name = 'Filmbot\ArtistBundle\Entity\Director';
        $this->beConstructedWith($manager, 'Filmbot\ArtistBundle\Entity\Director');
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Filmbot\ArtistBundle\Manager\DirectorManager');
    }

    function it_creates_knowledge()
    {
        $this->create()->shouldReturnAnInstanceOf('Filmbot\ArtistBundle\Entity\Director');
    }
}
