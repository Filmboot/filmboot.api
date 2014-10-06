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

use Myclapboard\CoreBundle\Model\Interfaces\BaseImageInterface;

/**
 * Interface ImageInterface.
 *
 * @package Myclapboard\ArtistBundle\Model\Interfaces
 */
interface ImageInterface extends BaseImageInterface
{
    /**
     * Sets artist.
     *
     * @param \Myclapboard\ArtistBundle\Model\Interfaces\ArtistInterface $artist The artist object
     *
     * @return $this self Object
     */
    public function setArtist(ArtistInterface $artist);

    /**
     * Gets artist.
     *
     * @return \Myclapboard\ArtistBundle\Model\Interfaces\ArtistInterface
     */
    public function getArtist();
}
