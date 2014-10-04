<?php

/**
 * This file belongs to myClapboard.
 * The source code of application includes a LICENSE file
 * with all information about license.
 *
 * @author benatespina <benatespina@gmail.com>
 * @author gorkalaucirica <gorka.lauzirika@gmail.com>
 */

namespace Myclapboard\UserBundle\Controller;

use FOS\RestBundle\Controller\Annotations\QueryParam;
use FOS\RestBundle\Request\ParamFetcher;
use Myclapboard\CoreBundle\Controller\ResourceController;
use Myclapboard\UserBundle\Form\ReviewType;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;

/**
 * Class ReviewController.
 *
 * @package Myclapboard\UserBundle\Controller
 */
class ReviewController extends ResourceController
{
    protected $class;

    protected $bundle;

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->class = 'review';
        $this->bundle = 'user';
    }

    /**
     * Returns all the reviews of the user logged, it admits ordering, count and pagination.
     *
     * @param ParamFetcher $paramFetcher The param fetcher
     *
     * @QueryParam(name="order", requirements="(date|movie)", default="date", description="Order")
     * @QueryParam(name="count", requirements="\d+", default="9999", description="Amount of movies to be returned")
     * @QueryParam(name="page", requirements="\d+", default="0", description="Offset in pages")
     *
     * @ApiDoc(
     *  description = "Returns all the reviews of the user logged, it admits ordering, count and pagination",
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
    public function getReviewsAction(ParamFetcher $paramFetcher)
    {
        return $this->getAllForUser($this->getUserLogged(), $paramFetcher, array('self'));
    }

    /**
     * Returns the review for id given.
     *
     * @param string $id The id of review
     *
     * @ApiDoc(
     *  description = "Returns the review for id given",
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
     *    404 = "Does not exist any review with <$id> id"
     *  }
     * )
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getReviewAction($id)
    {
        $review = $this->getResourceIfExists($id);
        $this->checkSameId($review->getUser()->getId());

        return $this->handleView($this->createView($review, array('self')));
    }

    /**
     * Creates new review with title, content, locale and movie given.
     *
     * @ApiDoc(
     *  description = "Creates new review with title, content, locale and movie given",
     *  https = true,
     *  input = "Myclapboard\UserBundle\Form\ReviewType",
     *  output = "Myclapboard\UserBundle\Entity\Review",
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
     *          "Title should not be blank",
     *          "Content should not be blank",
     *          "Locale should not be blank",
     *          "Movie should not be blank"
     *      },
     *      403 = "Not allowed to access this resource",
     *  }
     * )
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function postReviewsAction()
    {
        return $this->manageForm(
            new ReviewType(), $this->get('myclapboard_user.manager.review')->create(), array('self')
        );
    }

    /**
     * Updates the review of id given.
     *
     * @param string $id The review id
     *
     * @ApiDoc(
     *  description = "Updates the review of id given",
     *  https = true,
     *  input = "Myclapboard\UserBundle\Form\ReviewType",
     *  output = "Myclapboard\UserBundle\Entity\Review",
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
     *          "Title should not be blank",
     *          "Content should not be blank",
     *          "Locale should not be blank",
     *      },
     *      403 = "Not allowed to access this resource",
     *      404 = {
     *          "Movie not found",
     *          "Does not exist any review with <$id> id"
     *      }
     *  }
     * )
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function putReviewsAction($id)
    {
        $review = $this->getResourceIfExists($id);
        $this->checkSameId($review->getUser()->getId());

        return $this->manageForm(new ReviewType(), $review, array('self'));
    }

    /**
     * Deletes the review of the id given.
     *
     * @param string $id The review id
     *
     * @ApiDoc(
     *  description = "Deletes the review of the id given",
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
     *          "Does not exist any review with <$id> id"
     *      }
     *  }
     * )
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function deleteReviewsAction($id)
    {
        return $this->deleteResource($id);
    }
}
