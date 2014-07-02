<?php

/**
 * (c) benatespina <benatespina@gmail.com>
 *
 * This file belongs to Filmbot.
 * The source code of application includes a LICENSE file
 * with all information about license.
 */

namespace Filmbot\AwardBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Yaml\Parser;

/**
 * Class LoadAwardsWonCommand.
 *
 * @package Filmbot\AwardBundle\Command
 */
class LoadAwardsWonCommand extends ContainerAwareCommand
{
    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this
            ->setName('filmbot:award:load:awardWon')
            ->setDescription('Loads awardWon from yml file')
            ->addArgument('file', InputArgument::REQUIRED, 'Path of file to be loaded')
            ->setHelp(
                'The <info>filmbot:award:load:awardWon</info> command loads content of file passed by argument 
<info>php app/console filmbot:award:load:awardWon <path-of-file></info>'
            );
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln("Loading awardsWon");
        $this->loadAwardsWon($input->getArgument('file'));
        $output->writeln("AwardsWon loaded successfully");
    }

    /**
     * Loads all the awardsWon from fixtures app folder
     *
     * @param string $path The path of file
     *
     * @return void
     */
    public function loadAwardsWon($path)
    {
        $yaml = new Parser();

        $fixtures = $yaml->parse(file_get_contents($path));

        $container = $this->getContainer();
        $doctrine = $container->get('doctrine');
        $manager = $doctrine->getManager();
        foreach ($fixtures as $values) {
            $awardWon = $container->get('filmbot_award.manager.awardWon')->create();
            
            $award = $container->get('filmbot_award.manager.award')
                ->findOneByName($values['name']);
            if ($award) {
                $awardWon->setAward($award);
                $category = $container->get('filmbot_award.manager.category')
                    ->findOneByName($values['category']);
                if ($category) {
                    $awardWon->setCategory($category);
                    $movie = $container->get('filmbot_movie.manager.movie')
                        ->findOneByTitle($values['movie']);
                    if ($movie) {
                        $awardWon->setMovie($movie);
                        $artist = $container->get('filmbot_artist.manager.artist')
                            ->findOneByFullName($values['artist']['firstName'], $values['artist']['lastName']);
                        if ($artist) {
                            $awardWon->setArtist($artist);
                            $awardWon->setRole($values['role']);
                            $awardWon->setYear($values['year']);
                        }
        
                        $manager->persist($awardWon);
                    }
                }
            }
        }

        $manager->flush();
    }
}