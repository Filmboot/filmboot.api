<?php

namespace Myclapboard\UserBundle\Security;

use Symfony\Component\Security\Core\Authentication\SimplePreAuthenticatorInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\Authentication\Token\PreAuthenticatedToken;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\Exception\BadCredentialsException;
use Symfony\Component\Security\Http\Authentication\AuthenticationFailureHandlerInterface;
use Symfony\Component\HttpFoundation\Response;

class ApiKeyAuthenticator implements SimplePreAuthenticatorInterface, AuthenticationFailureHandlerInterface
{
    protected $userProvider;

    public function __construct(ApiKeyUserProvider $userProvider)
    {
        $this->userProvider = $userProvider;
    }

    public function createToken(Request $request, $providerKey)
    {
        if (!$request->headers->has('apikey')) {
            $apiKey = "";
        } else {
            $apiKey = $request->headers->get('apikey');
        }

        return new PreAuthenticatedToken(
            'anon.',
            $apiKey,
            $providerKey
        );
    }

    public function authenticateToken(TokenInterface $token, UserProviderInterface $userProvider, $providerKey)
    {
        $apiKey = $token->getCredentials();
        if($apiKey == "") {
            return new PreAuthenticatedToken(
                'anon.',
                "",
                $providerKey
            );
        }

        $username = $this->userProvider->getUsernameForApiKey($apiKey);

        if (!$username) {
            throw new AuthenticationException(
                sprintf('API Key "%s" does not exist.', $apiKey)
            );
        }

        $user = $this->userProvider->loadUserByUsername($username);

        return new PreAuthenticatedToken(
            $user,
            $apiKey,
            $providerKey,
            $user->getRoles()
        );
    }

    public function supportsToken(TokenInterface $token, $providerKey)
    {
        return $token instanceof PreAuthenticatedToken && $token->getProviderKey() === $providerKey;
    }

    public function onAuthenticationFailure(Request $request, AuthenticationException $exception)
    {
        return new Response("", 403);
    }
} 