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

use JJs\Bundle\GeonamesBundle\Entity\Country;
use Myclapboard\ArtistBundle\Entity\Actor;
use Myclapboard\ArtistBundle\Entity\Director;
use Myclapboard\ArtistBundle\Entity\Writer;
use Myclapboard\AwardBundle\Model\AwardWonInterface;
use Myclapboard\MovieBundle\Model\ImageInterface;
use Myclapboard\MovieBundle\Entity\MovieTranslation;
use Myclapboard\MovieBundle\Model\GenreInterface;
use Myclapboard\UserBundle\Model\RatingInterface;
use Myclapboard\UserBundle\Model\ReviewInterface;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 * Class MovieSpec.
 *
 * @package spec\Myclapboard\MovieBundle\Model
 */
class MovieSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Myclapboard\MovieBundle\Model\Movie');
    }

    function it_implements_movie_interface()
    {
        $this->shouldImplement('Myclapboard\MovieBundle\Model\MovieInterface');
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

    function its_release_date_is_mutable()
    {
        $releaseDate = new \DateTime('12-05-1994');
        
        $this->setReleaseDate($releaseDate)->shouldReturn($this);
        $this->getReleaseDate()->shouldReturn($releaseDate);
    }

    function its_country_is_mutable(Country $country)
    {
        $this->setCountry($country)->shouldReturn($this);
        $this->getCountry()->shouldReturn($country);
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

    function its_website_is_mutable()
    {
        $this->setWebsite('http://unchainedmovie.com/')->shouldReturn($this);
        $this->getWebsite()->shouldReturn('http://unchainedmovie.com/');
    }

    function its_title_is_mutable()
    {
        $this->setTitle('Pulp fiction')->shouldReturn($this);
        $this->getTitle()->shouldReturn('Pulp fiction');

        $this->__toString()->shouldReturn('Pulp fiction');
    }

    function its_poster_is_mutable()
    {
        $this->setPoster('pulp-fiction.jpg')->shouldReturn($this);
        $this->getPoster()->shouldReturn('pulp-fiction.jpg');
    }

    function its_actors_be_mutable(Actor $actor)
    {
        $this->getActors()->shouldHaveCount(0);

        $this->addActor($actor);

        $this->getActors()->shouldHaveCount(1);

        $this->removeActor($actor);

        $this->getActors()->shouldHaveCount(0);
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

    function its_awards_be_mutable(AwardWonInterface $award)
    {
        $this->getAwards()->shouldHaveCount(0);

        $this->addAward($award);

        $this->getAwards()->shouldHaveCount(1);

        $this->removeAward($award);

        $this->getAwards()->shouldHaveCount(0);
    }

    function its_images_be_mutable(ImageInterface $image)
    {
        $this->getImages()->shouldHaveCount(0);

        $this->addImage($image);

        $this->getImages()->shouldHaveCount(1);

        $this->removeImage($image);

        $this->getImages()->shouldHaveCount(0);
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

    function its_ratings_be_mutable(RatingInterface $rating)
    {
        $this->getRatings()->shouldHaveCount(0);

        $this->addRating($rating);

        $this->getRatings()->shouldHaveCount(1);

        $this->removeRating($rating);

        $this->getRatings()->shouldHaveCount(0);
    }

    function its_reviews_be_mutable(ReviewInterface $review)
    {
        $this->getReviews()->shouldHaveCount(0);

        $this->addReview($review);

        $this->getReviews()->shouldHaveCount(1);

        $this->removeReview($review);

        $this->getReviews()->shouldHaveCount(0);
    }
    
    function it_gets_score()
    {
        $this->getScore()->shouldReturn(null);
    }
    
    function it_calculates_score(RatingInterface $rating)
    {
        $this->addRating($rating);
        
        $this->calculateScore()->shouldReturn($this);
    }
}
