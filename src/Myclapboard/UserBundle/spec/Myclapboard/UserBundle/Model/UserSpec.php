<?php

/**
 * (c) benatespina <benatespina@gmail.com>
 *
 * This file belongs to myClapboard.
 * The source code of application includes a LICENSE file
 * with all information about license.
 */

namespace spec\Myclapboard\UserBundle\Model;

use JJs\Bundle\GeonamesBundle\Entity\City;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 * Class UserSpec.
 *
 * @package spec\Myclapboard\UserBundle\Model
 */
class UserSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Myclapboard\UserBundle\Model\User');
    }

    function it_implements_user_interface()
    {
        $this->shouldImplement('Myclapboard\UserBundle\Model\UserInterface');
    }

    function it_implements_advanced_user_interface()
    {
        $this->shouldImplement('Symfony\Component\Security\Core\User\AdvancedUserInterface');
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

    function it_should_not_have_id_by_default()
    {
        $this->getId()->shouldReturn(null);
    }

    function its_email_is_mutable()
    {
        $this->setEmail('email@email.com')->shouldReturn($this);
        $this->getEmail()->shouldReturn('email@email.com');
    }

    function its_first_name_is_mutable()
    {
        $this->setFirstName('my-first-name')->shouldReturn($this);
        $this->getFirstName()->shouldReturn('my-first-name');
    }

    function its_last_name_is_mutable()
    {
        $this->setLastName('my-last-name')->shouldReturn($this);
        $this->getLastName()->shouldReturn('my-last-name');
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

    function its_mobile_name_is_mutable()
    {
        $this->setMobile('666666666')->shouldReturn($this);
        $this->getMobile()->shouldReturn('666666666');
    }

    function its_phone_name_is_mutable()
    {
        $this->setPhone('999999999')->shouldReturn($this);
        $this->getPhone()->shouldReturn('999999999');
    }

    function its_location_is_mutable(City $location)
    {
        $this->setLocation($location)->shouldReturn($this);
        $this->getLocation()->shouldReturn($location);
    }

    function its_birthday_is_mutable()
    {
        $birthday = new \DateTime('25-03-1990');

        $this->setBirthday($birthday)->shouldReturn($this);
        $this->getBirthday()->shouldReturn($birthday);
    }

    function its_gender_is_mutable()
    {
        $this->setGender('female')->shouldReturn($this);
        $this->getGender()->shouldReturn('female');
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

    function it_returns_email_if_first_name_and_last_name_are_null()
    {
        $this->setEmail('email@email.com')->shouldReturn($this);

        $this->__toString()->shouldReturn('email@email.com');
    }

    function it_returns_last_name_if_first_name_is_null()
    {
        $this->setLastName('surname')->shouldReturn($this);

        $this->__toString()->shouldReturn('surname');
    }

    function it_returns_first_name_if_last_name_is_null()
    {
        $this->setFirstName('name')->shouldReturn($this);

        $this->__toString()->shouldReturn('name');
    }

    function it_returns_first_name_plus_last_name_if_it_is_default_situation()
    {
        $this->setFirstName('name')->shouldReturn($this);
        $this->setLastName('surname')->shouldReturn($this);

        $this->__toString()->shouldReturn('name surname');
    }
}
