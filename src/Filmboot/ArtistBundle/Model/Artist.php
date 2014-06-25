<?php
/**
 * (c) benatespina <benatespina@gmail.com>
 *
 * This file belongs to Filmboot.
 * The source code of application includes a LICENSE file
 * with all information about license.
 */

namespace Filmboot\ArtistBundle\Model;

use Filmboot\MovieBundle\Util\Util;

/**
 * Class Artist.
 *
 * @package Filmboot\ArtistBundle\Model
 */
class Artist implements ArtistInterface
{
    protected $id;

    protected $slug;

    protected $firstName;

    protected $lastName;

    protected $birthday;

    protected $birthplace;

    protected $biography;

    /**
     * {@inheritDoc}
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * {@inheritDoc}
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * {@inheritDoc}
     */
    public function setSlug()
    {
        $this->slug = Util::getSlug($this->__toString());

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * {@inheritDoc}
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return self::setSlug();
    }

    /**
     * {@inheritDoc}
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * {@inheritDoc}
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return self::setSlug();
    }

    /**
     * {@inheritDoc}
     */
    public function getBirthday()
    {
        return $this->birthday;
    }

    /**
     * {@inheritDoc}
     */
    public function setBirthday(\DateTime $birthday)
    {
        $this->birthday = $birthday;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getBirthplace()
    {
        return $this->birthplace;
    }

    /**
     * {@inheritDoc}
     */
    public function setBirthplace($birthplace)
    {
        $this->birthplace = $birthplace;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getBiography()
    {
        return $this->biography;
    }

    /**
     * {@inheritDoc}
     */
    public function setBiography($biography)
    {
        $this->biography = $biography;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function __toString()
    {
        if (!$this->getFirstName() || !$this->getLastName()) {
            return $this->getFirstName() . $this->getLastName();
        }

        return $this->getFirstName() . ' ' . $this->getLastName();
    }
}