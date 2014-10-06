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

use Myclapboard\ArtistBundle\Entity\Actor;
use Myclapboard\ArtistBundle\Entity\Director;
use Myclapboard\ArtistBundle\Entity\Writer;

/**
 * Trait RolesTrait.
 *
 * @package Myclapboard\CoreBundle\Model\Traits
 */
trait RolesTrait
{
    /**
     * Array that contains actors.
     *
     * @var \Doctrine\Common\Collections\ArrayCollection
     */
    protected $actors;

    /**
     * Array that contains directors.
     *
     * @var \Doctrine\Common\Collections\ArrayCollection
     */
    protected $directors;

    /**
     * Array that contains writers.
     *
     * @var \Doctrine\Common\Collections\ArrayCollection
     */
    protected $writers;

    /**
     * Adds actor.
     *
     * @param \Myclapboard\ArtistBundle\Entity\Actor $actor The actor object
     *
     * @return $this self Object
     */
    public function addActor(Actor $actor)
    {
        $this->actors[] = $actor;

        return $this;
    }

    /**
     * Removes actor.
     *
     * @param \Myclapboard\ArtistBundle\Entity\Actor $actor The actor object
     *
     * @return $this self Object
     */
    public function removeActor(Actor $actor)
    {
        $this->actors->removeElement($actor);

        return $this;
    }

    /**
     * Gets array of actors.
     *
     * @return array<\Myclapboard\ArtistBundle\Entity\Actor>
     */
    public function getActors()
    {
        return $this->actors;
    }

    /**
     * Adds director.
     *
     * @param \Myclapboard\ArtistBundle\Entity\Director $director The director object
     *
     * @return $this self Object
     */
    public function addDirector(Director $director)
    {
        $this->directors[] = $director;

        return $this;
    }

    /**
     * Removes director.
     *
     * @param \Myclapboard\ArtistBundle\Entity\Director $director The director object
     *
     * @return $this self Object
     */
    public function removeDirector(Director $director)
    {
        $this->directors->removeElement($director);

        return $this;
    }

    /**
     * Gets array of directors.
     *
     * @return array<\Myclapboard\ArtistBundle\Entity\Director>
     */
    public function getDirectors()
    {
        return $this->directors;
    }

    /**
     * Adds writer.
     *
     * @param \Myclapboard\ArtistBundle\Entity\Writer $writer The writer object
     *
     * @return $this self Object
     */
    public function addWriter(Writer $writer)
    {
        $this->writers[] = $writer;

        return $this;
    }

    /**
     * Removes writer.
     *
     * @param \Myclapboard\ArtistBundle\Entity\Writer $writer The writer object
     *
     * @return $this self Object
     */
    public function removeWriter(Writer $writer)
    {
        $this->writers->removeElement($writer);

        return $this;
    }

    /**
     * Gets array of writers.
     *
     * @return array<\Myclapboard\ArtistBundle\Entity\Writer>
     */
    public function getWriters()
    {
        return $this->writers;
    }
}
