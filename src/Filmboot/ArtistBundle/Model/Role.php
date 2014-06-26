<?php
/**
 * (c) benatespina <benatespina@gmail.com>
 *
 * This file belongs to Filmboot.
 * The source code of application includes a LICENSE file
 * with all information about license.
 */

namespace Filmboot\ArtistBundle\Model;

use Doctrine\Common\Collections\ArrayCollection;
use Filmboot\MovieBundle\Model\AwardInterface;
use Filmboot\MovieBundle\Model\MovieInterface;

/**
 * Class Role model.
 *
 * @package Filmboot\ArtistBundle\Model
 */
class Role implements RoleInterface
{
    protected $artist;

    protected $movie;

    protected $awards;

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->awards = new ArrayCollection;
    }

    /**
     * {@inheritDoc}
     */
    public function getArtist()
    {
        return $this->artist;
    }

    /**
     * {@inheritDoc}
     */
    public function setArtist(ArtistInterface $artist)
    {
        $this->artist = $artist;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getMovie()
    {
        return $this->movie;
    }

    /**
     * {@inheritDoc}
     */
    public function setMovie(MovieInterface $movie)
    {
        $this->movie = $movie;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function addAward(AwardInterface $award)
    {
        $this->awards[] = $award;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function removeAward(AwardInterface $award)
    {
        $this->awards->removeElement($award);

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getAwards()
    {
        return $this->awards;
    }
}
