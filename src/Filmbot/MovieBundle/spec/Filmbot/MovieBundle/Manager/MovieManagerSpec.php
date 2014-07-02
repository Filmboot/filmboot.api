<?php

/**
 * (c) benatespina <benatespina@gmail.com>
 *
 * This file belongs to Filmbot.
 * The source code of application includes a LICENSE file
 * with all information about license.
 */

namespace spec\Filmbot\MovieBundle\Manager;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping\ClassMetadata;
use Filmbot\MovieBundle\Model\MovieInterface;
use PhpSpec\ObjectBehavior;

/**
 * Class MovieManagerSpec.
 *
 * @package spec\Filmbot\MovieBundle\Manager
 */
class MovieManagerSpec extends ObjectBehavior
{
    function let(EntityManager $manager, EntityRepository $repository, ClassMetadata $metadata)
    {
        $manager->getRepository('Filmbot\MovieBundle\Entity\Movie')
            ->shouldBeCalled()->willReturn($repository);
        $manager->getClassMetadata('Filmbot\MovieBundle\Entity\Movie')
            ->shouldBeCalled()->willReturn($metadata);
        $metadata->name = 'Filmbot\MovieBundle\Entity\Movie';
        $this->beConstructedWith($manager, 'Filmbot\MovieBundle\Entity\Movie');
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Filmbot\MovieBundle\Manager\MovieManager');
    }

    function it_creates_movies()
    {
        $this->create()->shouldReturnAnInstanceOf('Filmbot\MovieBundle\Entity\Movie');
    }
    
    function it_finds_one_by_title(EntityRepository $repository, MovieInterface $movie)
    {
        $repository->findOneBy(array('title' => 'movie-title'))
            ->shouldBeCalled()->willReturn($movie);
        
        $this->findOneByTitle('movie-title');
    }
}
