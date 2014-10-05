<?php

/**
 * This file belongs to myClapboard.
 * The source code of application includes a LICENSE file
 * with all information about license.
 *
 * @author benatespina <benatespina@gmail.com>
 * @author gorkalaucirica <gorka.lauzirika@gmail.com>
 */

namespace Myclapboard\AwardBundle\Command;

use Doctrine\Common\Persistence\ObjectManager;
use Myclapboard\CoreBundle\Command\DataFixtureCommand;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class LoadAwardsWonCommand.
 *
 * @package Myclapboard\AwardBundle\Command
 */
class LoadAwardsWonCommand extends DataFixtureCommand
{
    /**
     * {@inheritdoc}
     */
    protected $initMessage = 'Loading awardsWon';

    /**
     * {@inheritdoc}
     */
    protected $endMessage = 'AwardsWon loaded successfully';

    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        parent::configure();
        $this
            ->setName('myclapboard:award:load:awardWon')
            ->setDescription('Loads awardWon from yml file')
            ->setHelp(
                'The <info>myclapboard:award:load:awardWon</info> command loads content of file passed by argument
<info>php app/console myclapboard:award:load:awardWon <path-of-file></info>'
            );
    }

    /**
     * {@inheritdoc}
     */
    protected function hydrateFixture(ContainerInterface $container, ObjectManager $manager, $values)
    {
        $award = $container->get('myclapboard_award.manager.award')
            ->findOneByName($values['name']);
        $category = $container->get('myclapboard_award.manager.category')
            ->findOneByName($values['category']);
        $movie = $container->get('myclapboard_movie.manager.movie')
            ->findOneByTitle($values['movie']);

        if ($award !== null && $category !== null && $movie !== null) {
            $awardWon = $container->get('myclapboard_award.manager.awardWon')->create();

            $awardWon->setAward($award);
            $awardWon->setCategory($category);
            $awardWon->setMovie($movie);
            $awardWon->setYear($values['year']);

            $artist = $container->get('myclapboard_artist.manager.artist')
                ->findOneByFullName($values['artist']['firstName'], $values['artist']['lastName']);

            if ($artist !== null) {
                $role = $container->get('myclapboard_artist.manager.' . $values['role'])
                    ->findOneByArtistAndMovie($artist, $movie);
                if ($role !== null) {
                    switch ($values['role']) {
                        case 'actor':
                            $awardWon->setActor($role);
                            break;
                        case 'director':
                            $awardWon->setDirector($role);
                            break;
                        case 'writer':
                            $awardWon->setWriter($role);
                            break;
                    }
                }
            }

            $manager->persist($awardWon);
        }
    }
}
