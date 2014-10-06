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

use Myclapboard\CoreBundle\Model\Interfaces\RoleInterface;
use Myclapboard\MovieBundle\Model\Interfaces\MovieInterface;

/**
 * Interface AwardWonInterface: ternary relationship table that joins Movie, Role and Award tables.
 *
 * @package Myclapboard\AwardBundle\Model\Interfaces
 */
interface AwardWonInterface extends RoleInterface
{
    /**
     * Gets id.
     *
     * @return string
     */
    public function getId();

    /**
     * Sets award.
     *
     * @param \Myclapboard\AwardBundle\Model\Interfaces\AwardInterface $award The award object
     *
     * @return $this self Object
     */
    public function setAward(AwardInterface $award);

    /**
     * Gets award.
     *
     * @return \Myclapboard\MovieBundle\Model\Interfaces\MovieInterface
     */
    public function getAward();

    /**
     * Sets category.
     *
     * @param string $category The category
     *
     * @return $this self Object
     */
    public function setCategory($category);

    /**
     * Gets category.
     *
     * @return string
     */
    public function getCategory();

    /**
     * Sets movie.
     *
     * @param \Myclapboard\MovieBundle\Model\Interfaces\MovieInterface $movie The movie object
     *
     * @return $this self Object
     */
    public function setMovie(MovieInterface $movie);

    /**
     * Gets movie.
     *
     * @return \Myclapboard\MovieBundle\Model\Interfaces\MovieInterface
     */
    public function getMovie();

    /**
     * Sets year.
     *
     * @param int $year The year
     *
     * @return $this self Object
     */
    public function setYear($year);

    /**
     * Gets year.
     *
     * @return int
     */
    public function getYear();
}
