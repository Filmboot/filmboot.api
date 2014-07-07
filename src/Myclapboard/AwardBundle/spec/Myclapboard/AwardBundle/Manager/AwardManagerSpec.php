<?php

/**
 * (c) benatespina <benatespina@gmail.com>
 *
 * This file belongs to myClapboard.
 * The source code of application includes a LICENSE file
 * with all information about license.
 */

namespace spec\Myclapboard\AwardBundle\Manager;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping\ClassMetadata;
use Myclapboard\AwardBundle\Model\AwardInterface;
use PhpSpec\ObjectBehavior;

/**
 * Class AwardManagerSpec.
 *
 * @package spec\Myclapboard\ArtistBundle\Manager
 */
class AwardManagerSpec extends ObjectBehavior
{
    function let(EntityManager $manager, EntityRepository $repository, ClassMetadata $metadata)
    {
        $manager->getRepository('Myclapboard\AwardBundle\Entity\Award')
            ->shouldBeCalled()->willReturn($repository);
        $manager->getClassMetadata('Myclapboard\AwardBundle\Entity\Award')
            ->shouldBeCalled()->willReturn($metadata);
        $metadata->name = 'Myclapboard\AwardBundle\Entity\Award';
        $this->beConstructedWith($manager, 'Myclapboard\AwardBundle\Entity\Award');
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Myclapboard\AwardBundle\Manager\AwardManager');
    }

    function it_creates_award()
    {
        $this->create()->shouldReturnAnInstanceOf('Myclapboard\AwardBundle\Entity\Award');
    }

    function it_finds_one_by_name(EntityRepository $repository, AwardInterface $award)
    {
        $repository->findOneBy(array('name' => 'award-name'))
            ->shouldBeCalled()->willReturn($award);

        $this->findOneByName('award-name');
    }
}
