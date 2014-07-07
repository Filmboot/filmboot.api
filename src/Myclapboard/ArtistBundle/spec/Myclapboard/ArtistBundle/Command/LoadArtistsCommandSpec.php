<?php

/**
 * (c) benatespina <benatespina@gmail.com>
 *
 * This file belongs to myClapboard.
 * The source code of application includes a LICENSE file
 * with all information about license.
 */

namespace spec\Myclapboard\ArtistBundle\Command;

use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\Persistence\ObjectRepository;
use Myclapboard\ArtistBundle\Manager\ArtistManager;
use Myclapboard\ArtistBundle\Model\ArtistInterface;
use JJs\Bundle\GeonamesBundle\Entity\City;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class LoadArtistCommandSpec.
 *
 * @package spec\Myclapboard\ArtistBundle\Model
 */
class LoadArtistsCommandSpec extends ObjectBehavior
{
    function let(ContainerInterface $container)
    {
        $this->setContainer($container);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Myclapboard\ArtistBundle\Command\LoadArtistsCommand');
    }

    function it_should_be_extends_Container_Aware_Command()
    {
        $this->shouldHaveType('Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand');
    }

    function it_executes_and_loads_artists(
        InputInterface $input,
        OutputInterface $output,
        ContainerInterface $container,
        ManagerRegistry $managerRegistry,
        ObjectManager $manager,
        ArtistManager $artistManager,
        ArtistInterface $artist,
        ObjectRepository $cityRepository,
        City $birthplace
    )
    {
        $output->writeln("Loading artists")->shouldBeCalled();

        $input->getArgument('file')->shouldBeCalled()->willReturn('app/Resources/fixtures/artists.yml');
        $input->bind(Argument::any())->shouldBeCalled();
        $input->isInteractive()->shouldBeCalled()->willReturn(false);
        $input->validate()->shouldBeCalled();

        $container->get('doctrine')->shouldBeCalled()->willReturn($managerRegistry);
        $managerRegistry->getManager()->shouldBeCalled()->willReturn($manager);

        $container->get('myclapboard_artist.manager.artist')
            ->shouldBeCalled()->willReturn($artistManager);
        $artistManager->create()->shouldBeCalled()->willReturn($artist);

        $managerRegistry->getRepository('JJsGeonamesBundle:City')
            ->shouldBeCalled()->willReturn($cityRepository);
        $cityRepository->findOneBy(Argument::any())
            ->shouldBeCalled()->willReturn($birthplace);


        $artist->setFirstName(Argument::any())->shouldBeCalled()->willReturn($artist);
        $artist->setLastName(Argument::any())->shouldBeCalled()->willReturn($artist);
        $artist->setBirthday(Argument::type('DateTime'))->shouldBeCalled()->willReturn($artist);
        $artist->setBirthplace($birthplace)->shouldBeCalled()->willReturn($artist);
        $artist->setBiography(Argument::any())->shouldBeCalled()->willReturn($artist);
        $artist->addTranslation(Argument::any())->shouldBeCalled()->willReturn($artist);

        $manager->persist($artist)->shouldBeCalled();

        $manager->flush()->shouldBeCalled();

        $output->writeln("Artists loaded successfully")->shouldBeCalled();

        $this->run($input, $output);
    }
} 
