<?php
/**
 * (c) benatespina <benatespina@gmail.com>
 *
 * This file belongs to Filmboot.
 * The source code of application includes a LICENSE file
 * with all information about license.
 */

namespace spec\Filmboot\ArtistBundle\Model;

use Filmboot\ArtistBundle\Model\ArtistInterface;
use Filmboot\MovieBundle\Model\MovieInterface;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 * Class RoleSpec.
 *
 * @package spec\Filmboot\ArtistBundle\Model
 */
class RoleSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Filmboot\ArtistBundle\Model\Role');
    }

    function it_implements_role_interface()
    {
        $this->shouldImplement('Filmboot\ArtistBundle\Model\RoleInterface');
    }

    function its_artist_is_mutable(ArtistInterface $artist)
    {
        $this->setArtist($artist)->shouldReturn($this);
        $this->getArtist()->shouldReturn($artist);
    }

    function its_movies_be_mutable(MovieInterface $movie)
    {
        $this->setMovie($movie)->shouldReturn($this);
        $this->getMovie()->shouldReturn($movie);
    }
}
