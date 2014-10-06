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
 * Trait RoleTrait.
 *
 * @package Myclapboard\CoreBundle\Model\Traits
 */
trait RoleTrait
{
    /**
     * The actor.
     *
     * @var \Myclapboard\ArtistBundle\Entity\Actor
     */
    protected $actor;

    /**
     * The director.
     *
     * @var \Myclapboard\ArtistBundle\Entity\Director
     */
    protected $director;

    /**
     * The writer.
     *
     * @var \Myclapboard\ArtistBundle\Entity\Writer
     */
    protected $writer;

    /**
     * Sets actor.
     *
     * @param \Myclapboard\ArtistBundle\Entity\Actor $actor The actor object
     *
     * @return $this self Object
     */
    public function setActor(Actor $actor)
    {
        $this->actor = $actor;

        return $this;
    }

    /**
     * Gets actor.
     *
     * @return \Myclapboard\ArtistBundle\Entity\Actor
     */
    public function getActor()
    {
        return $this->actor;
    }

    /**
     * Sets director.
     *
     * @param \Myclapboard\ArtistBundle\Entity\Director $director The director object
     *
     * @return $this self Object
     */
    public function setDirector(Director $director)
    {
        $this->director = $director;

        return $this;
    }

    /**
     * Gets director.
     *
     * @return \Myclapboard\ArtistBundle\Entity\Director
     */
    public function getDirector()
    {
        return $this->director;
    }

    /**
     * Sets writer.
     *
     * @param \Myclapboard\ArtistBundle\Entity\Writer $writer The writer object
     *
     * @return $this self Object
     */
    public function setWriter(Writer $writer)
    {
        $this->writer = $writer;

        return $this;
    }

    /**
     * Gets writer.
     *
     * @return \Myclapboard\ArtistBundle\Entity\Writer
     */
    public function getWriter()
    {
        return $this->writer;
    }
}
