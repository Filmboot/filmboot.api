<?php
/**
 * (c) benatespina <benatespina@gmail.com>
 *
 * This file belongs to Filmbot.
 * The source code of application includes a LICENSE file
 * with all information about license.
 */

namespace Filmbot\MovieBundle\Model;

use Filmbot\ArtistBundle\Entity\Actor;
use Filmbot\ArtistBundle\Entity\Director;
use Filmbot\ArtistBundle\Entity\Writer;
use Filmbot\MovieBundle\Entity\MovieTranslation;

/**
 * Interface MovieInterface.
 *
 * @package Filmbot\MovieBundle\Model
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
     * @return \Filmbot\MovieBundle\Model\MovieInterface
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
     * @return \Filmbot\MovieBundle\Model\MovieInterface
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
     * @return \Filmbot\MovieBundle\Model\MovieInterface
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
     * @return \Filmbot\MovieBundle\Model\MovieInterface
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
     * @return \Filmbot\MovieBundle\Model\MovieInterface
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
     * @return \Filmbot\MovieBundle\Model\MovieInterface
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
     * @return \Filmbot\MovieBundle\Model\MovieInterface
     */
    public function setTitle($title);

    /**
     * Adds actor.
     *
     * @param \Filmbot\ArtistBundle\Entity\Actor $actor The actor object
     *
     * @return \Filmbot\MovieBundle\Model\MovieInterface
     */
    public function addActor(Actor $actor);

    /**
     * Removes actor.
     *
     * @param \Filmbot\ArtistBundle\Entity\Actor $actor The actor object
     *
     * @return \Filmbot\MovieBundle\Model\MovieInterface
     */
    public function removeActor(Actor $actor);

    /**
     * Gets array of actors.
     *
     * @return array<\Filmbot\ArtistBundle\Entity\Actor>
     */
    public function getCast();

    /**
     * Adds director.
     *
     * @param \Filmbot\ArtistBundle\Entity\Director $director The director object
     *
     * @return \Filmbot\MovieBundle\Model\MovieInterface
     */
    public function addDirector(Director $director);

    /**
     * Removes director.
     *
     * @param \Filmbot\ArtistBundle\Entity\Director $director The director object
     *
     * @return \Filmbot\MovieBundle\Model\MovieInterface
     */
    public function removeDirector(Director $director);

    /**
     * Gets array of directors.
     *
     * @return array<\Filmbot\ArtistBundle\Entity\Director>
     */
    public function getDirectors();

    /**
     * Adds writer.
     *
     * @param \Filmbot\ArtistBundle\Entity\Writer $writer The writer object
     *
     * @return \Filmbot\MovieBundle\Model\MovieInterface
     */
    public function addWriter(Writer $writer);

    /**
     * Removes writer.
     *
     * @param \Filmbot\ArtistBundle\Entity\Writer $writer The writer object
     *
     * @return \Filmbot\MovieBundle\Model\MovieInterface
     */
    public function removeWriter(Writer $writer);

    /**
     * Gets array of writers.
     *
     * @return array<\Filmbot\ArtistBundle\Entity\Writer>
     */
    public function getWriters();


    /**
     * Adds genre.
     *
     * @param \Filmbot\MovieBundle\Model\GenreInterface $genre The genre object
     *
     * @return \Filmbot\MovieBundle\Model\MovieInterface
     */
    public function addGenre(GenreInterface $genre);

    /**
     * Removes genre.
     *
     * @param \Filmbot\MovieBundle\Model\GenreInterface $genre The genre object
     *
     * @return \Filmbot\MovieBundle\Model\MovieInterface
     */
    public function removeGenre(GenreInterface $genre);

    /**
     * Gets genres.
     *
     * @return array<\Filmbot\MovieBundle\Model\GenreInterface>
     */
    public function getGenres();


    /**
     * Gets array of translations.
     *
     * @return array<\Filmbot\MovieBundle\Entity\MovieTranslation>
     */
    public function getTranslations();

    /**
     * Adds translation.
     *
     * @param \Filmbot\MovieBundle\Entity\MovieTranslation $translation The translation
     *
     * @return \Filmbot\MovieBundle\Model\MovieInterface
     */
    public function addTranslation(MovieTranslation $translation);

    /**
     * Removes translation.
     *
     * @param \Filmbot\MovieBundle\Entity\MovieTranslation $translation The translation
     *
     * @return \Filmbot\MovieBundle\Model\MovieInterface
     */
    public function removeTranslation(MovieTranslation $translation);
}
