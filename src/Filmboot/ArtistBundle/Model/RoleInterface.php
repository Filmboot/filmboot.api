<?php
/**
 * (c) benatespina <benatespina@gmail.com>
 *
 * This file belongs to Filmboot.
 * The source code of application includes a LICENSE file
 * with all information about license.
 */

namespace Filmboot\ArtistBundle\Model;

use Filmboot\MovieBundle\Model\MovieInterface;

/**
 * Interface RoleInterface.
 *
 * @package Filmboot\ArtistBundle\Model
 */
interface RoleInterface
{
    /**
     * Gets artist.
     *
     * @return \Filmboot\ArtistBundle\Model\ArtistInterface
     */
    public function getArtist();

    /**
     * Sets artist.
     *
     * @param \Filmboot\ArtistBundle\Model\ArtistInterface $artist The artist object
     *
     * @return \Filmboot\ArtistBundle\Model\RoleInterface
     */
    public function setArtist(ArtistInterface $artist);

    /**
     * Gets movie.
     *
     * @return \Filmboot\MovieBundle\Model\MovieInterface
     */
    public function getMovie();

    /**
     * Sets movie.
     *
     * @param \Filmboot\MovieBundle\Model\MovieInterface $movie The movie object
     *
     * @return \Filmboot\ArtistBundle\Model\RoleInterface
     */
    public function setMovie(MovieInterface $movie);

//    /**
//     * Adds award.
//     *
//     * @param \Filmboot\MovieBundle\Model\AwardInterface $award The award object
//     *
//     * @return \Filmboot\ArtistBundle\Model\RoleInterface
//     */
//    public function addAward(AwardInterface $award);
//
//    /**
//     * Removes award.
//     *
//     * @param \Filmboot\MovieBundle\Model\AwardInterface $award The award object
//     *
//     * @return \Filmboot\ArtistBundle\Model\RoleInterface
//     */
//    public function removeAward(AwardInterface $award);

//    /**
//     * Gets array of awards.
//     *
//     * @return array
//     */
//    public function getAwards();
}
