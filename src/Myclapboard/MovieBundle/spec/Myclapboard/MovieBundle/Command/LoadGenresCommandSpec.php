<?php

/**
 * This file belongs to myClapboard.
 * The source code of application includes a LICENSE file
 * with all information about license.
 *
 * @author benatespina <benatespina@gmail.com>
 * @author gorkalaucirica <gorka.lauzirika@gmail.com>
 */

namespace spec\Myclapboard\MovieBundle\Command;

use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\Common\Persistence\ObjectManager;
use Myclapboard\MovieBundle\Manager\GenreManager;
use Myclapboard\MovieBundle\Model\Interfaces\GenreInterface;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class LoadGenresCommandSpec.
 *
 * @package spec\Myclapboard\ArtistBundle\Model
 */
class LoadGenresCommandSpec extends ObjectBehavior
{
    function let(ContainerInterface $container)
    {
        $this->setContainer($container);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Myclapboard\MovieBundle\Command\LoadGenresCommand');
    }

    function it_should_be_extends_Container_Aware_Command()
    {
        $this->shouldHaveType('Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand');
    }

    function it_executes_and_loads_genres(
        InputInterface $input,
        OutputInterface $output,
        ContainerInterface $container,
        ManagerRegistry $managerRegistry,
        ObjectManager $manager,
        GenreManager $genreManager,
        GenreInterface $genre
    )
    {
        $output->writeln("Loading genres")->shouldBeCalled();

        $input->getArgument('file')->shouldBeCalled()->willReturn('app/Resources/fixtures/genres.yml');
        $input->bind(Argument::any())->shouldBeCalled();
        $input->isInteractive()->shouldBeCalled()->willReturn(false);
        $input->validate()->shouldBeCalled();

        $container->get('doctrine')->shouldBeCalled()->willReturn($managerRegistry);
        $managerRegistry->getManager()->shouldBeCalled()->willReturn($manager);

        $container->get('myclapboard_movie.manager.genre')
            ->shouldBeCalled()->willReturn($genreManager);
        $genreManager->create()->shouldBeCalled()->willReturn($genre);


        $genre->setName(Argument::any())->shouldBeCalled()->willReturn($genre);
        $genre->addTranslation(Argument::any())->shouldBeCalled()->willReturn($genre);

        $manager->persist($genre)->shouldBeCalled();

        $manager->flush()->shouldBeCalled();

        $output->writeln("Genres loaded successfully")->shouldBeCalled();

        $this->run($input, $output);
    }
}
