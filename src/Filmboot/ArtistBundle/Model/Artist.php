<?php
/**
 * (c) benatespina <benatespina@gmail.com>
 *
 * This file belongs to Filmboot.
 * The source code of application includes a LICENSE file
 * with all information about license.
 */

namespace Filmboot\ArtistBundle\Model;

use Doctrine\Common\Collections\ArrayCollection;
use Filmboot\ArtistBundle\Entity\Actor;
use Filmboot\ArtistBundle\Entity\ArtistTranslation;
use Filmboot\ArtistBundle\Entity\Director;
use Filmboot\ArtistBundle\Entity\Writer;
use Filmboot\MovieBundle\Util\Util;

/**
 * Class Artist model.
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
    
    protected $actors;
    
    protected $directors;
    
    protected $writers;
    
    protected $translations;

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->actors = new ArrayCollection();
        $this->directors = new ArrayCollection();
        $this->writers = new ArrayCollection();
        $this->translations = new ArrayCollection();
    }

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
    public function addActor(Actor $actor)
    {
        $this->actors[] = $actor;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function removeActor(Actor $actor)
    {
        $this->actors->removeElement($actor);

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getActors()
    {
        return $this->actors;
    }

    /**
     * {@inheritDoc}
     */
    public function addDirector(Director $director)
    {
        $this->directors[] = $director;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function removeDirector(Director $director)
    {
        $this->directors->removeElement($director);

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getDirectors()
    {
        return $this->directors;
    }

    /**
     * {@inheritDoc}
     */
    public function addWriter(Writer $writer)
    {
        $this->writers[] = $writer;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function removeWriter(Writer $writer)
    {
        $this->writers->removeElement($writer);

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getWriters()
    {
        return $this->writers;
    }

    /**
     * {@inheritDoc}
     */
    public function addTranslation(ArtistTranslation $translation)
    {
        if (!$this->translations->contains($translation)) {
            $this->translations[] = $translation;
            $translation->setObject($this);
        }

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function removeTranslation(ArtistTranslation $translation)
    {
        $this->translations->removeElement($translation);

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getTranslations()
    {
        return $this->translations;
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
