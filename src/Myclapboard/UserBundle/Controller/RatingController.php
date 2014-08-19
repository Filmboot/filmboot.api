<?php

/**
 * (c) benatespina <benatespina@gmail.com>
 *
 * This file belongs to myClapboard.
 * The source code of application includes a LICENSE file
 * with all information about license.
 */

namespace Myclapboard\UserBundle\Controller;

use FOS\RestBundle\Controller\Annotations\QueryParam;
use FOS\RestBundle\Request\ParamFetcher;
use Myclapboard\CoreBundle\Controller\ResourceController;
use Myclapboard\UserBundle\Form\RatingType;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Class RatingController.
 *
 * @package Myclapboard\UserBundle\Controller
 */
class RatingController extends ResourceController
{
    protected $class;

    protected $bundle;

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->class = 'rating';
        $this->bundle = 'user';
    }

    /**
     * Returns all the ratings of the user logged, it admits ordering, count and pagination.
     *
     * @param ParamFetcher $paramFetcher The param fetcher
     *
     * @QueryParam(name="order", requirements="(date|mark|movie)", default="date", description="Order")
     * @QueryParam(name="count", requirements="\d+", default="9999", description="Amount of movies to be returned")
     * @QueryParam(name="page", requirements="\d+", default="0", description="Offset in pages")
     *
     * @ApiDoc(
     *  description = "Returns all the ratings of the user logged, it admits ordering, count and pagination",
     *  https = true,
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
    public function getRatingsAction(ParamFetcher $paramFetcher)
    {
        return $this->getAllForUser($this->getUserLogged(), $paramFetcher, array('self'));
    }

    /**
     * Returns the rating for user logged and the movie id given.
     *
     * @param string $id The id of movie
     *
     * @ApiDoc(
     *  description = "Returns the rating for user logged and the movie id given",
     *  https = true,
     *  requirements = {
     *    {
     *      "name"="_format",
     *      "requirement"="json|jsonp",
     *      "description"="Supported formats, by default json."
     *    }
     *  },
     *  statusCodes = {
     *    403 = "Not allowed to access this resource",
     *    404 = "Does not exist any movie with <$id> id"
     *  }
     * )
     *
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getRatingAction($id)
    {
        return $this->handleView($this->createView($this->getRatingIfExist($id), array('self')));
    }

    /**
     * Creates new rating for the logged user with mark, date and movie given.
     *
     * @ApiDoc(
     *  description = "Creates new rating for the logged user with mark, date and movie given",
     *  https = true,
     *  input = "Myclapboard\UserBundle\Form\RatingType",
     *  output = "Myclapboard\UserBundle\Entity\Rating",
     *  requirements = {
     *    {
     *      "name"="_format",
     *      "requirement"="json|jsonp",
     *      "description"="Supported formats, by default json."
     *    }
     *  },
     *  statusCodes = {
     *      200 = "Successfully saved",
     *      400 = {
     *          "Mark should not be blank",
     *          "Date should not be blank",
     *          "Movie should not be blank",
     *          "Date is not valid"
     *      },
     *      403 = "Not allowed to access this resource",
     *  }
     * )
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function postRatingsAction()
    {
        return $this->manageForm(
            new RatingType(), $this->get('myclapboard_user.manager.rating')->create(), array('self')
        );
    }

    /**
     * Updates the rating of logged user with the movie id given.
     *
     * @param string $id The movie id
     *
     * @ApiDoc(
     *  description = "Updates the rating of logged user with the movie id given",
     *  https = true,
     *  input = "Myclapboard\UserBundle\Form\RatingType",
     *  output = "Myclapboard\UserBundle\Entity\Rating",
     *  requirements = {
     *    {
     *      "name"="_format",
     *      "requirement"="json|jsonp",
     *      "description"="Supported formats, by default json."
     *    }
     *  },
     *  statusCodes = {
     *      200 = "Successfully updated",
     *      400 = {
     *          "Mark should not be blank",
     *          "Date should not be blank",
     *          "Movie should not be blank",
     *          "Date is not valid",
     *          "Movie attribute does not possible to update"
     *      },
     *      403 = "Not allowed to access this resource",
     *      404 = {
     *          "Movie not found",
     *          "Does not exist any rating with <$id> id of movie for <$user> user"
     *      }
     *  }
     * )
     *
     * @throws \Symfony\Component\HttpKernel\Exception\BadRequestHttpException
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function putRatingsAction($id)
    {
        $rating = $this->getRatingIfExist($id);

        if ($this->get('request')->get('movie') !== $rating->getMovie()->getId()) {
            throw new BadRequestHttpException('Movie attribute is not possible to update');
        }

        return $this->manageForm(new RatingType(), $rating, array('self'));
    }

    /**
     * Deletes the rating of logged user with the movie id given.
     *
     * @param string $id The movie id
     *
     * @ApiDoc(
     *  description = "Deletes the rating of logged user with the movie id given",
     *  https = true,
     *  requirements = {
     *    {
     *      "name"="_format",
     *      "requirement"="json|jsonp",
     *      "description"="Supported formats, by default json."
     *    }
     *  },
     *  statusCodes = {
     *      204 = "Successfully deleted",
     *      403 = "Not allowed to access this resource",
     *      404 = {
     *          "Movie not found",
     *          "Does not exist any rating with <$id> id of movie for <$user> user"
     *      }
     *  }
     * )
     *
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function deleteRatingsAction($id)
    {
        $rating = $this->getRatingIfExist($id);

        $manager = $this->getDoctrine()->getManager();
        $manager->remove($rating);
        $manager->flush();

        return $this->handleView($this->createView('', null, 204));
    }

    /**
     * Returns the rating of logged user with the movie id given if exists, otherwise throws the exception.
     *
     * @param string $id The id of the movie
     *
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     *
     * @return \Myclapboard\UserBundle\Model\RatingInterface
     */
    private function getRatingIfExist($id)
    {
        $user = $this->getUserLogged()->getId();

        if ($this->get('myclapboard_movie.manager.movie')->findOneById($id) === null) {
            throw new NotFoundHttpException('Movie not found');
        }

        $rating = $this->get('myclapboard_user.manager.rating')->findOneByUserAndMovie($user, $id);

        if ($rating === null) {
            throw new NotFoundHttpException(
                'Does not exist any ' . $this->class . ' with ' . $id . ' id of movie for ' . $user . ' user'
            );
        }

        return $rating;
    }
}
