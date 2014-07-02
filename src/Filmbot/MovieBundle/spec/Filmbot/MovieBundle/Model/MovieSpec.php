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
use Filmbot\MovieBundle\Entity\MovieTranslation;
use Filmbot\MovieBundle\Model\GenreInterface;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 * Class MovieSpec.
 *
 * @package spec\Filmbot\MovieBundle\Model
 */
class MovieSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Filmbot\MovieBundle\Model\Movie');
    }

    function it_implements_movie_interface()
    {
        $this->shouldImplement('Filmbot\MovieBundle\Model\MovieInterface');
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

    function its_actors_be_mutable(Actor $actor)
    {
        $this->getCast()->shouldHaveCount(0);

        $this->addActor($actor);

        $this->getCast()->shouldHaveCount(1);

        $this->removeActor($actor);

        $this->getCast()->shouldHaveCount(0);
    }

    function its_director_be_mutable(Director $director)
    {
        $this->getDirectors()->shouldHaveCount(0);

        $this->addDirector($director);

        $this->getDirectors()->shouldHaveCount(1);

        $this->removeDirector($director);

        $this->getDirectors()->shouldHaveCount(0);
    }

    function its_writers_be_mutable(Writer $writer)
    {
        $this->getWriters()->shouldHaveCount(0);

        $this->addWriter($writer);

        $this->getWriters()->shouldHaveCount(1);

        $this->removeWriter($writer);

        $this->getWriters()->shouldHaveCount(0);
    }

    function its_genders_be_mutable(GenreInterface $genre)
    {
        $this->getGenres()->shouldHaveCount(0);

        $this->addGenre($genre);

        $this->getGenres()->shouldHaveCount(1);

        $this->removeGenre($genre);

        $this->getGenres()->shouldHaveCount(0);
    }

    function its_title_translations_be_mutable()
    {
        $translation = new MovieTranslation('es', 'title', 'spanish-title-translation');

        $this->getTranslations()->shouldHaveCount(0);
        $this->addTranslation($translation);
        $this->getTranslations()->shouldHaveCount(1);

        // If array of translations contains translation, it does not add it again
        $this->addTranslation($translation);
        $this->getTranslations()->shouldHaveCount(1);

        $this->removeTranslation($translation);
        $this->getTranslations()->shouldHaveCount(0);
    }

    function its_storyline_translations_be_mutable()
    {
        $translation = new MovieTranslation('es', 'storyline', 'spanish-storyline-translation');

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
