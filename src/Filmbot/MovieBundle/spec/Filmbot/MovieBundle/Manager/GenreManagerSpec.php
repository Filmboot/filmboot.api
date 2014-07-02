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
use Filmbot\MovieBundle\Model\GenreInterface;
use PhpSpec\ObjectBehavior;

/**
 * Class GenreManagerSpec.
 *
 * @package spec\Filmbot\MovieBundle\Manager
 */
class GenreManagerSpec extends ObjectBehavior
{
    function let(EntityManager $manager, EntityRepository $repository, ClassMetadata $metadata)
    {
        $manager->getRepository('Filmbot\MovieBundle\Entity\Genre')
            ->shouldBeCalled()->willReturn($repository);
        $manager->getClassMetadata('Filmbot\MovieBundle\Entity\Genre')
            ->shouldBeCalled()->willReturn($metadata);
        $metadata->name = 'Filmbot\MovieBundle\Entity\Genre';
        $this->beConstructedWith($manager, 'Filmbot\MovieBundle\Entity\Genre');
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Filmbot\MovieBundle\Manager\GenreManager');
    }

    function it_creates_genres()
    {
        $this->create()->shouldReturnAnInstanceOf('Filmbot\MovieBundle\Entity\Genre');
    }

    function it_finds_one_by_name(EntityRepository $repository, GenreInterface $genre)
    {
        $repository->findOneBy(array('name' => 'Thriller'))
            ->shouldBeCalled()->willReturn($genre);
        
        $this->findOneByName('Thriller');
    }
}
