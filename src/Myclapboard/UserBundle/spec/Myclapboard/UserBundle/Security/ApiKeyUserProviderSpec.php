<?php

/**
 * (c) benatespina <benatespina@gmail.com>
 *
 * This file belongs to myClapboard.
 * The source code of application includes a LICENSE file
 * with all information about license.
 */

namespace spec\Myclapboard\UserBundle\Security;

use Myclapboard\UserBundle\Entity\User;
use Myclapboard\UserBundle\Manager\UserManager;
use PhpSpec\ObjectBehavior;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Class ApiKeyUserProviderSpec.
 *
 * @package spec\Myclapboard\UserBundle\Security
 */
class ApiKeyUserProviderSpec extends ObjectBehavior
{
    function let(UserManager $userManager)
    {
        $this->beConstructedWith($userManager);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Myclapboard\UserBundle\Security\ApiKeyUserProvider');
    }

    function it_implements_user_provider_interface()
    {
        $this->shouldImplement('Symfony\Component\Security\Core\User\UserProviderInterface');
    }

    function it_gets_username_for_api_key(UserManager $userManager, User $user)
    {
        $userManager->findOneByApiKey('api-key')
            ->shouldBeCalled()->willReturn($user);

        $user->getEmail()->shouldBeCalled()->willReturn('my-user-email');

        $this->getUsernameForApiKey('api-key')->shouldReturn('my-user-email');
    }

    function it_does_not_get_username_because_the_user_is_not_exist(UserManager $userManager)
    {
        $userManager->findOneByApiKey('api-key')
            ->shouldBeCalled()->willReturn(null);

        $this->getUsernameForApiKey('api-key')->shouldReturn(null);
    }

    function it_loads_user_by_username(UserManager $userManager, User $user)
    {
        $userManager->findOneByEmail('email')
            ->shouldBeCalled()->willReturn($user);

        $this->loadUserByUsername('email')->shouldReturn($user);
    }

    function it_refreshes_user(UserInterface $user)
    {
        $this->shouldThrow(new UnsupportedUserException())->during('refreshUser', array($user));
    }

    function it_supports_class()
    {
        $this->supportsClass('Symfony\Component\Security\Core\User\User')->shouldReturn(true);
    }

    function it_does_not_support_class()
    {
        $this->supportsClass('class-name')->shouldReturn(false);
    }

    function it_is_on_authentication_failure(Request $request, AuthenticationException $exception)
    {
        $this->onAuthenticationFailure($request, $exception);
    }
}
