<?php

/**
 * (c) benatespina <benatespina@gmail.com>
 *
 * This file belongs to Filmboot.
 * The source code of application includes a LICENSE file
 * with all information about license.
 */

namespace spec\Myclapboard\MovieBundle\Controller;

use Myclapboard\MovieBundle\Manager\MovieManager;
use FOS\RestBundle\Request\ParamFetcher;
use FOS\RestBundle\View\ViewHandler;
use PhpSpec\ObjectBehavior;
use Symfony\Component\DependencyInjection\ContainerInterface;

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

    function it_extends_base_api_controller()
    {
        $this->shouldHaveType('Myclapboard\CoreBundle\Controller\BaseApiController');
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
}
