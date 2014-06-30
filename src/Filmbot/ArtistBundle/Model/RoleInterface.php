<?php
/**
 * (c) benatespina <benatespina@gmail.com>
 *
 * This file belongs to Filmbot.
 * The source code of application includes a LICENSE file
 * with all information about license.
 */

namespace Filmbot\ArtistBundle\Model;

use Filmbot\AwardBundle\Model\AwardInterface;
use Filmbot\MovieBundle\Model\MovieInterface;

/**
 * Interface RoleInterface.
 *
 * @package Filmbot\ArtistBundle\Model
 */
interface RoleInterface
{
    /**
     * Gets artist.
     *
     * @return \Filmbot\ArtistBundle\Model\ArtistInterface
     */
    public function getArtist();

    /**
     * Sets artist.
     *
     * @param \Filmbot\ArtistBundle\Model\ArtistInterface $artist The artist object
     *
     * @return \Filmbot\ArtistBundle\Model\RoleInterface
     */
    public function setArtist(ArtistInterface $artist);

    /**
     * Gets movie.
     *
     * @return \Filmbot\MovieBundle\Model\MovieInterface
     */
    public function getMovie();

    /**
     * Sets movie.
     *
     * @param \Filmbot\MovieBundle\Model\MovieInterface $movie The movie object
     *
     * @return \Filmbot\ArtistBundle\Model\RoleInterface
     */
    public function setMovie(MovieInterface $movie);

    /**
     * Adds award.
     *
     * @param \Filmbot\AwardBundle\Model\AwardInterface $award The award object
     *
     * @return \Filmbot\ArtistBundle\Model\RoleInterface
     */
    public function addAward(AwardInterface $award);

    /**
     * Removes award.
     *
     * @param \Filmbot\AwardBundle\Model\AwardInterface $award The award object
     *
     * @return \Filmbot\ArtistBundle\Model\RoleInterface
     */
    public function removeAward(AwardInterface $award);

    /**
     * Gets array of awards.
     *
     * @return array<\Filmbot\MovieBundle\Model\AwardInterface>
     */
    public function getAwards();
}
