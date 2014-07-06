<?php

/**
 * (c) benatespina <benatespina@gmail.com>
 *
 * This file belongs to Myclapboard.
 * The source code of application includes a LICENSE file
 * with all information about license.
 */

namespace spec\Myclapboard\AwardBundle\Manager;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping\ClassMetadata;
use PhpSpec\ObjectBehavior;

/**
 * Class AwardWonManagerSpec.
 *
 * @package spec\Myclapboard\ArtistBundle\Manager
 */
class AwardWonManagerSpec extends ObjectBehavior
{
    function let(EntityManager $manager, EntityRepository $repository, ClassMetadata $metadata)
    {
        $manager->getRepository('Myclapboard\AwardBundle\Entity\AwardWon')
            ->shouldBeCalled()->willReturn($repository);
        $manager->getClassMetadata('Myclapboard\AwardBundle\Entity\AwardWon')
            ->shouldBeCalled()->willReturn($metadata);
        $metadata->name = 'Myclapboard\AwardBundle\Entity\AwardWon';
        $this->beConstructedWith($manager, 'Myclapboard\AwardBundle\Entity\AwardWon');
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Myclapboard\AwardBundle\Manager\AwardWonManager');
    }

    function it_creates_awardWon()
    {
        $this->create()->shouldReturnAnInstanceOf('Myclapboard\AwardBundle\Entity\AwardWon');
    }
}
