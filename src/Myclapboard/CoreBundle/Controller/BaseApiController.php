<?php

/**
 * (c) benatespina <benatespina@gmail.com>
 *
 * This file belongs to Filmboot.
 * The source code of application includes a LICENSE file
 * with all information about license.
 */

namespace Myclapboard\CoreBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\View\View;
use JMS\Serializer\SerializationContext;

class BaseApiController extends FOSRestController
{
    /**
     * Returns created view by data, groups, status code and format given
     *
     * @param mixed  $data       The data
     * @param null   $groups     The groups
     * @param int    $statusCode The HTTP status code
     * @param string $format     The format of serializer
     *
     * @return \FOS\RestBundle\View\View
     */
    protected function createView($data, $groups = null, $statusCode = 200, $format = 'json')
    {
        $view = View::create()
            ->setStatusCode($statusCode)
            ->setFormat($format)
            ->setData($data);

        if ($groups != null) {
            $view->setSerializationContext(SerializationContext::create()->setGroups($groups));
        }

        return $view;
    }
}
