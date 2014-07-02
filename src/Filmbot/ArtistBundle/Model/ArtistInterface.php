<?php
/**
 * (c) benatespina <benatespina@gmail.com>
 *
 * This file belongs to Filmbot.
 * The source code of application includes a LICENSE file
 * with all information about license.
 */

namespace Filmbot\ArtistBundle\Model;

use Filmbot\ArtistBundle\Entity\Actor;
use Filmbot\ArtistBundle\Entity\ArtistTranslation;
use Filmbot\ArtistBundle\Entity\Director;
use Filmbot\ArtistBundle\Entity\Writer;

/**
 * Interface ArtistInterface.
 *
 * @package Filmbot\ArtistBundle\Model
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
     * @return \Filmbot\ArtistBundle\Model\ArtistInterface
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
     * @return \Filmbot\ArtistBundle\Model\ArtistInterface
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
     * @return \Filmbot\ArtistBundle\Model\ArtistInterface
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
     * @return \Filmbot\ArtistBundle\Model\ArtistInterface
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
     * @return \Filmbot\ArtistBundle\Model\ArtistInterface
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
     * @return \Filmbot\ArtistBundle\Model\ArtistInterface
     */
    public function setBiography($biography);

    /**
     * Adds actor.
     *
     * @param \Filmbot\ArtistBundle\Entity\Actor $actor The actor object
     *
     * @return \Filmbot\ArtistBundle\Model\ArtistInterface
     */
    public function addActor(Actor $actor);

    /**
     * Removes actor.
     *
     * @param \Filmbot\ArtistBundle\Entity\Actor $actor The actor object
     *
     * @return \Filmbot\ArtistBundle\Model\ArtistInterface
     */
    public function removeActor(Actor $actor);

    /**
     * Gets array of actors.
     *
     * @return array<\Filmbot\ArtistBundle\Entity\Actor>
     */
    public function getActors();

    /**
     * Adds director.
     *
     * @param \Filmbot\ArtistBundle\Entity\Director $director The director object
     *
     * @return \Filmbot\ArtistBundle\Model\ArtistInterface
     */
    public function addDirector(Director $director);

    /**
     * Removes director.
     *
     * @param \Filmbot\ArtistBundle\Entity\Director $director The director object
     *
     * @return \Filmbot\ArtistBundle\Model\ArtistInterface
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
     * @return \Filmbot\ArtistBundle\Model\ArtistInterface
     */
    public function addWriter(Writer $writer);

    /**
     * Removes writer.
     *
     * @param \Filmbot\ArtistBundle\Entity\Writer $writer The writer object
     *
     * @return \Filmbot\ArtistBundle\Model\ArtistInterface
     */
    public function removeWriter(Writer $writer);

    /**
     * Gets array of writers.
     *
     * @return array<\Filmbot\ArtistBundle\Entity\Writer>
     */
    public function getWriters();

    /**
     * Gets array of translations.
     *
     * @return array<\Filmbot\ArtistBundle\Entity\ArtistTranslation>
     */
    public function getTranslations();

    /**
     * Adds translation.
     *
     * @param \Filmbot\ArtistBundle\Entity\ArtistTranslation $translation The translation
     *
     * @return \Filmbot\ArtistBundle\Model\ArtistInterface
     */
    public function addTranslation(ArtistTranslation $translation);

    /**
     * Removes translation.
     *
     * @param \Filmbot\ArtistBundle\Entity\ArtistTranslation $translation The translation
     *
     * @return \Filmbot\ArtistBundle\Model\ArtistInterface
     */
    public function removeTranslation(ArtistTranslation $translation);
}
