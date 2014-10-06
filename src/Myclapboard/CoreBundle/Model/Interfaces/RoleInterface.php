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
 * Interface RoleInterface.
 *
 * @package Myclapboard\CoreBundle\Model\Interfaces
 */
interface RoleInterface
{
    /**
     * Sets actor.
     *
     * @param \Myclapboard\ArtistBundle\Entity\Actor $actor The actor object
     *
     * @return $this self Object
     */
    public function setActor(Actor $actor);

    /**
     * Gets actor.
     *
     * @return \Myclapboard\ArtistBundle\Entity\Actor
     */
    public function getActor();

    /**
     * Sets director.
     *
     * @param \Myclapboard\ArtistBundle\Entity\Director $director The director object
     *
     * @return $this self Object
     */
    public function setDirector(Director $director);

    /**
     * Gets director.
     *
     * @return \Myclapboard\ArtistBundle\Entity\Director
     */
    public function getDirector();

    /**
     * Sets writer.
     *
     * @param \Myclapboard\ArtistBundle\Entity\Writer $writer The writer object
     *
     * @return $this self Object
     */
    public function setWriter(Writer $writer);

    /**
     * Gets writer.
     *
     * @return \Myclapboard\ArtistBundle\Entity\Writer
     */
    public function getWriter();
}
