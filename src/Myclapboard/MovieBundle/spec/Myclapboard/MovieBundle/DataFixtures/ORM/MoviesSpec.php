<?php

/**
 * (c) benatespina <benatespina@gmail.com>
 *
 * This file belongs to myClapboard.
 * The source code of application includes a LICENSE file
 * with all information about license.
 */

namespace spec\Myclapboard\MovieBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Myclapboard\MovieBundle\Command\LoadMoviesCommand;
use PhpSpec\ObjectBehavior;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpKernel\KernelInterface;

/**
 * Class MoviesSpec.
 *
 * @package spec\Myclapboard\MovieBundle\DataFixtures\ORM
 */
class MoviesSpec extends ObjectBehavior
{
    function let(ContainerInterface $container)
    {
        $this->setContainer($container);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Myclapboard\MovieBundle\DataFixtures\ORM\Movies');
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
        KernelInterface $kernel,
        LoadMoviesCommand $loadMoviesCommand
    )
    {
        $container->get('kernel')->shouldBeCalled()->willReturn($kernel);
        $kernel->getRootDir()->shouldBeCalled()->willReturn('rootDir');
        $container->get('myclapboard_movie.command_movies')
            ->shouldBeCalled()->willReturn($loadMoviesCommand);
        $loadMoviesCommand->loadEntity('rootDir/../app/Resources/fixtures/movies.yml')
            ->shouldBeCalled();

        $this->load($manager);
    }

    function its_order_is_one()
    {
        $this->getOrder()->shouldReturn(1);
    }
}
