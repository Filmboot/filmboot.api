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

    function it_implements_account_interface()
    {
        $this->shouldImplement('Myclapboard\UserBundle\Model\AccountInterface');
    }

    function its_apiKey_is_mutable()
    {
        $this->setApiKey('wef897fwfwef98')->shouldReturn($this);
        $this->getApiKey()->shouldReturn('wef897fwfwef98');
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

    function its_username_is_equal_to_its_email()
    {
        $this->setUsername('admin@gmail.com')->shouldReturn($this);
        $this->setEmail('admin@gmail.com');
    }
}
