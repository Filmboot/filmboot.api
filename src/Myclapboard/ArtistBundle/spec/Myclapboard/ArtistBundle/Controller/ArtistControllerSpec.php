<?php

/**
 * (c) benatespina <benatespina@gmail.com>
 *
 * This file belongs to myClapboard.
 * The source code of application includes a LICENSE file
 * with all information about license.
 */

namespace spec\Myclapboard\ArtistBundle\Controller;

use FOS\RestBundle\Request\ParamFetcher;
use FOS\RestBundle\View\ViewHandler;
use Myclapboard\ArtistBundle\Manager\ArtistManager;
use Myclapboard\ArtistBundle\Model\ArtistInterface;
use PhpSpec\ObjectBehavior;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Class ArtistControllerSpec.
 *
 * @package spec\Myclapboard\ArtistBundle\Controller
 */
class ArtistControllerSpec extends ObjectBehavior
{
    function let(ContainerInterface $container)
    {
        $this->setContainer($container);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Myclapboard\ArtistBundle\Controller\ArtistController');
    }

    function it_extends_base_api_controller()
    {
        $this->shouldHaveType('Myclapboard\CoreBundle\Controller\BaseApiController');
    }

    function it_gets_artists(
        ContainerInterface $container,
        ArtistManager $artistManager,
        ParamFetcher $paramFetcher,
        ViewHandler $viewHandler
    )
    {
        $container->get('myclapboard_artist.manager.artist')
            ->shouldBeCalled()->willReturn($artistManager);
        $paramFetcher->get('order')->shouldBeCalled()->willReturn('lastName');
        $paramFetcher->get('q')->shouldBeCalled()->willReturn('query');
        $paramFetcher->get('count')->shouldBeCalled()->willReturn(10);
        $paramFetcher->get('page')->shouldBeCalled()->willReturn(1);

        $artistManager->findAll('lastName', 'query', 10, 1)->shouldBeCalled()->willReturn(array());

        $container->get('fos_rest.view_handler')->shouldBeCalled()->willReturn($viewHandler);

        $this->getArtistsAction($paramFetcher);
    }

    function it_does_not_get_artist_for_given_id_because_it_does_not_exist(
        ContainerInterface $container,
        ArtistManager $artistManager
    )
    {
        $container->get('myclapboard_artist.manager.artist')
            ->shouldBeCalled()->willReturn($artistManager);
        $artistManager->findOneById('non-exist-artist-id')
            ->shouldBeCalled()->willReturn(null);

        $this->shouldThrow(new NotFoundHttpException('Does not exist any artist with non-exist-artist-id id'))
            ->during('getArtistAction', array('non-exist-artist-id'));
    }

    function it_gets_artist_for_given_id(
        ContainerInterface $container,
        ArtistManager $artistManager,
        ArtistInterface $artist,
        ViewHandler $viewHandler
    )
    {
        $container->get('myclapboard_artist.manager.artist')
            ->shouldBeCalled()->willReturn($artistManager);
        $artistManager->findOneById('artist-id')
            ->shouldBeCalled()->willReturn($artist);

        $container->get('fos_rest.view_handler')->shouldBeCalled()->willReturn($viewHandler);

        $this->getArtistAction('artist-id');
    }
}
