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
 * Interface ReviewInterface.
 *
 * @package Myclapboard\UserBundle\Model\Interfaces
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
     * @return $this self Object
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
     * @return $this self Object
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
     * @return $this self Object
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
     * @return $this self Object
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
     * @return $this self Object
     */
    public function setLocale($locale);

    /**
     * Gets movie.
     *
     * @return \Myclapboard\UserBundle\Model\Interfaces\ReviewInterface
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
     * Gets user.
     *
     * @return \Myclapboard\UserBundle\Model\Interfaces\AccountInterface
     */
    public function getUser();

    /**
     * Sets user.
     *
     * @param \Myclapboard\UserBundle\Model\Interfaces\AccountInterface $user The user object
     *
     * @return $this self Object
     */
    public function setUser(AccountInterface $user);
}
