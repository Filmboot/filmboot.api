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
 * Class WriterManagerSpec.
 *
 * @package spec\Myclapboard\ArtistBundle\Manager
 */
class WriterManagerSpec extends ObjectBehavior
{
    function let(EntityManager $manager, EntityRepository $repository, ClassMetadata $metadata)
    {
        $manager->getRepository('Myclapboard\ArtistBundle\Entity\Writer')
            ->shouldBeCalled()->willReturn($repository);
        $manager->getClassMetadata('Myclapboard\ArtistBundle\Entity\Writer')
            ->shouldBeCalled()->willReturn($metadata);
        $metadata->name = 'Myclapboard\ArtistBundle\Entity\Writer';
        $this->beConstructedWith($manager, 'Myclapboard\ArtistBundle\Entity\Writer');
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Myclapboard\ArtistBundle\Manager\WriterManager');
    }

    function it_creates_knowledge()
    {
        $this->create()->shouldReturnAnInstanceOf('Myclapboard\ArtistBundle\Entity\Writer');
    }
}
