<?php

/**
 * (c) benatespina <benatespina@gmail.com>
 *
 * This file belongs to Myclapboard.
 * The source code of application includes a LICENSE file
 * with all information about license.
 */

namespace Myclapboard\AwardBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class AwardsWon.
 *
 * @package Myclapboard\ArtistBundle\DataFixtures\ORM
 */
class AwardsWon extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
{
    /**
     * @var \Symfony\Component\DependencyInjection\ContainerInterface
     */
    private $container;

    /**
     * {@inheritdoc}
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    /**
     * {@inheritdoc}
     */
    public function load(ObjectManager $manager)
    {
        $this->container->get('myclapboard_award.command_awardsWon')->loadAwardsWon(
            $this->container->get('kernel')->getRootDir().'/../app/Resources/fixtures/awardswon.yml'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getOrder()
    {
        return 2;
    }
}
