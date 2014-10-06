<?php

/**
 * This file belongs to myClapboard.
 * The source code of application includes a LICENSE file
 * with all information about license.
 *
 * @author benatespina <benatespina@gmail.com>
 * @author gorkalaucirica <gorka.lauzirika@gmail.com>
 */

namespace Myclapboard\CoreBundle\Model\Traits;

use JJs\Bundle\GeonamesBundle\Entity\City;

/**
 * Trait HumanTrait.
 *
 * @package Myclapboard\CoreBundle\Model\Traits
 */
trait HumanTrait
{
    /**
     * The about me.
     *
     * @var string
     */
    protected $aboutMe;

    /**
     * The birthday.
     *
     * @var \DateTime
     */
    protected $birthday;

    /**
     * The first name.
     *
     * @var string
     */
    protected $firstName;

    /**
     * The last name.
     *
     * @var string
     */
    protected $lastName;

    /**
     * The location.
     *
     * @var \JJs\Bundle\GeonamesBundle\Entity\City
     */
    protected $location;

    /**
     * Sets about me.
     *
     * @param string $aboutMe The about me
     *
     * @return $this self Object
     */
    public function setAboutMe($aboutMe)
    {
        $this->aboutMe = $aboutMe;

        return $this;
    }

    /**
     * Gets about me.
     *
     * @return string
     */
    public function getAboutMe()
    {
        return $this->aboutMe;
    }

    /**
     * Sets birthday.
     *
     * @param \DateTime $birthday The birthday
     *
     * @return $this self Object
     */
    public function setBirthday(\DateTime $birthday)
    {
        $this->birthday = $birthday;

        return $this;
    }

    /**
     * Gets birthday.
     *
     * @return \DateTime
     */
    public function getBirthday()
    {
        return $this->birthday;
    }

    /**
     * Gets first name.
     *
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Gets last name.
     *
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Sets location.
     *
     * @param \JJs\Bundle\GeonamesBundle\Entity\City $location The location
     *
     * @return $this self Object
     */
    public function setLocation(City $location)
    {
        $this->location = $location;

        return $this;
    }

    /**
     * Gets location.
     *
     * @return \JJs\Bundle\GeonamesBundle\Entity\City
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * Sets first name.
     *
     * @param string $firstName The first name
     *
     * @return $this self Object
     */
    abstract public function setFirstName($firstName);

    /**
     * Sets last name.
     *
     * @param string $lastName The last name
     *
     * @return $this self Object
     */
    abstract public function setLastName($lastName);
}
