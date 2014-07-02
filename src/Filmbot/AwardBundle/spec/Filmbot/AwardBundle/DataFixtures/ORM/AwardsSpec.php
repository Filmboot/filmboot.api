<?php

/**
 * (c) benatespina <benatespina@gmail.com>
 *
 * This file belongs to Filmbot.
 * The source code of application includes a LICENSE file
 * with all information about license.
 */

namespace spec\Filmbot\AwardBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Filmbot\AwardBundle\Command\LoadAwardsCommand;
use Filmbot\AwardBundle\Command\LoadCategoriesCommand;
use PhpSpec\ObjectBehavior;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpKernel\KernelInterface;

/**
 * Class AwardsSpec.
 *
 * @package spec\Filmbot\AwardBundle\DataFixtures\ORM
 */
class AwardsSpec extends ObjectBehavior
{
    function let(ContainerInterface $container)
    {
        $this->setContainer($container);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Filmbot\AwardBundle\DataFixtures\ORM\Awards');
    }

    function it_extends_abstract_fixtures()
    {
        $this->shouldHaveType('Doctrine\Common\DataFixtures\AbstractFixture');
    }

    function it_implements_interface()
    {
        $this->shouldImplement('Doctrine\Common\DataFixtures\OrderedFixtureInterface');
        $this->shouldImplement('Symfony\Component\DependencyInjection\ContainerAwareInterface');
    }

    function it_loads_fixtures(
        ObjectManager $manager,
        ContainerInterface $container,
        KernelInterface $kernel,
        LoadAwardsCommand $loadAwardsCommand,
        LoadCategoriesCommand $loadCategoriesCommand
    )
    {
        $container->get('kernel')->shouldBeCalled()->willReturn($kernel);
        $kernel->getRootDir()->shouldBeCalled()->willReturn('rootDir');
        $container->get('filmbot_award.command_awards')
            ->shouldBeCalled()->willReturn($loadAwardsCommand);
        $loadAwardsCommand->loadAwards('rootDir/../app/Resources/fixtures/awards.yml')
            ->shouldBeCalled();

        $container->get('kernel')->shouldBeCalled()->willReturn($kernel);
        $kernel->getRootDir()->shouldBeCalled()->willReturn('rootDir');
        $container->get('filmbot_award.command_categories')
            ->shouldBeCalled()->willReturn($loadCategoriesCommand);
        $loadCategoriesCommand->loadCategories('rootDir/../app/Resources/fixtures/categories.yml')
            ->shouldBeCalled();

        $this->load($manager);
    }

    function its_order_is_zero()
    {
        $this->getOrder()->shouldReturn(0);
    }
}
