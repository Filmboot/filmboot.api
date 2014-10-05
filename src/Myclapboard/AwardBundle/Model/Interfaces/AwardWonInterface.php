<?php

/**
 * This file belongs to myClapboard.
 * The source code of application includes a LICENSE file
 * with all information about license.
 *
 * @author benatespina <benatespina@gmail.com>
 * @author gorkalaucirica <gorka.lauzirika@gmail.com>
 */

namespace Myclapboard\AwardBundle\Model\Interfaces;

use Myclapboard\ArtistBundle\Entity\Actor;
use Myclapboard\ArtistBundle\Entity\Director;
use Myclapboard\ArtistBundle\Entity\Writer;
use Myclapboard\MovieBundle\Model\Interfaces\MovieInterface;

/**
 * Interface AwardWonInterface: ternary relationship table that joins Movie, Role and Award tables.
 *
 * @package Myclapboard\AwardBundle\Model\Interfaces
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
     * @return $this self Object
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
     * @return $this self Object
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
     * @return $this self Object
     */
    public function setWriter(Writer $writer);

    /**
     * Gets award.
     *
     * @return \Myclapboard\MovieBundle\Model\Interfaces\MovieInterface
     */
    public function getAward();

    /**
     * Sets award.
     *
     * @param \Myclapboard\AwardBundle\Model\Interfaces\AwardInterface $award The award object
     *
     * @return $this self Object
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
     * @return $this self Object
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
     * @return $this self Object
     */
    public function setCategory($category);
}
