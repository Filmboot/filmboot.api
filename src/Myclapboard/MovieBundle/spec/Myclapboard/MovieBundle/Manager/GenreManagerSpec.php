<?php

/**
 * This file belongs to myClapboard.
 * The source code of application includes a LICENSE file
 * with all information about license.
 *
 * @author benatespina <benatespina@gmail.com>
 * @author gorkalaucirica <gorka.lauzirika@gmail.com>
 */

namespace spec\Myclapboard\MovieBundle\Manager;

use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping\ClassMetadata;
use Myclapboard\MovieBundle\Model\Interfaces\GenreInterface;
use PhpSpec\ObjectBehavior;

/**
 * Class GenreManagerSpec.
 *
 * @package spec\Myclapboard\MovieBundle\Manager
 */
class GenreManagerSpec extends ObjectBehavior
{
    function let(
        ManagerRegistry $managerRegistry,
        EntityManager $manager,
        EntityRepository $repository,
        ClassMetadata $metadata
    )
    {
        $managerRegistry->getManagerForClass('Myclapboard\MovieBundle\Entity\Genre')
            ->shouldBeCalled()->willReturn($manager);
        $manager->getRepository('Myclapboard\MovieBundle\Entity\Genre')
            ->shouldBeCalled()->willReturn($repository);
        $manager->getClassMetadata('Myclapboard\MovieBundle\Entity\Genre')
            ->shouldBeCalled()->willReturn($metadata);
        $metadata->getName()
            ->shouldBeCalled()->willReturn('Myclapboard\MovieBundle\Entity\Genre');
        $this->beConstructedWith($managerRegistry, 'Myclapboard\MovieBundle\Entity\Genre');
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Myclapboard\MovieBundle\Manager\GenreManager');
    }

    function it_creates_genres()
    {
        $this->create()->shouldReturnAnInstanceOf('Myclapboard\MovieBundle\Entity\Genre');
    }

    function it_finds_one_by_name(EntityRepository $repository, GenreInterface $genre)
    {
        $repository->findOneBy(array('name' => 'Thriller'))
            ->shouldBeCalled()->willReturn($genre);

        $this->findOneByName('Thriller');
    }
}
