<?php

/**
 * This file belongs to myClapboard.
 * The source code of application includes a LICENSE file
 * with all information about license.
 *
 * @author benatespina <benatespina@gmail.com>
 * @author gorkalaucirica <gorka.lauzirika@gmail.com>
 */

namespace spec\Myclapboard\MovieBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Myclapboard\MovieBundle\Command\LoadGenresCommand;
use PhpSpec\ObjectBehavior;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpKernel\KernelInterface;

/**
 * Class GenresSpec.
 *
 * @package spec\Myclapboard\MovieBundle\DataFixtures\ORM
 */
class GenresSpec extends ObjectBehavior
{
    function let(ContainerInterface $container)
    {
        $this->setContainer($container);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Myclapboard\MovieBundle\DataFixtures\ORM\Genres');
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
        LoadGenresCommand $loadGenresCommand
    )
    {
        $container->get('kernel')->shouldBeCalled()->willReturn($kernel);
        $kernel->getRootDir()->shouldBeCalled()->willReturn('rootDir');
        $container->get('myclapboard_movie.command_genres')
            ->shouldBeCalled()->willReturn($loadGenresCommand);
        $loadGenresCommand->loadEntity('rootDir/../app/Resources/fixtures/genres.yml')
            ->shouldBeCalled();

        $this->load($manager);
    }

    function its_order_is_zero()
    {
        $this->getOrder()->shouldReturn(0);
    }
}
