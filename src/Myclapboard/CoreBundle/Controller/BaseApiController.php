<?php

/**
 * (c) benatespina <benatespina@gmail.com>
 *
 * This file belongs to myClapboard.
 * The source code of application includes a LICENSE file
 * with all information about license.
 */

namespace Myclapboard\CoreBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\View\View;
use JMS\Serializer\SerializationContext;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class BaseApiController extends FOSRestController
{
    /**
     * Returns created view by data, groups and status code given
     *
     * @param mixed                 $data       The data
     * @param null | array<string>  $groups     The groups
     * @param int                   $statusCode The HTTP status code
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
     * Throws an exception if the user is not authenticated.
     * 
     * @return void
     * @throws \Symfony\Component\Security\Core\Exception\AccessDeniedException
     */
    protected function isSecure()
    {
        if ($this->get('security.context')->isGranted('IS_AUTHENTICATED_FULLY') === false) {
            throw new AccessDeniedException();
        }
    }
}
