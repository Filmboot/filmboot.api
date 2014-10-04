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
use Myclapboard\MovieBundle\Model\ImageInterface;
use PhpSpec\ObjectBehavior;

/**
 * Class ImageManagerSpec.
 *
 * @package spec\Myclapboard\MovieBundle\Manager
 */
class ImageManagerSpec extends ObjectBehavior
{
    function let(
        ManagerRegistry $managerRegistry,
        EntityManager $manager,
        EntityRepository $repository,
        ClassMetadata $metadata
    )
    {
        $managerRegistry->getManagerForClass('Myclapboard\MovieBundle\Entity\Image')
            ->shouldBeCalled()->willReturn($manager);
        $manager->getRepository('Myclapboard\MovieBundle\Entity\Image')
            ->shouldBeCalled()->willReturn($repository);
        $manager->getClassMetadata('Myclapboard\MovieBundle\Entity\Image')
            ->shouldBeCalled()->willReturn($metadata);
        $metadata->getName()
            ->shouldBeCalled()->willReturn('Myclapboard\MovieBundle\Entity\Image');
        $this->beConstructedWith($managerRegistry, 'Myclapboard\MovieBundle\Entity\Image');
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Myclapboard\MovieBundle\Manager\ImageManager');
    }

    function it_creates_image()
    {
        $this->create()->shouldReturnAnInstanceOf('Myclapboard\MovieBundle\Entity\Image');
    }

    function it_finds_all_by_movie_id(EntityRepository $repository)
    {
        $repository->findBy(array('movie' => 'movie-id'))
            ->shouldBeCalled()->willReturn(array());

        $this->findAllBy('movie-id')->shouldReturn(array());
    }

    function it_finds_one_by_name(EntityRepository $repository, ImageInterface $image)
    {
        $repository->findOneBy(array('name' => 'image-name'))
            ->shouldBeCalled()->willReturn($image);

        $this->findOneByName('image-name')->shouldReturn($image);
    }
}
