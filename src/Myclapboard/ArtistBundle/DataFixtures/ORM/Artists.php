<?php

/**
 * This file belongs to myClapboard.
 * The source code of application includes a LICENSE file
 * with all information about license.
 *
 * @author benatespina <benatespina@gmail.com>
 * @author gorkalaucirica <gorka.lauzirika@gmail.com>
 */

namespace Myclapboard\ArtistBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Myclapboard\CoreBundle\DataFixtures\ORM\DataFixtures;

/**
 * Class Artists.
 *
 * @package Myclapboard\ArtistBundle\DataFixtures\ORM
 */
class Artists extends DataFixtures
{
    /**
     * {@inheritdoc}
     */
    public function load(ObjectManager $manager)
    {
        $this->container->get('myclapboard_artist.command_artists')->loadEntity(
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
