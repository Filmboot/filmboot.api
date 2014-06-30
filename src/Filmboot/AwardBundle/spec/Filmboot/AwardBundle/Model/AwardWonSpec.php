<?php
/**
 * (c) benatespina <benatespina@gmail.com>
 *
 * This file belongs to Filmboot.
 * The source code of application includes a LICENSE file
 * with all information about license.
 */

namespace spec\Filmboot\AwardBundle\Model;

use Filmboot\ArtistBundle\Model\ArtistInterface;
use Filmboot\AwardBundle\Model\AwardInterface;
use Filmboot\MovieBundle\Model\MovieInterface;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 * Class AwardWonSpec.
 *
 * @package spec\Filmboot\AwardBundle\Model
 */
class AwardWonSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Filmboot\AwardBundle\Model\AwardWon');
    }

    function it_implements_award_won_interface()
    {
        $this->shouldImplement('Filmboot\AwardBundle\Model\AwardWonInterface');
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

    function its_role_is_mutable()
    {
        $this->setRole('director')->shouldReturn($this);
        $this->getRole()->shouldReturn('director');
    }
}
