<?php

/**
 * (c) benatespina <benatespina@gmail.com>
 *
 * This file belongs to Filmboot.
 * The source code of application includes a LICENSE file
 * with all information about license.
 */

namespace Filmboot\AwardBundle\Model;

use Filmboot\ArtistBundle\Model\ArtistInterface;
use Filmboot\MovieBundle\Model\MovieInterface;

/**
 * Interface AwardWonInterface: ternary relationship table that joins Movie, Artist and Award tables.
 *
 * @package Filmboot\AwardBundle\Model
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
     * @return \Filmboot\MovieBundle\Model\MovieInterface
     */
    public function getMovie();

    /**
     * Sets movie.
     *
     * @param \Filmboot\MovieBundle\Model\MovieInterface $movie The movie object
     *
     * @return \Filmboot\AwardBundle\Model\AwardWonInterface
     */
    public function setMovie(MovieInterface $movie);

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
     * @return \Filmboot\AwardBundle\Model\AwardWonInterface
     */
    public function setArtist(ArtistInterface $artist);

    /**
     * Gets award.
     *
     * @return \Filmboot\MovieBundle\Model\MovieInterface
     */
    public function getAward();

    /**
     * Sets award.
     *
     * @param \Filmboot\AwardBundle\Model\AwardInterface $award The award object
     *
     * @return \Filmboot\AwardBundle\Model\AwardWonInterface
     */
    public function setAward(AwardInterface $award);
} 
