<?php

/**
 * (c) benatespina <benatespina@gmail.com>
 *
 * This file belongs to myClapboard.
 * The source code of application includes a LICENSE file
 * with all information about license.
 */

namespace spec\Myclapboard\UserBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Myclapboard\MovieBundle\Manager\MovieManager;
use Myclapboard\MovieBundle\Model\MovieInterface;
use Myclapboard\UserBundle\Manager\RatingManager;
use Myclapboard\UserBundle\Manager\UserManager;
use Myclapboard\UserBundle\Model\AccountInterface;
use Myclapboard\UserBundle\Model\RatingInterface;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class RatingsSpec.
 *
 * @package spec\Myclapboard\UserBundle
 * \DataFixtures\ORM
 */
class RatingsSpec extends ObjectBehavior
{
    function let(ContainerInterface $container)
    {
        $this->setContainer($container);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Myclapboard\UserBundle\DataFixtures\ORM\Ratings');
    }

    function it_extends_abstract_fixtures()
    {
        $this->shouldHaveType('Doctrine\Common\DataFixtures\AbstractFixture');
    }

    function it_implements_interface()
    {
        $this->shouldImplement('Doctrine\Common\DataFixtures\OrderedFixtureInterface');
        $this->shouldImplement('Symfony\Component\DependencyInjection\ContainerAwareInterface');
    }

    function it_loads_fixtures(
        ObjectManager $manager,
        ContainerInterface $container,
        UserManager $userManager,
        AccountInterface $user,
        MovieManager $movieManager,
        MovieInterface $movie,
        MovieInterface $movie2,
        MovieInterface $movie3,
        RatingManager $ratingManager,
        RatingInterface $rating
    )
    {
        $container->get('myclapboard_user.manager.user')
            ->shouldBeCalled()->willReturn($userManager);
        $userManager->findAll()->shouldBeCalled()->willReturn(array($user));
        
        $container->get('myclapboard_movie.manager.movie')
            ->shouldBeCalled()->willReturn($movieManager);
        $movieManager->findAll('title')
            ->shouldBeCalled()->willReturn(array($movie, $movie2, $movie3));
        
        $container->get('myclapboard_user.manager.rating')
            ->shouldBeCalled()->willReturn($ratingManager);
        $ratingManager->create()->shouldBeCalled()->willReturn($rating);
        
        $rating->setMark(Argument::any())
            ->shouldBeCalled()->willReturn($rating);
        $rating->setDate(Argument::type('DateTime'))
            ->shouldBeCalled()->willReturn($rating);
        $rating->setUser($user)
            ->shouldBeCalled()->willReturn($rating);
        $rating->setMovie(Argument::type('Myclapboard\MovieBundle\Model\MovieInterface'))
            ->shouldBeCalled()->willReturn($rating);
        
        $manager->persist($rating)->shouldBeCalled();
        
        $manager->flush()->shouldBeCalled();

        $this->load($manager);
    }

    function its_order_is_two()
    {
        $this->getOrder()->shouldReturn(2);
    }
}
