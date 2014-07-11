<?php

/**
 * (c) benatespina <benatespina@gmail.com>
 *
 * This file belongs to myClapboard.
 * The source code of application includes a LICENSE file
 * with all information about license.
 */

namespace Myclapboard\ArtistBundle\Model;

use Myclapboard\CoreBundle\Model\BaseImage;

/**
 * Class Image.
 *
 * @package Myclapboard\ArtistBundle\Model
 */
class Image extends BaseImage implements ImageInterface
{
    protected $artist;
    
    /**
     * Constructor.
     */
    public function __construct()
    {
    }

    /**
     * {@inheritdoc}
     */
    public function getArtist()
    {
        return $this->artist;
    }

    /**
     * {@inheritdoc}
     */
    public function setArtist(ArtistInterface $artist)
    {
        $this->artist = $artist;

        return $this;
    }
}
