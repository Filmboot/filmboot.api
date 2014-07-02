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
use Filmbot\ArtistBundle\Manager\ArtistManager;
use Filmbot\ArtistBundle\Model\ArtistInterface;
use Filmbot\AwardBundle\Manager\AwardManager;
use Filmbot\AwardBundle\Manager\AwardWonManager;
use Filmbot\AwardBundle\Manager\CategoryManager;
use Filmbot\AwardBundle\Model\AwardInterface;
use Filmbot\AwardBundle\Model\AwardWonInterface;
use Filmbot\AwardBundle\Model\CategoryInterface;
use Filmbot\MovieBundle\Manager\MovieManager;
use Filmbot\MovieBundle\Model\MovieInterface;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class LoadAwardsWonCommandSpec.
 *
 * @package spec\Filmbot\AwardBundle\Model
 */
class LoadAwardsWonCommandSpec extends ObjectBehavior
{
    function let(ContainerInterface $container)
    {
        $this->setContainer($container);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Filmbot\AwardBundle\Command\LoadAwardsWonCommand');
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
        ArtistInterface $artist
    )
    {
        $output->writeln("Loading awardsWon")->shouldBeCalled();

        $input->getArgument('file')->shouldBeCalled()->willReturn('app/Resources/fixtures/awardswon.yml');
        $input->bind(Argument::any())->shouldBeCalled();
        $input->isInteractive()->shouldBeCalled()->willReturn(false);
        $input->validate()->shouldBeCalled();

        $container->get('doctrine')->shouldBeCalled()->willReturn($managerRegistry);
        $managerRegistry->getManager()->shouldBeCalled()->willReturn($manager);

        $container->get('filmbot_award.manager.awardWon')
            ->shouldBeCalled()->willReturn($awardWonManager);
        $awardWonManager->create()->shouldBeCalled()->willReturn($awardWon);

        $container->get('filmbot_award.manager.award')
            ->shouldBeCalled()->willReturn($awardManager);
        $awardManager->findOneByName(Argument::any())
            ->shouldBeCalled()->willReturn($award);

        $awardWon->setAward($award)->shouldBeCalled()->willReturn($awardWon);

        $container->get('filmbot_award.manager.category')
            ->shouldBeCalled()->willReturn($categoryManager);
        $categoryManager->findOneByName(Argument::any())
            ->shouldBeCalled()->willReturn($category);

        $awardWon->setCategory($category)->shouldBeCalled()->willReturn($awardWon);

        $container->get('filmbot_movie.manager.movie')
            ->shouldBeCalled()->willReturn($movieManager);
        $movieManager->findOneByTitle(Argument::any())
            ->shouldBeCalled()->willReturn($movie);

        $awardWon->setMovie($movie)->shouldBeCalled()->willReturn($awardWon);

        $container->get('filmbot_artist.manager.artist')
            ->shouldBeCalled()->willReturn($artistManager);
        $artistManager->findOneByFullName(Argument::any(), Argument::any())
            ->shouldBeCalled()->willReturn($artist);

        $awardWon->setArtist($artist)->shouldBeCalled()->willReturn($awardWon);
        $awardWon->setRole(Argument::any())->shouldBeCalled()->willReturn($awardWon);
        $awardWon->setYear(Argument::any())->shouldBeCalled()->willReturn($awardWon);

        $manager->persist($awardWon)->shouldBeCalled();

        $manager->flush()->shouldBeCalled();

        $output->writeln("AwardsWon loaded successfully")->shouldBeCalled();

        $this->run($input, $output);
    }
}
