<?php

/**
 * (c) benatespina <benatespina@gmail.com>
 *
 * This file belongs to myClapboard.
 * The source code of application includes a LICENSE file
 * with all information about license.
 */

namespace Myclapboard\CoreBundle\Controller;

use FOS\RestBundle\Request\ParamFetcher;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ResourceController extends BaseApiController
{
    protected $class;

    protected $bundle;

    /**
     * Returns all the resources, it admits ordering, filter, count and pagination.
     *
     * @param ParamFetcher          $paramFetcher The param fetcher
     * @param array()|array<string> $groups       The array of serialization groups
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    protected function getAll(ParamFetcher $paramFetcher, $groups = array())
    {
        $resources = $this->get('myclapboard_' . $this->bundle . '.manager.' . $this->class)
            ->findAll(
                $paramFetcher->get('order'),
                $paramFetcher->get('q'),
                $paramFetcher->get('count'),
                $paramFetcher->get('page')
            );

        return $this->handleView($this->createView($resources, $groups));
    }

    /**
     * Returns the resource for given id.
     *
     * @param string $id     The id of the resource
     * @param array  $groups The serialization groups
     *
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     */
    protected function getOne($id, $groups = array())
    {
        $resource = $this->get('myclapboard_' . $this->bundle . '.manager.' . $this->class)
            ->findOneById($id);

        if ($resource === null) {
            throw new NotFoundHttpException('Does not exist any artist with ' . $id . ' id');
        }

        return $this->handleView($this->createView($resource, $groups));
    }
}
