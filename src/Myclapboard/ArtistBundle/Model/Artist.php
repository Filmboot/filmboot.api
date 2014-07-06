<?php
/**
 * (c) benatespina <benatespina@gmail.com>
 *
 * This file belongs to Myclapboard.
 * The source code of application includes a LICENSE file
 * with all information about license.
 */

namespace Myclapboard\ArtistBundle\Model;

use Doctrine\Common\Collections\ArrayCollection;
use Myclapboard\ArtistBundle\Entity\Actor;
use Myclapboard\ArtistBundle\Entity\ArtistTranslation;
use Myclapboard\ArtistBundle\Entity\Director;
use Myclapboard\ArtistBundle\Entity\Writer;
use Myclapboard\MovieBundle\Util\Util;

/**
 * Class Artist model.
 *
 * @package Myclapboard\ArtistBundle\Model
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
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * {@inheritdoc}
     */
    public function setSlug()
    {
        $this->slug = Util::getSlug($this->__toString());

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * {@inheritdoc}
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return self::setSlug();
    }

    /**
     * {@inheritdoc}
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * {@inheritdoc}
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return self::setSlug();
    }

    /**
     * {@inheritdoc}
     */
    public function getBirthday()
    {
        return $this->birthday;
    }

    /**
     * {@inheritdoc}
     */
    public function setBirthday(\DateTime $birthday)
    {
        $this->birthday = $birthday;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getBirthplace()
    {
        return $this->birthplace;
    }

    /**
     * {@inheritdoc}
     */
    public function setBirthplace($birthplace)
    {
        $this->birthplace = $birthplace;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getBiography()
    {
        return $this->biography;
    }

    /**
     * {@inheritdoc}
     */
    public function setBiography($biography)
    {
        $this->biography = $biography;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function addActor(Actor $actor)
    {
        $this->actors[] = $actor;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function removeActor(Actor $actor)
    {
        $this->actors->removeElement($actor);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getActors()
    {
        return $this->actors;
    }

    /**
     * {@inheritdoc}
     */
    public function addDirector(Director $director)
    {
        $this->directors[] = $director;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function removeDirector(Director $director)
    {
        $this->directors->removeElement($director);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getDirectors()
    {
        return $this->directors;
    }

    /**
     * {@inheritdoc}
     */
    public function addWriter(Writer $writer)
    {
        $this->writers[] = $writer;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function removeWriter(Writer $writer)
    {
        $this->writers->removeElement($writer);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getWriters()
    {
        return $this->writers;
    }

    /**
     * {@inheritdoc}
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
     * {@inheritdoc}
     */
    public function removeTranslation(ArtistTranslation $translation)
    {
        $this->translations->removeElement($translation);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getTranslations()
    {
        return $this->translations;
    }

    /**
     * {@inheritdoc}
     */
    public function __toString()
    {
        if (!$this->getFirstName() || !$this->getLastName()) {
            return $this->getFirstName() . $this->getLastName();
        }

        return $this->getFirstName() . ' ' . $this->getLastName();
    }
}
