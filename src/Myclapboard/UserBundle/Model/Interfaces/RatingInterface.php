<?php

/**
 * This file belongs to myClapboard.
 * The source code of application includes a LICENSE file
 * with all information about license.
 *
 * @author benatespina <benatespina@gmail.com>
 * @author gorkalaucirica <gorka.lauzirika@gmail.com>
 */

namespace Myclapboard\UserBundle\Model\Interfaces;

use Myclapboard\MovieBundle\Model\Interfaces\MovieInterface;

/**
 * Interface RatingInterface.
 *
 * @package Myclapboard\UserBundle\Model\Interfaces
 */
interface RatingInterface
{
    /**
     * Gets mark.
     *
     * @return int
     */
    public function getMark();

    /**
     * Sets mark.
     *
     * @param int $mark The mark
     *
     * @return $this self Object
     */
    public function setMark($mark);

    /**
     * Gets date.
     *
     * @return \DateTime
     */
    public function getDate();

    /**
     * Sets date.
     *
     * @param \DateTime $date The date
     *
     * @return $this self Object
     */
    public function setDate(\DateTime $date);

    /**
     * Gets user.
     *
     * @return \Myclapboard\UserBundle\Model\Interfaces\AccountInterface
     */
    public function getUser();

    /**
     * Sets user.
     *
     * @param \Myclapboard\UserBundle\Model\Interfaces\AccountInterface $user The user
     *
     * @return $this self Object
     */
    public function setUser(AccountInterface $user);

    /**
     * Gets movie.
     *
     * @return \Myclapboard\MovieBundle\Model\Interfaces\MovieInterface
     */
    public function getMovie();

    /**
     * Sets movie.
     *
     * @param \Myclapboard\MovieBundle\Model\Interfaces\MovieInterface $movie The movie
     *
     * @return $this self Object
     */
    public function setMovie(MovieInterface $movie);
}
