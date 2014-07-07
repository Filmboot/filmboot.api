<?php

/**
 * (c) benatespina <benatespina@gmail.com>
 *
 * This file belongs to myClapboard.
 * The source code of application includes a LICENSE file
 * with all information about license.
 */

namespace Myclapboard\MovieBundle\Model;

use Myclapboard\ArtistBundle\Entity\Actor;
use Myclapboard\ArtistBundle\Entity\Director;
use Myclapboard\ArtistBundle\Entity\Writer;
use Myclapboard\MovieBundle\Entity\MovieTranslation;

/**
 * Interface MovieInterface.
 *
 * @package Myclapboard\MovieBundle\Model
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
     * @return \Myclapboard\MovieBundle\Model\MovieInterface
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
     * @return \Myclapboard\MovieBundle\Model\MovieInterface
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
     * @return \Myclapboard\MovieBundle\Model\MovieInterface
     */
    public function setReleaseDate(\DateTime $releaseDate);

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
     * @return \Myclapboard\MovieBundle\Model\MovieInterface
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
     * @return \Myclapboard\MovieBundle\Model\MovieInterface
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
     * @return \Myclapboard\MovieBundle\Model\MovieInterface
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
     * @return \Myclapboard\MovieBundle\Model\MovieInterface
     */
    public function setTitle($title);

    /**
     * Adds actor.
     *
     * @param \Myclapboard\ArtistBundle\Entity\Actor $actor The actor object
     *
     * @return \Myclapboard\MovieBundle\Model\MovieInterface
     */
    public function addActor(Actor $actor);

    /**
     * Removes actor.
     *
     * @param \Myclapboard\ArtistBundle\Entity\Actor $actor The actor object
     *
     * @return \Myclapboard\MovieBundle\Model\MovieInterface
     */
    public function removeActor(Actor $actor);

    /**
     * Gets array of actors.
     *
     * @return array<\Myclapboard\ArtistBundle\Entity\Actor>
     */
    public function getCast();

    /**
     * Adds director.
     *
     * @param \Myclapboard\ArtistBundle\Entity\Director $director The director object
     *
     * @return \Myclapboard\MovieBundle\Model\MovieInterface
     */
    public function addDirector(Director $director);

    /**
     * Removes director.
     *
     * @param \Myclapboard\ArtistBundle\Entity\Director $director The director object
     *
     * @return \Myclapboard\MovieBundle\Model\MovieInterface
     */
    public function removeDirector(Director $director);

    /**
     * Gets array of directors.
     *
     * @return array<\Myclapboard\ArtistBundle\Entity\Director>
     */
    public function getDirectors();

    /**
     * Adds writer.
     *
     * @param \Myclapboard\ArtistBundle\Entity\Writer $writer The writer object
     *
     * @return \Myclapboard\MovieBundle\Model\MovieInterface
     */
    public function addWriter(Writer $writer);

    /**
     * Removes writer.
     *
     * @param \Myclapboard\ArtistBundle\Entity\Writer $writer The writer object
     *
     * @return \Myclapboard\MovieBundle\Model\MovieInterface
     */
    public function removeWriter(Writer $writer);

    /**
     * Gets array of writers.
     *
     * @return array<\Myclapboard\ArtistBundle\Entity\Writer>
     */
    public function getWriters();


    /**
     * Adds genre.
     *
     * @param \Myclapboard\MovieBundle\Model\GenreInterface $genre The genre object
     *
     * @return \Myclapboard\MovieBundle\Model\MovieInterface
     */
    public function addGenre(GenreInterface $genre);

    /**
     * Removes genre.
     *
     * @param \Myclapboard\MovieBundle\Model\GenreInterface $genre The genre object
     *
     * @return \Myclapboard\MovieBundle\Model\MovieInterface
     */
    public function removeGenre(GenreInterface $genre);

    /**
     * Gets genres.
     *
     * @return array<\Myclapboard\MovieBundle\Model\GenreInterface>
     */
    public function getGenres();


    /**
     * Gets array of translations.
     *
     * @return array<\Myclapboard\MovieBundle\Entity\MovieTranslation>
     */
    public function getTranslations();

    /**
     * Adds translation.
     *
     * @param \Myclapboard\MovieBundle\Entity\MovieTranslation $translation The translation
     *
     * @return \Myclapboard\MovieBundle\Model\MovieInterface
     */
    public function addTranslation(MovieTranslation $translation);

    /**
     * Removes translation.
     *
     * @param \Myclapboard\MovieBundle\Entity\MovieTranslation $translation The translation
     *
     * @return \Myclapboard\MovieBundle\Model\MovieInterface
     */
    public function removeTranslation(MovieTranslation $translation);
}
