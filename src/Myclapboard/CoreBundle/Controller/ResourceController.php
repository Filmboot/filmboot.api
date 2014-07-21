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
            throw new NotFoundHttpException('Does not exist any ' . $this->class . ' with ' . $id . ' id');
        }

        return $this->handleView($this->createView($resource, $groups));
    }

    /**
     * Returns the images of resource's given id.
     *
     * @param string $id The id
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    protected function getOnesImages($id)
    {
        $this->getResourceIfExists($id);

        $images = $this->get('myclapboard_' . $this->bundle . '.manager.image')->findAllBy($id);

        foreach ($images as $image) {
            $image->setName(
                $this->generateUrl('myclapboard_core_get_image', array('name' => $image->getName()), true)
            );
        }

        return $this->handleView($this->createView($images));
    }

    /**
     * Returns the resource for given id if exists, otherwise throws the exception.
     *
     * @param string $id The id of the resource
     *
     * @return mixed
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     */
    protected function getResourceIfExists($id)
    {
        $resource = $this->get('myclapboard_' . $this->bundle . '.manager.' . $this->class)
            ->findOneById($id);

        if ($resource === null) {
            throw new NotFoundHttpException('Does not exist any ' . $this->class . ' with ' . $id . ' id');
        }

        return $resource;
    }

    /**
     * Skeleton for some basic methods, returning a response with resource and its groups.
     *
     * @param string $id     The id
     * @param array  $groups The array of groups
     * @param null   $bundle The bundle name, defaults null (it uses value for this)
     * @param null   $class  The class name, defaults null (it uses value for this)
     * @param string $method The method name
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    protected function getOnesResources(
        $id,
        $groups = array('artist'),
        $bundle = null,
        $class = null,
        $method = 'findOneById'
    )
    {
        $this->getResourceIfExists($id);

        if ($class === null) {
            $class = $this->class;
        }
        if ($bundle === null) {
            $bundle = $this->bundle;
        }

        $resources = $this->get('myclapboard_' . $bundle . '.manager.' . $class)->$method($id);

        return $this->handleView($this->createView($resources, $groups));
    }
}
