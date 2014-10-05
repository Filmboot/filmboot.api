<?php

/**
 * This file belongs to myClapboard.
 * The source code of application includes a LICENSE file
 * with all information about license.
 *
 * @author benatespina <benatespina@gmail.com>
 * @author gorkalaucirica <gorka.lauzirika@gmail.com>
 */

namespace Myclapboard\CoreBundle\Controller;

use FOS\RestBundle\Request\ParamFetcher;
use Myclapboard\UserBundle\Model\Interfaces\AccountInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Class ResourceController.
 *
 * @package Myclapboard\CoreBundle\Controller
 */
class ResourceController extends BaseApiController
{
    /**
     * The name of class.
     *
     * @var string
     */
    protected $class;

    /**
     * The name of bundle.
     *
     * @var string
     */
    protected $bundle;

    /**
     * Returns all the resources, it admits ordering, filter, count and pagination.
     *
     * @param ParamFetcher $paramFetcher The param fetcher
     * @param string[]     $groups       The array of serialization groups
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
     * Returns all the resources, it admits ordering, filter, count and pagination.
     *
     * @param \Myclapboard\UserBundle\Model\Interfaces\AccountInterface $user         The user object
     * @param ParamFetcher                                              $paramFetcher The param fetcher
     * @param string[]                                                  $groups       The array of serialization groups
     *
     * @throws \Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException
     * @return \Symfony\Component\HttpFoundation\Response
     */
    protected function getAllForUser(AccountInterface $user, ParamFetcher $paramFetcher, $groups = array())
    {
        $resources = $this->get('myclapboard_' . $this->bundle . '.manager.' . $this->class)
            ->findAll(
                $user->getId(),
                $paramFetcher->get('order'),
                $paramFetcher->get('count'),
                $paramFetcher->get('page')
            );

        return $this->handleView($this->createView($resources, $groups));
    }

    /**
     * Returns the resource for given id.
     *
     * @param string   $id     The id of the resource
     * @param string[] $groups The serialization groups
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    protected function getOne($id, $groups = array())
    {
        return $this->handleView($this->createView($this->getResourceIfExists($id), $groups));
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
        $resource = $this->get('myclapboard_' . $this->bundle . '.manager.' . $this->class)->findOneById($id);

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
     * @param string $bundle The bundle name, defaults null (it uses value for this)
     * @param string $class  The class name, defaults null (it uses value for this)
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

    /**
     * Manage POST and PUT request with logic of forms returning the response or form's validation errors.
     *
     * @param mixed    $formType The form of skill object
     * @param mixed    $resource The object of resource
     * @param string[] $groups   The serialization groups
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    protected function manageForm($formType, $resource, $groups = array())
    {
        $resource->setUser($this->getUserLogged());
        $form = $this->createForm($formType, $resource, array('csrf_protection' => false));
        $form->submit($this->get('request'));
        if ($form->isValid() === true) {
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($resource);
            $manager->flush();

            return $this->handleView($this->createView($resource, $groups));
        }

        return $this->handleView($this->createView($this->getFormErrors($form), null, 400));
    }

    /**
     * Deletes the resource of given id.
     *
     * @param string $id The id of resource
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    protected function deleteResource($id)
    {
        $resource = $this->getResourceIfExists($id);
        $this->checkSameId($resource->getUser()->getId());

        $manager = $this->getDoctrine()->getManager();
        $manager->remove($resource);
        $manager->flush();

        return $this->handleView($this->createView('', null, 204));
    }
}
