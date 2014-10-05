<?php

/**
 * This file belongs to myClapboard.
 * The source code of application includes a LICENSE file
 * with all information about license.
 *
 * @author benatespina <benatespina@gmail.com>
 * @author gorkalaucirica <gorka.lauzirika@gmail.com>
 */

namespace Myclapboard\ArtistBundle\Model;

use JJs\Bundle\GeonamesBundle\Entity\City;
use Myclapboard\ArtistBundle\Entity\Actor;
use Myclapboard\ArtistBundle\Entity\Director;
use Myclapboard\ArtistBundle\Entity\Writer;
use Myclapboard\CoreBundle\Model\Interfaces\TranslatableInterface;

/**
 * Interface ArtistInterface.
 *
 * @package Myclapboard\ArtistBundle\Model
 */
interface ArtistInterface extends TranslatableInterface
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
     * @return $this self Object
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
     * @return $this self Object
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
     * @return $this self Object
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
     * @return $this self Object
     */
    public function setBirthday(\DateTime $birthday);

    /**
     * Gets birthplace.
     *
     * @return \JJs\Bundle\GeonamesBundle\Entity\City
     */
    public function getBirthplace();

    /**
     * Sets birthplace.
     *
     * @param \JJs\Bundle\GeonamesBundle\Entity\City $birthplace The birthplace
     *
     * @return $this self Object
     */
    public function setBirthplace(City $birthplace);

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
     * @return $this self Object
     */
    public function setBiography($biography);

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
     * Gets photo.
     *
     * @return string
     */
    public function getPhoto();

    /**
     * Sets photo.
     *
     * @param string $photo The photo
     *
     * @return $this self Object
     */
    public function setPhoto($photo);

    /**
     * Adds actor.
     *
     * @param \Myclapboard\ArtistBundle\Entity\Actor $actor The actor object
     *
     * @return $this self Object
     */
    public function addActor(Actor $actor);

    /**
     * Removes actor.
     *
     * @param \Myclapboard\ArtistBundle\Entity\Actor $actor The actor object
     *
     * @return $this self Object
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
     * @return $this self Object
     */
    public function addDirector(Director $director);

    /**
     * Removes director.
     *
     * @param \Myclapboard\ArtistBundle\Entity\Director $director The director object
     *
     * @return $this self Object
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
     * @return $this self Object
     */
    public function addWriter(Writer $writer);

    /**
     * Removes writer.
     *
     * @param \Myclapboard\ArtistBundle\Entity\Writer $writer The writer object
     *
     * @return $this self Object
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
     * @param \Myclapboard\ArtistBundle\Model\ImageInterface $image The image object
     *
     * @return $this self Object
     */
    public function addImage(ImageInterface $image);

    /**
     * Removes image.
     *
     * @param \Myclapboard\ArtistBundle\Model\ImageInterface $image The image object
     *
     * @return $this self Object
     */
    public function removeImage(ImageInterface $image);

    /**
     * Gets image.
     *
     * @return array<\Myclapboard\ArtistBundle\Model\ImageInterface>
     */
    public function getImages();
}
