<?php

/**
 * (c) benatespina <benatespina@gmail.com>
 *
 * This file belongs to Filmbot.
 * The source code of application includes a LICENSE file
 * with all information about license.
 */

namespace spec\Filmbot\ArtistBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Filmbot\ArtistBundle\Command\LoadArtistsCommand;
use PhpSpec\ObjectBehavior;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpKernel\KernelInterface;

class ArtistsSpec extends ObjectBehavior
{
    function let(ContainerInterface $container)
    {
        $this->setContainer($container);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Filmbot\ArtistBundle\DataFixtures\ORM\Artists');
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
        LoadArtistsCommand $loadArtistsCommand
    )
    {
        $container->get('kernel')->shouldBeCalled()->willReturn($kernel);
        $kernel->getRootDir()->shouldBeCalled()->willReturn('rootDir');
        $container->get('filmbot_artist.command_artists')
            ->shouldBeCalled()->willReturn($loadArtistsCommand);
        $loadArtistsCommand->loadArtists('rootDir/../app/Resources/fixtures/artists.yml')
            ->shouldBeCalled();

        $this->load($manager);
    }

    function its_order_is_six()
    {
        $this->getOrder()->shouldReturn(0);
    }
}
