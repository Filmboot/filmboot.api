<?php

/**
 * (c) benatespina <benatespina@gmail.com>
 *
 * This file belongs to Myclapboard.
 * The source code of application includes a LICENSE file
 * with all information about license.
 */

namespace spec\Myclapboard\AwardBundle\Command;

use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\Common\Persistence\ObjectManager;
use Myclapboard\AwardBundle\Manager\AwardManager;
use Myclapboard\AwardBundle\Model\AwardInterface;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class LoadAwardsCommandSpec.
 *
 * @package spec\Myclapboard\AwardBundle\Model
 */
class LoadAwardsCommandSpec extends ObjectBehavior
{
    function let(ContainerInterface $container)
    {
        $this->setContainer($container);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Myclapboard\AwardBundle\Command\LoadAwardsCommand');
    }

    function it_should_be_extends_Container_Aware_Command()
    {
        $this->shouldHaveType('Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand');
    }

    function it_executes_and_loads_awards(
        InputInterface $input,
        OutputInterface $output,
        ContainerInterface $container,
        ManagerRegistry $managerRegistry,
        ObjectManager $manager,
        AwardManager $awardManager,
        AwardInterface $award
    )
    {
        $output->writeln("Loading awards")->shouldBeCalled();

        $input->getArgument('file')->shouldBeCalled()->willReturn('app/Resources/fixtures/awards.yml');
        $input->bind(Argument::any())->shouldBeCalled();
        $input->isInteractive()->shouldBeCalled()->willReturn(false);
        $input->validate()->shouldBeCalled();

        $container->get('doctrine')->shouldBeCalled()->willReturn($managerRegistry);
        $managerRegistry->getManager()->shouldBeCalled()->willReturn($manager);

        $container->get('myclapboard_award.manager.award')
            ->shouldBeCalled()->willReturn($awardManager);
        $awardManager->create()->shouldBeCalled()->willReturn($award);


        $award->setName(Argument::any())->shouldBeCalled()->willReturn($award);
        $award->addTranslation(Argument::any())->shouldBeCalled()->willReturn($award);

        $manager->persist($award)->shouldBeCalled();

        $manager->flush()->shouldBeCalled();

        $output->writeln("Awards loaded successfully")->shouldBeCalled();

        $this->run($input, $output);
    }
}
