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
use Myclapboard\ArtistBundle\Manager\ImageManager;
use Myclapboard\ArtistBundle\Model\ArtistInterface;
use Myclapboard\ArtistBundle\Model\Image;
use Myclapboard\AwardBundle\Manager\AwardWonManager;
use PhpSpec\ObjectBehavior;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Router;

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

    function it_does_not_get_movies_for_given_artist_id_because_it_does_not_exist(
        ParamFetcher $paramFetcher,
        ContainerInterface $container,
        ArtistManager $artistManager
    )
    {
        $paramFetcher->get('q')->shouldBeCalled()->willReturn(null);

        $container->get('myclapboard_artist.manager.artist')
            ->shouldBeCalled()->willReturn($artistManager);
        $artistManager->findOneById('non-exist-artist-id')
            ->shouldBeCalled()->willReturn(null);
        
        $this->shouldThrow(new NotFoundHttpException('Does not exist any artist with non-exist-artist-id id'))
            ->during('getArtistsMoviesAction', array('non-exist-artist-id', $paramFetcher));
    }
    
    function it_gets_all_the_movies_for_given_artist_id(
        ParamFetcher $paramFetcher,
        ContainerInterface $container,
        ArtistManager $artistManager,
        ArtistInterface $artist,
        ViewHandler $viewHandler
    )
    {
        $paramFetcher->get('q')->shouldBeCalled()->willReturn(null);

        $container->get('myclapboard_artist.manager.artist')
            ->shouldBeCalled()->willReturn($artistManager);
        $artistManager->findOneById('artist-id')
            ->shouldBeCalled()->willReturn($artist);

        $container->get('fos_rest.view_handler')->shouldBeCalled()->willReturn($viewHandler);

        $this->getArtistsMoviesAction('artist-id', $paramFetcher);
    }

    function it_gets_all_the_movies_for_given_artist_id_filtering_by_actor(
        ParamFetcher $paramFetcher,
        ContainerInterface $container,
        ArtistManager $artistManager,
        ArtistInterface $artist,
        ViewHandler $viewHandler
    )
    {
        $paramFetcher->get('q')->shouldBeCalled()->willReturn('actor');
        
        $container->get('myclapboard_artist.manager.artist')
            ->shouldBeCalled()->willReturn($artistManager);
        $artistManager->findOneById('artist-id')
            ->shouldBeCalled()->willReturn($artist);

        $container->get('fos_rest.view_handler')->shouldBeCalled()->willReturn($viewHandler);

        $this->getArtistsMoviesAction('artist-id', $paramFetcher);
    }

    function it_does_not_get_awards_for_given_artist_id_because_it_does_not_exist(
        ContainerInterface $container,
        ArtistManager $artistManager
    )
    {
        $container->get('myclapboard_artist.manager.artist')
            ->shouldBeCalled()->willReturn($artistManager);
        $artistManager->findOneById('non-exist-artist-id')
            ->shouldBeCalled()->willReturn(null);
        
        $this->shouldThrow(new NotFoundHttpException('Does not exist any artist with non-exist-artist-id id'))
            ->during('getArtistsAwardsAction', array('non-exist-artist-id'));
    }

    function it_gets_all_the_awards_for_given_artist_id(
        ContainerInterface $container,
        ArtistManager $artistManager,
        ArtistInterface $artist,
        AwardWonManager $awardWonManager,
        ViewHandler $viewHandler
    )
    {
        $container->get('myclapboard_artist.manager.artist')
            ->shouldBeCalled()->willReturn($artistManager);
        $artistManager->findOneById('artist-id')
            ->shouldBeCalled()->willReturn($artist);
        
        $container->get('myclapboard_award.manager.awardWon')
            ->shouldBeCalled()->willReturn($awardWonManager);
        $awardWonManager->findAllByArtist('artist-id')
            ->shouldBeCalled()->willReturn(array());

        $container->get('fos_rest.view_handler')->shouldBeCalled()->willReturn($viewHandler);

        $this->getArtistsAwardsAction('artist-id');
    }

    function it_does_not_get_the_images_of_artist_because_the_artist_does_not_exist(
        ContainerInterface $container,
        ArtistManager $artistManager
    )
    {
        $container->get('myclapboard_artist.manager.artist')
            ->shouldBeCalled()->willReturn($artistManager);
        $artistManager->findOneById('non-exist-artist-id')
            ->shouldBeCalled()->willReturn(null);

        $this->shouldThrow(
            new NotFoundHttpException('Does not exist any artist with non-exist-artist-id id')
        )->during('getArtistsImagesAction', array('non-exist-artist-id'));
    }

    function it_gets_the_images_of_artist(
        ContainerInterface $container,
        ArtistManager $artistManager,
        ArtistInterface $artist,
        ImageManager $imageManager,
        Image $image,
        Router $router,
        ViewHandler $viewHandler
    )
    {
        $container->get('myclapboard_artist.manager.artist')
            ->shouldBeCalled()->willReturn($artistManager);
        $artistManager->findOneById('artist-id')
            ->shouldBeCalled()->willReturn($artist);

        $container->get('myclapboard_artist.manager.image')
            ->shouldBeCalled()->willReturn($imageManager);
        $imageManager->findAllBy('artist-id')
            ->shouldBeCalled()->willReturn(array($image));

        $image->getName()->shouldBeCalled()->willReturn('image-name.jpg');
        $container->get('router')->shouldBeCalled()->willReturn($router);
        $image->setName(null)->shouldBeCalled()->willReturn($image);

        $container->get('fos_rest.view_handler')->shouldBeCalled()->willReturn($viewHandler);

        $this->getArtistsImagesAction('artist-id');
    }
}
