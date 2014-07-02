<?php

/**
 * (c) benatespina <benatespina@gmail.com>
 *
 * This file belongs to Filmbot.
 * The source code of application includes a LICENSE file
 * with all information about license.
 */

namespace Filmbot\AwardBundle\Model;

use Filmbot\ArtistBundle\Model\ArtistInterface;
use Filmbot\MovieBundle\Model\MovieInterface;

/**
 * Interface AwardWonInterface: ternary relationship table that joins Movie, Artist and Award tables.
 *
 * @package Filmbot\AwardBundle\Model
 */
interface AwardWonInterface
{
    /**
     * Gets id.
     *
     * @return string
     */
    public function getId();

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
     * @return \Filmbot\AwardBundle\Model\AwardWonInterface
     */
    public function setMovie(MovieInterface $movie);

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
     * @return \Filmbot\AwardBundle\Model\AwardWonInterface
     */
    public function setArtist(ArtistInterface $artist);

    /**
     * Gets award.
     *
     * @return \Filmbot\MovieBundle\Model\MovieInterface
     */
    public function getAward();

    /**
     * Sets award.
     *
     * @param \Filmbot\AwardBundle\Model\AwardInterface $award The award object
     *
     * @return \Filmbot\AwardBundle\Model\AwardWonInterface
     */
    public function setAward(AwardInterface $award);

    /**
     * Gets year.
     *
     * @return int
     */
    public function getYear();

    /**
     * Sets year.
     *
     * @param int $year The year
     *
     * @return \Filmbot\AwardBundle\Model\AwardWonInterface
     */
    public function setYear($year);

    /**
     * Gets category.
     *
     * @return string
     */
    public function getCategory();

    /**
     * Sets category.
     *
     * @param string $category The category
     *
     * @return \Filmbot\AwardBundle\Model\AwardWonInterface
     */
    public function setCategory($category);

    /**
     * Gets role.
     *
     * @return null|'actor'|'director'|'writer'
     */
    public function getRole();

    /**
     * Sets role.
     *
     * @param null|'actor'|'director'|'writer' $role The role
     *
     * @return \Filmbot\AwardBundle\Model\AwardWonInterface
     */
    public function setRole($role);
}
