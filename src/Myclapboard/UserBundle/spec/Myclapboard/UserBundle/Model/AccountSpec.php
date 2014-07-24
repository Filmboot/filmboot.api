<?php

/**
 * (c) benatespina <benatespina@gmail.com>
 *
 * This file belongs to myClapboard.
 * The source code of application includes a LICENSE file
 * with all information about license.
 */

namespace spec\Myclapboard\UserBundle\Model;

use Myclapboard\UserBundle\Model\RatingInterface;
use Myclapboard\UserBundle\Model\ReviewInterface;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 * Class AccountSpec.
 *
 * @package spec\Myclapboard\UserBundle\Model
 */
class AccountSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Myclapboard\UserBundle\Model\Account');
    }
    
    function it_extends_basic_info()
    {
        $this->shouldHaveType('Myclapboard\UserBundle\Model\BasicInfo');
    }

    function it_implements_advanced_user_interface_and_account_interface()
    {
        $this->shouldImplement('Symfony\Component\Security\Core\User\AdvancedUserInterface');
        $this->shouldImplement('Myclapboard\UserBundle\Model\AccountInterface');
    }

    function it_is_account_non_expired()
    {
        $this->isAccountNonExpired()->shouldReturn(true);
    }

    function it_is_account_non_locked()
    {
        $this->isAccountNonLocked()->shouldReturn(true);
    }

    function it_is_credentials_non_expired()
    {
        $this->isCredentialsNonExpired()->shouldReturn(true);
    }

    function it_is_enabled()
    {
        $this->isEnabled()->shouldReturn(false);
        
        $this->setActivated(true)->shouldReturn($this);
        $this->isEnabled()->shouldReturn(true);
    }

    function it_gets_roles()
    {        
        $this->setRole('ROLE_ADMIN')->shouldReturn($this);
        $this->getRoles()->shouldReturn(array('ROLE_ADMIN'));
    }

    function it_erases_credentials()
    {
        $this->eraseCredentials();
    }
    
    function it_gets_username()
    {
        $this->setEmail('email@email.com')->shouldReturn($this);
        $this->getUsername()->shouldReturn('email@email.com');
    }

    function its_password_is_mutable()
    {
        $this->setPassword('my-password')->shouldReturn($this);
        $this->getPassword()->shouldReturn('my-password');
    }

    function its_salt_is_mutable()
    {
        $this->setSalt('password-salt')->shouldReturn($this);
        $this->getSalt()->shouldReturn('password-salt');
    }

    function its_role_is_mutable()
    {
        $this->setRole('ROLE_USER')->shouldReturn($this);
        $this->getRole()->shouldReturn('ROLE_USER');
    }

    function its_locale_is_mutable()
    {
        $this->getLocale()->shouldReturn('en');

        $this->setLocale('es')->shouldReturn($this);
        $this->getLocale()->shouldReturn('es');
    }

    function its_created_with_the_current_datetime()
    {
        $this->getCreatedAt()->shouldHaveType('DateTime');
    }

    function its_last_login_is_mutable()
    {
        $this->getLastLogin()->shouldReturn(null);

        $lastLogin = new \DateTime();
        $this->setLastLogin($lastLogin)->shouldReturn($this);
        $this->getLastLogin()->shouldReturn($lastLogin);
    }

    function its_activated_is_mutable()
    {
        $this->hasActivated()->shouldReturn(false);

        $this->setActivated(true)->shouldReturn($this);
        $this->hasActivated()->shouldReturn(true);
    }

    function its_cookies_accepted_is_mutable()
    {
        $this->hasCookiesAccepted()->shouldReturn(false);

        $this->setCookiesAccepted(true)->shouldReturn($this);
        $this->hasCookiesAccepted()->shouldReturn(true);
    }

    function its_ratings_be_mutable(RatingInterface $rating)
    {
        $this->getRatings()->shouldHaveCount(0);

        $this->addRating($rating);

        $this->getRatings()->shouldHaveCount(1);

        $this->removeRating($rating);

        $this->getRatings()->shouldHaveCount(0);
    }
    
    function its_reviews_be_mutable(ReviewInterface $review)
    {
        $this->getReviews()->shouldHaveCount(0);

        $this->addReview($review);

        $this->getReviews()->shouldHaveCount(1);

        $this->removeReview($review);

        $this->getReviews()->shouldHaveCount(0);
    }
}
