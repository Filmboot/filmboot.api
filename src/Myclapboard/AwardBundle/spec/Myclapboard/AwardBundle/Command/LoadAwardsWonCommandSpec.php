<?php

/**
 * This file belongs to myClapboard.
 * The source code of application includes a LICENSE file
 * with all information about license.
 *
 * @author benatespina <benatespina@gmail.com>
 * @author gorkalaucirica <gorka.lauzirika@gmail.com>
 */

namespace spec\Myclapboard\AwardBundle\Command;

use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\Common\Persistence\ObjectManager;
use Myclapboard\ArtistBundle\Entity\Actor;
use Myclapboard\ArtistBundle\Entity\Director;
use Myclapboard\ArtistBundle\Entity\Writer;
use Myclapboard\ArtistBundle\Manager\ActorManager;
use Myclapboard\ArtistBundle\Manager\ArtistManager;
use Myclapboard\ArtistBundle\Manager\DirectorManager;
use Myclapboard\ArtistBundle\Manager\WriterManager;
use Myclapboard\ArtistBundle\Model\ArtistInterface;
use Myclapboard\AwardBundle\Manager\AwardManager;
use Myclapboard\AwardBundle\Manager\AwardWonManager;
use Myclapboard\AwardBundle\Manager\CategoryManager;
use Myclapboard\AwardBundle\Model\AwardInterface;
use Myclapboard\AwardBundle\Model\AwardWonInterface;
use Myclapboard\AwardBundle\Model\CategoryInterface;
use Myclapboard\MovieBundle\Manager\MovieManager;
use Myclapboard\MovieBundle\Model\MovieInterface;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class LoadAwardsWonCommandSpec.
 *
 * @package spec\Myclapboard\AwardBundle\Model
 */
class LoadAwardsWonCommandSpec extends ObjectBehavior
{
    function let(ContainerInterface $container)
    {
        $this->setContainer($container);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Myclapboard\AwardBundle\Command\LoadAwardsWonCommand');
    }

    function it_should_be_extends_Container_Aware_Command()
    {
        $this->shouldHaveType('Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand');
    }

    function it_executes_and_loads_awardsWon(
        InputInterface $input,
        OutputInterface $output,
        ContainerInterface $container,
        ManagerRegistry $managerRegistry,
        ObjectManager $manager,
        AwardWonManager $awardWonManager,
        AwardWonInterface $awardWon,
        AwardManager $awardManager,
        AwardInterface $award,
        CategoryManager $categoryManager,
        CategoryInterface $category,
        MovieManager $movieManager,
        MovieInterface $movie,
        ArtistManager $artistManager,
        ArtistInterface $artist,
        ActorManager $actorManager,
        Actor $actor,
        DirectorManager $directorManager,
        Director $director,
        WriterManager $writerManager,
        Writer $writer
    )
    {
        $output->writeln("Loading awardsWon")->shouldBeCalled();

        $input->getArgument('file')->shouldBeCalled()->willReturn('app/Resources/fixtures/awardswon.yml');
        $input->bind(Argument::any())->shouldBeCalled();
        $input->isInteractive()->shouldBeCalled()->willReturn(false);
        $input->validate()->shouldBeCalled();

        $container->get('doctrine')->shouldBeCalled()->willReturn($managerRegistry);
        $managerRegistry->getManager()->shouldBeCalled()->willReturn($manager);


        $container->get('myclapboard_award.manager.award')
            ->shouldBeCalled()->willReturn($awardManager);
        $awardManager->findOneByName(Argument::any())
            ->shouldBeCalled()->willReturn($award);

        $container->get('myclapboard_award.manager.category')
            ->shouldBeCalled()->willReturn($categoryManager);
        $categoryManager->findOneByName(Argument::any())
            ->shouldBeCalled()->willReturn($category);

        $container->get('myclapboard_movie.manager.movie')
            ->shouldBeCalled()->willReturn($movieManager);
        $movieManager->findOneByTitle(Argument::any())
            ->shouldBeCalled()->willReturn($movie);

        $container->get('myclapboard_award.manager.awardWon')
            ->shouldBeCalled()->willReturn($awardWonManager);
        $awardWonManager->create()->shouldBeCalled()->willReturn($awardWon);

        $awardWon->setAward($award)->shouldBeCalled()->willReturn($awardWon);
        $awardWon->setCategory($category)->shouldBeCalled()->willReturn($awardWon);
        $awardWon->setMovie($movie)->shouldBeCalled()->willReturn($awardWon);
        $awardWon->setYear(Argument::any())->shouldBeCalled()->willReturn($awardWon);

        $container->get('myclapboard_artist.manager.artist')
            ->shouldBeCalled()->willReturn($artistManager);
        $artistManager->findOneByFullName(Argument::any(), Argument::any())
            ->shouldBeCalled()->willReturn($artist);

        $container->get('myclapboard_artist.manager.actor')
            ->shouldBeCalled()->willReturn($actorManager);
        $actorManager->findOneByArtistAndMovie($artist, $movie)
            ->shouldBeCalled()->willReturn($actor);

        $container->get('myclapboard_artist.manager.director')
            ->shouldBeCalled()->willReturn($directorManager);
        $directorManager->findOneByArtistAndMovie($artist, $movie)
            ->shouldBeCalled()->willReturn($director);

        $container->get('myclapboard_artist.manager.writer')
            ->shouldBeCalled()->willReturn($writerManager);
        $writerManager->findOneByArtistAndMovie($artist, $movie)
            ->shouldBeCalled()->willReturn($writer);

        $awardWon->setActor($actor)->shouldBeCalled()->willReturn($awardWon);
        $awardWon->setDirector($director)->shouldBeCalled()->willReturn($awardWon);
        $awardWon->setWriter($writer)->shouldBeCalled()->willReturn($awardWon);

        $manager->persist($awardWon)->shouldBeCalled();

        $manager->flush()->shouldBeCalled();

        $output->writeln("AwardsWon loaded successfully")->shouldBeCalled();

        $this->run($input, $output);
    }
}
