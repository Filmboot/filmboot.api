<?php

/**
 * This file belongs to myClapboard.
 * The source code of application includes a LICENSE file
 * with all information about license.
 *
 * @author benatespina <benatespina@gmail.com>
 * @author gorkalaucirica <gorka.lauzirika@gmail.com>
 */

namespace Myclapboard\UserBundle\Model\Interfaces;

use JJs\Bundle\GeonamesBundle\Entity\City;

/**
 * Interface BasicInfoInterface.
 *
 * @package Myclapboard\UserBundle\Model\Interfaces
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
     * @return $this self Object
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
     * @return $this self Object
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
     * @return $this self Object
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
     * @return $this self Object
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
     * @return $this self Object
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
     * @return $this self Object
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
     * @return $this self Object
     */
    public function setGender($gender);
}
