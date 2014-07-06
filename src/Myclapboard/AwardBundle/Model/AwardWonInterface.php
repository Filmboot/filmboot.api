<?php

/**
 * (c) benatespina <benatespina@gmail.com>
 *
 * This file belongs to Myclapboard.
 * The source code of application includes a LICENSE file
 * with all information about license.
 */

namespace Myclapboard\AwardBundle\Model;

use Myclapboard\ArtistBundle\Model\ArtistInterface;
use Myclapboard\MovieBundle\Model\MovieInterface;

/**
 * Interface AwardWonInterface: ternary relationship table that joins Movie, Artist and Award tables.
 *
 * @package Myclapboard\AwardBundle\Model
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
     * @return \Myclapboard\MovieBundle\Model\MovieInterface
     */
    public function getMovie();

    /**
     * Sets movie.
     *
     * @param \Myclapboard\MovieBundle\Model\MovieInterface $movie The movie object
     *
     * @return \Myclapboard\AwardBundle\Model\AwardWonInterface
     */
    public function setMovie(MovieInterface $movie);

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
     * @return \Myclapboard\AwardBundle\Model\AwardWonInterface
     */
    public function setArtist(ArtistInterface $artist);

    /**
     * Gets award.
     *
     * @return \Myclapboard\MovieBundle\Model\MovieInterface
     */
    public function getAward();

    /**
     * Sets award.
     *
     * @param \Myclapboard\AwardBundle\Model\AwardInterface $award The award object
     *
     * @return \Myclapboard\AwardBundle\Model\AwardWonInterface
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
     * @return \Myclapboard\AwardBundle\Model\AwardWonInterface
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
     * @return \Myclapboard\AwardBundle\Model\AwardWonInterface
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
     * @return \Myclapboard\AwardBundle\Model\AwardWonInterface
     */
    public function setRole($role);
}
