<?php

/**
 * This file belongs to myClapboard.
 * The source code of application includes a LICENSE file
 * with all information about license.
 *
 * @author benatespina <benatespina@gmail.com>
 * @author gorkalaucirica <gorka.lauzirika@gmail.com>
 */

namespace spec\Myclapboard\UserBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Myclapboard\MovieBundle\Manager\MovieManager;
use Myclapboard\MovieBundle\Model\MovieInterface;
use Myclapboard\UserBundle\Manager\ReviewManager;
use Myclapboard\UserBundle\Manager\UserManager;
use Myclapboard\UserBundle\Model\Account;
use Myclapboard\UserBundle\Model\ReviewInterface;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class ReviewsSpec.
 *
 * @package spec\Myclapboard\UserBundle
 * \DataFixtures\ORM
 */
class ReviewsSpec extends ObjectBehavior
{
    function let(ContainerInterface $container)
    {
        $this->setContainer($container);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Myclapboard\UserBundle\DataFixtures\ORM\Reviews');
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
        Account $user,
        MovieManager $movieManager,
        MovieInterface $movie,
        MovieInterface $movie2,
        MovieInterface $movie3,
        MovieInterface $movie4,
        MovieInterface $movie5,
        ReviewManager $reviewManager,
        ReviewInterface $review
    )
    {
        $container->get('myclapboard_user.manager.user')
            ->shouldBeCalled()->willReturn($userManager);
        $userManager->findAll()->shouldBeCalled()->willReturn(array($user));

        $container->get('myclapboard_movie.manager.movie')
            ->shouldBeCalled()->willReturn($movieManager);
        $movieManager->findAll('title', '', 'uncountable')
            ->shouldBeCalled()->willReturn(array($movie, $movie2, $movie3, $movie4, $movie5));

        $container->get('myclapboard_user.manager.review')
            ->shouldBeCalled()->willReturn($reviewManager);
        $reviewManager->create()->shouldBeCalled()->willReturn($review);

        $review->setTitle(Argument::any())
            ->shouldBeCalled()->willReturn($review);
        $review->setContent(Argument::any())
            ->shouldBeCalled()->willReturn($review);
        $review->setLocale('en')
            ->shouldBeCalled()->willReturn($review);

        $createdAtDate = new \DateTime();
        $review->getCreatedAt()
            ->shouldBeCalled()->willReturn($createdAtDate);
        $createdAt = $createdAtDate->format('Y-m-d H:i:s');
        $review->setUpdatedAt(new \DateTime($createdAt . '+30 minutes'))
            ->shouldBeCalled()->willReturn($review);
        $review->setLocale('es')
            ->willReturn($review);


        $review->setUser($user)
            ->shouldBeCalled()->willReturn($review);
        $review->setMovie(Argument::type('Myclapboard\MovieBundle\Model\MovieInterface'))
            ->shouldBeCalled()->willReturn($review);

        $manager->persist($review)->shouldBeCalled();

        $manager->flush()->shouldBeCalled();

        $this->load($manager);
    }

    function its_order_is_two()
    {
        $this->getOrder()->shouldReturn(2);
    }
}
