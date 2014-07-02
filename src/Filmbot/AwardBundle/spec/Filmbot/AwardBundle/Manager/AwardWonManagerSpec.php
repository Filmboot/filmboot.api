<?php

/**
 * (c) benatespina <benatespina@gmail.com>
 *
 * This file belongs to Filmbot.
 * The source code of application includes a LICENSE file
 * with all information about license.
 */

namespace spec\Filmbot\AwardBundle\Manager;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping\ClassMetadata;
use PhpSpec\ObjectBehavior;

/**
 * Class AwardWonManagerSpec.
 *
 * @package spec\Filmbot\ArtistBundle\Manager
 */
class AwardWonManagerSpec extends ObjectBehavior
{
    function let(EntityManager $manager, EntityRepository $repository, ClassMetadata $metadata)
    {
        $manager->getRepository('Filmbot\AwardBundle\Entity\AwardWon')
            ->shouldBeCalled()->willReturn($repository);
        $manager->getClassMetadata('Filmbot\AwardBundle\Entity\AwardWon')
            ->shouldBeCalled()->willReturn($metadata);
        $metadata->name = 'Filmbot\AwardBundle\Entity\AwardWon';
        $this->beConstructedWith($manager, 'Filmbot\AwardBundle\Entity\AwardWon');
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Filmbot\AwardBundle\Manager\AwardWonManager');
    }

    function it_creates_awardWon()
    {
        $this->create()->shouldReturnAnInstanceOf('Filmbot\AwardBundle\Entity\AwardWon');
    }
}
