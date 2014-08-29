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
use JJs\Bundle\GeonamesBundle\Entity\City;
use JJs\Bundle\GeonamesBundle\Entity\CityRepository;
use Myclapboard\UserBundle\Manager\UserManager;
use Myclapboard\UserBundle\Entity\User;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class UsersSpec.
 *
 * @package spec\Myclapboard\UserBundle
 * \DataFixtures\ORM
 */
class UsersSpec extends ObjectBehavior
{
    function let(ContainerInterface $container)
    {
        $this->setContainer($container);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Myclapboard\UserBundle\DataFixtures\ORM\Users');
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
        CityRepository $cityRepository,
        City $location,
        ContainerInterface $container,
        UserManager $userManager,
        User $user
    )
    {
        $this->createUsers(
            $manager,
            $cityRepository,
            $location,
            $container,
            $userManager,
            $user,
            'ROLE_USER',
            false
        );

        $this->createUsers(
            $manager,
            $cityRepository,
            $location,
            $container,
            $userManager,
            $user,
            'ROLE_ADMIN',
            true
        );

        $manager->flush()->shouldBeCalled();

        $this->load($manager);
    }

    function its_order_is_zero()
    {
        $this->getOrder()->shouldReturn(0);
    }

    private function createUsers(
        ObjectManager $manager,
        CityRepository $cityRepository,
        City $location,
        ContainerInterface $container,
        UserManager $userManager,
        User $user,
        $role,
        $enabled
    )
    {
        $manager->getRepository('JJsGeonamesBundle:City')
            ->shouldBeCalled()->willReturn($cityRepository);
        $cityRepository->findAll()->shouldBeCalled()->willReturn(array($location));

        $container->get('myclapboard_user.manager.user')
            ->shouldBeCalled()->willReturn($userManager);
        $userManager->create()->shouldBeCalled()->willReturn($user);

        $user->setEmail(Argument::any())->shouldBeCalled()->willReturn($user);
        $user->setFirstName(Argument::any())->shouldBeCalled()->willReturn($user);
        $user->setLastName(Argument::any())->shouldBeCalled()->willReturn($user);
        $user->setPlainPassword(Argument::any())->shouldBeCalled()->willReturn($user);
        $user->setMobile('666666666')->shouldBeCalled()->willReturn($user);
        $user->setPhone('999999999')->shouldBeCalled()->willReturn($user);
        $locations = array($location);
        $user->setLocation($locations[array_rand(array($location))])
            ->shouldBeCalled()->willReturn($user);
        $user->setBirthday(Argument::any())->shouldBeCalled()->willReturn($user);
        $user->setGender(Argument::any())->shouldBeCalled()->willReturn($user);
        $user->setRoles(array($role))->shouldBeCalled()->willReturn($user);
        $user->setEnabled($enabled)->shouldBeCalled()->willReturn($user);

        $manager->persist($user)->shouldBeCalled();
    }
}
