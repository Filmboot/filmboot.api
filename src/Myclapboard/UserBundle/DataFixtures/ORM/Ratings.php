<?php

/**
 * This file belongs to myClapboard.
 * The source code of application includes a LICENSE file
 * with all information about license.
 *
 * @author benatespina <benatespina@gmail.com>
 * @author gorkalaucirica <gorka.lauzirika@gmail.com>
 */

namespace Myclapboard\UserBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Myclapboard\CoreBundle\DataFixtures\ORM\DataFixtures;

/**
 * Class Ratings.
 *
 * @package Myclapboard\UserBundle\DataFixtures\ORM
 */
class Ratings extends DataFixtures
{
    /**
     * {@inheritdoc}
     */
    public function load(ObjectManager $manager)
    {
        $users = $this->container->get('myclapboard_user.manager.user')->findAll();
        $movies = $this->container->get('myclapboard_movie.manager.movie')->findAll('title', '', 'uncountable');

        foreach ($users as $user) {
            for ($i = 0; $i < 5; $i++) {
                $rating = $this->container->get('myclapboard_user.manager.rating')->create();
                $rating->setMark(rand(1, 10));
                $rating->setDate(new \DateTime());
                $rating->setUser($user);
                $rating->setMovie($movies[$i]);
                
                $manager->persist($rating);
            }
        }
        
        $manager->flush();
    }

    /**
     * {@inheritdoc}
     */
    public function getOrder()
    {
        return 2;
    }
}
