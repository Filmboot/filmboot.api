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

use Myclapboard\MovieBundle\Model\MovieInterface;
use Myclapboard\UserBundle\Model\AccountInterface;
use PhpSpec\ObjectBehavior;

/**
 * Class ReviewSpec.
 *
 * @package spec\Myclapboard\UserBundle\Model
 */
class ReviewSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Myclapboard\UserBundle\Model\Review');
    }

    function it_implements_account()
    {
        $this->shouldImplement('Myclapboard\UserBundle\Model\ReviewInterface');
    }

    function it_should_not_have_id_by_default()
    {
        $this->getId()->shouldReturn(null);
    }

    function its_title_is_mutable()
    {
        $this->setTitle('The title of review')->shouldReturn($this);
        $this->gettitle()->shouldReturn('The title of review');
    }
    
    function its_content_is_mutable()
    {
        $this->setContent('The content of review')->shouldReturn($this);
        $this->getContent()->shouldReturn('The content of review');
    }

    function its_created_date_is_mutable()
    {
        $date = new \DateTime();

        $this->setCreatedAt($date)->shouldReturn($this);
        $this->getCreatedAt()->shouldReturn($date);
    }

    function its_updated_at_is_mutable()
    {
        $date = new \DateTime();

        $this->setUpdatedAt($date)->shouldReturn($this);
        $this->getUpdatedAt()->shouldReturn($date);
    }

    function its_locale_is_mutable()
    {
        $this->setLocale('en')->shouldReturn($this);
        $this->getLocale()->shouldReturn('en');
    }

    function its_movie_is_mutable(MovieInterface $movie)
    {
        $this->setMovie($movie)->shouldReturn($this);
        $this->getMovie()->shouldReturn($movie);
    }

    function its_user_is_mutable(AccountInterface $user)
    {
        $this->setUser($user)->shouldReturn($this);
        $this->getUser()->shouldReturn($user);
    }

    function its_to_string_returns_the_title()
    {
        $this->setTitle('The title of review')->shouldReturn($this);

        $this->__toString()->shouldReturn('The title of review');
    }
}
