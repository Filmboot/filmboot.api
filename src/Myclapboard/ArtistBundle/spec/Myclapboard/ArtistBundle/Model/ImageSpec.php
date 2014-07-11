<?php

/**
 * (c) benatespina <benatespina@gmail.com>
 *
 * This file belongs to myClapboard.
 * The source code of application includes a LICENSE file
 * with all information about license.
 */

namespace spec\Myclapboard\ArtistBundle\Model;

use Myclapboard\ArtistBundle\Model\ArtistInterface;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 * Class ImageSpec.
 *
 * @package spec\Myclapboard\ArtistBundle\Model
 */
class ImageSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Myclapboard\ArtistBundle\Model\Image');
    }

    function it_implements_image_interface()
    {
        $this->shouldImplement('Myclapboard\ArtistBundle\Model\ImageInterface');
    }

    function its_artist_is_mutable(ArtistInterface $artist)
    {
        $this->setArtist($artist)->shouldReturn($this);
        $this->getArtist()->shouldReturn($artist);
    }
}
