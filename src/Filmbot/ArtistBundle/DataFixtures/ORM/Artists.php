<?php

/**
 * (c) benatespina <benatespina@gmail.com>
 *
 * This file belongs to Filmbot.
 * The source code of application includes a LICENSE file
 * with all information about license.
 */

namespace Filmbot\ArtistBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class Artists.
 *
 * @package Filmbot\ArtistBundle\DataFixtures\ORM
 */
class Artists extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
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
        $this->container->get('filmbot_artist.command_artists')->loadArtists(
            $this->container->get('kernel')->getRootDir().'/../app/Resources/fixtures/artists.yml'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getOrder()
    {
        return 0;
    }
}
