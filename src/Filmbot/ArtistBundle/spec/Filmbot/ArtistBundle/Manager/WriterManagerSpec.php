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
 * Class WriterManagerSpec.
 *
 * @package spec\Filmbot\ArtistBundle\Manager
 */
class WriterManagerSpec extends ObjectBehavior
{
    function let(EntityManager $manager, EntityRepository $repository, ClassMetadata $metadata)
    {
        $manager->getRepository('Filmbot\ArtistBundle\Entity\Writer')
            ->shouldBeCalled()->willReturn($repository);
        $manager->getClassMetadata('Filmbot\ArtistBundle\Entity\Writer')
            ->shouldBeCalled()->willReturn($metadata);
        $metadata->name = 'Filmbot\ArtistBundle\Entity\Writer';
        $this->beConstructedWith($manager, 'Filmbot\ArtistBundle\Entity\Writer');
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Filmbot\ArtistBundle\Manager\WriterManager');
    }

    function it_creates_knowledge()
    {
        $this->create()->shouldReturnAnInstanceOf('Filmbot\ArtistBundle\Entity\Writer');
    }
}
