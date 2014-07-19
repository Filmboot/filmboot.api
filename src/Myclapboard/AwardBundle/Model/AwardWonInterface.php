<?php

/**
 * (c) benatespina <benatespina@gmail.com>
 *
 * This file belongs to myClapboard.
 * The source code of application includes a LICENSE file
 * with all information about license.
 */

namespace Myclapboard\AwardBundle\Model;

use Myclapboard\ArtistBundle\Entity\Actor;
use Myclapboard\ArtistBundle\Entity\Director;
use Myclapboard\ArtistBundle\Entity\Writer;
use Myclapboard\MovieBundle\Model\MovieInterface;

/**
 * Interface AwardWonInterface: ternary relationship table that joins Movie, Role and Award tables.
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
     * Gets actor.
     *
     * @return \Myclapboard\ArtistBundle\Entity\Actor
     */
    public function getActor();

    /**
     * Sets actor.
     *
     * @param \Myclapboard\ArtistBundle\Entity\Actor $actor The actor object
     *
     * @return \Myclapboard\AwardBundle\Model\AwardWonInterface
     */
    public function setActor(Actor $actor);

    /**
     * Gets director.
     *
     * @return \Myclapboard\ArtistBundle\Entity\Director
     */
    public function getDirector();

    /**
     * Sets director.
     *
     * @param \Myclapboard\ArtistBundle\Entity\Director $director The director object
     *
     * @return \Myclapboard\AwardBundle\Model\AwardWonInterface
     */
    public function setDirector(Director $director);

    /**
     * Gets writer.
     *
     * @return \Myclapboard\ArtistBundle\Entity\Writer
     */
    public function getWriter();

    /**
     * Sets writer.
     *
     * @param \Myclapboard\ArtistBundle\Entity\Writer $writer The writer object
     *
     * @return \Myclapboard\AwardBundle\Model\AwardWonInterface
     */
    public function setWriter(Writer $writer);

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
}
