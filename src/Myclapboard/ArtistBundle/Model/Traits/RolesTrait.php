<?php

namespace Myclapboard\ArtistBundle\Model\Traits;

use Myclapboard\ArtistBundle\Entity\Actor;
use Myclapboard\ArtistBundle\Entity\Director;
use Myclapboard\ArtistBundle\Entity\Writer;

/**
 * Trait for elements managing movie roles
 *
 * @package Myclapboard\ArtistBundle\Model\Traits
 */
trait RolesTrait
{
    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     */
    protected $actors;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     */
    protected $directors;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     */
    protected $writers;

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
}
