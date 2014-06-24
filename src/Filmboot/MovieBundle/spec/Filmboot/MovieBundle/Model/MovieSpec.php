<?php
/**
 * (c) benatespina <benatespina@gmail.com>
 *
 * This file belongs to Filmboot.
 * The source code of application includes a LICENSE file
 * with all information about license.
 */

namespace spec\Filmboot\MovieBundle\Model;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 * Class MovieSpec
 *
 * @package spec\Filmboot\MovieBundle\Model
 */
class MovieSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Filmboot\MovieBundle\Model\Movie');
    }

    function it_implements_movie_interface()
    {
        $this->shouldImplement('Filmboot\MovieBundle\Model\MovieInterface');
    }

    function it_should_not_have_id_by_default()
    {
        $this->getId()->shouldReturn(null);
    }

    function its_slug_is_mutable()
    {
        $this->setSlug('movie-slug')->shouldReturn($this);
        $this->getSlug()->shouldReturn('movie-slug');
    }

    function its_duration_is_mutable()
    {
        $this->setDuration('98')->shouldReturn($this);
        $this->getDuration()->shouldReturn('98');
    }

    function its_year_is_mutable()
    {
        $this->setYear('2010')->shouldReturn($this);
        $this->getYear()->shouldReturn('2010');
    }

    function its_country_is_mutable()
    {
        $this->setCountry('Santurtzi')->shouldReturn($this);
        $this->getCountry()->shouldReturn('Santurtzi');
    }

    function its_storyline_is_mutable()
    {
        $this->setStoryline(
            'Lorem ipsum ad his scripta blandit partiendo, eum fastidii accumsan euripidis in eum liber hendrerit an.'
        )->shouldReturn($this);
        $this->getStoryline()->shouldReturn(
            'Lorem ipsum ad his scripta blandit partiendo, eum fastidii accumsan euripidis in eum liber hendrerit an.'
        );
    }

    function its_producer_is_mutable()
    {
        $this->setProducer('Quentin Tarantino')->shouldReturn($this);
        $this->getProducer()->shouldReturn('Quentin Tarantino');
    }

    function its_title_is_mutable()
    {
        $this->setTitle('Pulp fiction')->shouldReturn($this);
        $this->getTitle()->shouldReturn('Pulp fiction');

        $this->__toString()->shouldReturn('Pulp fiction');
    }
}