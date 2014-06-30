<?php
/**
 * (c) benatespina <benatespina@gmail.com>
 *
 * This file belongs to Filmbot.
 * The source code of application includes a LICENSE file
 * with all information about license.
 */

namespace Filmbot\MovieBundle\Model;

use Doctrine\Common\Collections\ArrayCollection;
use Filmbot\ArtistBundle\Entity\Actor;
use Filmbot\ArtistBundle\Entity\Director;
use Filmbot\ArtistBundle\Entity\Writer;
use Filmbot\MovieBundle\Util\Util;

/**
 * Class Movie model.
 *
 * @package Filmbot\MovieBundle\Model
 */
class Movie implements MovieInterface
{
    protected $id;

    protected $slug;

    protected $title;

    protected $duration;

    protected $year;

    protected $country;

    protected $storyline;

    protected $producer;

    protected $cast;

    protected $directors;

    protected $writers;

    protected $genres;

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->cast = new ArrayCollection();
        $this->directors = new ArrayCollection();
        $this->writers = new ArrayCollection();
        $this->genres = new ArrayCollection();
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
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getDuration()
    {
        return $this->duration;
    }

    /**
     * {@inheritDoc}
     */
    public function setDuration($duration)
    {
        $this->duration = $duration;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getYear()
    {
        return $this->year;
    }

    /**
     * {@inheritDoc}
     */
    public function setYear($year)
    {
        $this->year = $year;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * {@inheritDoc}
     */
    public function setCountry($country)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getStoryline()
    {
        return $this->storyline;
    }

    /**
     * {@inheritDoc}
     */
    public function setStoryline($storyline)
    {
        $this->storyline = $storyline;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getProducer()
    {
        return $this->producer;
    }

    /**
     * {@inheritDoc}
     */
    public function setProducer($producer)
    {
        $this->producer = $producer;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * {@inheritDoc}
     */
    public function setTitle($title)
    {
        $this->title = $title;
        $this->slug = Util::getSlug($title);

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function addActor(Actor $actor)
    {
        $this->cast[] = $actor;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function removeActor(Actor $actor)
    {
        $this->cast->removeElement($actor);

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getCast()
    {
        return $this->cast;
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
    public function addGenre(GenreInterface $genre)
    {
        $this->genres[] = $genre;
        
        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function removeGenre(GenreInterface $genre)
    {
        $this->genres->removeElement($genre);

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getGenres()
    {
        return $this->genres;
    }

    /**
     * {@inheritDoc}
     */
    public function __toString()
    {
        return $this->getTitle();
    }
}