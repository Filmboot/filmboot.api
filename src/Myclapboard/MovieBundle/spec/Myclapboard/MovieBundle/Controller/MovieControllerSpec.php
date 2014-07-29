<?php

/**
 * (c) benatespina <benatespina@gmail.com>
 *
 * This file belongs to myClapboard.
 * The source code of application includes a LICENSE file
 * with all information about license.
 */

namespace spec\Myclapboard\MovieBundle\Controller;

use FOS\RestBundle\View\ViewHandler;
use Myclapboard\ArtistBundle\Manager\ActorManager;
use Myclapboard\AwardBundle\Manager\AwardWonManager;
use Myclapboard\MovieBundle\Manager\ImageManager;
use Myclapboard\MovieBundle\Manager\MovieManager;
use FOS\RestBundle\Request\ParamFetcher;
use Myclapboard\MovieBundle\Model\Image;
use Myclapboard\MovieBundle\Model\MovieInterface;
use PhpSpec\ObjectBehavior;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Router;

/**
 * Class MovieControllerSpec.
 *
 * @package spec\Myclapboard\MovieBundle\Controller
 */
class MovieControllerSpec extends ObjectBehavior
{
    function let(ContainerInterface $container)
    {
        $this->setContainer($container);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Myclapboard\MovieBundle\Controller\MovieController');
    }

    function it_extends_resource_controller()
    {
        $this->shouldHaveType('Myclapboard\CoreBundle\Controller\ResourceController');
    }

    function it_gets_movies(
        ContainerInterface $container,
        MovieManager $movieManager,
        ParamFetcher $paramFetcher,
        ViewHandler $viewHandler
    )
    {
        $container->get('myclapboard_movie.manager.movie')
            ->shouldBeCalled()->willReturn($movieManager);
        $paramFetcher->get('order')->shouldBeCalled()->willReturn('title');
        $paramFetcher->get('q')->shouldBeCalled()->willReturn('query');
        $paramFetcher->get('count')->shouldBeCalled()->willReturn(10);
        $paramFetcher->get('page')->shouldBeCalled()->willReturn(1);

        $movieManager->findAll('title', 'query', 10, 1)->shouldBeCalled()->willReturn(array());

        $container->get('fos_rest.view_handler')->shouldBeCalled()->willReturn($viewHandler);

        $this->getMoviesAction($paramFetcher);
    }

    function it_does_not_get_movie_for_given_id_because_it_does_not_exist(
        ContainerInterface $container,
        MovieManager $movieManager
    )
    {
        $container->get('myclapboard_movie.manager.movie')
            ->shouldBeCalled()->willReturn($movieManager);
        $movieManager->findOneById('non-exist-movie-id')
            ->shouldBeCalled()->willReturn(null);

        $this->shouldThrow(new NotFoundHttpException('Does not exist any movie with non-exist-movie-id id'))
            ->during('getMovieAction', array('non-exist-movie-id'));
    }

    function it_gets_movie_for_given_id(
        ContainerInterface $container,
        MovieManager $movieManager,
        MovieInterface $movie,
        ViewHandler $viewHandler
    )
    {
        $container->get('myclapboard_movie.manager.movie')
            ->shouldBeCalled()->willReturn($movieManager);
        $movieManager->findOneById('movie-id')
            ->shouldBeCalled()->willReturn($movie);

        $container->get('fos_rest.view_handler')->shouldBeCalled()->willReturn($viewHandler);

        $this->getMovieAction('movie-id');
    }
    
    function it_does_not_get_the_cast_of_movie_because_the_movie_does_not_exist(
        ContainerInterface $container,
        MovieManager $movieManager
    )
    {
        $container->get('myclapboard_movie.manager.movie')
            ->shouldBeCalled()->willReturn($movieManager);
        $movieManager->findOneById('movie-id')
            ->shouldBeCalled()->willReturn(null);
        
        $this->shouldThrow(
            new NotFoundHttpException('Does not exist any movie with movie-id id')
        )->during('getMoviesCastAction', array('movie-id'));
    }
    
