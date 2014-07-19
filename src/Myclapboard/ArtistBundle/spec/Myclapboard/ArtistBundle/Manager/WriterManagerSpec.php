<?php

/**
 * (c) benatespina <benatespina@gmail.com>
 *
 * This file belongs to myClapboard.
 * The source code of application includes a LICENSE file
 * with all information about license.
 */

namespace spec\Myclapboard\ArtistBundle\Manager;

use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping\ClassMetadata;
use Myclapboard\ArtistBundle\Entity\Writer;
use Myclapboard\ArtistBundle\Model\ArtistInterface;
use Myclapboard\MovieBundle\Model\MovieInterface;
use PhpSpec\ObjectBehavior;

/**
 * Class WriterManagerSpec.
 *
 * @package spec\Myclapboard\ArtistBundle\Manager
 */
class WriterManagerSpec extends ObjectBehavior
{
    function let(
        ManagerRegistry $managerRegistry,
        EntityManager $manager,
        EntityRepository $repository,
        ClassMetadata $metadata
    )
    {
        $managerRegistry->getManagerForClass('Myclapboard\ArtistBundle\Entity\Writer')
            ->shouldBeCalled()->willReturn($manager);
        $manager->getRepository('Myclapboard\ArtistBundle\Entity\Writer')
            ->shouldBeCalled()->willReturn($repository);
        $manager->getClassMetadata('Myclapboard\ArtistBundle\Entity\Writer')
            ->shouldBeCalled()->willReturn($metadata);
        $metadata->getName()
            ->shouldBeCalled()->willReturn('Myclapboard\ArtistBundle\Entity\Writer');
        $this->beConstructedWith($managerRegistry, 'Myclapboard\ArtistBundle\Entity\Writer');
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Myclapboard\ArtistBundle\Manager\WriterManager');
    }

    function it_creates_director()
    {
        $this->create()->shouldReturnAnInstanceOf('Myclapboard\ArtistBundle\Entity\Writer');
    }

    function it_finds_one_by_artist_and_movie(
        EntityRepository $repository,
        ArtistInterface $artist,
        MovieInterface $movie,
        Writer $writer
    )
    {
        $repository->findOneBy(array('artist' => $artist, 'movie' => $movie))
            ->shouldBeCalled()->willReturn($writer);

        $this->findOneByArtistAndMovie($artist, $movie)->shouldReturn($writer);
    }
}
