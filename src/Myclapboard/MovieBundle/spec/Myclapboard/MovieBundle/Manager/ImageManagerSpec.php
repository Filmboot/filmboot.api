<?php

/**
 * (c) benatespina <benatespina@gmail.com>
 *
 * This file belongs to myClapboard.
 * The source code of application includes a LICENSE file
 * with all information about license.
 */

namespace spec\Myclapboard\MovieBundle\Manager;

use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping\ClassMetadata;
use PhpSpec\ObjectBehavior;

/**
 * Class ImageManagerSpec.
 *
 * @package spec\Myclapboard\MovieBundle\Manager
 */
class ImageManagerSpec extends ObjectBehavior
{
    function let(
        ManagerRegistry $managerRegistry,
        EntityManager $manager,
        EntityRepository $repository,
        ClassMetadata $metadata
    )
    {
        $managerRegistry->getManagerForClass('Myclapboard\MovieBundle\Entity\Image')
            ->shouldBeCalled()->willReturn($manager);
        $manager->getRepository('Myclapboard\MovieBundle\Entity\Image')
            ->shouldBeCalled()->willReturn($repository);
        $manager->getClassMetadata('Myclapboard\MovieBundle\Entity\Image')
            ->shouldBeCalled()->willReturn($metadata);
        $metadata->getName()
            ->shouldBeCalled()->willReturn('Myclapboard\MovieBundle\Entity\Image');
        $this->beConstructedWith($managerRegistry, 'Myclapboard\MovieBundle\Entity\Image');
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Myclapboard\MovieBundle\Manager\ImageManager');
    }

    function it_creates_image()
    {
        $this->create()->shouldReturnAnInstanceOf('Myclapboard\MovieBundle\Entity\Image');
    }
}
