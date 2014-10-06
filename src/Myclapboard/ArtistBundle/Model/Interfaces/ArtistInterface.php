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

use Myclapboard\CoreBundle\Model\Interfaces\HumanInterface;
use Myclapboard\CoreBundle\Model\Interfaces\MediaInterface;
use Myclapboard\CoreBundle\Model\Interfaces\RolesInterface;
use Myclapboard\CoreBundle\Model\Interfaces\TranslatableInterface;

/**
 * Interface ArtistInterface.
 *
 * @package Myclapboard\ArtistBundle\Model\Interfaces
 */
interface ArtistInterface extends HumanInterface, MediaInterface, RolesInterface, TranslatableInterface
{
    /**
     * Gets id.
     *
     * @return string
     */
    public function getId();

    /**
     * Gets slug.
     *
     * @return string
     */
    public function getSlug();

    /**
     * Sets slug.
     *
     * @return $this self Object
     */
    public function setSlug();

    /**
     * Adds images.
     *
     * @param \Myclapboard\ArtistBundle\Model\Interfaces\ImageInterface $image The image object
     *
     * @return $this self Object
     */
    public function addImage(ImageInterface $image);

    /**
     * Removes image.
     *
     * @param \Myclapboard\ArtistBundle\Model\Interfaces\ImageInterface $image The image object
     *
     * @return $this self Object
     */
    public function removeImage(ImageInterface $image);

    /**
     * Gets image.
     *
     * @return array<\Myclapboard\ArtistBundle\Model\Interfaces\ImageInterface>
     */
    public function getImages();
}
