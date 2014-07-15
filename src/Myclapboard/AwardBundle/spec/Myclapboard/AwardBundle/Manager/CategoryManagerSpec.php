<?php

/**
 * (c) benatespina <benatespina@gmail.com>
 *
 * This file belongs to myClapboard.
 * The source code of application includes a LICENSE file
 * with all information about license.
 */

namespace spec\Myclapboard\AwardBundle\Manager;

use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping\ClassMetadata;
use Myclapboard\AwardBundle\Model\CategoryInterface;
use PhpSpec\ObjectBehavior;

/**
 * Class CategoryManagerSpec.
 *
 * @package spec\Myclapboard\AwardBundle\Manager
 */
class CategoryManagerSpec extends ObjectBehavior
{
    function let(
        ManagerRegistry $managerRegistry,
        EntityManager $manager,
        EntityRepository $repository,
        ClassMetadata $metadata
    )
    {
        $managerRegistry->getManagerForClass('Myclapboard\AwardBundle\Entity\Category')
            ->shouldBeCalled()->willReturn($manager);
        $manager->getRepository('Myclapboard\AwardBundle\Entity\Category')
            ->shouldBeCalled()->willReturn($repository);
        $manager->getClassMetadata('Myclapboard\AwardBundle\Entity\Category')
            ->shouldBeCalled()->willReturn($metadata);
        $metadata->getName()
            ->shouldBeCalled()->willReturn('Myclapboard\AwardBundle\Entity\Category');
        $this->beConstructedWith($managerRegistry, 'Myclapboard\AwardBundle\Entity\Category');
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Myclapboard\AwardBundle\Manager\CategoryManager');
    }

    function it_creates_category()
    {
        $this->create()->shouldReturnAnInstanceOf('Myclapboard\AwardBundle\Entity\Category');
    }

    function it_finds_one_by_name(EntityRepository $repository, CategoryInterface $category)
    {
        $repository->findOneBy(array('name' => 'category-name'))
            ->shouldBeCalled()->willReturn($category);

        $this->findOneByName('category-name');
    }
}
