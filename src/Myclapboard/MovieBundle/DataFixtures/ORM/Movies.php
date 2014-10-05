<?php

/**
 * This file belongs to myClapboard.
 * The source code of application includes a LICENSE file
 * with all information about license.
 *
 * @author benatespina <benatespina@gmail.com>
 * @author gorkalaucirica <gorka.lauzirika@gmail.com>
 */

namespace Myclapboard\MovieBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Myclapboard\CoreBundle\DataFixtures\ORM\DataFixtures;

/**
 * Class Movies.
 *
 * @package Myclapboard\ArtistBundle\DataFixtures\ORM
 */
class Movies extends DataFixtures
{
    /**
     * {@inheritdoc}
     */
    public function load(ObjectManager $manager)
    {
        $this->container->get('myclapboard_movie.command_movies')->loadEntity(
            $this->container->get('kernel')->getRootDir().'/../app/Resources/fixtures/movies.yml'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getOrder()
    {
        return 1;
    }
}
