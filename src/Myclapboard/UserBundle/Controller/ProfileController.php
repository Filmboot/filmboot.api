<?php

/**
 * (c) benatespina <benatespina@gmail.com>
 *
 * This file belongs to myClapboard.
 * The source code of application includes a LICENSE file
 * with all information about license.
 */

namespace Myclapboard\UserBundle\Controller;

use Myclapboard\CoreBundle\Controller\ResourceController;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;

/**
 * Class ProfileController.
 *
 * @package Myclapboard\UserBundle\Controller
 */
class ProfileController extends ResourceController
{
    protected $class;

    protected $bundle;

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->class = 'user';
        $this->bundle = $this->class;
    }

    /**
     * Returns all the info of the user logged.
     *
     * @ApiDoc(
     *  description = "Returns all the info of the user logged",
     *  https = true,
     *  requirements = {
     *    {
     *      "name"="_format",
     *      "requirement"="json|jsonp",
     *      "description"="Supported formats, by default json."
     *    }
     *  },
     *  statusCodes = {
     *    403 = "Not allowed to access this resource"
     *  }
     * )
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getMeAction()
    {
        $user = $this->getUserLogged();

        return $this->getOne($user->getId(), array('self'));
    }
}
