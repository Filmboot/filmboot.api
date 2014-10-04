<?php

/**
 * This file belongs to myClapboard.
 * The source code of application includes a LICENSE file
 * with all information about license.
 *
 * @author benatespina <benatespina@gmail.com>
 * @author gorkalaucirica <gorka.lauzirika@gmail.com>
 */

namespace Myclapboard\AwardBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Myclapboard\CoreBundle\DataFixtures\ORM\DataFixtures;

/**
 * Class Awards.
 *
 * @package Myclapboard\ArtistBundle\DataFixtures\ORM
 */
class Awards extends DataFixtures
{
    /**
     * {@inheritdoc}
     */
    public function load(ObjectManager $manager)
    {
        $this->container->get('myclapboard_award.command_awards')->loadEntity(
            $this->container->get('kernel')->getRootDir() . '/../app/Resources/fixtures/awards.yml'
        );

        $this->container->get('myclapboard_award.command_categories')->loadEntity(
            $this->container->get('kernel')->getRootDir() . '/../app/Resources/fixtures/categories.yml'
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
