<?php

/**
 * (c) benatespina <benatespina@gmail.com>
 *
 * This file belongs to myClapboard.
 * The source code of application includes a LICENSE file
 * with all information about license.
 */

namespace Myclapboard\MovieBundle\Controller;

use FOS\RestBundle\Controller\Annotations\QueryParam;
use FOS\RestBundle\Request\ParamFetcher;
use Myclapboard\CoreBundle\Controller\ResourceController;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;

/**
 * Class MovieController.
 *
 * @package Myclapboard\MovieBundle\Controller
 */
class MovieController extends ResourceController
{
    protected $class;

    protected $bundle;

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->class = 'movie';
        $this->bundle = $this->class;
    }

    /**
     * Returns all the movies, it admits ordering, filter, count and pagination.
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
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getMoviesAction(ParamFetcher $paramFetcher)
    {
        return $this->getAll($paramFetcher, array('movieList'));
    }

    /**
     * Returns movie for given id.
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
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getMovieAction($id)
    {
        return $this->getOne($id, array('movie'));
    }

    /**
     * Returns the cast of the movie for given id.
     *
     * @param string $id The id of movie
     *
     * @ApiDoc(
     *  description = "Returns the cast of the movie for given id",
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
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getMoviesCastAction($id)
    {
        $this->getResourceIfExists($id);

        $cast = $this->get('myclapboard_artist.manager.actor')->findAllByMovie($id);

        return $this->handleView($this->createView($cast, array('movie', 'cast')));
    }

    /**
     * Returns the awards of the movie for given id.
     *
     * @param string $id The id of movie
     *
     * @ApiDoc(
     *  description = "Returns the awards of the movie for given id",
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
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getMoviesAwardsAction($id)
    {
        $this->getResourceIfExists($id);

        $awards = $this->get('myclapboard_award.manager.awardWon')->findAllByMovie($id);

        return $this->handleView($this->createView($awards, array('movie')));
    }

    /**
     * Returns the images of the movie for given id.
     *
     * @param string $id The id of movie
     *
     * @ApiDoc(
     *  description = "Returns the images of the movie for given id",
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
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getMoviesImagesAction($id)
    {
        $this->getResourceIfExists($id);

        $images = $this->get('myclapboard_movie.manager.image')->findAllByMovie($id);

        foreach ($images as $image) {
            $image->setName(
                $this->generateUrl('myclapboard_core_get_image', array('name' => $image->getName()), true)
            );
        }

        return $this->handleView($this->createView($images));
    }
}
