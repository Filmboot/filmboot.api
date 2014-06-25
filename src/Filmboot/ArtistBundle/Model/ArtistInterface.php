<?php
/**
 * (c) benatespina <benatespina@gmail.com>
 *
 * This file belongs to Filmboot.
 * The source code of application includes a LICENSE file
 * with all information about license.
 */

namespace Filmboot\ArtistBundle\Model;

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
}