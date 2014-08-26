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
     * Generates and returns api key to access API.
     *
     * @param \FOS\RestBundle\Request\ParamFetcher $paramFetcher The param fetcher
     *
     * @RequestParam(name="username", strict=true, description="Username")
     * @RequestParam(name="password", strict=true, description="Password")
     *
     * @ApiDoc(
     *  description = "Generates and returns api key to access API",
     *  https = true,
     *  requirements = {
     *    {
     *      "name"="_format",
     *      "requirement"="json|jsonp",
     *      "description"="Supported formats, by default json."
     *    }
     *  },
     *  statusCodes = {
     *      200 = "Successfully authenticated",
     *      400 = {
     *          "Bad credentials given",
     *      }
     *  }
     * )
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function postTokenAction(ParamFetcher $paramFetcher)
    {
        $manager = $this->get('myclapboard_user.manager.user');

        $user = $manager->findByUsername($paramFetcher->get('username'));
        if ($user === null) {
            return $this->handleView($this->createView(array('error' => 'Bad credentials'), null, 403));
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
