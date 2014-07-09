<?php

/**
 * (c) benatespina <benatespina@gmail.com>
 *
 * This file belongs to myClapboard.
 * The source code of application includes a LICENSE file
 * with all information about license.
 */

namespace Myclapboard\ArtistBundle\Model;

use Myclapboard\ArtistBundle\Entity\Actor;
use Myclapboard\ArtistBundle\Entity\ArtistTranslation;
use Myclapboard\ArtistBundle\Entity\Director;
use Myclapboard\ArtistBundle\Entity\Writer;
use Myclapboard\CoreBundle\Model\ImageInterface;

/**
 * Interface ArtistInterface.
 *
 * @package Myclapboard\ArtistBundle\Model
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
     * @return \Myclapboard\ArtistBundle\Model\ArtistInterface
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
     * @return \Myclapboard\ArtistBundle\Model\ArtistInterface
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
     * @return \Myclapboard\ArtistBundle\Model\ArtistInterface
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
     * @return \Myclapboard\ArtistBundle\Model\ArtistInterface
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
     * @return \Myclapboard\ArtistBundle\Model\ArtistInterface
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
     * @return \Myclapboard\ArtistBundle\Model\ArtistInterface
     */
    public function setBiography($biography);

    /**
     * Adds actor.
     *
     * @param \Myclapboard\ArtistBundle\Entity\Actor $actor The actor object
     *
     * @return \Myclapboard\ArtistBundle\Model\ArtistInterface
     */
    public function addActor(Actor $actor);

    /**
     * Removes actor.
     *
     * @param \Myclapboard\ArtistBundle\Entity\Actor $actor The actor object
     *
     * @return \Myclapboard\ArtistBundle\Model\ArtistInterface
     */
    public function removeActor(Actor $actor);

    /**
     * Gets array of actors.
     *
     * @return array<\Myclapboard\ArtistBundle\Entity\Actor>
     */
    public function getActors();

    /**
     * Adds director.
     *
     * @param \Myclapboard\ArtistBundle\Entity\Director $director The director object
     *
     * @return \Myclapboard\ArtistBundle\Model\ArtistInterface
     */
    public function addDirector(Director $director);

    /**
     * Removes director.
     *
     * @param \Myclapboard\ArtistBundle\Entity\Director $director The director object
     *
     * @return \Myclapboard\ArtistBundle\Model\ArtistInterface
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
     * @return \Myclapboard\ArtistBundle\Model\ArtistInterface
     */
    public function addWriter(Writer $writer);

    /**
     * Removes writer.
     *
     * @param \Myclapboard\ArtistBundle\Entity\Writer $writer The writer object
     *
     * @return \Myclapboard\ArtistBundle\Model\ArtistInterface
     */
    public function removeWriter(Writer $writer);

    /**
     * Gets array of writers.
     *
     * @return array<\Myclapboard\ArtistBundle\Entity\Writer>
     */
    public function getWriters();

    /**
     * Adds images.
     *
     * @param \Myclapboard\CoreBundle\Model\ImageInterface $image The image object
     *
     * @return \Myclapboard\ArtistBundle\Model\ArtistInterface
     */
    public function addImage(ImageInterface $image);

    /**
     * Removes image.
     *
     * @param \Myclapboard\CoreBundle\Model\ImageInterface $image The image object
     *
     * @return \Myclapboard\ArtistBundle\Model\ArtistInterface
     */
    public function removeImage(ImageInterface $image);

    /**
     * Gets image.
     *
     * @return array<\Myclapboard\CoreBundle\Model\ImageInterface>
     */
    public function getImages();

    /**
     * Gets array of translations.
     *
     * @return array<\Myclapboard\ArtistBundle\Entity\ArtistTranslation>
     */
    public function getTranslations();

    /**
     * Adds translation.
     *
     * @param \Myclapboard\ArtistBundle\Entity\ArtistTranslation $translation The translation
     *
     * @return \Myclapboard\ArtistBundle\Model\ArtistInterface
     */
    public function addTranslation(ArtistTranslation $translation);

    /**
     * Removes translation.
     *
     * @param \Myclapboard\ArtistBundle\Entity\ArtistTranslation $translation The translation
     *
     * @return \Myclapboard\ArtistBundle\Model\ArtistInterface
     */
    public function removeTranslation(ArtistTranslation $translation);
}
