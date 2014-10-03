<?php

/**
 * (c) benatespina <benatespina@gmail.com>
 *
 * This file belongs to myClapboard.
 * The source code of application includes a LICENSE file
 * with all information about license.
 */

namespace Myclapboard\ArtistBundle\Model;

use JJs\Bundle\GeonamesBundle\Entity\City;
use Myclapboard\ArtistBundle\Entity\ArtistTranslation;
use Myclapboard\ArtistBundle\Model\Interfaces\RolesTraitInterface;

/**
 * Interface ArtistInterface.
 *
 * @package Myclapboard\ArtistBundle\Model
 */
interface ArtistInterface extends RolesTraitInterface
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
     * @return \JJs\Bundle\GeonamesBundle\Entity\City
     */
    public function getBirthplace();

    /**
     * Sets birthplace.
     *
     * @param \JJs\Bundle\GeonamesBundle\Entity\City $birthplace The birthplace
     *
     * @return \Myclapboard\ArtistBundle\Model\ArtistInterface
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
     * @return \Myclapboard\ArtistBundle\Model\ArtistInterface
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
     * @return \Myclapboard\ArtistBundle\Model\ArtistInterface
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
     * @return \Myclapboard\ArtistBundle\Model\ArtistInterface
     */
    public function setPhoto($photo);

    /**
     * Adds images.
     *
     * @param \Myclapboard\ArtistBundle\Model\ImageInterface $image The image object
     *
     * @return \Myclapboard\ArtistBundle\Model\ArtistInterface
     */
    public function addImage(ImageInterface $image);

    /**
     * Removes image.
     *
     * @param \Myclapboard\ArtistBundle\Model\ImageInterface $image The image object
     *
     * @return \Myclapboard\ArtistBundle\Model\ArtistInterface
     */
    public function removeImage(ImageInterface $image);

    /**
     * Gets image.
     *
     * @return array<\Myclapboard\ArtistBundle\Model\ImageInterface>
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
