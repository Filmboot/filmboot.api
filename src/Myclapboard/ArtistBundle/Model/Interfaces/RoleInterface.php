<?php

/**
 * This file belongs to myClapboard.
 * The source code of application includes a LICENSE file
 * with all information about license.
 *
 * @author benatespina <benatespina@gmail.com>
 * @author gorkalaucirica <gorka.lauzirika@gmail.com>
 */

namespace Myclapboard\ArtistBundle\Model\Interfaces;

use Myclapboard\AwardBundle\Model\Interfaces\AwardWonInterface;
use Myclapboard\MovieBundle\Model\Interfaces\MovieInterface;

/**
 * Interface RoleInterface.
 *
 * @package Myclapboard\ArtistBundle\Model\Interfaces
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
     * @return \Myclapboard\ArtistBundle\Model\Interfaces\ArtistInterface
     */
    public function getArtist();

    /**
     * Sets artist.
     *
     * @param \Myclapboard\ArtistBundle\Model\Interfaces\ArtistInterface $artist The artist object
     *
     * @return $this self Object
     */
    public function setArtist(ArtistInterface $artist);

    /**
     * Gets movie.
     *
     * @return \Myclapboard\MovieBundle\Model\Interfaces\MovieInterface
     */
    public function getMovie();

    /**
     * Sets movie.
     *
     * @param \Myclapboard\MovieBundle\Model\Interfaces\MovieInterface $movie The movie object
     *
     * @return $this self Object
     */
    public function setMovie(MovieInterface $movie);

    /**
     * Adds award.
     *
     * @param \Myclapboard\AwardBundle\Model\Interfaces\AwardWonInterface $award The award object
     *
     * @return $this self Object
     */
    public function addAward(AwardWonInterface $award);

    /**
     * Removes award.
     *
     * @param \Myclapboard\AwardBundle\Model\Interfaces\AwardWonInterface $award The award object
     *
     * @return $this self Object
     */
    public function removeAward(AwardWonInterface $award);

    /**
     * Gets array of awards.
     *
     * @return array<\Myclapboard\MovieBundle\Model\Interfaces\AwardWonInterface>
     */
    public function getAwards();
}
