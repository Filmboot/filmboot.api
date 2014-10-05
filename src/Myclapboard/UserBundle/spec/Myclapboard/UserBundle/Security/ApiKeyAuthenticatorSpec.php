<?php

/**
 * This file belongs to myClapboard.
 * The source code of application includes a LICENSE file
 * with all information about license.
 *
 * @author benatespina <benatespina@gmail.com>
 * @author gorkalaucirica <gorka.lauzirika@gmail.com>
 */

namespace spec\Myclapboard\UserBundle\Security;

use Myclapboard\UserBundle\Entity\User;
use Myclapboard\UserBundle\Security\ApiKeyUserProvider;
use PhpSpec\ObjectBehavior;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authentication\Token\PreAuthenticatedToken;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\User\UserProviderInterface;

/**
 * Class ApiKeyAuthenticatorSpec.
 *
 * @package spec\Myclapboard\UserBundle\Security
 */
class ApiKeyAuthenticatorSpec extends ObjectBehavior
{
    function let(ApiKeyUserProvider $userProvider)
    {
        $this->beConstructedWith($userProvider);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Myclapboard\UserBundle\Security\ApiKeyAuthenticator');
    }

    function it_implements_user_provider_interface()
    {
        $this->shouldImplement('Symfony\Component\Security\Core\Authentication\SimplePreAuthenticatorInterface');
        $this->shouldImplement('Symfony\Component\Security\Http\Authentication\AuthenticationFailureHandlerInterface');
    }

    function it_does_not_authenticate_token_because_the_api_key_is_not_exist(
        TokenInterface $token,
        UserProviderInterface $userProvider
    )
    {
        $token->getCredentials()->shouldBeCalled()->willReturn('');

        $this->authenticateToken($token, $userProvider, 'key-provider');
    }

    function it_does_not_authenticate_token_because_the_username_is_not_exist(
        TokenInterface $token,
        UserProviderInterface $userProvider
    )
    {
        $token->getCredentials()->shouldBeCalled()->willReturn('credentials');
        $userProvider->getUsernameForApiKey('credentials')
            ->shouldBeCalled()->willReturn(null);

        $this->shouldThrow(new AuthenticationException('API Key "credentials" does not exist.'))
            ->during('authenticateToken', array($token, $userProvider, 'key-provider'));
    }

    function it_authenticates_token(TokenInterface $token, UserProviderInterface $userProvider, User $user)
    {
        $token->getCredentials()->shouldBeCalled()->willReturn('credentials');
        $userProvider->getUsernameForApiKey('credentials')
            ->shouldBeCalled()->willReturn('username');
        $userProvider->loadUserByUsername('username')
            ->shouldBeCalled()->willReturn($user);
        $user->getRoles()->shouldBeCalled()->willReturn(array());

        $this->authenticateToken($token, $userProvider, 'key-provider');
    }

    function it_does_not_support_token_because_token_is_not_instanceof_PreAuthenticatedToken(TokenInterface $token)
    {
        $this->supportsToken($token, 'key-provider')->shouldReturn(false);
    }

    function it_does_not_support_token_because_the_provider_key_is_not_the_equal(PreAuthenticatedToken $token)
    {
        $token->getProviderKey()->shouldBeCalled()->willReturn('different-key-provider');

        $this->supportsToken($token, 'key-provider')->shouldReturn(false);
    }

    function it_supports_token(PreAuthenticatedToken $token)
    {
        $token->getProviderKey()->shouldBeCalled()->willReturn('key-provider');

        $this->supportsToken($token, 'key-provider')->shouldReturn(true);
    }

    function it_is_on_authentication_failure(Request $request, AuthenticationException $exception)
    {
        $this->onAuthenticationFailure($request, $exception);
    }
}
