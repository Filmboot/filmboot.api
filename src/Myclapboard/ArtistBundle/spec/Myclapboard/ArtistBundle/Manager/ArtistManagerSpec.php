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
use Myclapboard\ArtistBundle\Model\ArtistInterface;
use PhpSpec\ObjectBehavior;

/**
 * Class ArtistManagerSpec.
 *
 * @package spec\Myclapboard\ArtistBundle\Manager
 */
class ArtistManagerSpec extends ObjectBehavior
{
    function let(EntityManager $manager, EntityRepository $repository, ClassMetadata $metadata)
    {
        $manager->getRepository('Myclapboard\ArtistBundle\Entity\Artist')
            ->shouldBeCalled()->willReturn($repository);
        $manager->getClassMetadata('Myclapboard\ArtistBundle\Entity\Artist')
            ->shouldBeCalled()->willReturn($metadata);
        $metadata->name = 'Myclapboard\ArtistBundle\Entity\Artist';
        $this->beConstructedWith($manager, 'Myclapboard\ArtistBundle\Entity\Artist');
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Myclapboard\ArtistBundle\Manager\ArtistManager');
    }

    function it_creates_knowledge()
    {
        $this->create()->shouldReturnAnInstanceOf('Myclapboard\ArtistBundle\Entity\Artist');
    }

    function it_finds_one_by_full_name(EntityRepository $repository, ArtistInterface $artist)
    {
        $repository->findOneBy(array('firstName' => 'Quentin', 'lastName' => 'Tarantino'))
            ->shouldBeCalled()->willReturn($artist);

        $this->findOneByFullName('Quentin', 'Tarantino');
    }
}
