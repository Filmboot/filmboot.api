<?php

/**
 * (c) benatespina <benatespina@gmail.com>
 *
 * This file belongs to myClapboard.
 * The source code of application includes a LICENSE file
 * with all information about license.
 */

namespace spec\Myclapboard\UserBundle\Controller;

use FOS\RestBundle\Request\ParamFetcher;
use FOS\RestBundle\View\ViewHandler;
use Myclapboard\UserBundle\Entity\User;
use Myclapboard\UserBundle\Manager\UserManager;
use PhpSpec\ObjectBehavior;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;
use Symfony\Component\Security\Core\Encoder\PasswordEncoderInterface;
use Symfony\Component\Security\Core\SecurityContext;

/**
 * Class SecurityController.
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

    function it_extends_base_api_controller()
    {
        $this->shouldHaveType('Myclapboard\CoreBundle\Controller\BaseApiController');
    }

    function it_does_not_post_login_because_the_user_is_not_exist(
        ContainerInterface $container,
        UserManager $userManager,
        ParamFetcher $paramFetcher,
        ViewHandler $viewHandler
    )
    {
        $container->get('myclapboard_user.manager.user')
            ->shouldBeCalled()->willReturn($userManager);

        $paramFetcher->get('email')
            ->shouldBeCalled()->willReturn('email-parameter');

        $userManager->findOneByEmail('email-parameter')
            ->shouldBeCalled()->willReturn(null);

        $container->get('fos_rest.view_handler')
            ->shouldBeCalled()->willReturn($viewHandler);

        $this->loginAction($paramFetcher);
    }

    function it_does_not_post_login_because_the_password_is_not_valid(
        ContainerInterface $container,
        UserManager $userManager,
        ParamFetcher $paramFetcher,
        User $user,
        EncoderFactoryInterface $encoderFactory,
        PasswordEncoderInterface $passwordEncoder,
        ViewHandler $viewHandler
    )
    {
        $container->get('myclapboard_user.manager.user')
            ->shouldBeCalled()->willReturn($userManager);

        $paramFetcher->get('email')
            ->shouldBeCalled()->willReturn('email-parameter');

        $userManager->findOneByEmail('email-parameter')
            ->shouldBeCalled()->willReturn($user);

        $container->get('security.encoder_factory')
            ->shouldBeCalled()->willReturn($encoderFactory);
        $encoderFactory->getEncoder($user)
            ->shouldBeCalled()->willReturn($passwordEncoder);
        $user->getPassword()->shouldBeCalled()->willReturn('password');
        $paramFetcher->get('password')
            ->shouldBeCalled()->willReturn('password-parameter');
        $user->getSalt()->shouldBeCalled()->willReturn('salt');
        $passwordEncoder->isPasswordValid('password', 'password-parameter', 'salt')
            ->shouldBeCalled()->willReturn(false);

        $container->get('fos_rest.view_handler')
            ->shouldBeCalled()->willReturn($viewHandler);

        $this->loginAction($paramFetcher);
    }

    function it_posts_login(
        ContainerInterface $container,
        UserManager $userManager,
        ParamFetcher $paramFetcher,
        User $user,
        EncoderFactoryInterface $encoderFactory,
        PasswordEncoderInterface $passwordEncoder,
        UserManager $userManager,
        TokenInterface $token,
        ViewHandler $viewHandler
    )
    {
        $container->get('myclapboard_user.manager.user')
            ->shouldBeCalled()->willReturn($userManager);

        $paramFetcher->get('email')
            ->shouldBeCalled()->willReturn('email-parameter');

        $userManager->findOneByEmail('email-parameter')
            ->shouldBeCalled()->willReturn($user);

        $container->get('security.encoder_factory')
            ->shouldBeCalled()->willReturn($encoderFactory);
        $encoderFactory->getEncoder($user)
            ->shouldBeCalled()->willReturn($passwordEncoder);
        $user->getPassword()->shouldBeCalled()->willReturn('password');
        $paramFetcher->get('password')
            ->shouldBeCalled()->willReturn('password-parameter');
        $user->getSalt()->shouldBeCalled()->willReturn('salt');
        $passwordEncoder->isPasswordValid('password', 'password-parameter', 'salt')
            ->shouldBeCalled()->willReturn(true);

        $container->get('myclapboard_user.manager.user')
            ->shouldBeCalled()->willReturn($userManager);
        $userManager->createApiKey($user)
            ->shouldBeCalled()->willReturn($token);

        $container->get('fos_rest.view_handler')
            ->shouldBeCalled()->willReturn($viewHandler);

        $this->loginAction($paramFetcher);
    }
}
