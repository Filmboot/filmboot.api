<?php

/**
 * This file belongs to myClapboard.
 * The source code of application includes a LICENSE file
 * with all information about license.
 *
 * @author benatespina <benatespina@gmail.com>
 * @author gorkalaucirica <gorka.lauzirika@gmail.com>
 */

namespace spec\Myclapboard\MovieBundle\Model;

use Myclapboard\MovieBundle\Model\MovieInterface;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 * Class ImageSpec.
 *
 * @package spec\Myclapboard\MovieBundle\Model
 */
class ImageSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Myclapboard\MovieBundle\Model\Image');
    }

    function it_implements_image_interface()
    {
        $this->shouldImplement('Myclapboard\MovieBundle\Model\ImageInterface');
    }

    function its_movie_is_mutable(MovieInterface $movie)
    {
        $this->setMovie($movie)->shouldReturn($this);
        $this->getMovie()->shouldReturn($movie);
    }
}
