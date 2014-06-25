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
 * Class DirectorSpec.
 *
 * @package spec\Filmboot\ArtistBundle\Model
 */
class DirectorSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Filmboot\ArtistBundle\Model\Director');
    }

    function it_implements_role_interface()
    {
        $this->shouldImplement('Filmboot\ArtistBundle\Model\RoleInterface');
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

    function its_movies_be_mutable(MovieInterface $movie)
    {
        $this->getMovies()->shouldHaveCount(0);

        $this->addMovie($movie);

        $this->getMovies()->shouldHaveCount(1);

        $this->removeMovie($movie);

        $this->getMovies()->shouldHaveCount(0);
    }
}