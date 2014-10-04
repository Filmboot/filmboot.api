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
use Doctrine\Common\Persistence\ObjectRepository;
use JJs\Bundle\GeonamesBundle\Entity\Country;
use Myclapboard\ArtistBundle\Entity\Actor;
use Myclapboard\ArtistBundle\Entity\Director;
use Myclapboard\ArtistBundle\Entity\Writer;
use Myclapboard\ArtistBundle\Manager\ActorManager;
use Myclapboard\ArtistBundle\Manager\ArtistManager;
use Myclapboard\ArtistBundle\Manager\DirectorManager;
use Myclapboard\ArtistBundle\Manager\WriterManager;
use Myclapboard\ArtistBundle\Model\ArtistInterface;
use Myclapboard\CoreBundle\Manager\BaseImageManager;
use Myclapboard\MovieBundle\Manager\ImageManager;
use Myclapboard\CoreBundle\Model\BaseImageInterface;
use Myclapboard\MovieBundle\Model\Image;
use Myclapboard\MovieBundle\Manager\GenreManager;
use Myclapboard\MovieBundle\Manager\MovieManager;
use Myclapboard\MovieBundle\Model\GenreInterface;
use Myclapboard\MovieBundle\Model\MovieInterface;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class LoadMoviesCommandSpec.
 *
 * @package spec\Myclapboard\MovieBundle\Command
 */
class LoadMoviesCommandSpec extends ObjectBehavior
{
    function let(ContainerInterface $container)
    {
        $this->setContainer($container);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Myclapboard\MovieBundle\Command\LoadMoviesCommand');
    }

    function it_should_be_extends_load_artists_command()
    {
        $this->shouldHaveType('Myclapboard\ArtistBundle\Command\LoadArtistsCommand');
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
        Country $country,
        ArtistManager $artistManager,
        ArtistInterface $artist,
        ActorManager $actorManager,
        DirectorManager $directorManager,
        WriterManager $writerManager,
        Actor $actor,
        Director $director,
        Writer $writer,
        GenreManager $genreManager,
        GenreInterface $genre,
        BaseImageManager $baseImageManager,
        BaseImageInterface $baseImage,
        ImageManager $imageManager,
        Image $image
    )
    {
        $output->writeln("Loading movies")->shouldBeCalled();

        $input->getArgument('file')->shouldBeCalled()->willReturn('app/Resources/fixtures/movies.yml');
        $input->bind(Argument::any())->shouldBeCalled();
        $input->isInteractive()->shouldBeCalled()->willReturn(false);
        $input->validate()->shouldBeCalled();

        $container->get('doctrine')->shouldBeCalled()->willReturn($managerRegistry);
        $managerRegistry->getManager()->shouldBeCalled()->willReturn($manager);

        $container->get('myclapboard_movie.manager.movie')
            ->shouldBeCalled()->willReturn($movieManager);
        $movieManager->create()->shouldBeCalled()->willReturn($movie);

        $managerRegistry->getRepository('JJsGeonamesBundle:Country')
            ->shouldBeCalled()->willReturn($cityRepository);
        $cityRepository->findOneBy(Argument::any())
            ->shouldBeCalled()->willReturn($country);

        $movie->setTitle(Argument::any())->shouldBeCalled()->willReturn($movie);
        $movie->addTranslation(Argument::any())->shouldBeCalled()->willReturn($movie);
        $movie->setDuration(Argument::any())->shouldBeCalled()->willReturn($movie);
        $movie->setReleaseDate(Argument::type('DateTime'))->shouldBeCalled()->willReturn($movie);
        $movie->setCountry($country)->shouldBeCalled()->willReturn($movie);
        $movie->setWebsite((Argument::any()))->shouldBeCalled()->willReturn($movie);
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

        $container->get('myclapboard_movie.manager.genre')
            ->shouldBeCalled()->willReturn($genreManager);
        $genreManager->findOneByName(Argument::any())
            ->shouldBeCalled()->willReturn($genre);
        $movie->addGenre($genre)->shouldBeCalled()->willReturn($movie);

        $this->addPoster(
            $container,
            $baseImageManager,
            $baseImage,
            $movie
        );

        $this->addImage(
            $container,
            $imageManager,
            $image,
            $movie,
            $manager
        );

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
        $container->get('myclapboard_artist.manager.artist')
            ->shouldBeCalled()->willReturn($artistManager);
        $artistManager->findOneByFullName(Argument::any(), Argument::any())
            ->shouldBeCalled()->willReturn($artist);

        $container->get('myclapboard_artist.manager.' . $class)
            ->shouldBeCalled()->willReturn($roleManager);
        $roleManager->create()
            ->shouldBeCalled()->willReturn($role);

        $role->setArtist($artist)->shouldBeCalled()->willReturn($role);
        $role->setMovie($movie)->shouldBeCalled()->willReturn($role);

        $movie->$method($role)->shouldBeCalled()->willReturn($role);
    }

    private function addPoster(
        ContainerInterface $container,
        BaseImageManager $imageManager,
        BaseImageInterface $image,
        MovieInterface $movie
    )
    {
        $container->get('myclapboard_core.manager.baseImage')
            ->shouldBeCalled()->willReturn($imageManager);
        $imageManager->create()->shouldBeCalled()->willReturn($image);

        $movie->getSlug()->shouldBeCalled()->willReturn('django-unchained');

        $image->getFixturePath('posters')
            ->shouldBeCalled()->willReturn(__DIR__ . '/../../../../../../../app/Resources/fixtures/posters/');
        $image->getAbsolutePath()
            ->shouldBeCalled()->willReturn(__DIR__ . '/../../../../../../../web/uploads/images/');

        $movie->setPoster('django-unchained.jpg')->shouldBeCalled()->willReturn($movie);
    }

    private function addImage(
        ContainerInterface $container,
        ImageManager $imageManager,
        Image $image,
        MovieInterface $movie,
        ObjectManager $manager
    )
    {
        $container->get('myclapboard_movie.manager.image')
            ->shouldBeCalled()->willReturn($imageManager);
        $imageManager->create()->shouldBeCalled()->willReturn($image);

        $image->getFixturePath('images/movies')
            ->shouldBeCalled()->willReturn(__DIR__ . '/../../../../../../../app/Resources/fixtures/images/movies/');

        $movie->getSlug()->shouldBeCalled()->willReturn('django-unchained');

        $image->getAbsolutePath()
            ->shouldBeCalled()->willReturn(__DIR__ . '/../../../../../../../web/uploads/images/');

        $image->setName(Argument::any())->shouldBeCalled()->willReturn($image);
        $image->setFile(Argument::any())->shouldBeCalled()->willReturn($image);
        $image->setMovie($movie)->shouldBeCalled()->willReturn($image);

        $manager->persist($image)->shouldBeCalled();
    }
}
