<?php

/**
 * (c) benatespina <benatespina@gmail.com>
 *
 * This file belongs to myClapboard.
 * The source code of application includes a LICENSE file
 * with all information about license.
 */

namespace spec\Myclapboard\AwardBundle\Model;

use Myclapboard\ArtistBundle\Model\ArtistInterface;
use Myclapboard\AwardBundle\Model\AwardInterface;
use Myclapboard\AwardBundle\Model\CategoryInterface;
use Myclapboard\MovieBundle\Model\MovieInterface;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 * Class AwardWonSpec.
 *
 * @package spec\Myclapboard\AwardBundle\Model
 */
class AwardWonSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Myclapboard\AwardBundle\Model\AwardWon');
    }

    function it_implements_award_won_interface()
    {
        $this->shouldImplement('Myclapboard\AwardBundle\Model\AwardWonInterface');
    }

    function it_should_not_have_id_by_default()
    {
        $this->getId()->shouldReturn(null);
    }

    function its_artist_is_mutable(ArtistInterface $artist)
    {
        $this->setArtist($artist)->shouldReturn($this);
        $this->getArtist()->shouldReturn($artist);
    }

    function its_award_is_mutable(AwardInterface $award)
    {
        $this->setAward($award)->shouldReturn($this);
        $this->getAward()->shouldReturn($award);
    }

    function its_movie_is_mutable(MovieInterface $movie)
    {
        $this->setMovie($movie)->shouldReturn($this);
        $this->getMovie()->shouldReturn($movie);
    }

    function its_category_is_mutable(CategoryInterface $category)
    {
        $this->setCategory($category)->shouldReturn($this);
        $this->getCategory()->shouldReturn($category);
    }

    function its_year_is_mutable()
    {
        $this->setYear('1992')->shouldReturn($this);
        $this->getYear()->shouldReturn('1992');
    }

    function its_role_is_mutable()
    {
        $this->setRole('director')->shouldReturn($this);
        $this->getRole()->shouldReturn('director');
    }
}
