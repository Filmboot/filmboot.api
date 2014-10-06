<?php

/**
 * This file belongs to myClapboard.
 * The source code of application includes a LICENSE file
 * with all information about license.
 *
 * @author benatespina <benatespina@gmail.com>
 * @author gorkalaucirica <gorka.lauzirika@gmail.com>
 */

namespace Myclapboard\MovieBundle\Model\Interfaces;

use JJs\Bundle\GeonamesBundle\Entity\Country;
use Myclapboard\AwardBundle\Model\Interfaces\AwardWonInterface;
use Myclapboard\CoreBundle\Model\Interfaces\ActivityInterface;
use Myclapboard\CoreBundle\Model\Interfaces\CollectionInterface;
use Myclapboard\CoreBundle\Model\Interfaces\MediaInterface;
use Myclapboard\CoreBundle\Model\Interfaces\TranslatableInterface;

/**
 * Interface MovieInterface.
 *
 * @package Myclapboard\MovieBundle\Model\Interfaces
 */
interface MovieInterface extends ActivityInterface, CollectionInterface, MediaInterface, TranslatableInterface
{
    /**
     * Gets id.
     *
     * @return string
     */
    public function getId();

    /**
     * Adds award.
     *
     * @param \Myclapboard\AwardBundle\Model\Interfaces\AwardWonInterface $award The award object
     *
     * @return $this self Object
     */
    public function addAward(AwardWonInterface $award);

    /**
     * Removes award.
     *
     * @param \Myclapboard\AwardBundle\Model\Interfaces\AwardWonInterface $award The award object
     *
     * @return $this self Object
     */
    public function removeAward(AwardWonInterface $award);

    /**
     * Gets array of awards.
     *
     * @return array<\Myclapboard\AwardBundle\Model\Interfaces\AwardWonInterface>
     */
    public function getAwards();

    /**
     * Sets country.
     *
     * @param \JJs\Bundle\GeonamesBundle\Entity\Country $country The code of the country
     *
     * @return $this self Object
     */
    public function setCountry(Country $country);

    /**
     * Gets country.
     *
     * @return \JJs\Bundle\GeonamesBundle\Entity\Country
     */
    public function getCountry();

    /**
     * Sets duration.
     *
     * @param \DateTime $duration The duration
     *
     * @return $this self Object
     */
    public function setDuration($duration);

    /**
     * Gets duration.
     *
     * @return \DateTime
     */
    public function getDuration();

    /**
     * Adds genre.
     *
     * @param \Myclapboard\MovieBundle\Model\Interfaces\GenreInterface $genre The genre object
     *
     * @return $this self Object
     */
    public function addGenre(GenreInterface $genre);

    /**
     * Removes genre.
     *
     * @param \Myclapboard\MovieBundle\Model\Interfaces\GenreInterface $genre The genre object
     *
     * @return $this self Object
     */
    public function removeGenre(GenreInterface $genre);

    /**
     * Gets genres.
     *
     * @return array<\Myclapboard\MovieBundle\Model\Interfaces\GenreInterface>
     */
    public function getGenres();

    /**
     * Sets producer's name.
     *
     * @param string $producer The name of producer
     *
     * @return $this self Object
     */
    public function setProducer($producer);

    /**
     * Gets producer's name.
     *
     * @return string
     */
    public function getProducer();

    /**
     * Sets slug.
     *
     * @param string $slug The slug
     *
     * @return $this self Object
     */
    public function setSlug($slug);

    /**
     * Gets slug.
     *
     * @return string
     */
    public function getSlug();

    /**
     * Sets releaseDate.
     *
     * @param \DateTime $releaseDate The release date
     *
     * @return $this self Object
     */
    public function setReleaseDate(\DateTime $releaseDate);

    /**
     * Gets releaseDate.
     *
     * @return \DateTime
     */
    public function getReleaseDate();

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

    /**
     * Sets storyline.
     *
     * @param string $storyline The storyline
     *
     * @return $this self Object
     */
    public function setStoryline($storyline);

    /**
     * Gets storyline.
     *
     * @return string
     */
    public function getStoryline();

    /**
     * Sets title.
     *
     * @param string $title The title
     *
     * @return $this self Object
     */
    public function setTitle($title);

    /**
     * Gets title.
     *
     * @return string
     */
    public function getTitle();
}
