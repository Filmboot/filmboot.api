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

use Myclapboard\ArtistBundle\Model\Interfaces\ArtistInterface;
use Myclapboard\ArtistBundle\Model\Interfaces\ImageInterface;
use Myclapboard\CoreBundle\Model\BaseImage;

/**
 * Class Image.
 *
 * @package Myclapboard\ArtistBundle\Model
 */
class Image extends BaseImage implements ImageInterface
{
    /**
     * The artist.
     *
     * @var \Myclapboard\ArtistBundle\Model\Interfaces\ArtistInterface
     */
    protected $artist;

    /**
     * {@inheritdoc}
     */
    public function setArtist(ArtistInterface $artist)
    {
        $this->artist = $artist;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getArtist()
    {
        return $this->artist;
    }
}
