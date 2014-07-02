<?php
/**
 * (c) benatespina <benatespina@gmail.com>
 *
 * This file belongs to Filmbot.
 * The source code of application includes a LICENSE file
 * with all information about license.
 */

namespace Filmbot\ArtistBundle\Model;

use Doctrine\Common\Collections\ArrayCollection;
use Filmbot\AwardBundle\Model\AwardInterface;
use Filmbot\MovieBundle\Model\MovieInterface;

/**
 * Class Role model.
 *
 * @package Filmbot\ArtistBundle\Model
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

    /**
     * {@inheritdoc}
     */
    public function getMovie()
    {
        return $this->movie;
    }

    /**
     * {@inheritdoc}
     */
    public function setMovie(MovieInterface $movie)
    {
        $this->movie = $movie;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function addAward(AwardInterface $award)
    {
        $this->awards[] = $award;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function removeAward(AwardInterface $award)
    {
        $this->awards->removeElement($award);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getAwards()
    {
        return $this->awards;
    }
}
