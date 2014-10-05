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

use Myclapboard\MovieBundle\Model\Interfaces\MovieInterface;
use Myclapboard\UserBundle\Model\Interfaces\AccountInterface;
use PhpSpec\ObjectBehavior;

/**
 * Class RatingSpec.
 *
 * @package spec\Myclapboard\UserBundle\Model
 */
class RatingSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Myclapboard\UserBundle\Model\Rating');
    }

    function it_implements_account()
    {
        $this->shouldImplement('Myclapboard\UserBundle\Model\Interfaces\RatingInterface');
    }

    function its_mark_is_mutable()
    {
        $this->setMark(6)->shouldReturn($this);
        $this->getMark()->shouldReturn(6);
    }

    function its_date_is_mutable()
    {
        $date = new \DateTime();

        $this->setDate($date)->shouldReturn($this);
        $this->getDate()->shouldReturn($date);
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
}
