<?php

/**
 * (c) benatespina <benatespina@gmail.com>
 *
 * This file belongs to myClapboard.
 * The source code of application includes a LICENSE file
 * with all information about license.
 */

namespace spec\Myclapboard\CoreBundle\Model;

use Myclapboard\ArtistBundle\Model\ArtistInterface;
use Myclapboard\MovieBundle\Model\MovieInterface;
use PhpSpec\ObjectBehavior;

class ImageSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Myclapboard\CoreBundle\Model\Image');
    }

    function it_implements_image_interface()
    {
        $this->shouldImplement('Myclapboard\CoreBundle\Model\ImageInterface');
    }

    function it_should_not_have_id_by_default()
    {
        $this->getId()->shouldReturn(null);
    }

    function its_name_is_mutable()
    {
        $this->setName('image-name')->shouldReturn($this);
        $this->getName()->shouldReturn('image-name');
    }
    
    function its_movie_is_mutable(MovieInterface $movie)
    {
        $this->setMovie($movie)->shouldReturn($this);
        $this->getMovie()->shouldReturn($movie);
    }

    function its_artist_is_mutable(ArtistInterface $artist)
    {
        $this->setArtist($artist)->shouldReturn($this);
        $this->getArtist()->shouldReturn($artist);
    }
    
    function it_gets_absolute_path()
    {
        $this->getAbsolutePath()
//          ->shouldReturn(__DIR__ . '/../../../../../../../web/uploads/images')
        ;
    }
    
    public function it_gets_fixture_path()
    {
        $this->getFixturePath('movies')
//          ->shouldReturn(__DIR__ . '/../../../../../../../app/Resources/fixtures/images/movies/')
        ;
    }
} 
