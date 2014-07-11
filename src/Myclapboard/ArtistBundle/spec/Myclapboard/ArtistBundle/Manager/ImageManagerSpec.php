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
 * Class ImageManagerSpec.
 *
 * @package spec\Myclapboard\ArtistBundle\Manager
 */
class ImageManagerSpec extends ObjectBehavior
{
    function let(EntityManager $manager, EntityRepository $repository, ClassMetadata $metadata)
    {
        $manager->getRepository('Myclapboard\ArtistBundle\Entity\Image')
            ->shouldBeCalled()->willReturn($repository);
        $manager->getClassMetadata('Myclapboard\ArtistBundle\Entity\Image')
            ->shouldBeCalled()->willReturn($metadata);
        $metadata->name = 'Myclapboard\ArtistBundle\Entity\Image';
        $this->beConstructedWith($manager, 'Myclapboard\ArtistBundle\Entity\Image');
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Myclapboard\ArtistBundle\Manager\ImageManager');
    }

    function it_creates_image()
    {
        $this->create()->shouldReturnAnInstanceOf('Myclapboard\ArtistBundle\Entity\Image');
    }
}