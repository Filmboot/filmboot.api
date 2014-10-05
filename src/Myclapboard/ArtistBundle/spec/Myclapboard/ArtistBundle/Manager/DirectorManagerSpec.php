<?php

/**
 * This file belongs to myClapboard.
 * The source code of application includes a LICENSE file
 * with all information about license.
 *
 * @author benatespina <benatespina@gmail.com>
 * @author gorkalaucirica <gorka.lauzirika@gmail.com>
 */

namespace spec\Myclapboard\ArtistBundle\Manager;

use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping\ClassMetadata;
use Myclapboard\ArtistBundle\Entity\Director;
use Myclapboard\ArtistBundle\Model\Interfaces\ArtistInterface;
use Myclapboard\MovieBundle\Model\Interfaces\MovieInterface;
use PhpSpec\ObjectBehavior;

/**
 * Class DirectorManagerSpec.
 *
 * @package spec\Myclapboard\ArtistBundle\Manager
 */
class DirectorManagerSpec extends ObjectBehavior
{
    function let(
        ManagerRegistry $managerRegistry,
        EntityManager $manager,
        EntityRepository $repository,
        ClassMetadata $metadata
    )
    {
        $managerRegistry->getManagerForClass('Myclapboard\ArtistBundle\Entity\Director')
            ->shouldBeCalled()->willReturn($manager);
        $manager->getRepository('Myclapboard\ArtistBundle\Entity\Director')
            ->shouldBeCalled()->willReturn($repository);
        $manager->getClassMetadata('Myclapboard\ArtistBundle\Entity\Director')
            ->shouldBeCalled()->willReturn($metadata);
        $metadata->getName()
            ->shouldBeCalled()->willReturn('Myclapboard\ArtistBundle\Entity\Director');
        $this->beConstructedWith($managerRegistry, 'Myclapboard\ArtistBundle\Entity\Director');
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Myclapboard\ArtistBundle\Manager\DirectorManager');
    }

    function it_creates_director()
    {
        $this->create()->shouldReturnAnInstanceOf('Myclapboard\ArtistBundle\Entity\Director');
    }

    function it_finds_one_by_artist_and_movie(
        EntityRepository $repository,
        ArtistInterface $artist,
        MovieInterface $movie,
        Director $director
    )
    {
        $repository->findOneBy(array('artist' => $artist, 'movie' => $movie))
            ->shouldBeCalled()->willReturn($director);

        $this->findOneByArtistAndMovie($artist, $movie)->shouldReturn($director);
    }
}
