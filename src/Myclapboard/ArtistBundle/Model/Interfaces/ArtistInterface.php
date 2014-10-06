<?php

/**
 * This file belongs to myClapboard.
 * The source code of application includes a LICENSE file
 * with all information about license.
 *
 * @author benatespina <benatespina@gmail.com>
 * @author gorkalaucirica <gorka.lauzirika@gmail.com>
 */

namespace Myclapboard\ArtistBundle\Model\Interfaces;

use Myclapboard\CoreBundle\Model\Interfaces\CollectionInterface;
use Myclapboard\CoreBundle\Model\Interfaces\HumanInterface;
use Myclapboard\CoreBundle\Model\Interfaces\MediaInterface;
use Myclapboard\CoreBundle\Model\Interfaces\TranslatableInterface;

/**
 * Interface ArtistInterface.
 *
 * @package Myclapboard\ArtistBundle\Model\Interfaces
 */
interface ArtistInterface extends CollectionInterface, HumanInterface, MediaInterface, TranslatableInterface
{
    /**
     * Gets id.
     *
     * @return string
     */
    public function getId();

    /**
     * Sets slug.
     *
     * @return $this self Object
     */
    public function setSlug();

    /**
     * Gets slug.
     *
     * @return string
     */
    public function getSlug();
}