    function it_gets_the_cast_of_movie(
        ContainerInterface $container,
        MovieManager $movieManager,
        MovieInterface $movie,
        ActorManager $actorManager,
        ViewHandler $viewHandler
    )
    {
        $container->get('myclapboard_movie.manager.movie')
            ->shouldBeCalled()->willReturn($movieManager);
        $movieManager->findOneById('movie-id')
            ->shouldBeCalled()->willReturn($movie);
        
        $container->get('myclapboard_artist.manager.actor')
            ->shouldBeCalled()->willReturn($actorManager);
        $actorManager->findAllByMovie('movie-id')
            ->shouldBeCalled()->willReturn(array());

        $container->get('fos_rest.view_handler')->shouldBeCalled()->willReturn($viewHandler);

        $this->getMoviesCastAction('movie-id');
    }

    function it_does_not_get_the_awards_of_movie_because_the_movie_does_not_exist(
        ContainerInterface $container,
        MovieManager $movieManager
    )
    {
        $container->get('myclapboard_movie.manager.movie')
            ->shouldBeCalled()->willReturn($movieManager);
        $movieManager->findOneById('movie-id')
            ->shouldBeCalled()->willReturn(null);

        $this->shouldThrow(
            new NotFoundHttpException('Does not exist any movie with movie-id id')
        )->during('getMoviesAwardsAction', array('movie-id'));
    }
    
    function it_gets_the_awards_of_movie(
        ContainerInterface $container,
        MovieManager $movieManager,
        MovieInterface $movie,
        AwardWonManager $awardWonManager,
        ViewHandler $viewHandler
    )
    {
        $container->get('myclapboard_movie.manager.movie')
            ->shouldBeCalled()->willReturn($movieManager);
        $movieManager->findOneById('movie-id')
            ->shouldBeCalled()->willReturn($movie);

        $container->get('myclapboard_award.manager.awardWon')
            ->shouldBeCalled()->willReturn($awardWonManager);
        $awardWonManager->findAllByMovie('movie-id')
            ->shouldBeCalled()->willReturn(array());

        $container->get('fos_rest.view_handler')->shouldBeCalled()->willReturn($viewHandler);

        $this->getMoviesAwardsAction('movie-id');}

    function it_does_not_get_the_images_of_movie_because_the_movie_does_not_exist(
        ContainerInterface $container,
        MovieManager $movieManager
    )
    {
        $container->get('myclapboard_movie.manager.movie')
            ->shouldBeCalled()->willReturn($movieManager);
        $movieManager->findOneById('movie-id')
            ->shouldBeCalled()->willReturn(null);

        $this->shouldThrow(
            new NotFoundHttpException('Does not exist any movie with movie-id id')
        )->during('getMoviesImagesAction', array('movie-id'));
    }
    
    function it_gets_the_images_of_movie(
        ContainerInterface $container,
        MovieManager $movieManager,
        MovieInterface $movie,
        ImageManager $imageManager,
        Image $image,
        Router $router,
        ViewHandler $viewHandler
    )
    {
        $container->get('myclapboard_movie.manager.movie')
            ->shouldBeCalled()->willReturn($movieManager);
        $movieManager->findOneById('movie-id')
            ->shouldBeCalled()->willReturn($movie);

        $container->get('myclapboard_movie.manager.image')
            ->shouldBeCalled()->willReturn($imageManager);
        $imageManager->findAllBy('movie-id')
            ->shouldBeCalled()->willReturn(array($image));
        
        $image->getName()->shouldBeCalled()->willReturn('image-name.jpg');
        $container->get('router')->shouldBeCalled()->willReturn($router);
        $image->setName(null)->shouldBeCalled()->willReturn($image);

        $container->get('fos_rest.view_handler')->shouldBeCalled()->willReturn($viewHandler);

        $this->getMoviesImagesAction('movie-id');
    }
}
