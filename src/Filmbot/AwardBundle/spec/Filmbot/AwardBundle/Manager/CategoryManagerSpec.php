<?php

/**
 * (c) benatespina <benatespina@gmail.com>
 *
 * This file belongs to Filmbot.
 * The source code of application includes a LICENSE file
 * with all information about license.
 */

namespace spec\Filmbot\AwardBundle\Manager;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping\ClassMetadata;
use Filmbot\AwardBundle\Model\CategoryInterface;
use PhpSpec\ObjectBehavior;

/**
 * Class CategoryManagerSpec.
 *
 * @package spec\Filmbot\AwardBundle\Manager
 */
class CategoryManagerSpec extends ObjectBehavior
{
    function let(EntityManager $manager, EntityRepository $repository, ClassMetadata $metadata)
    {
        $manager->getRepository('Filmbot\AwardBundle\Entity\Category')
            ->shouldBeCalled()->willReturn($repository);
        $manager->getClassMetadata('Filmbot\AwardBundle\Entity\Category')
            ->shouldBeCalled()->willReturn($metadata);
        $metadata->name = 'Filmbot\AwardBundle\Entity\Category';
        $this->beConstructedWith($manager, 'Filmbot\AwardBundle\Entity\Category');
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Filmbot\AwardBundle\Manager\CategoryManager');
    }

    function it_creates_category()
    {
        $this->create()->shouldReturnAnInstanceOf('Filmbot\AwardBundle\Entity\Category');
    }

    function it_finds_one_by_name(EntityRepository $repository, CategoryInterface $category)
    {
        $repository->findOneBy(array('name' => 'category-name'))
            ->shouldBeCalled()->willReturn($category);

        $this->findOneByName('category-name');
    }
}
