<?php

/**
 * This file belongs to myClapboard.
 * The source code of application includes a LICENSE file
 * with all information about license.
 *
 * @author benatespina <benatespina@gmail.com>
 * @author gorkalaucirica <gorka.lauzirika@gmail.com>
 */

namespace Myclapboard\MovieBundle\Model;

use JJs\Bundle\GeonamesBundle\Entity\Country;
use Myclapboard\ArtistBundle\Model\Interfaces\RolesTraitInterface;
use Myclapboard\AwardBundle\Model\AwardWonInterface;
use Myclapboard\CoreBundle\Model\Interfaces\TranslatableInterface;
use Myclapboard\UserBundle\Model\RatingInterface;
use Myclapboard\UserBundle\Model\ReviewInterface;

/**
 * Interface MovieInterface.
 *
 * @package Myclapboard\MovieBundle\Model
 */
interface MovieInterface extends RolesTraitInterface, TranslatableInterface
{
    /**
     * Gets id.
     *
     * @return string
     */
    public function getId();

    /**
     * Gets slug.
     *
     * @return string
     */
    public function getSlug();

    /**
     * Sets slug.
     *
     * @param string $slug The slug
     *
     * @return $this self Object
     */
    public function setSlug($slug);

    /**
     * Gets title.
     *
     * @return string
     */
    public function getTitle();

    /**
     * Sets title.
     *
     * @param string $title The title
     *
     * @return $this self Object
     */
    public function setTitle($title);

    /**
     * Gets duration.
     *
     * @return \DateTime
     */
    public function getDuration();

    /**
     * Sets duration.
     *
     * @param \DateTime $duration The duration
     *
     * @return $this self Object
     */
    public function setDuration($duration);

    /**
     * Gets releaseDate.
     *
     * @return \DateTime
     */
    public function getReleaseDate();

    /**
     * Sets releaseDate.
     *
     * @param \DateTime $releaseDate The release date
     *
     * @return $this self Object
     */
    public function setReleaseDate(\DateTime $releaseDate);

    /**
     * Gets country.
     *
     * @return \JJs\Bundle\GeonamesBundle\Entity\Country
     */
    public function getCountry();

    /**
     * Sets country.
     *
     * @param \JJs\Bundle\GeonamesBundle\Entity\Country $country The code of the country
     *
     * @return $this self Object
     */
    public function setCountry(Country $country);

    /**
     * Gets storyline.
     *
     * @return string
     */
    public function getStoryline();

    /**
     * Sets storyline.
     *
     * @param string $storyline The storyline
     *
     * @return $this self Object
     */
    public function setStoryline($storyline);

    /**
     * Gets producer's name.
     *
     * @return string
     */
    public function getProducer();

    /**
     * Sets producer's name.
     *
     * @param string $producer The name of producer
     *
     * @return $this self Object
     */
    public function setProducer($producer);

    /**
     * Gets website.
     *
     * @return string
     */
    public function getWebsite();

    /**
     * Sets website.
     *
     * @param string $website The website
     *
     * @return $this self Object
     */
    public function setWebsite($website);

    /**
     * Gets poster.
     *
     * @return string
     */
    public function getPoster();

    /**
     * Sets poster.
     *
     * @param string $poster The poster
     *
     * @return $this self Object
     */
    public function setPoster($poster);

    /**
     * Adds genre.
     *
     * @param \Myclapboard\MovieBundle\Model\GenreInterface $genre The genre object
     *
     * @return $this self Object
     */
    public function addGenre(GenreInterface $genre);

    /**
     * Removes genre.
     *
     * @param \Myclapboard\MovieBundle\Model\GenreInterface $genre The genre object
     *
     * @return $this self Object
     */
    public function removeGenre(GenreInterface $genre);

    /**
     * Gets genres.
     *
     * @return array<\Myclapboard\MovieBundle\Model\GenreInterface>
     */
    public function getGenres();

    /**
     * Adds award.
     *
     * @param \Myclapboard\AwardBundle\Model\AwardWonInterface $award The award object
     *
     * @return $this self Object
     */
    public function addAward(AwardWonInterface $award);

    /**
     * Removes award.
     *
     * @param \Myclapboard\AwardBundle\Model\AwardWonInterface $award The award object
     *
     * @return $this self Object
     */
    public function removeAward(AwardWonInterface $award);

    /**
     * Gets array of awards.
     *
     * @return array<\Myclapboard\AwardBundle\Model\AwardWonInterface>
     */
    public function getAwards();

    /**
     * Adds images.
     *
     * @param \Myclapboard\MovieBundle\Model\ImageInterface $image The image object
     *
     * @return $this self Object
     */
    public function addImage(ImageInterface $image);

    /**
     * Removes image.
     *
     * @param \Myclapboard\MovieBundle\Model\ImageInterface $image The image object
     *
     * @return $this self Object
     */
    public function removeImage(ImageInterface $image);

    /**
     * Gets image.
     *
     * @return array<\Myclapboard\MovieBundle\Model\ImageInterface>
     */
    public function getImages();

    /**
     * Adds rating.
     *
     * @param \Myclapboard\UserBundle\Model\RatingInterface $rating The rating
     *
     * @return $this self Object
     */
    public function addRating(RatingInterface $rating);

    /**
     * Removes rating.
     *
     * @param \Myclapboard\UserBundle\Model\RatingInterface $rating The rating
     *
     * @return $this self Object
     */
    public function removeRating(RatingInterface $rating);

    /**
     * Gets ratings.
     *
     * @return array<\Myclapboard\UserBundle\Model\RatingInterface>
     */
    public function getRatings();

    /**
     * Adds review.
     *
     * @param \Myclapboard\UserBundle\Model\ReviewInterface $review The review
     *
     * @return $this self Object
     */
    public function addReview(ReviewInterface $review);

    /**
     * Removes review.
     *
     * @param \Myclapboard\UserBundle\Model\ReviewInterface $review The review
     *
     * @return $this self Object
     */
    public function removeReview(ReviewInterface $review);

    /**
     * Gets reviews.
     *
     * @return array<\Myclapboard\UserBundle\Model\ReviewInterface>
     */
    public function getReviews();

    /**
     * Gets the score average.
     *
     * @return float
     */
    public function getScore();

    /**
     * Calculates the score average.
     *
     * @return $this self Object
     */
    public function calculateScore();
}
