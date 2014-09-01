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
use Myclapboard\UserBundle\Model\AccountInterface;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

/**
 * Class RegistrationController.
 *
 * @package Myclapboard\UserBundle\Controller
 */
class RegistrationController extends BaseApiController
{
    /**
     * Creates the new user with very basic information (email and password).
     *
     * @ApiDoc(
     *  description = "Creates the new user with very basic information (email and password)",
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
     *      "name"="plainPassword[first]",
     *      "dataType"="string",
     *      "required"="true",
     *      "description"="Its name into payload is fos_user_registration_form[plainPassword][first]"
     *    },
     *    {
     *      "name"="plainPassword[second]",
     *      "dataType"="string",
     *      "required"="true",
     *      "description"="Its name into payload is fos_user_registration_form[plainPassword][second]"
     *    }
     *  },
     *  statusCodes = {
     *    201 = "Successfully created",
     *    400 = {
     *      "The email is not valid",
     *      "The email is already used",
     *      "Please enter an email",
     *      "Please enter a password",
     *      "The entered passwords don't match",
     *      "This is not the right way to insert the password, for more info you could read the Api documentation"
     *    },
     *    403 = "Forbidden"
     *  }
     * )
     *
     * @throws \Symfony\Component\HttpKernel\Exception\BadRequestHttpException
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function registerAction()
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

        if (is_array($form->get('plainPassword')->getViewData()) === true) {
            if ($form->isValid() === true) {
                $event = new FormEvent($form, $request);
                $dispatcher->dispatch(FOSUserEvents::REGISTRATION_SUCCESS, $event);

                $userManager->updateUser($user);

                $token = $this->get('myclapboard_user.manager.user')->createApiKey($user);

                return $this->handleView($this->createView(array('token' => $token)));
            }

            return $this->handleView($this->createView($this->getFormErrors($form), null, 400));
        }
        throw new BadRequestHttpException(
            'This is not the right way to insert the password, for more info you could read the Api documentation'
        );
    }

    /**
     * Tells the user his account is now confirmed, returning the object.
     *
     * @ApiDoc(
     *  description = "Tells the user his account is now confirmed, returning the object",
     *  requirements = {
     *    {
     *      "name"="_format",
     *      "requirement"="json|jsonp",
     *      "description"="Supported formats, by default json."
     *    }
     *  },
     *  statusCodes = {
     *    200 = "Successfully created",
     *    403 = "This user does not have access to this section",
     *    404 = "The user with confirmation token <$confirmation_token> does not exist"
     *  }
     * )
     *
     * @throws \Symfony\Component\Security\Core\Exception\AccessDeniedException
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function confirmedAction()
    {
        $user = $this->getUser();
        if (is_object($user) === false || $user instanceof AccountInterface === false) {
            throw new AccessDeniedException('This user does not have access to this section');
        }

        return $this->handleView($this->createView($user, array('self')));
    }
}
