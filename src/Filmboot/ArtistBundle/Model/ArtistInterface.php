<?php
/**
 * (c) benatespina <benatespina@gmail.com>
 *
 * This file belongs to Filmboot.
 * The source code of application includes a LICENSE file
 * with all information about license.
 */

namespace Filmboot\ArtistBundle\Model;

use Filmboot\ArtistBundle\Entity\Actor;
use Filmboot\ArtistBundle\Entity\ArtistTranslation;
use Filmboot\ArtistBundle\Entity\Director;
use Filmboot\ArtistBundle\Entity\Writer;

/**
 * Interface ArtistInterface.
 *
 * @package Filmboot\ArtistBundle\Model
 */
interface ArtistInterface
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
     * @return \Filmboot\ArtistBundle\Model\ArtistInterface
     */
    public function setSlug();

    /**
     * Gets first name.
     *
     * @return string
     */
    public function getFirstName();

    /**
     * Sets first name.
     *
     * @param string $firstName The first name
     *
     * @return \Filmboot\ArtistBundle\Model\ArtistInterface
     */
    public function setFirstName($firstName);

    /**
     * Gets last name.
     *
     * @return string
     */
    public function getLastName();

    /**
     * Sets last name.
     *
     * @param string $lastName The last name
     *
     * @return \Filmboot\ArtistBundle\Model\ArtistInterface
     */
    public function setLastName($lastName);

    /**
     * Gets birthday.
     *
     * @return \DateTime
     */
    public function getBirthday();

    /**
     * Sets birthday.
     *
     * @param \DateTime $birthday The birthday
     *
     * @return \Filmboot\ArtistBundle\Model\ArtistInterface
     */
    public function setBirthday(\DateTime $birthday);

    /**
     * Gets birthplace.
     *
     * @return string
     */
    public function getBirthplace();

    /**
     * Sets birthplace.
     *
     * @param string $birthplace The birthplace
     *
     * @return \Filmboot\ArtistBundle\Model\ArtistInterface
     */
    public function setBirthplace($birthplace);

    /**
     * Gets biography.
     *
     * @return string
     */
    public function getBiography();

    /**
     * Sets biography.
     *
     * @param string $biography The biography
     *
     * @return \Filmboot\ArtistBundle\Model\ArtistInterface
     */
    public function setBiography($biography);

    /**
     * Adds actor.
     *
     * @param \Filmboot\ArtistBundle\Entity\Actor $actor The actor object
     *
     * @return \Filmboot\ArtistBundle\Model\ArtistInterface
     */
    public function addActor(Actor $actor);

    /**
     * Removes actor.
     *
     * @param \Filmboot\ArtistBundle\Entity\Actor $actor The actor object
     *
     * @return \Filmboot\ArtistBundle\Model\ArtistInterface
     */
    public function removeActor(Actor $actor);

    /**
     * Gets array of actors.
     *
     * @return array<\Filmboot\ArtistBundle\Entity\Actor>
     */
    public function getActors();

    /**
     * Adds director.
     *
     * @param \Filmboot\ArtistBundle\Entity\Director $director The director object
     *
     * @return \Filmboot\ArtistBundle\Model\ArtistInterface
     */
    public function addDirector(Director $director);

    /**
     * Removes director.
     *
     * @param \Filmboot\ArtistBundle\Entity\Director $director The director object
     *
     * @return \Filmboot\ArtistBundle\Model\ArtistInterface
     */
    public function removeDirector(Director $director);

    /**
     * Gets array of directors.
     *
     * @return array<\Filmboot\ArtistBundle\Entity\Director>
     */
    public function getDirectors();

    /**
     * Adds writer.
     *
     * @param \Filmboot\ArtistBundle\Entity\Writer $writer The writer object
     *
     * @return \Filmboot\ArtistBundle\Model\ArtistInterface
     */
    public function addWriter(Writer $writer);

    /**
     * Removes writer.
     *
     * @param \Filmboot\ArtistBundle\Entity\Writer $writer The writer object
     *
     * @return \Filmboot\ArtistBundle\Model\ArtistInterface
     */
    public function removeWriter(Writer $writer);

    /**
     * Gets array of translations.
     *
     * @return array<\Filmboot\ArtistBundle\Entity\ArtistTranslation>
     */
    public function getTranslations();

    /**
     * Adds translation.
     *
     * @param \Filmboot\ArtistBundle\Entity\ArtistTranslation $translation The translation
     *
     * @return \Filmboot\ArtistBundle\Model\ArtistInterface
     */
    public function addTranslation(ArtistTranslation $translation);

    /**
     * Removes translation.
     *
     * @param \Filmboot\ArtistBundle\Entity\ArtistTranslation $translation The translation
     *
     * @return \Filmboot\ArtistBundle\Model\ArtistInterface
     */
    public function removeTranslation(ArtistTranslation $translation);

    /**
     * Gets array of writers.
     *
     * @return array<\Filmboot\ArtistBundle\Entity\Writer>
     */
    public function getWriters();
}
