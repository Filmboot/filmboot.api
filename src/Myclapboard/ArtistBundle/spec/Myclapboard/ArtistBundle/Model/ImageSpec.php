<?php

/**
 * This file belongs to myClapboard.
 * The source code of application includes a LICENSE file
 * with all information about license.
 *
 * @author benatespina <benatespina@gmail.com>
 * @author gorkalaucirica <gorka.lauzirika@gmail.com>
 */

namespace spec\Myclapboard\ArtistBundle\Model;

use Myclapboard\ArtistBundle\Model\Interfaces\ArtistInterface;
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
        $this->shouldImplement('Myclapboard\ArtistBundle\Model\Interfaces\ImageInterface');
    }

    function its_artist_is_mutable(ArtistInterface $artist)
    {
        $this->setArtist($artist)->shouldReturn($this);
        $this->getArtist()->shouldReturn($artist);
    }
}
