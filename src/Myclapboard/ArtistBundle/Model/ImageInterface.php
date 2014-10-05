<?php

/**
 * This file belongs to myClapboard.
 * The source code of application includes a LICENSE file
 * with all information about license.
 *
 * @author benatespina <benatespina@gmail.com>
 * @author gorkalaucirica <gorka.lauzirika@gmail.com>
 */

namespace Myclapboard\ArtistBundle\Model;

use Myclapboard\CoreBundle\Model\Interfaces\BaseImageInterface;

/**
 * Interface ImageInterface.
 *
 * @package Myclapboard\ArtistBundle\Model
 */
interface ImageInterface extends BaseImageInterface
{
    /**
     * Gets artist.
     *
     * @return \Myclapboard\ArtistBundle\Model\ArtistInterface
     */
    public function getArtist();

    /**
     * Sets artist.
     *
     * @param \Myclapboard\ArtistBundle\Model\ArtistInterface $artist The artist object
     *
     * @return $this self Object
     */
    public function setArtist(ArtistInterface $artist);
}
