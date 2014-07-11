<?php

/**
 * (c) benatespina <benatespina@gmail.com>
 *
 * This file belongs to myClapboard.
 * The source code of application includes a LICENSE file
 * with all information about license.
 */

namespace Myclapboard\MovieBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations\QueryParam;
use FOS\RestBundle\Request\ParamFetcher;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class MovieController extends FOSRestController
{
    /**
     * Returns all the movies, it admits ordering, filter, count and pagination
     *
     * @param ParamFetcher $paramFetcher The param fetcher
     *
     * @QueryParam(name="order", requirements="(year|country|title)", default="title", description="Order")
     * @QueryParam(name="q", requirements="(.*)", strict=true, nullable=true, description="Query")
     * @QueryParam(name="count", requirements="\d+", default="9999", description="Amount of movies to be returned")
     * @QueryParam(name="page", requirements="\d+", default="0", description="Offset in pages")
     *
     * @ApiDoc(
     *  description = "Returns all the movies, it admits ordering, filter, count and pagination",
     *  requirements = {
     *    {
     *      "name"="_format",
     *      "requirement"="json|jsonp",
     *      "description"="Supported formats, by default json."
     *    }
     *  },
     * )
     *
     * @return \FOS\RestBundle\View\View
     */
    public function getMoviesAction(ParamFetcher $paramFetcher)
    {
        $movies = $this->get('myclapboard_movie.manager.movie')
            ->findAll(
                $paramFetcher->get('order'),
                $paramFetcher->get('q'),
                $paramFetcher->get('count'),
                $paramFetcher->get('page')
            );

        return $this->view($movies, 200, array('movie'));
    }

    /**
     * Returns movie for given id
     *
     * @param string $id The id of movie
     *
     * @ApiDoc(
     *  description = "Returns movie for given id",
     *  requirements = {
     *    {
     *      "name"="_format",
     *      "requirement"="json|jsonp",
     *      "description"="Supported formats, by default json."
     *    }
     *  },
     *  statusCodes = {
     *    404 = "Does not exist any movie with <$id> id"
     *  }
     * )
     *
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     * 
     * @return \FOS\RestBundle\View\View
     */
    public function getMovieAction($id)
    {
        $movie = $this->get('myclapboard_movie.manager.movie')->findOneById($id);

        if ($movie === null) {
            throw new NotFoundHttpException('Does not exist any movie with ' . $id . ' id');
        }

        return $this->view($movie, 200, array('movie'));
    }
}
