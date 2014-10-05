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

use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\View\View;
use JMS\Serializer\SerializationContext;
use Myclapboard\UserBundle\Model\Interfaces\AccountInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

/**
 * Class BaseApiController.
 *
 * @package Myclapboard\CoreBundle\Controller
 */
class BaseApiController extends FOSRestController
{
    /**
     * Returns created view by data, groups and status code given.
     *
     * @param mixed         $data       The data
     * @param null|string[] $groups     The groups
     * @param int           $statusCode The HTTP status code
     *
     * @return \FOS\RestBundle\View\View
     */
    protected function createView($data, $groups = null, $statusCode = 200)
    {
        $view = View::create()
            ->setStatusCode($statusCode)
            ->setData($data);

        if ($groups !== null) {
            $view->setSerializationContext(SerializationContext::create()->setGroups($groups));
        }

        return $view;
    }

    /**
     * Checks if user is logged returning this, otherwise throws an exception.
     *
     * @throws \Symfony\Component\Security\Core\Exception\AccessDeniedException
     *
     * @return \Myclapboard\UserBundle\Entity\User
     */
    protected function getUserLogged()
    {
        if ($this->getUser() instanceof AccountInterface === false) {
            throw new AccessDeniedException('Not allowed to access this resource');
        }

        return $this->getUser();
    }

    /**
     * Returns all the errors from form into array.
     *
     * @param \Symfony\Component\Form\FormInterface $form The form
     *
     * @return array
     */
    protected function getFormErrors(FormInterface $form)
    {
        $errors = array();

        foreach ($form->getErrors() as $error) {
            $errors[] = $error->getMessage();
        }

        foreach ($form->all() as $child) {
            if ($child->isValid() === false) {
                $errors[$child->getName()] = $this->getFormErrors($child);
            }
        }

        return $errors;
    }

    /**
     * Throws exception if the the logged user id does not match with given id.
     *
     * @param string $id The id of user
     *
     * @throws \Symfony\Component\Security\Core\Exception\AccessDeniedException
     *
     * @return void
     */
    protected function checkSameId($id)
    {
        if ($id !== $this->getUser()->getId()) {
            throw new AccessDeniedException('Not allowed to access this resource');
        }
    }
}
