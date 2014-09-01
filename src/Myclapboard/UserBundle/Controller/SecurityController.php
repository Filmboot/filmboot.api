<?php

/**
 * (c) benatespina <benatespina@gmail.com>
 *
 * This file belongs to myClapboard.
 * The source code of application includes a LICENSE file
 * with all information about license.
 */

namespace Myclapboard\UserBundle\Controller;

use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use FOS\RestBundle\Controller\Annotations\RequestParam;
use FOS\RestBundle\Request\ParamFetcher;
use Myclapboard\CoreBundle\Controller\BaseApiController;

/**
 * Class SecurityController.
 *
 * @package Myclapboard\UserBundle\Controller
 */
class SecurityController extends BaseApiController
{
    /**
     * Generates and returns api key to access API, login the user.
     *
     * @param \FOS\RestBundle\Request\ParamFetcher $paramFetcher The param fetcher
     *
     * @RequestParam(name="email", strict=true, description="The email")
     * @RequestParam(name="password", strict=true, description="The password")
     *
     * @ApiDoc(
     *  description = "Generates and returns api key to access API, login the user",
     *  requirements = {
     *    {
     *      "name"="_format",
     *      "requirement"="json|jsonp",
     *      "description"="Supported formats, by default json."
     *    }
     *  },
     *  statusCodes = {
     *   200 = "Successfully authenticated",
     *   403 = "Bad credentials",
     *   404 = "This email is not exist"
     *  }
     * )
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function loginAction(ParamFetcher $paramFetcher)
    {
        $manager = $this->get('myclapboard_user.manager.user');

        $user = $manager->findOneByEmail($paramFetcher->get('email'));
        if ($user === null) {
            return $this->handleView($this->createView(array('error' => 'The email is not exist'), null, 403));
        }

        $passwordValid = $this->get('security.encoder_factory')->getEncoder($user)->isPasswordValid(
            $user->getPassword(), $paramFetcher->get('password'), $user->getSalt()
        );
        if ($passwordValid === false) {
            return $this->handleView($this->createView(array('error' => 'Bad credentials'), null, 403));
        }

        $token = $this->get('myclapboard_user.manager.user')->createApiKey($user);

        return $this->handleView($this->createView(array('token' => $token)));
    }
}
