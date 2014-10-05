<?php

/**
 * This file belongs to myClapboard.
 * The source code of application includes a LICENSE file
 * with all information about license.
 *
 * @author benatespina <benatespina@gmail.com>
 * @author gorkalaucirica <gorka.lauzirika@gmail.com>
 */

namespace Myclapboard\ArtistBundle\Controller;

use FOS\RestBundle\Controller\Annotations\QueryParam;
use FOS\RestBundle\Request\ParamFetcher;
use Myclapboard\CoreBundle\Controller\ResourceController;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;

/**
 * Class ArtistController.
 *
 * @package Myclapboard\ArtistBundle\Controller
 */
class ArtistController extends ResourceController
{
    /**
     * {@inheritdoc}
     */
    protected $class;

    /**
     * {@inheritdoc}
     */
    protected $bundle;

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->class = 'artist';
        $this->bundle = $this->class;
    }

    /**
     * Returns all the artists, it admits ordering, filter, count and pagination.
     *
     * @param ParamFetcher $paramFetcher The param fetcher
     *
     * @QueryParam(name="order", requirements="(firstName|lastName|birthday)", default="lastName", description="Order")
     * @QueryParam(name="q", requirements="(.*)", strict=true, nullable=true, description="Query")
     * @QueryParam(name="count", requirements="\d+", default="9999", description="Amount of artists to be returned")
     * @QueryParam(name="page", requirements="\d+", default="0", description="Offset in pages")
     *
     * @ApiDoc(
     *  description = "Returns all the artists, it admits ordering, filter, count and pagination",
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
    public function getArtistsAction(ParamFetcher $paramFetcher)
    {
        return $this->getAll($paramFetcher, array('artistList'));
    }

    /**
     * Returns artist for given id.
     *
     * @param string $id The id of the artist
     *
     * @ApiDoc(
     *  description = "Returns artist for given id",
     *  requirements = {
     *    {
     *      "name"="_format",
     *      "requirement"="json|jsonp",
     *      "description"="Supported formats, by default json."
     *    }
     *  },
     *  statusCodes = {
     *    404 = "Does not exist any artist with <$id> id"
     *  }
     * )
     *
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getArtistAction($id)
    {
        return $this->getOne($id, array('artist'));
    }

    /**
     * Returns all the movies of the artist given id, it admits filtering by role.
     *
     * @param string       $id           The id
     * @param ParamFetcher $paramFetcher The param fetcher
     *
     * @QueryParam(name="q", requirements="(actor|director|writer)", strict=true, nullable=true, description="Query")
     *
     * @ApiDoc(
     *  description = "Returns all the movies of the artist given id, it admits filtering by role.",
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
    public function getArtistsMoviesAction($id, ParamFetcher $paramFetcher)
    {
        $groups = array('role', 'actor', 'director', 'writer');
        if ($paramFetcher->get('q') !== null) {
            $groups = array('role', $paramFetcher->get('q'));
        }

        return $this->getOnesResources($id, $groups);
    }

    /**
     * Returns the awards of the artist for given id.
     *
     * @param string $id The id of artist
     *
     * @ApiDoc(
     *  description = "Returns the awards of the artist for given id",
     *  requirements = {
     *    {
     *      "name"="_format",
     *      "requirement"="json|jsonp",
     *      "description"="Supported formats, by default json."
     *    }
     *  },
     *  statusCodes = {
     *    404 = "Does not exist any artist with <$id> id"
     *  }
     * )
     *
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getArtistsAwardsAction($id)
    {
        return $this->getOnesResources($id, array('awardList'), 'award', 'awardWon', 'findAllByArtist');
    }

    /**
     * Returns the images of the artist for given id.
     *
     * @param string $id The id of artist
     *
     * @ApiDoc(
     *  description = "Returns the images of the artist for given id",
     *  requirements = {
     *    {
     *      "name"="_format",
     *      "requirement"="json|jsonp",
     *      "description"="Supported formats, by default json."
     *    }
     *  },
     *  statusCodes = {
     *    404 = "Does not exist any artist with <$id> id"
     *  }
     * )
     *
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getArtistsImagesAction($id)
    {
        return $this->getOnesImages($id);
    }
}
