<?php

/**
 * (c) benatespina <benatespina@gmail.com>
 *
 * This file belongs to myClapboard.
 * The source code of application includes a LICENSE file
 * with all information about license.
 */

namespace Myclapboard\UserBundle\Model;

use Myclapboard\MovieBundle\Model\MovieInterface;

/**
 * Interface ReviewInterface.
 *
 * @package Myclapboard\UserBundle\Model
 */
interface ReviewInterface
{
    /**
     * Gets id.
     *
     * @return string
     */
    public function getId();

    /**
     * Gets title.
     *
     * @return string
     */
    public function getTitle();

    /**
     * Sets title.
     *
     * @param string $title The title
     *
     * @return \Myclapboard\UserBundle\Model\ReviewInterface
     */
    public function setTitle($title);

    /**
     * Gets content.
     *
     * @return string
     */
    public function getContent();

    /**
     * Sets content.
     *
     * @param string $content The content
     *
     * @return \Myclapboard\UserBundle\Model\ReviewInterface
     */
    public function setContent($content);

    /**
     * Gets created date.
     *
     * @return \DateTime
     */
    public function getCreatedAt();

    /**
     *  Sets created date.
     *
     * @param \DateTime $createdAt The created date
     *
     * @return \Myclapboard\UserBundle\Model\ReviewInterface
     */
    public function setCreatedAt(\DateTime $createdAt);

    /**
     * Gets updated date.
     *
     * @return \DateTime
     */
    public function getUpdatedAt();

    /**
     * Sets updated date.
     *
     * @param \DateTime $updatedAt The updated date
     *
     * @return \Myclapboard\UserBundle\Model\ReviewInterface
     */
    public function setUpdatedAt($updatedAt);

    /**
     * Gets locale.
     *
     * @return string
     */
    public function getLocale();

    /**
     * Sets locale.
     *
     * @param string $locale The locale
     *
     * @return \Myclapboard\UserBundle\Model\ReviewInterface
     */
    public function setLocale($locale);

    /**
     * Gets movie.
     *
     * @return \Myclapboard\UserBundle\Model\ReviewInterface
     */
    public function getMovie();

    /**
     * Sets movie.
     *
     * @param \Myclapboard\MovieBundle\Model\MovieInterface $movie The movie object
     *
     * @return \Myclapboard\UserBundle\Model\ReviewInterface
     */
    public function setMovie(MovieInterface $movie);

    /**
     * Gets user.
     *
     * @return \Myclapboard\UserBundle\Model\AccountInterface
     */
    public function getUser();

    /**
     * Sets user.
     *
     * @param \Myclapboard\UserBundle\Model\AccountInterface $user The user object
     *
     * @return \Myclapboard\UserBundle\Model\ReviewInterface
     */
    public function setUser(AccountInterface $user);
}
