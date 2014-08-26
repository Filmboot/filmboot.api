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
 * Class Reviews.
 *
 * @package Myclapboard\UserBundle\DataFixtures\ORM
 */
class Reviews extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
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
                $review = $this->container->get('myclapboard_user.manager.review')->create();
                $review->setTitle($user->getFirstName() . '\'s review about ' . $movies[$i]->getTitle());
                $review->setContent(
                    'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do
                    eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim
                    ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut
                    aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit
                    in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
                    Excepteur sint occaecat cupidatat non proident, sunt in culpa qui
                    officia deserunt mollit anim id est laborum. Lorem ipsum dolor sit amet,
                    consectetur adipisicing elit. Modi, quam, itaque exercitationem sunt
                    perspiciatis optio ad labore natus sapiente accusantium nesciunt vel
                    quia dolore nam ea excepturi ipsum. Dolores, dicta! Lorem ipsum dolor
                    sit amet, consectetur adipisicing elit. Provident, qui nulla dignissimos
                    commodi molestiae dolorem at quae porro soluta quos harum reprehenderit.
                    Sunt, quos, vitae? Nobis, et cum hic amet.'
                );
                $review->setLocale('en');

                if (rand(0, 1) === 1) {
                    $createdAt = $review->getCreatedAt()->format('Y-m-d H:i:s');
                    $review->setUpdatedAt(new \DateTime($createdAt . '+30 minutes'));
                    $review->setLocale('es');
                }

                $review->setUser($user);
                $review->setMovie($movies[$i]);

                $manager->persist($review);
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
