<?php

/**
 * (c) benatespina <benatespina@gmail.com>
 *
 * This file belongs to myClapboard.
 * The source code of application includes a LICENSE file
 * with all information about license.
 */

namespace Myclapboard\UserBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class Ratings.
 *
 * @package Myclapboard\UserBundle\DataFixtures\ORM
 */
class Ratings extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
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
