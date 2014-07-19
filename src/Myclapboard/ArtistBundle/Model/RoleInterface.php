<?php

/**
 * (c) benatespina <benatespina@gmail.com>
 *
 * This file belongs to myClapboard.
 * The source code of application includes a LICENSE file
 * with all information about license.
 */

namespace Myclapboard\ArtistBundle\Model;

use Myclapboard\AwardBundle\Model\AwardWonInterface;
use Myclapboard\MovieBundle\Model\MovieInterface;

/**
 * Interface RoleInterface.
 *
 * @package Myclapboard\ArtistBundle\Model
 */
interface RoleInterface
{
    /**
     * Gets id.
     *
     * @return string
     */
    public function getId();

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
     * @return \Myclapboard\ArtistBundle\Model\RoleInterface
     */
    public function setArtist(ArtistInterface $artist);

    /**
     * Gets movie.
     *
     * @return \Myclapboard\MovieBundle\Model\MovieInterface
     */
    public function getMovie();

    /**
     * Sets movie.
     *
     * @param \Myclapboard\MovieBundle\Model\MovieInterface $movie The movie object
     *
     * @return \Myclapboard\ArtistBundle\Model\RoleInterface
     */
    public function setMovie(MovieInterface $movie);

    /**
     * Adds award.
     *
     * @param \Myclapboard\AwardBundle\Model\AwardWonInterface $award The award object
     *
     * @return \Myclapboard\ArtistBundle\Model\RoleInterface
     */
    public function addAward(AwardWonInterface $award);

    /**
     * Removes award.
     *
     * @param \Myclapboard\AwardBundle\Model\AwardWonInterface $award The award object
     *
     * @return \Myclapboard\ArtistBundle\Model\RoleInterface
     */
    public function removeAward(AwardWonInterface $award);

    /**
     * Gets array of awards.
     *
     * @return array<\Myclapboard\MovieBundle\Model\AwardWonInterface>
     */
    public function getAwards();
}
