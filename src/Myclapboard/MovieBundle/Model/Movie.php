<?php

/**
 * (c) benatespina <benatespina@gmail.com>
 *
 * This file belongs to myClapboard.
 * The source code of application includes a LICENSE file
 * with all information about license.
 */

namespace Myclapboard\MovieBundle\Model;

use Doctrine\Common\Collections\ArrayCollection;
use JJs\Bundle\GeonamesBundle\Entity\Country;
use Myclapboard\ArtistBundle\Entity\Actor;
use Myclapboard\ArtistBundle\Entity\Director;
use Myclapboard\ArtistBundle\Entity\Writer;
use Myclapboard\CoreBundle\Model\ImageInterface;
use Myclapboard\MovieBundle\Entity\MovieTranslation;
use Myclapboard\MovieBundle\Util\Util;

/**
 * Class Movie model.
 *
 * @package Myclapboard\MovieBundle\Model
 */
class Movie implements MovieInterface
{
    protected $id;

    protected $slug;

    protected $title;

    protected $duration;

    protected $releaseDate;

    protected $country;

    protected $storyline;

    protected $producer;

    protected $cast;

    protected $directors;

    protected $writers;

    protected $genres;
    
    protected $images;

    protected $translations;

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->cast = new ArrayCollection();
        $this->directors = new ArrayCollection();
        $this->writers = new ArrayCollection();
        $this->genres = new ArrayCollection();
        $this->images = new ArrayCollection();
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
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getDuration()
    {
        return $this->duration;
    }

    /**
     * {@inheritdoc}
     */
    public function setDuration($duration)
    {
        $this->duration = $duration;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getReleaseDate()
    {
        return $this->releaseDate;
    }

    /**
     * {@inheritdoc}
     */
    public function setReleaseDate(\DateTime $releaseDate)
    {
        $this->releaseDate = $releaseDate;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * {@inheritdoc}
     */
    public function setCountry(Country $country)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getStoryline()
    {
        return $this->storyline;
    }

    /**
     * {@inheritdoc}
     */
    public function setStoryline($storyline)
    {
        $this->storyline = $storyline;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getProducer()
    {
        return $this->producer;
    }

    /**
     * {@inheritdoc}
     */
    public function setProducer($producer)
    {
        $this->producer = $producer;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * {@inheritdoc}
     */
    public function setTitle($title)
    {
        $this->title = $title;
        $this->slug = Util::getSlug($title);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function addActor(Actor $actor)
    {
        $this->cast[] = $actor;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function removeActor(Actor $actor)
    {
        $this->cast->removeElement($actor);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getCast()
    {
        return $this->cast;
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
    public function addGenre(GenreInterface $genre)
    {
        $this->genres[] = $genre;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function removeGenre(GenreInterface $genre)
    {
        $this->genres->removeElement($genre);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getGenres()
    {
        return $this->genres;
    }

    /**
     * {@inheritdoc}
     */
    public function addImage(ImageInterface $image)
    {
        $this->images[] = $image;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function removeImage(ImageInterface $image)
    {
        $this->images->removeElement($image);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getImages()
    {
        return $this->images;
    }

    /**
     * {@inheritdoc}
     */
    public function addTranslation(MovieTranslation $translation)
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
    public function removeTranslation(MovieTranslation $translation)
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
        return $this->getTitle();
    }
}
