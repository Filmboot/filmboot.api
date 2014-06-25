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
 * Class Actor model.
 *
 * @package Filmboot\ArtistBundle\Model
 */
class Actor implements RoleInterface
{
    protected $id;

    protected $artist;

    protected $awards;

    protected $movies;

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->awards = new ArrayCollection;
        $this->movies = new ArrayCollection;
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

//    /**
//     * {@inheritDoc}
//     */
//    public function addAward(AwardInterface $award)
//    {
//        $this->awards[] = $award;
//        $award->setActor($this);
//
//        return $this;
//    }
//
//    /**
//     * {@inheritDoc}
//     */
//    public function removeAward(AwardInterface $award)
//    {
//        $this->awards->removeElement($award);
//
//        return $this;
//    }

//    /**
//     * {@inheritDoc}
//     */
//    public function getAwards()
//    {
//        return $this->awards;
//    }

    /**
     * {@inheritDoc}
     */
    public function addMovie(MovieInterface $movie)
    {
        $this->movies[] = $movie;
//        $movie->addCast($this);

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function removeMovie(MovieInterface $movie)
    {
        $this->movies->removeElement($movie);

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getMovies()
    {
        return $this->movies;
    }
}