<?php
/**
 * (c) benatespina <benatespina@gmail.com>
 *
 * This file belongs to Filmboot.
 * The source code of application includes a LICENSE file
 * with all information about license.
 */

namespace Filmboot\MovieBundle\Model;

use Doctrine\Common\Collections\ArrayCollection;
use Filmboot\ArtistBundle\Entity\Actor;
use Filmboot\ArtistBundle\Entity\Director;
use Filmboot\ArtistBundle\Entity\Writer;
use Filmboot\MovieBundle\Util\Util;

/**
 * Class Genre model.
 *
 * @package Filmboot\MovieBundle\Model
 */
class Genre implements GenreInterface
{
    protected $id;

    protected $slug;

    protected $name;

    /**
     * Constructor.
     */
    public function __construct()
    {
    }

    /**
     * {@inheritDoc}
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * {@inheritDoc}
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * {@inheritDoc}
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * {@inheritDoc}
     */
    public function setName($name)
    {
        $this->name = $name;
        $this->slug = Util::getSlug($name);

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function __toString()
    {
        return $this->name;
    }
}
