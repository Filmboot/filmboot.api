<?php
/**
 * (c) benatespina <benatespina@gmail.com>
 *
 * This file belongs to Filmboot.
 * The source code of application includes a LICENSE file
 * with all information about license.
 */

namespace Filmboot\MovieBundle\Model;

use Filmboot\ArtistBundle\Entity\Actor;
use Filmboot\ArtistBundle\Entity\Director;
use Filmboot\ArtistBundle\Entity\Writer;

/**
 * Interface MovieInterface.
 *
 * @package Filmboot\MovieBundle\Model
 */
interface MovieInterface
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
     * @return \Filmboot\MovieBundle\Model\MovieInterface
     */
    public function setSlug($slug);

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
     * @return \Filmboot\MovieBundle\Model\MovieInterface
     */
    public function setDuration($duration);

    /**
     * Gets year.
     *
     * @return int
     */
    public function getYear();

    /**
     * Sets year.
     *
     * @param int $year The year
     *
     * @return \Filmboot\MovieBundle\Model\MovieInterface
     */
    public function setYear($year);

    /**
     * Gets country.
     *
     * @return string
     */
    public function getCountry();

    /**
     * Sets country.
     *
     * @param string $country The name of the country
     *
     * @return \Filmboot\MovieBundle\Model\MovieInterface
     */
    public function setCountry($country);

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
     * @return \Filmboot\MovieBundle\Model\MovieInterface
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
     * @return \Filmboot\MovieBundle\Model\MovieInterface
     */
    public function setProducer($producer);

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
     * @return \Filmboot\MovieBundle\Model\MovieInterface
     */
    public function setTitle($title);

    /**
     * Adds actor.
     *
     * @param \Filmboot\ArtistBundle\Entity\Actor $actor The actor object
     *
     * @return \Filmboot\MovieBundle\Model\MovieInterface
     */
    public function addActor(Actor $actor);

    /**
     * Removes actor.
     *
     * @param \Filmboot\ArtistBundle\Entity\Actor $actor The actor object
     *
     * @return \Filmboot\MovieBundle\Model\MovieInterface
     */
    public function removeActor(Actor $actor);

    /**
     * Gets array of actors.
     *
     * @return array
     */
    public function getCast();

    /**
     * Adds director.
     *
     * @param \Filmboot\ArtistBundle\Entity\Director $director The director object
     *
     * @return \Filmboot\MovieBundle\Model\MovieInterface
     */
    public function addDirector(Director $director);

    /**
     * Removes director.
     *
     * @param \Filmboot\ArtistBundle\Entity\Director $director The director object
     *
     * @return \Filmboot\MovieBundle\Model\MovieInterface
     */
    public function removeDirector(Director $director);

    /**
     * Gets array of directors.
     *
     * @return array
     */
    public function getDirectors();

    /**
     * Adds writer.
     *
     * @param \Filmboot\ArtistBundle\Entity\Writer $writer The writer object
     *
     * @return \Filmboot\MovieBundle\Model\MovieInterface
     */
    public function addWriter(Writer $writer);

    /**
     * Removes writer.
     *
     * @param \Filmboot\ArtistBundle\Entity\Writer $writer The writer object
     *
     * @return \Filmboot\MovieBundle\Model\MovieInterface
     */
    public function removeWriter(Writer $writer);

    /**
     * Gets array of writers.
     *
     * @return array
     */
    public function getWriters();

}
