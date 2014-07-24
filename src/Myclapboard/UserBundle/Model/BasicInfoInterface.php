<?php

/**
 * (c) benatespina <benatespina@gmail.com>
 *
 * This file belongs to myClapboard.
 * The source code of application includes a LICENSE file
 * with all information about license.
 */

namespace Myclapboard\UserBundle\Model;

use JJs\Bundle\GeonamesBundle\Entity\City;

/**
 * Interface BasicInfoInterface.
 *
 * @package Myclapboard\UserBundle\Model
 */
interface BasicInfoInterface
{
    /**
     * Gets id.
     *
     * @return string
     */
    public function getId();

    /**
     * Gets email.
     *
     * @return string
     */
    public function getEmail();

    /**
     * Sets email.
     *
     * @param string $email The email
     *
     * @return \Myclapboard\UserBundle\Model\BasicInfoInterface
     */
    public function setEmail($email);

    /**
     * Gets firstName.
     *
     * @return string
     */
    public function getFirstName();

    /**
     * Sets firstName.
     *
     * @param string $firstName The firstName
     *
     * @return \Myclapboard\UserBundle\Model\BasicInfoInterface
     */
    public function setFirstName($firstName);

    /**
     * Gets lastName.
     *
     * @return string
     */
    public function getLastName();

    /**
     * Sets lastName.
     *
     * @param string $lastName The lastName
     *
     * @return \Myclapboard\UserBundle\Model\BasicInfoInterface
     */
    public function setLastName($lastName);

    /**
     * Gets mobile.
     *
     * @return string
     */
    public function getMobile();

    /**
     * Sets mobile.
     *
     * @param string $mobile The mobile
     *
     * @return \Myclapboard\UserBundle\Model\BasicInfoInterface
     */
    public function setMobile($mobile);

    /**
     * Gets phone.
     *
     * @return string
     */
    public function getPhone();

    /**
     * Sets phone.
     *
     * @param string $phone The phone
     *
     * @return \Myclapboard\UserBundle\Model\BasicInfoInterface
     */
    public function setPhone($phone);

    /**
     * Gets location.
     *
     * @return \JJs\Bundle\GeonamesBundle\Entity\City
     */
    public function getLocation();

    /**
     * Sets location.
     *
     * @param \JJs\Bundle\GeonamesBundle\Entity\City $location The location
     *
     * @return \Myclapboard\UserBundle\Model\BasicInfoInterface
     */
    public function setLocation(City $location);

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
     * @return \Myclapboard\UserBundle\Model\BasicInfoInterface
     */
    public function setBirthday(\DateTime $birthday);

    /**
     * Gets gender.
     *
     * @return string
     */
    public function getGender();

    /**
     * Sets gender.
     *
     * @param string $gender The gender
     *
     * @return \Myclapboard\UserBundle\Model\BasicInfoInterface
     */
    public function setGender($gender);
}
