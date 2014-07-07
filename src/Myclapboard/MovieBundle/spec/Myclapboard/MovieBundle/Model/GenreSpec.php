<?php

/**
 * (c) benatespina <benatespina@gmail.com>
 *
 * This file belongs to myClapboard.
 * The source code of application includes a LICENSE file
 * with all information about license.
 */

namespace spec\Myclapboard\MovieBundle\Model;

use Myclapboard\MovieBundle\Entity\GenreTranslation;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 * Class GenreSpec.
 *
 * @package spec\Myclapboard\MovieBundle\Model
 */
class GenreSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Myclapboard\MovieBundle\Model\Genre');
    }

    function it_implements_movie_interface()
    {
        $this->shouldImplement('Myclapboard\MovieBundle\Model\GenreInterface');
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

    function its_name_translations_be_mutable()
    {
        $translation = new GenreTranslation('es', 'name', 'spanish-name-translation');

        $this->getTranslations()->shouldHaveCount(0);
        $this->addTranslation($translation);
        $this->getTranslations()->shouldHaveCount(1);

        // If array of translations contains translation, it does not add it again
        $this->addTranslation($translation);
        $this->getTranslations()->shouldHaveCount(1);

        $this->removeTranslation($translation);
        $this->getTranslations()->shouldHaveCount(0);
    }
}
