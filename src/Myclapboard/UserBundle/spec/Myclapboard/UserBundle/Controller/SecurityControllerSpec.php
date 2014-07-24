<?php

/**
 * (c) benatespina <benatespina@gmail.com>
 *
 * This file belongs to myClapboard.
 * The source code of application includes a LICENSE file
 * with all information about license.
 */

namespace spec\Myclapboard\UserBundle\Controller;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Symfony\Bundle\TwigBundle\TwigEngine;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\ParameterBag;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

/**
 * Class SecurityControllerSpec.
 *
 * @package spec\Myclapboard\UserBundle\Controller
 */
class SecurityControllerSpec extends ObjectBehavior
{
    function let(ContainerInterface $container)
    {
        $this->setContainer($container);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Myclapboard\UserBundle\Controller\SecurityController');
    }

    function it_extends_controller()
    {
        $this->shouldHaveType('Symfony\Bundle\FrameworkBundle\Controller\Controller');
    }

    function it_logins_action_when_the_request_has_an_error(
        Request $request,
        SessionInterface $session,
        ParameterBag $parameterBag,
        ContainerInterface $container,
        TwigEngine $templating,
        FormError $error
    )
    {
        $request->getSession()->shouldBeCalled()->willReturn($session);

        $request->attributes = $parameterBag;
        $parameterBag->has('_security.last_error')
            ->shouldBeCalled()->willReturn(true);
        $parameterBag->get('_security.last_error')
            ->shouldBeCalled()->willReturn($error);

        $error->getMessage()->shouldBeCalled()->willReturn('the error message');

        $session->get('_security.last_username')
            ->shouldBeCalled()->willReturn('my-last-username');

        $container->get('templating')
            ->shouldBeCalled()->willReturn($templating);
        $templating->renderResponse(
            'MyclapboardUserBundle:Security:login.html.twig',
            array('last_username' => 'my-last-username', 'error' => 'the error message'),
            null
        )->shouldBeCalled();

        $this->loginAction($request);
    }

    function it_logins_action_when_the_session_exists_and_it_has_an_error(
        Request $request,
        SessionInterface $session,
        ParameterBag $parameterBag,
        ContainerInterface $container,
        TwigEngine $templating,
        FormError $error
    )
    {
        $request->getSession()->shouldBeCalled()->willReturn($session);

        $request->attributes = $parameterBag;
        $parameterBag->has('_security.last_error')
            ->shouldBeCalled()->willReturn(false);

        $session->has('_security.last_error')
            ->shouldBeCalled()->willReturn(true);

        $session->get('_security.last_error')
            ->shouldBeCalled()->willReturn($error);
        $session->remove('_security.last_error')
            ->shouldBeCalled()->willReturn('_security.last_error');

        $error->getMessage()->shouldBeCalled()->willReturn('the error message');

        $session->get('_security.last_username')
            ->shouldBeCalled()->willReturn('my-last-username');

        $container->get('templating')
            ->shouldBeCalled()->willReturn($templating);
        $templating->renderResponse(
            'MyclapboardUserBundle:Security:login.html.twig',
            array('last_username' => 'my-last-username', 'error' => 'the error message'),
            null
        )->shouldBeCalled();

        $this->loginAction($request);
    }

    function it_logins_action_when_anything_has_an_error(
        Request $request,
        SessionInterface $session,
        ParameterBag $parameterBag,
        ContainerInterface $container,
        TwigEngine $templating
    )
    {
        $request->getSession()->shouldBeCalled()->willReturn($session);

        $request->attributes = $parameterBag;
        $parameterBag->has('_security.last_error')
            ->shouldBeCalled()->willReturn(false);

        $session->has('_security.last_error')
            ->shouldBeCalled()->willReturn(false);

        $session->get('_security.last_username')
            ->shouldBeCalled()->willReturn('my-last-username');

        $container->get('templating')
            ->shouldBeCalled()->willReturn($templating);
        $templating->renderResponse(
            'MyclapboardUserBundle:Security:login.html.twig',
            array('last_username' => 'my-last-username', 'error' => ''),
            null
        )->shouldBeCalled();

        $this->loginAction($request);
    }

    function it_logins_action_when_the_session_is_not_exist(
        Request $request,
        ParameterBag $parameterBag,
        ContainerInterface $container,
        TwigEngine $templating
    )
    {
        $request->getSession()->shouldBeCalled()->willReturn(null);

        $request->attributes = $parameterBag;
        $parameterBag->has('_security.last_error')
            ->shouldBeCalled()->willReturn(false);

        $container->get('templating')
            ->shouldBeCalled()->willReturn($templating);
        $templating->renderResponse(
            'MyclapboardUserBundle:Security:login.html.twig',
            array('last_username' => '', 'error' => ''),
            null
        )->shouldBeCalled();

        $this->loginAction($request);
    }

    function it_checks_login_action(Request $request)
    {
        $this->loginCheckAction($request);
    }
}
