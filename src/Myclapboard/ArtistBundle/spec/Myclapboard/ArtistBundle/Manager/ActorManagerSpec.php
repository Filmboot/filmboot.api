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
use Myclapboard\ArtistBundle\Entity\Actor;
use Myclapboard\ArtistBundle\Model\Interfaces\ArtistInterface;
use Myclapboard\MovieBundle\Model\Interfaces\MovieInterface;
use PhpSpec\ObjectBehavior;

/**
 * Class ActorManagerSpec.
 *
 * @package spec\Myclapboard\ArtistBundle\Manager
 */
class ActorManagerSpec extends ObjectBehavior
{
    function let(
        ManagerRegistry $managerRegistry,
        EntityManager $manager,
        EntityRepository $repository,
        ClassMetadata $metadata
    )
    {
        $managerRegistry->getManagerForClass('Myclapboard\ArtistBundle\Entity\Actor')
            ->shouldBeCalled()->willReturn($manager);
        $manager->getRepository('Myclapboard\ArtistBundle\Entity\Actor')
            ->shouldBeCalled()->willReturn($repository);
        $manager->getClassMetadata('Myclapboard\ArtistBundle\Entity\Actor')
            ->shouldBeCalled()->willReturn($metadata);
        $metadata->getName()
            ->shouldBeCalled()->willReturn('Myclapboard\ArtistBundle\Entity\Actor');
        $this->beConstructedWith($managerRegistry, 'Myclapboard\ArtistBundle\Entity\Actor');
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Myclapboard\ArtistBundle\Manager\ActorManager');
    }

    function it_creates_actor()
    {
        $this->create()->shouldReturnAnInstanceOf('Myclapboard\ArtistBundle\Entity\Actor');
    }

    function it_finds_one_by_artist_and_movie(
        EntityRepository $repository,
        ArtistInterface $artist,
        MovieInterface $movie,
        Actor $actor
    )
    {
        $repository->findOneBy(array('artist' => $artist, 'movie' => $movie))
            ->shouldBeCalled()->willReturn($actor);

        $this->findOneByArtistAndMovie($artist, $movie)->shouldReturn($actor);
    }

    function it_finds_all_by_movie(EntityRepository $repository)
    {
        $repository->findBy(array('movie' => 'movie-id'))
            ->shouldBeCalled()->willReturn(array());

        $this->findAllByMovie('movie-id')->shouldReturn(array());
    }
}
