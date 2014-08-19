<?php

namespace Myclapboard\UserBundle\Controller;

use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use FOS\RestBundle\Controller\Annotations\RequestParam;
use FOS\RestBundle\Request\ParamFetcher;
use Myclapboard\CoreBundle\Controller\BaseApiController;

class SecurityController extends BaseApiController
{
    /**
     * Generates and returns api key to access API
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
     * @param ParamFetcher $paramFetcher
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function postTokenAction(ParamFetcher $paramFetcher)
    {
        $manager = $this->get('myclapboard_user.manager.user');

        $user = $manager->findByUsername($paramFetcher->get('username'));
        if(!$user) {
            return $this->createView(array('error' => 'Bad credentials'), null, 403);
        }

        $passwordValid = $this->get('security.encoder_factory')->getEncoder($user)->isPasswordValid(
            $user->getPassword(), $paramFetcher->get('password'), $user->getSalt());

        if(!$passwordValid) {
            return $this->createView(array('error' => 'Bad credentials'), null, 403);
        }

        $token = $this->get('myclapboard_user.manager.user')->createApiKey($user);

        return $this->createView(array('token' => $token));
    }
} 