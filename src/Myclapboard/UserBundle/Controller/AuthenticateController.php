<?php

/**
 * (c) benatespina <benatespina@gmail.com>
 *
 * This file belongs to myClapboard.
 * The source code of application includes a LICENSE file
 * with all information about license.
 */

namespace Myclapboard\UserBundle\Controller;

use FOS\UserBundle\Event\FormEvent;
use FOS\UserBundle\Event\GetResponseUserEvent;
use FOS\UserBundle\FOSUserEvents;
use Myclapboard\CoreBundle\Controller\BaseApiController;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class AuthenticateController.
 *
 * @package Myclapboard\UserBundle\Controller
 */
class AuthenticateController extends BaseApiController
{
    /**
     * Creates the new user with very basic information (email, username, and password).
     *
     * @ApiDoc(
     *  description = "Creates the new user with very basic information (email, username, and password)",
     *  https = true,
     *  requirements = {
     *    {
     *      "name"="_format",
     *      "requirement"="json|jsonp",
     *      "description"="Supported formats, by default json."
     *    }
     *  },
     *  parameters={
     *    {
     *      "name"="email",
     *      "dataType"="string",
     *      "required"="true",
     *      "description"="Its name into payload is fos_user_registration_form[email]"
     *    },
     *    {
     *      "name"="username",
     *      "dataType"="string",
     *      "required"="true",
     *      "description"="Its name into payload is fos_user_registration_form[username]"
     *    },
     *    {
     *      "name"="plainPassword",
     *      "dataType"="string",
     *      "required"="true",
     *      "description"="Its name into payload is fos_user_registration_form[plainPassword]"
     *    }
     *  },
     *  statusCodes = {
     *      201 = "Successfully created",
     *      400 = {
     *          "The email is not valid",
     *          "The email is already used",
     *          "The username is already used"
     *      },
     *      403 = "Forbidden"
     *  }
     * )
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function postRegisterAction()
    {
        $formFactory = $this->container->get('fos_user.registration.form.factory');
        $userManager = $this->container->get('fos_user.user_manager');
        $dispatcher = $this->container->get('event_dispatcher');
        $request = $this->get('request');

        $user = $userManager->createUser();

        $event = new GetResponseUserEvent($user, $request);
        $dispatcher->dispatch(FOSUserEvents::REGISTRATION_INITIALIZE, $event);

        if (null !== $event->getResponse()) {
            return $event->getResponse();
        }

        $form = $formFactory->createForm();
        $form->setData($user);
        $form->submit($request);

        if ($form->isValid() === true) {
            $event = new FormEvent($form, $request);
            $dispatcher->dispatch(FOSUserEvents::REGISTRATION_SUCCESS, $event);

            $user->setPlainPassword($form->get('plainPassword')->getViewData());
            $userManager->updateUser($user);

            return $this->handleView($this->createView($user, array('self')));
        }

        return $this->handleView($this->createView($this->getFormErrors($form), null, 400));
    }
}
