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
 * Interface UserInterface.
 *
 * @package Myclapboard\UserBundle\Model
 */
interface UserInterface
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
     * @return \Myclapboard\UserBundle\Model\UserInterface
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
     * @return \Myclapboard\UserBundle\Model\UserInterface
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
     * @return \Myclapboard\UserBundle\Model\UserInterface
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
     * @return \Myclapboard\UserBundle\Model\UserInterface
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
     * @return \Myclapboard\UserBundle\Model\UserInterface
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
     * @return \Myclapboard\UserBundle\Model\UserInterface
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
     * @return \Myclapboard\UserBundle\Model\UserInterface
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
     * @return \Myclapboard\UserBundle\Model\UserInterface
     */
    public function setGender($gender);

    /**
     * Gets role.
     *
     * @return string
     */
    public function getRole();

    /**
     * Sets role.
     *
     * @param string $role The role
     *
     * @return \Myclapboard\UserBundle\Model\UserInterface
     */
    public function setRole($role);

    /**
     * Gets locale.
     *
     * @return string
     */
    public function getLocale();

    /**
     * Sets locale.
     *
     * @param string $locale The locale
     *
     * @return \Myclapboard\UserBundle\Model\UserInterface
     */
    public function setLocale($locale);

    /**
     * Gets true if has account activated, otherwise gets false.
     *
     * @return boolean
     */
    public function hasActivated();

    /**
     * Sets activated.
     *
     * @param boolean $activated The activated
     *
     * @return \Myclapboard\UserBundle\Model\UserInterface
     */
    public function setActivated($activated);

    /**
     * Gets createdAt.
     *
     * @return \DateTime
     */
    public function getCreatedAt();

    /**
     * Gets lastLogin.
     *
     * @return \DateTime
     */
    public function getLastLogin();

    /**
     * Sets lastLogin.
     *
     * @param \DateTime $lastLogin The last login
     *
     * @return \Myclapboard\UserBundle\Model\UserInterface
     */
    public function setLastLogin(\DateTime $lastLogin);

    /**
     * Gets true if has cookies accepted, otherwise gets false.
     *
     * @return boolean
     */
    public function hasCookiesAccepted();

    /**
     * Sets cookiesAccepted.
     *
     * @param boolean $cookiesAccepted The cookies accepted
     *
     * @return \Myclapboard\UserBundle\Model\UserInterface
     */
    public function setCookiesAccepted($cookiesAccepted);
}
