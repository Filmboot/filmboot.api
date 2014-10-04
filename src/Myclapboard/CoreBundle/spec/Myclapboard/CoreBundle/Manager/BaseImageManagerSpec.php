<?php

/**
 * This file belongs to myClapboard.
 * The source code of application includes a LICENSE file
 * with all information about license.
 *
 * @author benatespina <benatespina@gmail.com>
 * @author gorkalaucirica <gorka.lauzirika@gmail.com>
 */

namespace spec\Myclapboard\CoreBundle\Manager;

use Doctrine\Common\Persistence\ManagerRegistry;
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
    function let(
        ManagerRegistry $managerRegistry,
        EntityManager $manager,
        EntityRepository $repository,
        ClassMetadata $metadata
    )
    {
        $managerRegistry->getManagerForClass('Myclapboard\CoreBundle\Entity\BaseImage')
            ->shouldBeCalled()->willReturn($manager);
        $manager->getRepository('Myclapboard\CoreBundle\Entity\BaseImage')
            ->shouldBeCalled()->willReturn($repository);
        $manager->getClassMetadata('Myclapboard\CoreBundle\Entity\BaseImage')
            ->shouldBeCalled()->willReturn($metadata);
        $metadata->getName()
            ->shouldBeCalled()->willReturn('Myclapboard\CoreBundle\Entity\BaseImage');
        $this->beConstructedWith($managerRegistry, 'Myclapboard\CoreBundle\Entity\BaseImage');
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
