<?php

/**
 * This file belongs to myClapboard.
 * The source code of application includes a LICENSE file
 * with all information about license.
 *
 * @author benatespina <benatespina@gmail.com>
 * @author gorkalaucirica <gorka.lauzirika@gmail.com>
 */

namespace Myclapboard\CoreBundle\Model\Interfaces;

use JJs\Bundle\GeonamesBundle\Entity\City;

/**
 * Interface HumanInterface.
 *
 * @package Myclapboard\CoreBundle\Model\Interfaces
 */
interface HumanInterface
{
    /**
     * Sets about me.
     *
     * @param string $aboutMe The about me
     *
     * @return $this self Object
     */
    public function setAboutMe($aboutMe);

    /**
     * Gets about me.
     *
     * @return string
     */
    public function getAboutMe();

    /**
     * Sets birthday.
     *
     * @param \DateTime $birthday The birthday
     *
     * @return $this self Object
     */
    public function setBirthday(\DateTime $birthday);

    /**
     * Gets birthday.
     *
     * @return \DateTime
     */
    public function getBirthday();

    /**
     * Sets first name.
     *
     * @param string $firstName The first name
     *
     * @return $this self Object
     */
    public function setFirstName($firstName);

    /**
     * Gets first name.
     *
     * @return string
     */
    public function getFirstName();

    /**
     * Sets last name.
     *
     * @param string $lastName The last name
     *
     * @return $this self Object
     */
    public function setLastName($lastName);

    /**
     * Gets last name.
     *
     * @return string
     */
    public function getLastName();

    /**
     * Sets location.
     *
     * @param \JJs\Bundle\GeonamesBundle\Entity\City $location The location
     *
     * @return $this self Object
     */
    public function setLocation(City $location);

    /**
     * Gets location.
     *
     * @return \JJs\Bundle\GeonamesBundle\Entity\City
     */
    public function getLocation();
}
