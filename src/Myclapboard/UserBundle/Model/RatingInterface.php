<?php

/**
 * This file belongs to myClapboard.
 * The source code of application includes a LICENSE file
 * with all information about license.
 *
 * @author benatespina <benatespina@gmail.com>
 * @author gorkalaucirica <gorka.lauzirika@gmail.com>
 */

namespace Myclapboard\UserBundle\Model;

use Myclapboard\MovieBundle\Model\MovieInterface;

/**
 * Interface RatingInterface.
 *
 * @package Myclapboard\UserBundle\Model
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
     * @return \Myclapboard\UserBundle\Model\RatingInterface
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
     * @return \Myclapboard\UserBundle\Model\RatingInterface
     */
    public function setDate(\DateTime $date);

    /**
     * Gets user.
     * 
     * @return \Myclapboard\UserBundle\Model\AccountInterface
     */
    public function getUser();

    /**
     * Sets user.
     * 
     * @param \Myclapboard\UserBundle\Model\AccountInterface $user The user
     *
     * @return \Myclapboard\UserBundle\Model\RatingInterface
     */
    public function setUser(AccountInterface $user);

    /**
     * Gets movie.
     * 
     * @return \Myclapboard\MovieBundle\Model\MovieInterface
     */
    public function getMovie();

    /**
     * Sets movie.
     * 
     * @param \Myclapboard\MovieBundle\Model\MovieInterface $movie The movie
     *
     * @return \Myclapboard\UserBundle\Model\RatingInterface
     */
    public function setMovie(MovieInterface $movie);
}
