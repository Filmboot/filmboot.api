<?php

/**
 * This file belongs to myClapboard.
 * The source code of application includes a LICENSE file
 * with all information about license.
 *
 * @author benatespina <benatespina@gmail.com>
 * @author gorkalaucirica <gorka.lauzirika@gmail.com>
 */

namespace spec\Myclapboard\UserBundle\Controller;

use FOS\RestBundle\View\ViewHandler;
use Myclapboard\UserBundle\Entity\User;
use Myclapboard\UserBundle\Manager\UserManager;
use PhpSpec\ObjectBehavior;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\Security\Core\SecurityContext;

/**
 * Class ProfileControllerSpec.
 *
 * @package spec\Myclapboard\UserBundle\Controller
 */
class ProfileControllerSpec extends ObjectBehavior
{
    function let(ContainerInterface $container)
    {
        $this->setContainer($container);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Myclapboard\UserBundle\Controller\ProfileController');
    }

    function it_extends_resource_controller()
    {
        $this->shouldHaveType('Myclapboard\CoreBundle\Controller\ResourceController');
    }

    function it_does_not_get_my_profile_because_the_user_is_not_logged(
        ContainerInterface $container,
        SecurityContext $securityContext,
        TokenInterface $token
    )
    {
        $container->has('security.context')->shouldBeCalled()->willReturn(true);
        $container->get('security.context')->shouldBeCalled()->willReturn($securityContext);
        $securityContext->getToken()->shouldBeCalled()->willReturn($token);

        $token->getUser()->shouldBeCalled()->willReturn(null);

        $this->shouldThrow(new AccessDeniedException('Not allowed to access this resource'))
            ->during('getMeAction');
    }

    function it_does_not_get_my_profile_because_the_user_is_not_exist(
        ContainerInterface $container,
        UserManager $userManager,
        SecurityContext $securityContext,
        TokenInterface $token,
        User $user
    )
    {
        $container->has('security.context')->shouldBeCalled()->willReturn(true);
        $container->get('security.context')->shouldBeCalled()->willReturn($securityContext);
        $securityContext->getToken()->shouldBeCalled()->willReturn($token);

        $token->getUser()->shouldBeCalled()->willReturn($user);
        $user->getId()->shouldBeCalled()->willReturn('non-exist-user-id');
        $container->get('myclapboard_user.manager.user')
            ->shouldBeCalled()->willReturn($userManager);
        $userManager->findOneById('non-exist-user-id')
            ->shouldBeCalled()->willReturn(null);

        $this->shouldThrow(new NotFoundHttpException('Does not exist any user with non-exist-user-id id'))
            ->during('getMeAction');
    }

    function it_gets_my_profile(
        ContainerInterface $container,
        UserManager $userManager,
        SecurityContext $securityContext,
        TokenInterface $token,
        User $user,
        ViewHandler $viewHandler
    )
    {
        $container->has('security.context')->shouldBeCalled()->willReturn(true);
        $container->get('security.context')->shouldBeCalled()->willReturn($securityContext);
        $securityContext->getToken()->shouldBeCalled()->willReturn($token);

        $token->getUser()->shouldBeCalled()->willReturn($user);
        $user->getId()->shouldBeCalled()->willReturn('user-id');
        $container->get('myclapboard_user.manager.user')
            ->shouldBeCalled()->willReturn($userManager);
        $userManager->findOneById('user-id')->shouldBeCalled()->willReturn($user);

        $container->get('fos_rest.view_handler')->shouldBeCalled()->willReturn($viewHandler);

        $this->getMeAction();
    }
}
