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

use Myclapboard\ArtistBundle\Entity\Actor;
use Myclapboard\ArtistBundle\Entity\Director;
use Myclapboard\ArtistBundle\Entity\Writer;

/**
 * Interface RolesInterface.
 *
 * @package Myclapboard\CoreBundle\Model\Interfaces
 */
interface RolesInterface
{
    /**
     * Adds actor.
     *
     * @param \Myclapboard\ArtistBundle\Entity\Actor $actor The actor object
     *
     * @return $this self Object
     */
    public function addActor(Actor $actor);

    /**
     * Removes actor.
     *
     * @param \Myclapboard\ArtistBundle\Entity\Actor $actor The actor object
     *
     * @return $this self Object
     */
    public function removeActor(Actor $actor);

    /**
     * Gets array of actors.
     *
     * @return array<\Myclapboard\ArtistBundle\Entity\Actor>
     */
    public function getActors();

    /**
     * Adds director.
     *
     * @param \Myclapboard\ArtistBundle\Entity\Director $director The director object
     *
     * @return $this self Object
     */
    public function addDirector(Director $director);

    /**
     * Removes director.
     *
     * @param \Myclapboard\ArtistBundle\Entity\Director $director The director object
     *
     * @return $this self Object
     */
    public function removeDirector(Director $director);

    /**
     * Gets array of directors.
     *
     * @return array<\Myclapboard\ArtistBundle\Entity\Director>
     */
    public function getDirectors();

    /**
     * Adds writer.
     *
     * @param \Myclapboard\ArtistBundle\Entity\Writer $writer The writer object
     *
     * @return $this self Object
     */
    public function addWriter(Writer $writer);

    /**
     * Removes writer.
     *
     * @param \Myclapboard\ArtistBundle\Entity\Writer $writer The writer object
     *
     * @return $this self Object
     */
    public function removeWriter(Writer $writer);

    /**
     * Gets array of writers.
     *
     * @return array<\Myclapboard\ArtistBundle\Entity\Writer>
     */
    public function getWriters();
}
