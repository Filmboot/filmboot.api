<?php

/**
 * (c) benatespina <benatespina@gmail.com>
 *
 * This file belongs to myClapboard.
 * The source code of application includes a LICENSE file
 * with all information about license.
 */

namespace spec\Myclapboard\MovieBundle\Controller;

use Myclapboard\MovieBundle\Manager\MovieManager;
use FOS\RestBundle\Request\ParamFetcher;
use Myclapboard\MovieBundle\Model\MovieInterface;
use PhpSpec\ObjectBehavior;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Class MovieController.
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

    function it_extends_fos_rest_controller()
    {
        $this->shouldHaveType('FOS\RestBundle\Controller\FOSRestController');
    }

    function it_gets_movies(
        ContainerInterface $container,
        MovieManager $movieManager,
        ParamFetcher $paramFetcher
    )
    {
        $container->get('myclapboard_movie.manager.movie')
            ->shouldBeCalled()->willReturn($movieManager);
        $paramFetcher->get('order')->shouldBeCalled()->willReturn('title');
        $paramFetcher->get('q')->shouldBeCalled()->willReturn('query');
        $paramFetcher->get('count')->shouldBeCalled()->willReturn(10);
        $paramFetcher->get('page')->shouldBeCalled()->willReturn(1);

        $movieManager->findAll('title', 'query', 10, 1)->shouldBeCalled()->willReturn(array());

        $this->getMoviesAction($paramFetcher)->shouldReturnAnInstanceOf('FOS\RestBundle\View\View');
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
        MovieInterface $movie
    )
    {
        $container->get('myclapboard_movie.manager.movie')
            ->shouldBeCalled()->willReturn($movieManager);
        $movieManager->findOneById('movie-id')
            ->shouldBeCalled()->willReturn($movie);

        $this->getMovieAction('movie-id')->shouldReturnAnInstanceOf('FOS\RestBundle\View\View');
    }
}
