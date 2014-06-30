<?php
/**
 * (c) benatespina <benatespina@gmail.com>
 *
 * This file belongs to Filmbot.
 * The source code of application includes a LICENSE file
 * with all information about license.
 */

namespace spec\Filmbot\MovieBundle\Model;

use Filmbot\ArtistBundle\Entity\Actor;
use Filmbot\ArtistBundle\Entity\Director;
use Filmbot\ArtistBundle\Entity\Writer;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 * Class GenreSpec.
 *
 * @package spec\Filmbot\MovieBundle\Model
 */
class GenreSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Filmbot\MovieBundle\Model\Genre');
    }

    function it_implements_movie_interface()
    {
        $this->shouldImplement('Filmbot\MovieBundle\Model\GenreInterface');
    }

    function it_should_not_have_id_by_default()
    {
        $this->getId()->shouldReturn(null);
    }

    function its_slug_is_mutable()
    {
        $this->setSlug('science-fiction')->shouldReturn($this);
        $this->getSlug()->shouldReturn('science-fiction');
    }

    function its_name_is_mutable()
    {
        $this->setName('Science Fiction')->shouldReturn($this);
        $this->getName()->shouldReturn('Science Fiction');
        
        $this->__toString()->shouldReturn('Science Fiction');
    }
}
