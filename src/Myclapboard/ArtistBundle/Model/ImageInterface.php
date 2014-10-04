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

/**
 * Interface ImageInterface.
 *
 * @package Myclapboard\ArtistBundle\Model
 */
interface ImageInterface
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
     * @return \Myclapboard\ArtistBundle\Model\ImageInterface
     */
    public function setArtist(ArtistInterface $artist);
}
