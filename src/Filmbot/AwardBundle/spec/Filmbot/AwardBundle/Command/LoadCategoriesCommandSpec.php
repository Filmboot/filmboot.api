<?php

/**
 * (c) benatespina <benatespina@gmail.com>
 *
 * This file belongs to Filmbot.
 * The source code of application includes a LICENSE file
 * with all information about license.
 */

namespace spec\Filmbot\AwardBundle\Command;

use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\Common\Persistence\ObjectManager;
use Filmbot\AwardBundle\Manager\CategoryManager;
use Filmbot\AwardBundle\Model\CategoryInterface;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class LoadCategoriesCommandSpec.
 *
 * @package spec\Filmbot\AwardBundle\Model
 */
class LoadCategoriesCommandSpec extends ObjectBehavior
{
    function let(ContainerInterface $container)
    {
        $this->setContainer($container);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Filmbot\AwardBundle\Command\LoadCategoriesCommand');
    }

    function it_should_be_extends_Container_Aware_Command()
    {
        $this->shouldHaveType('Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand');
    }

    function it_executes_and_loads_categories(
        InputInterface $input,
        OutputInterface $output,
        ContainerInterface $container,
        ManagerRegistry $managerRegistry,
        ObjectManager $manager,
        CategoryManager $categoryManager,
        CategoryInterface $category
    )
    {
        $output->writeln("Loading categories")->shouldBeCalled();

        $input->getArgument('file')->shouldBeCalled()->willReturn('app/Resources/fixtures/categories.yml');
        $input->bind(Argument::any())->shouldBeCalled();
        $input->isInteractive()->shouldBeCalled()->willReturn(false);
        $input->validate()->shouldBeCalled();

        $container->get('doctrine')->shouldBeCalled()->willReturn($managerRegistry);
        $managerRegistry->getManager()->shouldBeCalled()->willReturn($manager);

        $container->get('filmbot_award.manager.category')
            ->shouldBeCalled()->willReturn($categoryManager);
        $categoryManager->create()->shouldBeCalled()->willReturn($category);


        $category->setName(Argument::any())->shouldBeCalled()->willReturn($category);
        $category->addTranslation(Argument::any())->shouldBeCalled()->willReturn($category);

        $manager->persist($category)->shouldBeCalled();

        $manager->flush()->shouldBeCalled();

        $output->writeln("Categories loaded successfully")->shouldBeCalled();

        $this->run($input, $output);
    }
}
