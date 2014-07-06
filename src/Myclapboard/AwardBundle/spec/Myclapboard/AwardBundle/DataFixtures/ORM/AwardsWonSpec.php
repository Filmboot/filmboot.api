<?php

/**
 * (c) benatespina <benatespina@gmail.com>
 *
 * This file belongs to Myclapboard.
 * The source code of application includes a LICENSE file
 * with all information about license.
 */

namespace spec\Myclapboard\AwardBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Myclapboard\AwardBundle\Command\LoadAwardsWonCommand;
use PhpSpec\ObjectBehavior;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpKernel\KernelInterface;

/**
 * Class AwardsWonSpec.
 *
 * @package spec\Myclapboard\AwardBundle\DataFixtures\ORM
 */
class AwardsWonSpec extends ObjectBehavior
{
    function let(ContainerInterface $container)
    {
        $this->setContainer($container);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Myclapboard\AwardBundle\DataFixtures\ORM\AwardsWon');
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
        LoadAwardsWonCommand $loadAwardsWonCommand
    )
    {
        $container->get('kernel')->shouldBeCalled()->willReturn($kernel);
        $kernel->getRootDir()->shouldBeCalled()->willReturn('rootDir');
        $container->get('myclapboard_award.command_awardsWon')
            ->shouldBeCalled()->willReturn($loadAwardsWonCommand);
        $loadAwardsWonCommand->loadAwardsWon('rootDir/../app/Resources/fixtures/awardswon.yml')
            ->shouldBeCalled();

        $this->load($manager);
    }

    function its_order_is_two()
    {
        $this->getOrder()->shouldReturn(2);
    }
}
