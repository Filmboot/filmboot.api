<?php

/**
 * (c) benatespina <benatespina@gmail.com>
 *
 * This file belongs to Filmbot.
 * The source code of application includes a LICENSE file
 * with all information about license.
 */

namespace spec\Filmbot\MovieBundle\Command;

use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\Persistence\ObjectRepository;
use Filmbot\ArtistBundle\Entity\Actor;
use Filmbot\ArtistBundle\Entity\Director;
use Filmbot\ArtistBundle\Entity\Writer;
use Filmbot\ArtistBundle\Manager\ActorManager;
use Filmbot\ArtistBundle\Manager\ArtistManager;
use Filmbot\ArtistBundle\Manager\DirectorManager;
use Filmbot\ArtistBundle\Manager\WriterManager;
use Filmbot\ArtistBundle\Model\ArtistInterface;
use Filmbot\MovieBundle\Manager\GenreManager;
use Filmbot\MovieBundle\Manager\MovieManager;
use Filmbot\MovieBundle\Model\GenreInterface;
use Filmbot\MovieBundle\Model\MovieInterface;
use JJs\Bundle\GeonamesBundle\Entity\City;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class LoadMoviesCommandSpec.
 *
 * @package spec\Filmbot\MovieBundle\Command
 */
class LoadMoviesCommandSpec extends ObjectBehavior
{
    function let(ContainerInterface $container)
    {
        $this->setContainer($container);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Filmbot\MovieBundle\Command\LoadMoviesCommand');
    }

    function it_should_be_extends_Container_Aware_Command()
    {
        $this->shouldHaveType('Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand');
    }

    function it_executes_and_loads_movies(
        InputInterface $input,
        OutputInterface $output,
        ContainerInterface $container,
        ManagerRegistry $managerRegistry,
        ObjectManager $manager,
        MovieManager $movieManager,
        MovieInterface $movie,
        ObjectRepository $cityRepository,
        City $country,
        ArtistManager $artistManager,
        ArtistInterface $artist,
        ActorManager $actorManager,
        DirectorManager $directorManager,
        WriterManager $writerManager,
        Actor $actor,
        Director $director,
        Writer $writer,
        GenreManager $genreManager,
        GenreInterface $genre
    )
    {
        $output->writeln("Loading movies")->shouldBeCalled();

        $input->getArgument('file')->shouldBeCalled()->willReturn('app/Resources/fixtures/movies.yml');
        $input->bind(Argument::any())->shouldBeCalled();
        $input->isInteractive()->shouldBeCalled()->willReturn(false);
        $input->validate()->shouldBeCalled();

        $container->get('doctrine')->shouldBeCalled()->willReturn($managerRegistry);
        $managerRegistry->getManager()->shouldBeCalled()->willReturn($manager);

        $container->get('filmbot_movie.manager.movie')
            ->shouldBeCalled()->willReturn($movieManager);
        $movieManager->create()->shouldBeCalled()->willReturn($movie);

        $managerRegistry->getRepository('JJsGeonamesBundle:Country')
            ->shouldBeCalled()->willReturn($cityRepository);
        $cityRepository->findOneBy(Argument::any())
            ->shouldBeCalled()->willReturn($country);

        $movie->setTitle(Argument::any())->shouldBeCalled()->willReturn($movie);
        $movie->addTranslation(Argument::any())->shouldBeCalled()->willReturn($movie);
        $movie->setDuration(Argument::any())->shouldBeCalled()->willReturn($movie);
        $movie->setYear(Argument::any())->shouldBeCalled()->willReturn($movie);
        $movie->setCountry($country)->shouldBeCalled()->willReturn($movie);
        $movie->setStoryline(Argument::any())->shouldBeCalled()->willReturn($movie);
        $movie->addTranslation(Argument::any())->shouldBeCalled()->willReturn($movie);
        $movie->setProducer(Argument::any())->shouldBeCalled()->willReturn($movie);

        $this->addArtists(
            $container,
            $artistManager,
            $artist,
            'actor',
            $actorManager,
            $actor,
            $movie,
            'addActor'
        );
        $this->addArtists(
            $container,
            $artistManager,
            $artist,
            'director',
            $directorManager,
            $director,
            $movie,
            'addDirector'
        );
        $this->addArtists(
            $container,
            $artistManager,
            $artist,
            'writer',
            $writerManager,
            $writer,
            $movie,
            'addWriter'
        );

        $container->get('filmbot_movie.manager.genre')
            ->shouldBeCalled()->willReturn($genreManager);
        $genreManager->findOneByName(Argument::any())
            ->shouldBeCalled()->willReturn($genre);
        $movie->addGenre($genre)->shouldBeCalled()->willReturn($movie);

        $manager->persist($movie)->shouldBeCalled();

        $manager->flush()->shouldBeCalled();

        $output->writeln("Movies loaded successfully")->shouldBeCalled();

        $this->run($input, $output);
    }

    private function addArtists(
        ContainerInterface $container,
        ArtistManager $artistManager,
        ArtistInterface $artist,
        $class,
        $roleManager,
        $role,
        MovieInterface $movie,
        $method
    )
    {
        $container->get('filmbot_artist.manager.artist')
            ->shouldBeCalled()->willReturn($artistManager);
        $artistManager->findOneByFullName(Argument::any(), Argument::any())
            ->shouldBeCalled()->willReturn($artist);

        $container->get('filmbot_artist.manager.' . $class)
            ->shouldBeCalled()->willReturn($roleManager);
        $roleManager->create()
            ->shouldBeCalled()->willReturn($role);

        $role->setArtist($artist)->shouldBeCalled()->willReturn($role);
        $role->setMovie($movie)->shouldBeCalled()->willReturn($role);

        $movie->$method($role)->shouldBeCalled()->willReturn($role);
    }
}
