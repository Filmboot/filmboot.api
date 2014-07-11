<?php

/**
 * (c) benatespina <benatespina@gmail.com>
 *
 * This file belongs to myClapboard.
 * The source code of application includes a LICENSE file
 * with all information about license.
 */

namespace spec\Myclapboard\CoreBundle\Manager;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping\ClassMetadata;
use PhpSpec\ObjectBehavior;

/**
 * Class BaseImageManagerSpec.
 *
 * @package spec\Myclapboard\CoreBundle\Manager
 */
class BaseImageManagerSpec extends ObjectBehavior
{
    function let(EntityManager $manager, EntityRepository $repository, ClassMetadata $metadata)
    {
        $manager->getRepository('Myclapboard\CoreBundle\Entity\BaseImage')
            ->shouldBeCalled()->willReturn($repository);
        $manager->getClassMetadata('Myclapboard\CoreBundle\Entity\BaseImage')
            ->shouldBeCalled()->willReturn($metadata);
        $metadata->name = 'Myclapboard\CoreBundle\Entity\BaseImage';
        $this->beConstructedWith($manager, 'Myclapboard\CoreBundle\Entity\BaseImage');
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Myclapboard\CoreBundle\Manager\BaseImageManager');
    }

    function it_creates_base_image()
    {
        $this->create()->shouldReturnAnInstanceOf('Myclapboard\CoreBundle\Entity\BaseImage');
    }
}
