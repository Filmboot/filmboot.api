<?php

/**
 * (c) benatespina <benatespina@gmail.com>
 *
 * This file belongs to myClapboard.
 * The source code of application includes a LICENSE file
 * with all information about license.
 */

namespace Myclapboard\ArtistBundle\Controller;

use FOS\RestBundle\Controller\Annotations\QueryParam;
use FOS\RestBundle\Request\ParamFetcher;
use Myclapboard\CoreBundle\Controller\ResourceController;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;

class ArtistController extends ResourceController 
{
    protected $class;
    
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
     * Returns all the artists, it admits ordering, filter, count and pagination
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
     * Returns artist for given id
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
}
