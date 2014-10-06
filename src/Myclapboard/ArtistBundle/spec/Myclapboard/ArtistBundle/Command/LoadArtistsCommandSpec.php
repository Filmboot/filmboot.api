<?php

/**
 * This file belongs to myClapboard.
 * The source code of application includes a LICENSE file
 * with all information about license.
 *
 * @author benatespina <benatespina@gmail.com>
 * @author gorkalaucirica <gorka.lauzirika@gmail.com>
 */

namespace spec\Myclapboard\ArtistBundle\Command;

use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\Persistence\ObjectRepository;
use Myclapboard\ArtistBundle\Manager\ArtistManager;
use Myclapboard\ArtistBundle\Manager\ImageManager;
use Myclapboard\ArtistBundle\Model\Interfaces\ArtistInterface;
use JJs\Bundle\GeonamesBundle\Entity\City;
use Myclapboard\ArtistBundle\Model\Image;
use Myclapboard\CoreBundle\Manager\BaseImageManager;
use Myclapboard\CoreBundle\Model\Interfaces\BaseImageInterface;
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
        City $location,
        BaseImageManager $baseImageManager,
        BaseImageInterface $baseImage,
        ImageManager $imageManager,
        Image $image
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
            ->shouldBeCalled()->willReturn($location);


        $artist->setFirstName(Argument::any())->shouldBeCalled()->willReturn($artist);
        $artist->setLastName(Argument::any())->shouldBeCalled()->willReturn($artist);
        $artist->setBirthday(Argument::type('DateTime'))->shouldBeCalled()->willReturn($artist);
        $artist->setLocation($location)->shouldBeCalled()->willReturn($artist);
        $artist->setWebsite(Argument::any())->shouldBeCalled()->willReturn($artist);
        $artist->setAboutMe(Argument::any())->shouldBeCalled()->willReturn($artist);
        $artist->addTranslation(Argument::any())->shouldBeCalled()->willReturn($artist);

        $this->addPicture(
            $container,
            $baseImageManager,
            $baseImage,
            $artist
        );

        $this->addImage(
            $container,
            $imageManager,
            $image,
            $artist,
            $manager
        );

        $manager->persist($artist)->shouldBeCalled();

        $manager->flush()->shouldBeCalled();

        $output->writeln("Artists loaded successfully")->shouldBeCalled();

        $this->run($input, $output);
    }

    private function addPicture(
        ContainerInterface $container,
        BaseImageManager $imageManager,
        BaseImageInterface $image,
        ArtistInterface $artist
    )
    {
        $container->get('myclapboard_core.manager.baseImage')
            ->shouldBeCalled()->willReturn($imageManager);
        $imageManager->create()->shouldBeCalled()->willReturn($image);

        $artist->getSlug()->shouldBeCalled()->willReturn('quentin-tarantino');

        $image->getFixturePath('photos')
            ->shouldBeCalled()->willReturn(__DIR__ . '/../../../../../../../app/Resources/fixtures/photos/');
        $image->getAbsolutePath()
            ->shouldBeCalled()->willReturn(__DIR__ . '/../../../../../../../web/uploads/images/');

        $artist->setPicture('quentin-tarantino.jpg')->shouldBeCalled()->willReturn($artist);
    }

    private function addImage(
        ContainerInterface $container,
        ImageManager $imageManager,
        Image $image,
        ArtistInterface $artist,
        ObjectManager $manager
    )
    {
        $container->get('myclapboard_artist.manager.image')
            ->shouldBeCalled()->willReturn($imageManager);
        $imageManager->create()->shouldBeCalled()->willReturn($image);

        $image->getFixturePath('images/artists')
            ->shouldBeCalled()->willReturn(__DIR__ . '/../../../../../../../app/Resources/fixtures/images/artists/');

        $artist->getSlug()->shouldBeCalled()->willReturn('quentin-tarantino');

        $image->getAbsolutePath()
            ->shouldBeCalled()->willReturn(__DIR__ . '/../../../../../../../web/uploads/images/');

        $image->setName(Argument::any())->shouldBeCalled()->willReturn($image);
        $image->setFile(Argument::any())->shouldBeCalled()->willReturn($image);
        $image->setArtist($artist)->shouldBeCalled()->willReturn($image);

        $manager->persist($image)->shouldBeCalled();
    }
}
