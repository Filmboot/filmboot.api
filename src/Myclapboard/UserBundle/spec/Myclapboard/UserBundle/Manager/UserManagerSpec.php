<?php

/**
 * (c) benatespina <benatespina@gmail.com>
 *
 * This file belongs to myClapboard.
 * The source code of application includes a LICENSE file
 * with all information about license.
 */

namespace spec\Myclapboard\UserBundle\Manager;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping\ClassMetadata;
use PhpSpec\ObjectBehavior;

/**
 * Class UserManagerSpec.
 *
 * @package spec\Myclapboard\UserBundle\Manager
 */
class UserManagerSpec extends ObjectBehavior
{
    function let(EntityManager $manager, EntityRepository $repository, ClassMetadata $metadata)
    {
        $manager->getRepository('Myclapboard\UserBundle\Entity\User')
            ->shouldBeCalled()->willReturn($repository);
        $manager->getClassMetadata('Myclapboard\UserBundle\Entity\User')
            ->shouldBeCalled()->willReturn($metadata);
        $metadata->name = 'Myclapboard\UserBundle\Entity\User';
        $this->beConstructedWith($manager, 'Myclapboard\UserBundle\Entity\User');
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Myclapboard\UserBundle\Manager\UserManager');
    }

    function it_creates_user()
    {
        $this->create()->shouldReturnAnInstanceOf('Myclapboard\UserBundle\Entity\User');
    }
}
