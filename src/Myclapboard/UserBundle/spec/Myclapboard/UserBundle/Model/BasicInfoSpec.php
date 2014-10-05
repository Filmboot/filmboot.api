<?php

/**
 * This file belongs to myClapboard.
 * The source code of application includes a LICENSE file
 * with all information about license.
 *
 * @author benatespina <benatespina@gmail.com>
 * @author gorkalaucirica <gorka.lauzirika@gmail.com>
 */

namespace spec\Myclapboard\UserBundle\Model;

use JJs\Bundle\GeonamesBundle\Entity\City;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 * Class BasicInfoSpec.
 *
 * @package spec\Myclapboard\UserBundle\Model
 */
class BasicInfoSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Myclapboard\UserBundle\Model\BasicInfo');
    }

    function it_extends_basic_info()
    {
        $this->shouldHaveType('Myclapboard\UserBundle\Model\BasicInfo');
    }

    function it_implements_basic_info_interface()
    {
        $this->shouldImplement('Myclapboard\UserBundle\Model\Interfaces\BasicInfoInterface');
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
